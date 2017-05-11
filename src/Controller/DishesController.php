<?php
namespace App\Controller;

use Cake\ORM\TableRegistry;
use App\Controller\AppController;

/**
 * Dishes Controller
 *
 * @property \App\Model\Table\DishesTable $Dishes
 */
class DishesController extends AppController
{
    
    public function isAuthorized($user)
    {
        // All registered users can add new dish
        if (in_array($this->request->action, ['index', 'view', 'add'])) {
            return true;
        }
        
        // The makerof dish can edit and delete it
        if (in_array($this->request->action, ['edit', 'delete'])) {
            $dishId = (int)$this->request->params['pass'][0];
            if ($this->Dishes->isOwnedBy($dishId, $user['id']) || $user['role'] == '3') {
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
            'contain' => ['DishesTypes']
        ];
        $dishes = $this->paginate($this->Dishes);

        $this->set(compact('dishes'));
        $this->set('_serialize', ['dishes']);
    }

    /**
     * View method
     *
     * @param string|null $id Dish id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $dish = $this->Dishes->get($id, [
            'contain' => ['Components.Ingredients', 'DishesTypes']
        ]);
        
        $dishesTypes = $this->Dishes->DishesTypes->find('list');
        
        $this->set(compact('dish', 'dishesTypes'));
        $this->set('_serialize', ['dish']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($weekId = null)
    {
        $dish = $this->Dishes->newEntity();
        $ingredientsTable = TableRegistry::get('Ingredients');
        $ingredient = $ingredientsTable->newEntity();
        if ($this->request->is('post')) {
            if(isset($this->request->data['notes'])){
                $dish->user_id = $this->Auth->user('id');
                $ingredients = $this->request->data['ingredients'];
                unset($this->request->data['ingredients']);
                $dish = $this->Dishes->patchEntity($dish, $this->request->data);
                if ($this->Dishes->save($dish)) {
                    $dishId = $dish->id;

                    foreach ($ingredients as $ingredient){
                        $componentsTable = TableRegistry::get('Components');
                        $component = $componentsTable->newEntity();
                        $component->dish_id = $dishId;
                        $component->ingredient_id = $ingredient;
                        if(!$componentsTable->save($component)){
                            $this->Flash->error(__('The components could not be saved. Please, try again.'));
                        }

                    }
                    $this->Flash->success(__('The dish has been saved.'));
                    if($weekId){
                        return $this->redirect(['controller' => 'Weeks', 'action' => 'view', $weekId]);
                    }else{
                        return $this->redirect(['action' => 'index']);
                    }
                } else {
                    $this->Flash->error(__('The dish could not be saved. Please, try again.'));
                }
            }else{
                $ingredient = $ingredientsTable->patchEntity($ingredient, $this->request->data);
                if($ingredientsTable->save($ingredient)){
                    $this->Flash->success(__('The ingredient has been saved.'));
                    return $this->redirect(['controller' => 'Dishes', 'action' => 'add', $weekId]);
                }
            }
            
        }
        $ingredientsByType = $ingredientsTable->find()->order(['type' => 'ASC'])->groupBy('type');
        $ingredientsTypesTable = TableRegistry::get('IngredientsTypes');
        $ingredientsTypes = $ingredientsTypesTable->find('list');
        $dishesTypes = $this->Dishes->DishesTypes->find('list');
        $this->set(compact('dish', 'dishesTypes', 'ingredient', 'ingredientsByType', 'ingredientsTypes', 'weekId'));
        $this->set('_serialize', ['dish']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Dish id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
//        debug($this->request->data);
//        die;
        $dish = $this->Dishes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ingredients = $this->request->data['ingredients'];
            unset($this->request->data['ingredients']);
            $dish = $this->Dishes->patchEntity($dish, $this->request->data);

            if ($this->Dishes->save($dish)) {
                if(!$ingredients == ''){
                    $dishId = $dish->id;
                    $componentsTable = TableRegistry::get('Components');
                    foreach ($ingredients as $ingredient){
                        if(!$componentsTable->exists(['dish_id' => $dishId, 'ingredient_id' => $ingredient])){
                            $component = $componentsTable->newEntity();
                            $component->dish_id = $dishId;
                            $component->ingredient_id = $ingredient;
                            if(!$componentsTable->save($component)){
                                $this->Flash->error(__('The components could not be saved. Please, try again.'));
                            } 
                        }

                    }
                }
                
                $this->Flash->success(__('The dish has been saved.'));

                return $this->redirect('/dish/'.$id);
            } else {
                $this->Flash->error(__('The dish could not be saved. Please, try again.'));
            }
        }
        $querry = TableRegistry::get('Ingredients');
        $ingredients = $querry->find('list');
        $dishesTypes = $this->Dishes->DishesTypes->find('list');
        $this->set(compact('dish', 'dishesTypes', 'ingredients'));
        $this->set('_serialize', ['dish']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Dish id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $dish = $this->Dishes->get($id);
        if ($this->Dishes->delete($dish)) {
            $this->Flash->success(__('The dish has been deleted.'));
        } else {
            $this->Flash->error(__('The dish could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
