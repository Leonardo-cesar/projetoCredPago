<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario $usuario
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Usuario'), ['action' => 'edit', $usuario->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Usuario'), ['action' => 'delete', $usuario->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usuario->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Usuarios'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Usuario'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="usuarios view content">
            <h3><?= h($usuario->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nome') ?></th>
                    <td><?= h($usuario->nome) ?></td>
                </tr>
                <tr>
                    <th><?= __('Usuario') ?></th>
                    <td><?= h($usuario->usuario) ?></td>
                </tr>
                <tr>
                    <th><?= __('Permissao') ?></th>
                    <td><?= h($usuario->permissao) ?></td>
                </tr>
                <tr>
                    <th><?= __('Ativo') ?></th>
                    <td><?= h($usuario->ativo) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($usuario->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Ultimo Acesso') ?></th>
                    <td><?= h($usuario->ultimo_acesso) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($usuario->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($usuario->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Urls') ?></h4>
                <?php if (!empty($usuario->urls)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Nome') ?></th>
                            <th><?= __('Url') ?></th>
                            <th><?= __('Ativo') ?></th>
                            <th><?= __('Usuario Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($usuario->urls as $urls) : ?>
                        <tr>
                            <td><?= h($urls->id) ?></td>
                            <td><?= h($urls->nome) ?></td>
                            <td><?= h($urls->url) ?></td>
                            <td><?= h($urls->ativo) ?></td>
                            <td><?= h($urls->usuario_id) ?></td>
                            <td><?= h($urls->created) ?></td>
                            <td><?= h($urls->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Urls', 'action' => 'view', $urls->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Urls', 'action' => 'edit', $urls->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Urls', 'action' => 'delete', $urls->id], ['confirm' => __('Are you sure you want to delete # {0}?', $urls->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
