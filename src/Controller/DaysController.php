<?php
namespace App\Controller;

use Cake\ORM\TableRegistry;

use App\Controller\AppController;

/**
 * Days Controller
 *
 * @property DaysTable $Days
 */
class DaysController extends AppController
{
    
    public function isAuthorized($user)
    {
        if(isset($this->request->params['pass'][1])){
            if (in_array($this->request->action, ['view', 'edit', 'delete', 'shoppingList'])) {
                $weekId = (int)$this->request->params['pass'][1];
                if(($this->Days->exists(['id' => (int)$this->request->params['pass'][0], 'week_id' => (int)$this->request->params['pass'][1]]) && $this->Days->Weeks->isOwnedBy($weekId, $user['id'])) || $user['role'] == '3'){
                     return true;
                }else{
                    $this->Flash->error(__('You dont have access'));
                    $this->redirect('/');
                    return false; 
                }
           
            }
        }else{
            if ($this->request->action == 'add') {
                $weekId = (int)$this->request->params['pass'][0];
                if ($this->Days->Weeks->isOwnedBy($weekId, $user['id']) || $user['role'] == '3') {
                    return true;
                }else{
                    $this->Flash->error(__('You dont have access'));
                    $this->redirect('/');
                    return false;
                }
            } 
        }

        return parent::isAuthorized($user);
    }
    
    /**
     * Index method
     *
     * @return Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Weeks', 'Daytimes']
        ];
        $days = $this->paginate($this->Days);

        $this->set(compact('days'));
        $this->set('_serialize', ['days']);
    }

    /**
     * View method
     *
     * @param string|null $id Day id.
     * @return Response|null
     * @throws RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $day = $this->Days->get($id, [
            'contain' => ['Weeks', 'Daytimes', 'Meals.MealsTypes', 'Meals.Dishes']
        ]);
        $day->daysQuantity = count($day->meals);

        $this->set('day', $day);
        $this->set('_serialize', ['day']);
    }

    /**
     * Add method
     *
     * @return Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($weekId = null)
    {
        $day = $this->Days->newEntity();
        if ($this->request->is(['post', 'put'])){
            $dayData['daytime_id'] = $this->request->data['daytime_id'];
            unset($this->request->data['daytime_id']);
            if($weekId){
               $dayData['week_id'] = $weekId;
            }else{
                $dayData['week_id'] = $this->request->data['daytime_id'];
                unset($this->request->data['week_id']);
            }
            $day = $this->Days->patchEntity($day, $dayData);
            if(!$this->Days->exists(['week_id' => $dayData['week_id'], 'daytime_id' => $dayData['daytime_id']])){
                if ($this->Days->save($day)) {
                    $meals = TableRegistry::get('Meals');
                    $mealsData = $meals->parseData($day->id, $this->request->data);
                    $entities = $meals->newEntities($mealsData);
                    foreach ($entities as $entity) {
                        $meals->save($entity);
                    }
                    $this->Flash->success(__('The day has been saved.'));

                    return $this->redirect('/week/'.$dayData['week_id']);
                } else {
                    $this->Flash->error(__('The day could not be saved. Please, try again.'));
                }
            } else {
                $this->Flash->error(__('Week allredy have this day, pick another.'));
            }           
        }
        $daytimes = $this->Days->Daytimes->find('list', ['limit' => 200]);
        if($weekId){
            $week = $this->Days->Weeks->get($weekId, [
                'contain' => ['Days.Daytimes']
            ]);
            $daytimesToRemove = array();
            foreach($week['days'] as $day){
                $daytimesToRemove[$day->daytime['id']] = $day->daytime['name'];
            }
            $daytimes = array_diff($daytimes->toArray(),$daytimesToRemove);
            
        }else{
            $weeks = $this->Days->Weeks->find('list', ['limit' => 200]);
        }
        $mealsTypesTable = TableRegistry::get('MealsTypes');
        $mealsTypes = $mealsTypesTable->find();
        $dishesTable = TableRegistry::get('Dishes');
        $dishes = $dishesTable->find('list', ['limit' => 200]);     
        $this->set(compact('day', 'week', 'weeks', 'daytimes', 'dishes', 'mealsTypes'));
        $this->set('_serialize', ['day']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Day id.
     * @return Response|void Redirects on successful edit, renders view otherwise.
     * @throws NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $day = $this->Days->get($id, [
            'contain' => ['Daytimes', 'Weeks', 'Meals.MealsTypes', 'Meals.Dishes']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $day = $this->Days->patchEntity($day, $this->request->data);
            if(!$this->Days->exists(['week_id' => $this->request->data['week_id'], 'daytime_id' => $this->request->data['daytime_id']]) || $this->request->data['daytime_id'] == $day['daytime']['id']){
                if ($this->Days->save($day)) {
                    unset($this->request->data['week_id']);
                    unset($this->request->data['daytime_id']);
                    foreach ($this->request->data as $mealToEdit => $dishToEdit){
                        $data['dish_id'] = $dishToEdit;
                        $meal = $this->Days->Meals->get($mealToEdit);
                        $meal = $this->Days->Meals->patchEntity($meal, $data);
                        if (!$this->Days->Meals->save($meal)) {
                            $this->Flash->error(__('The dish could not be saved. Please, try again.'));
                        }
                    }
                    $this->Flash->success(__('The day has been saved.'));

                    return $this->redirect('/week/'.$day['week_id']);
                } else {
                    $this->Flash->error(__('The day could not be saved. Please, try again.'));
                }
            } else {
                $this->Flash->error(__('W tygodniu znajduje się już ten dzień wybierz inny.'));
            }          
        }
        $mealsQuantity = count($day['meals']);
        $mealsTypesTable = TableRegistry::get('MealsTypes');
        $mealsTypes = $mealsTypesTable->find();
        $dishesTable = TableRegistry::get('Dishes');
        $dishes = $dishesTable->find('list', ['limit' => 200]);
        $weeks = $this->Days->Weeks->find('list', ['limit' => 200]);
        $daytimes = $this->Days->Daytimes->find('list', ['limit' => 200]);
        $this->set(compact('day', 'week', 'weeks', 'daytimes', 'dishes', 'mealsTypes', 'mealsQuantity'));
        $this->set('_serialize', ['day']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Day id.
     * @return Response|null Redirects to index.
     * @throws RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $day = $this->Days->get($id);
        
        if ($this->Days->delete($day)) {
            $this->Flash->success(__('The day has been deleted.'));
        } else {
            $this->Flash->error(__('The day could not be deleted. Please, try again.'));
        }

        return $this->redirect('/week/'.$day->week_id);
    }
    
    /**
     * getShoppingList method
     *
     * @param string|null $id Day id.
     * @return array $shopingList 
     * 
     */
    public function shoppingList($id = null)
    {
        $this->autoRender = false;
        
        $day = $this->Days->get($id, [
            'contain' => ['Meals.Dishes.Components.Ingredients.IngredientsTypes']
        ]);
        
        $shoppingList = $this->Days->getShoppingList($day);

        echo json_encode($shoppingList);
    }
}
