<?php
namespace App\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;

class CronCommand extends Command
{
    public $modelClass = "Requisicoes";

    public function execute(Arguments $args, ConsoleIo $io)
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
}