<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * Weeks Controller
 *
 * @property \App\Model\Table\WeeksTable $Weeks
 */
class WeeksController extends AppController
{
    
    public function isAuthorized($user)
    {
        // All registered users can add new week
        if (in_array($this->request->action, ['index', 'add', 'shoppingList'])) {
            return true;
        }

        // The owner of an article can edit and delete it
        if (in_array($this->request->action, ['view', 'edit', 'delete'])) {
            $weekId = (int)$this->request->params['pass'][0];
            if ($this->Weeks->isOwnedBy($weekId, $user['id']) || $user['role'] == '3') {
                return true;
            }else{
                $this->Flash->error(__('You dont have acces.'));
                $this->redirect('/');
                return false;
            }
        }

        return parent::isAuthorized($user);
    }
    
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $week = $this->Weeks->newEntity();
        if($this->Auth->user('role') == '3'){
           $weeks = $this->paginate($this->Weeks->find());
        }else{
           $weeks = $this->paginate($this->Weeks->find('all')
                                                ->contain(['Days' => function($q) {
                                                            $q->select([
                                                                 'Days.week_id',
                                                                 'total' => $q->func()->count('Days.week_id')
                                                            ])
                                                            ->group(['Days.week_id']);
                                                            return $q;
                                                }])
                                                ->where(['user_id' => $this->Auth->user('id')]));
        }
        
        $thumbnailsDir = new Folder(WWW_ROOT . 'img/thumbnails');
        $thumbnails = $thumbnailsDir->find('.*\.jpg');
        $thumbnails = $this->Weeks->getThumbNames($thumbnails);

        $this->set(compact('weeks'));
        $this->set('_serialize', ['weeks']);
        $this->set(compact('thumbnails'));
        $this->set('_serialize', ['thumbnails']);
        $this->set(compact('week'));
        $this->set('_serialize', ['week']);
    }

    /**
     * View method
     *
     * @param string|null $id Week id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $week = $this->Weeks->get($id, [
            'contain' => ['Days.Daytimes', 'Days.Meals.MealsTypes', 'Days.Meals.Dishes.DishesTypes']
        ]);
        $week->daysQuantity = count($week->days);
        usort($week->days, function($a, $b) {
            return $a['daytime_id'] - $b['daytime_id'];
        });
        
        foreach($week->days as $day){
            $day->mealsQuantity = count($day->meals);
            usort($day->meals, function($a, $b) {
                return $a['type'] - $b['type'];
            });
        }
        
        $mealsTypes = $this->Weeks->Days->Meals->MealsTypes->find('list', ['limit' => 200]);
        $dishes = $this->Weeks->Days->Meals->Dishes->find('list', ['limit' => 200]);
        $day = $this->Weeks->Days->newEntity();

        $this->set('week', $week);
        $this->set('_serialize', ['week']);
        $this->set(compact('day', 'dishes', 'mealsTypes'));
        $this->set('_serialize', ['day']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $week = $this->Weeks->newEntity();
        if ($this->request->is('post')) {
            $week->user_id = $this->Auth->user('id');
            $week = $this->Weeks->patchEntity($week, $this->request->data);
            if ($this->Weeks->save($week)) {
                $this->Flash->success(__('The week has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The week could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('week'));
        $this->set('_serialize', ['week']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Week id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $week = $this->Weeks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $week = $this->Weeks->patchEntity($week, $this->request->data);
            if ($this->Weeks->save($week)) {
                $this->Flash->success(__('The week has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The week could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('week'));
        $this->set('_serialize', ['week']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Week id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $week = $this->Weeks->get($id);
        if ($this->Weeks->delete($week)) {
            $this->Flash->success(__('The week has been deleted.'));
        } else {
            $this->Flash->error(__('The week could not be deleted. Please, try again.'));
        }

        return $this->redirect('/');
    }
    
    /**
     * getShoppingList method
     *
     * @param string|null $id Week id.
     * @return array $shopingList 
     * 
     */
    public function shoppingList($id = null)
    {
        $this->autoRender = false;
       
        $week = $this->Weeks->get($id, [
            'contain' => ['Days.Meals.Dishes.Components.Ingredients.IngredientsTypes']
        ]);
        
        $shoppingList = $this->Weeks->getShoppingList($week);
        
        echo json_encode($shoppingList);
    }
}
