<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Url $url
 * @var \Cake\Collection\CollectionInterface|string[] $usuarios
 */
?>
<div>
    <?= $this->Form->create($url) ?>
    <div class="mb-3">
        <?php echo $this->Form->control('nome', ['class' => "form-control", 'required']); ?>
    </div>
    <div class="mb-3">
        <?php echo $this->Form->control('url', ['class' => "form-control", 'type' => "url", 'required', 'placeholder' => 'http://exemple.com']); ?>
    </div>
    <hr />
    <?php echo $this->Form->control('usuario_id', ['value' => $this->request->getSession()->read('Auth.id'), 'type' => 'hidden']); ?>
    <?= $this->Form->button(__('Editar'), ['class' => 'button btn btn-warning']) ?>
    <?= $this->Html->link('Voltar', '/urls', ['class' => "btn btn-danger"]) ?>
    <?= $this->Form->end() ?>
</div>