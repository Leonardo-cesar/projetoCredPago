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

    // CRON QUE FAZ A VERIFICAÇÃO DAS URLS A CADA 1 MINUTO
    public function cron()
    {
        // DESABILITA O TEMPLATE
        $this->autoRender = false;

        //BUSCA AS URLS
        $urls = $this->Requisicoes->Urls->find('list', ['valueField' => 'url']);

        // FAZ O LAÇO E ARMAZENA O RESULTADO
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

    // LISTA AS REQUISIÇÕES NA HOME
    public function listar()
    {
        $conditions = array();
        // VERIFICA SE É O ADMINISTRADOR PARA LISTAR TODAS
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

    // RESPONSAVÉL POR GERAR OS DADOS PARA O GRÁFICO 
    public function grafico()
    {
        $conditions = array();
        // VERIFICA SE É O ADMINISTRADOR PARA LISTAR TODAS
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
}
