<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['register', 'verifyEmail']);
    }
    
    public function isAuthorized($user)
    {
        $action = $this->request->params['action'];

        //Only superadmin can add, edit and delete all things
        if (in_array($this->request->action, ['view', 'add', 'edit', 'delete'])) {
            if($this->Auth->user('role') == 3) {
                return true;
            }
        }

        if (in_array($this->request->action, ['panel', 'logout', 'changePass'])) {
            if($this->Auth->user()) {
                return true;
            }else{
                return $this->redirect(['controller' => 'users', 'action' => 'login']);
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
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }
    
    /**
     * Login method
     */
    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Flash->success('Zalogowano pomyślnie');
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Adres email bądź hasło są niepoprawne.');
        }
    }

    /**
     * Logout method
     */
    public function logout()
    {
        $this->Flash->success('Wylogowano pomyślnie');
        $this->Auth->logout();
        return $this->redirect($this->Auth->logout());
    }

    /**
     * Register method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function register()
    {
        $user = $this->Users->newEntity();
        if($this->request->is('post'))
        {
            $user = $this->Users->patchEntity($user, $this->request->data);
            //$user['modified'] = NULL;
            //$user['permission'] = 0;
            //$user['verify'] = 0;
            $user['hash'] = '';
            
            if($this->Users->save($user))
            {
//                $email = new Email('default');
//                $email->from(['maciek.kosiarski@gmail.com' => 'Weryfikacja'])
//                    ->template('register')
//                    ->to($user['email'])
//                    ->emailFormat('html')
//                    ->viewVars(['email' => $user['email'], 'password' => $user['confirm_password'], 'hash' => $user['hash']])
//                    ->subject('Rejestracja')
//                    ->send();

                $this->Flash->success('Rejestracja zakończona pomyślnie. Na podany adres email wysłany został mail, potwierdź go jeśli chcesz aktywować konto.');
                return $this->redirect(['action'=>'login']);
            }
            else
            {
                $this->Flash->error('Błędy w formularzu.');
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * verify email method
     *
     * @param string $email User email.
     * @param string $hash User hash.
     */
    public function verifyEmail()
    {
        $email = $this->request->pass[0];
        $hash = $this->request->pass[1];
       
        if($email === null || $hash === null){
            $this->Flash->error('Błędny adres URL. Użyj tego który został wysłany w mailu.');
        }else{
            $user = $this->Users->find()->all()->where(['email' => $email, 'hash' => $hash]);
            $userToVerify = $user->rowCount();
            if($userToVerify){
                
                $user->update()->set(['verify' => true]);

                $this->Flash->success('Email został potwierdzony. Dziękujemy');
            }else{
                $this->Flash->error('Błędny adres URL albo konto posiada już zweryfikowany adres email(można to sprawdzić po zalogowaniu się w panelu użytkownika).');
            }
        }
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Dishes', 'Ingredients', 'Weeks']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
