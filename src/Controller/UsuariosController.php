<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Event\EventInterface;

/**
 * Usuarios Controller
 *
 * @property \App\Model\Table\UsuariosTable $Usuarios
 * @method \App\Model\Entity\Usuario[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsuariosController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['login', 'cadastrar', 'verificaUsuario']);
    }

    public function login()
    {
        $this->set('title', 'Login Sistema - CREDPAGO');
        $this->viewBuilder()->setLayout('login');

        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            return $this->redirect('/home');
        }
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Usuário ou senha inválido!'));
        }
    }

    public function logout()
    {
        $this->Authentication->logout();
        return $this->redirect(['controller' => 'Usuarios', 'action' => 'login']);
    }

    public function senha($id = null)
    {
        if ($this->request->getSession()->read('Auth.id') != $id || $id == null) {
            $this->Flash->error(__('Sem permissão!'));
            return $this->redirect('/home');
        }

        $usuario = $this->Usuarios->get($id, []);

        if ($this->request->is(['patch', 'post', 'put'])) {
            if (strlen($this->request->getData('password')) > 0) {
                $pass = (new DefaultPasswordHasher)->hash($this->request->getData('password'));
            }

            $this->Usuarios->updateAll(['password' => $pass], ['id' => $id]);
            $this->Flash->success(__('Senha editada com sucesso!'));

            return $this->redirect(['action' => 'senha', $id]);
        }
        $this->set(compact('usuario'));
    }

    public function verificaUsuario()
    {
        if ($this->request->getQuery('nome') != '') {
            $usuario = $this->Usuarios->find('all', ['conditions' => ['nome LIKE "%' . $this->request->getQuery('nome') . '%"']])->first();
        }

        if ($usuario == '') {
            $usuario = array();
        }

        $this->set(['usuario' => $usuario]);
        $this->viewBuilder()->setOption('serialize', true);
        $this->RequestHandler->renderAs($this, 'json');
    }
    
    public function cadastrar()
    {
        $this->viewBuilder()->setLayout('cadastrar');
        $usuario = $this->Usuarios->newEmptyEntity();
        if ($this->request->is('post')) {
            $this->request->getData['usuario'] = $this->request->getData();
            $pass = (new DefaultPasswordHasher)->hash($this->request->getData('password'));
            $this->request->getData['usuario']['password'] = $pass;
            $this->request->getData['usuario']['ultimo_acesso'] = date("Y-m-d H:i:s");

            $usuario = $this->Usuarios->patchEntity($usuario, $this->request->getData['usuario']);
            if ($this->Usuarios->save($usuario)) {
                $this->Flash->success(__('Cadastrado com sucesso'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Erro Tente novamente'));
        }
        $this->set(compact('usuario'));
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {

        if ($this->request->getSession()->read('Auth.id') != 1) {
            $this->Flash->error(__('Sem permissão!'));
            return $this->redirect('/home');
        }

        $usuarios = $this->Usuarios->find('all');

        $this->set(compact('usuarios'));
    }

    /**
     * View method
     *
     * @param string|null $id Usuario id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $usuario = $this->Usuarios->get($id, [
            'contain' => ['Urls'],
        ]);

        $this->set(compact('usuario'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $usuario = $this->Usuarios->newEmptyEntity();
        if ($this->request->is('post')) {
            $this->request->getData['usuario'] = $this->request->getData();
            $pass = (new DefaultPasswordHasher)->hash($this->request->getData('password'));
            $this->request->getData['usuario']['password'] = $pass;
            $this->request->getData['usuario']['ultimo_acesso'] = date("Y-m-d H:i:s");

            $usuario = $this->Usuarios->patchEntity($usuario, $this->request->getData['usuario']);
            if ($this->Usuarios->save($usuario)) {
                $this->Flash->success(__('Cadastrado com sucesso'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Erro Tente novamente'));
        }
        $this->set(compact('usuario'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Usuario id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {

        if ($this->request->getSession()->read('Auth.id') != $id || $id == null) {
            $this->Flash->error(__('Sem permissão!'));
            return $this->redirect('/home');
        }

        $usuario = $this->Usuarios->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usuario = $this->Usuarios->patchEntity($usuario, $this->request->getData());
            if ($this->Usuarios->save($usuario)) {
                $this->Flash->success(__('Usuário editado com sucesso.'));

                return $this->redirect('/home');
            }
            $this->Flash->error(__('Erro Tente novamente'));
        }
        $this->set(compact('usuario'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Usuario id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $this->Usuarios->updateAll(['ativo' => 'n'], ['id' => $id]);
        $this->Flash->success(__('Usuário deletado com sucesso'));

        return $this->redirect(['action' => 'index']);
    }

    public function ativar($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $this->Usuarios->updateAll(['ativo' => 's'], ['id' => $id]);
        $this->Flash->success(__('Usuário reativado com sucesso'));

        return $this->redirect(['action' => 'index']);
    }
}
