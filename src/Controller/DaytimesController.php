<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Daytimes Controller
 *
 * @property \App\Model\Table\DaytimesTable $Daytimes
 */
class DaytimesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $daytimes = $this->paginate($this->Daytimes);

        $this->set(compact('daytimes'));
        $this->set('_serialize', ['daytimes']);
    }

    /**
     * View method
     *
     * @param string|null $id Daytime id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $daytime = $this->Daytimes->get($id, [
            'contain' => ['Days']
        ]);

        $this->set('daytime', $daytime);
        $this->set('_serialize', ['daytime']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $daytime = $this->Daytimes->newEntity();
        if ($this->request->is('post')) {
            $daytime = $this->Daytimes->patchEntity($daytime, $this->request->data);
            if ($this->Daytimes->save($daytime)) {
                $this->Flash->success(__('The daytime has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The daytime could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('daytime'));
        $this->set('_serialize', ['daytime']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Daytime id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $daytime = $this->Daytimes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $daytime = $this->Daytimes->patchEntity($daytime, $this->request->data);
            if ($this->Daytimes->save($daytime)) {
                $this->Flash->success(__('The daytime has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The daytime could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('daytime'));
        $this->set('_serialize', ['daytime']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Daytime id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $daytime = $this->Daytimes->get($id);
        if ($this->Daytimes->delete($daytime)) {
            $this->Flash->success(__('The daytime has been deleted.'));
        } else {
            $this->Flash->error(__('The daytime could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
