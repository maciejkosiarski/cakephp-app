<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Meals Controller
 *
 * @property \App\Model\Table\MealsTable $Meals
 */
class MealsController extends AppController
{
    
    public function isAuthorized($user)
    {
        // All registered users can add new meal
        if ($this->request->action === 'add') {
            $dayId = (int)$this->request->params['pass'][0];
            if ($this->Meals->isOwnedDay($dayId, $user['id']) || $user['role'] == '3') {
                return true;
            }else{
                $this->Flash->error(__('You dont have access.'));
                $this->redirect('/');
                return false;
            }
        }
        
        // The owner of an week can edit and delete days belongs to it
        if (in_array($this->request->action, ['edit', 'delete'])) {
            $mealsId = (int)$this->request->params['pass'][0];
            if ($this->Meals->isOwnedMeal($mealsId, $user['id']) || $user['role'] == '3') {
                return true;
            }else{
                $this->Flash->error(__('You dont have access.'));
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
        $this->paginate = [
            'contain' => ['Dishes', 'Days']
        ];
        $meals = $this->paginate($this->Meals->find()->contain([
            'Days.Daytimes',
            'MealsTypes'
        ]));
        
        $this->set(compact('meals'));
        $this->set('_serialize', ['meals']);
    }

    /**
     * View method
     *
     * @param string|null $id Meal id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $meal = $this->Meals->get($id, [
            'contain' => ['Dishes', 'Days']
        ]);

        $this->set('meal', $meal);
        $this->set('_serialize', ['meal']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        $meal = $this->Meals->newEntity();
        if($id){
            $day = $this->Meals->Days->get($id, [
                'contain' => ['Meals.MealsTypes']
            ]);
        }
        if ($this->request->is(['put', 'post'])) {
            $meal = $this->Meals->patchEntity($meal, $this->request->data);
            if(!$this->Meals->exists(['day_id' => $this->request->data['day_id'], 'type' => $this->request->data['type']])){
                if ($this->Meals->save($meal)) {
                    $this->Flash->success(__('The meal has been saved.'));
                    if($id){
                    return $this->redirect('/week/'.$day['week_id']);
                    }else{
                        return $this->redirect('/');
                    }
                    
                } else {
                    $this->Flash->error(__('The meal could not be saved. Please, try again.'));
                }
            }else{
                if($id){
                    $this->Flash->error(__('W dniu znajduje się już ten posiłek.'));
                    return $this->redirect('/week/'.$day['week_id']);
                }
                
                $this->Flash->error(__('W dniu znajduje się już ten posiłek.'));
            }
        }
        $dishes = $this->Meals->Dishes->find('list', ['limit' => 200]);
        $days = $this->Meals->Days->find('list', [
            'keyField' => 'id',
            'valueField' => 'daytime.name',
        ])->contain([
            'Daytimes' => function($q){
            return $q
                ->select(['name']);
            }
        ]);
        
        $mealsTypesToRmove = array();
        foreach ($day['meals'] as $meal){
           $mealsTypesToRmove[$meal->meals_type['id']] = $meal->meals_type['name'];
        }
        $mealsTypes = $this->Meals->MealsTypes->find('list', ['limit' => 200]);
        $mealsTypes = array_diff($mealsTypes->toArray(),$mealsTypesToRmove);
        $this->set(compact('meal', 'dishes', 'day', 'mealsTypes'));
        $this->set('_serialize', ['meal']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Meal id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $meal = $this->Meals->get($id, [
            'contain' => ['Dishes', 'Days.Daytimes', 'MealsTypes']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $meal = $this->Meals->patchEntity($meal, $this->request->data);
            if ($this->Meals->save($meal)) {
                $this->Flash->success(__('The meal has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The meal could not be saved. Please, try again.'));
            }
        }
        $dishes = $this->Meals->Dishes->find('list', ['limit' => 200]);
         $days = $this->Meals->Days->find('list', [
            'keyField' => 'id',
            'valueField' => 'daytime.name',
            ])->contain([
                'Daytimes' => function($q){
                return $q
                    ->select(['name']);
                }
        ]);
        $mealsTypes = $this->Meals->MealsTypes->find('list', ['limit' => 200]);
        $this->set(compact('meal', 'dishes', 'days', 'mealsTypes'));
        $this->set('_serialize', ['meal']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Meal id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $meal = $this->Meals->get($id, [
            'contain' => ['Days']
        ]);
        
        if ($this->Meals->delete($meal)) {
            $this->Flash->success(__('The meal has been deleted.'));
            return $this->redirect('/week/'.$meal->day->week_id);
        } else {
            $this->Flash->error(__('The meal could not be deleted. Please, try again.'));
            return $this->redirect('/');
        }
    }
}
