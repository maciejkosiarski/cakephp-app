<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * DishesTypes Controller
 *
 * @property \App\Model\Table\DishesTypesTable $DishesTypes
 */
class DishesTypesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $dishesTypes = $this->paginate($this->DishesTypes);

        $this->set(compact('dishesTypes'));
        $this->set('_serialize', ['dishesTypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Dishes Type id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $dishesType = $this->DishesTypes->get($id, [
            'contain' => []
        ]);

        $this->set('dishesType', $dishesType);
        $this->set('_serialize', ['dishesType']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $dishesType = $this->DishesTypes->newEntity();
        if ($this->request->is('post')) {
            $dishesType = $this->DishesTypes->patchEntity($dishesType, $this->request->data);
            if ($this->DishesTypes->save($dishesType)) {
                $this->Flash->success(__('The dishes type has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The dishes type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('dishesType'));
        $this->set('_serialize', ['dishesType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Dishes Type id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $dishesType = $this->DishesTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dishesType = $this->DishesTypes->patchEntity($dishesType, $this->request->data);
            if ($this->DishesTypes->save($dishesType)) {
                $this->Flash->success(__('The dishes type has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The dishes type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('dishesType'));
        $this->set('_serialize', ['dishesType']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Dishes Type id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $dishesType = $this->DishesTypes->get($id);
        if ($this->DishesTypes->delete($dishesType)) {
            $this->Flash->success(__('The dishes type has been deleted.'));
        } else {
            $this->Flash->error(__('The dishes type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
