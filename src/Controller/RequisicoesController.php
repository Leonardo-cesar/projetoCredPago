<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Requisicoes Controller
 *
 * @property \App\Model\Table\RequisicoesTable $Requisicoes
 * @method \App\Model\Entity\Requisico[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RequisicoesController extends AppController
{

    public function cron()
    {
        $this->autoRender = false;
        $urls = $this->Requisicoes->Urls->find('list', ['valueField' => 'url']);
        foreach ($urls as $key => $url) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 400);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

            $content = curl_exec($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $requisicao['url_id'] = $key;
            $requisicao['data_requisicao'] = date("Y-m-d H:i:s");
            $requisicao['http'] = $httpcode;
            $requisicao['corpo'] = $content;
            $requisico = $this->Requisicoes->newEmptyEntity();
            $requisico = $this->Requisicoes->patchEntity($requisico, $requisicao);
            $this->Requisicoes->save($requisico);
        }
    }

    public function listar()
    {
        $conditions = array();
        if ($this->request->getSession()->read('Auth.id') != 1) {
            $conditions = 'urls.usuario_id =' . $this->request->getSession()->read('Auth.id');
        }

        $requisicoes = $this->Requisicoes->find('all', [
            'conditions' => [$conditions],
            'fields' => ['Urls.url', 'Requisicoes.data_requisicao', 'Requisicoes.http'],
            'contain' => ['Urls'],
            'limite' => 10
        ]);
        $this->set(['requisicoes' => $requisicoes]);
        $this->viewBuilder()->setOption('serialize', true);
        $this->RequestHandler->renderAs($this, 'json');
    }

    public function grafico()
    {
        $conditions = array();
        if ($this->request->getSession()->read('Auth.id') != 1) {
            $conditions = 'urls.usuario_id =' . $this->request->getSession()->read('Auth.id');
        }

        $requisicoes = $this->Requisicoes->find('all', [
            'conditions' => [$conditions],
            'fields' => ['Requisicoes.http'],
            'contain' => ['Urls'],
            'limite' => 10
        ]);

        $dados = array();
        foreach ($requisicoes as $requisicoe) {
            array_key_exists($requisicoe->http, $dados)  ? $dados[$requisicoe->http] = $dados[$requisicoe->http] + 1 :  $dados[$requisicoe->http] = 1;
        }

        $this->set(['dados' => $dados]);
        $this->viewBuilder()->setOption('serialize', true);
        $this->RequestHandler->renderAs($this, 'json');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        
        $conditions = array();
        if ($this->request->getSession()->read('Auth.id') != 1) {
            $conditions = 'urls.usuario_id =' . $this->request->getSession()->read('Auth.id');
        }

        $requisicoes = $this->Requisicoes->find('all', [
            'conditions' => [$conditions],
            'fields' => ['Urls.url', 'Requisicoes.id', 'Requisicoes.data_requisicao', 'Requisicoes.http'],
            'contain' => ['Urls']
        ]);

        $this->set(compact('requisicoes'));
    }

    /**
     * View method
     *
     * @param string|null $id Requisico id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('ajax');
        $requisico = $this->Requisicoes->get($id, [
            'contain' => ['Urls'],
        ]);

        $this->set(compact('requisico'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $requisico = $this->Requisicoes->newEmptyEntity();
        if ($this->request->is('post')) {
            $requisico = $this->Requisicoes->patchEntity($requisico, $this->request->getData());
            if ($this->Requisicoes->save($requisico)) {
                $this->Flash->success(__('The requisico has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The requisico could not be saved. Please, try again.'));
        }
        $urls = $this->Requisicoes->Urls->find('list', ['limit' => 200])->all();
        $this->set(compact('requisico', 'urls'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Requisico id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $requisico = $this->Requisicoes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $requisico = $this->Requisicoes->patchEntity($requisico, $this->request->getData());
            if ($this->Requisicoes->save($requisico)) {
                $this->Flash->success(__('The requisico has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The requisico could not be saved. Please, try again.'));
        }
        $urls = $this->Requisicoes->Urls->find('list', ['limit' => 200])->all();
        $this->set(compact('requisico', 'urls'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Requisico id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $requisico = $this->Requisicoes->get($id);
        if ($this->Requisicoes->delete($requisico)) {
            $this->Flash->success(__('The requisico has been deleted.'));
        } else {
            $this->Flash->error(__('The requisico could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
