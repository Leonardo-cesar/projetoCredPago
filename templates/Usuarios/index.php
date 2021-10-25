<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario[]|\Cake\Collection\CollectionInterface $usuarios
 */
?>
<div class="usuarios index content">
    <?= $this->Html->link(__('Novo Usuário'), ['action' => 'add'], ['class' => 'button float-right btn btn-success']) ?>
    <h3><?= __('Usuarios') ?></h3>
    <hr />
    <div class="table-responsive">
        <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('nome') ?></th>
                    <th><?= $this->Paginator->sort('usuario') ?></th>
                    <th><?= $this->Paginator->sort('ultimo_acesso') ?></th>
                    <th><?= $this->Paginator->sort('ativo') ?></th>
                    <th class="actions"><?= __('Ações') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario) :
                    if ($usuario->id != 1) {
                ?>
                        <tr>
                            <td><?= $this->Number->format($usuario->id) ?></td>
                            <td><?= h($usuario->nome) ?></td>
                            <td><?= h($usuario->usuario) ?></td>
                            <td><?= $usuario->ultimo_acesso->i18nFormat('dd/MM/yyyy HH:mm:ss') ?></td>
                            <td><?= $usuario->ativo == 's' ? 'Sim' : 'Não' ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('Ver'), ['action' => 'view', $usuario->id], ['class' => "btn btn-info btn-sm"]) ?>
                                <?= $this->Html->link(__('Editar'), ['action' => 'edit', $usuario->id], ['class' => "btn btn-warning btn-sm"]) ?>
                                <?php if ($usuario->ativo == 's') { ?>
                                    <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $usuario->id], ['class' => "btn btn-danger btn-sm"], ['confirm' => __(
                                        'Deseja deletar o usuário # {0}?',
                                        $usuario->nome
                                    )]) ?>
                                <?php } else { ?>
                                    <?= $this->Form->postLink(__('Ativar'), ['action' => 'ativar', $usuario->id], ['class' => "btn btn-success btn-sm"], ['confirm' => __(
                                        'Deseja reativar o usuário # {0}?',
                                        $usuario->nome
                                    )]) ?>
                                <?php } ?>
                            </td>
                        </tr>
                <?php }
                endforeach; ?>
            </tbody>
        </table>
    </div>
</div>