<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Url[]|\Cake\Collection\CollectionInterface $urls
 */
?>
<div class="urls index content">
    <?= $this->Html->link(__('Nova Url'), ['action' => 'add'], ['class' => 'button float-right btn btn-success']) ?>
    <h3><?= __('Urls') ?></h3>
    <hr />
    <div class="table-responsive">
        <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('nome') ?></th>
                    <th><?= $this->Paginator->sort('URL') ?></th>
                    <th class="actions"><?= __('Ações') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($urls as $url) : ?>
                    <tr>
                        <td><?= $this->Number->format($url->id) ?></td>
                        <td><?= h($url->nome) ?></td>
                        <td><?= h($url->url) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('Ver'), ['action' => 'view', $url->id], ['class' => "btn btn-info btn-sm"]) ?>
                            <?= $this->Html->link(__('Editar'), ['action' => 'edit', $url->id], ['class' => "btn btn-warning btn-sm"]) ?>
                            <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $url->id], ['class' => "btn btn-danger btn-sm"], ['confirm' => __(
                                'Deseja deletar a URL # {0}?',
                                $url->nome
                            )]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>