<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * IngredientsTypes Controller
 *
 * @property \App\Model\Table\IngredientsTypesTable $IngredientsTypes
 */
class IngredientsTypesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $ingredientsTypes = $this->paginate($this->IngredientsTypes);

        $this->set(compact('ingredientsTypes'));
        $this->set('_serialize', ['ingredientsTypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Ingredients Type id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ingredientsType = $this->IngredientsTypes->get($id, [
            'contain' => []
        ]);

        $this->set('ingredientsType', $ingredientsType);
        $this->set('_serialize', ['ingredientsType']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ingredientsType = $this->IngredientsTypes->newEntity();
        if ($this->request->is('post')) {
            $ingredientsType = $this->IngredientsTypes->patchEntity($ingredientsType, $this->request->data);
            if ($this->IngredientsTypes->save($ingredientsType)) {
                $this->Flash->success(__('The ingredients type has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The ingredients type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('ingredientsType'));
        $this->set('_serialize', ['ingredientsType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Ingredients Type id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ingredientsType = $this->IngredientsTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ingredientsType = $this->IngredientsTypes->patchEntity($ingredientsType, $this->request->data);
            if ($this->IngredientsTypes->save($ingredientsType)) {
                $this->Flash->success(__('The ingredients type has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The ingredients type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('ingredientsType'));
        $this->set('_serialize', ['ingredientsType']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Ingredients Type id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ingredientsType = $this->IngredientsTypes->get($id);
        if ($this->IngredientsTypes->delete($ingredientsType)) {
            $this->Flash->success(__('The ingredients type has been deleted.'));
        } else {
            $this->Flash->error(__('The ingredients type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
