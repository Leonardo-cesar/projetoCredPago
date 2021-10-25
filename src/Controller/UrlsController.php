<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Urls Controller
 *
 * @property \App\Model\Table\UrlsTable $Urls
 * @method \App\Model\Entity\Url[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UrlsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {

        $conditions = array();
        if ($this->request->getSession()->read('Auth.id') != 1) {
            $conditions = 'usuario_id =' . $this->request->getSession()->read('Auth.id');
        }
        
        $urls = $this->Urls->find('all', [
            'conditions' => [
                $conditions
            ]
        ]);

        $this->set(compact('urls'));
    }

    /**
     * View method
     *
     * @param string|null $id Url id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $url = $this->Urls->get($id, [
            'contain' => ['Usuarios'],
        ]);

        $this->set(compact('url'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $url = $this->Urls->newEmptyEntity();
        if ($this->request->is('post')) {
            $url = $this->Urls->patchEntity($url, $this->request->getData());
            if ($this->Urls->save($url)) {
                $this->Flash->success(__('URL cadastrada com sucesso'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Erro tente novamente.'));
        }
        $usuarios = $this->Urls->Usuarios->find('list', ['limit' => 200])->all();
        $this->set(compact('url', 'usuarios'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Url id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $url = $this->Urls->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $url = $this->Urls->patchEntity($url, $this->request->getData());
            if ($this->Urls->save($url)) {
                $this->Flash->success(__('Editada com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Erro tente novamente.'));
        }
        $usuarios = $this->Urls->Usuarios->find('list', ['limit' => 200])->all();
        $this->set(compact('url', 'usuarios'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Url id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $url = $this->Urls->get($id);
        if ($this->Urls->delete($url)) {
            $this->Flash->success(__('URL Deletada com sucesso'));
        } else {
            $this->Flash->error(__('Erro tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
