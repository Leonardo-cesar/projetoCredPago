<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Requisico[]|\Cake\Collection\CollectionInterface $requisicoes
 */
?>
<div class="requisicoes index content">
    <h3><?= __('Requisicoes') ?></h3>
    <div class="table-responsive">
        <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('url_id') ?></th>
                    <th><?= $this->Paginator->sort('data_requisicao') ?></th>
                    <th><?= $this->Paginator->sort('http') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($requisicoes as $requisico) : ?>
                    <tr>
                        <td><?= $requisico->url->url ?></td>
                        <td><?= h($requisico->data_requisicao->i18nFormat('dd/MM/yyyy HH:mm:ss')) ?></td>
                        <td><?= h($requisico->http) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('Ver Corpo'), ['action' => 'view', $requisico->id], ['target' => '_blank', 'class' => "btn btn-info btn-sm"]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>