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
        <?php echo $this->Form->control('nome', ['class' => "form-control", 'disabled']); ?>
    </div>
    <div class="mb-3">
        <?php echo $this->Form->control('url', ['class' => "form-control", 'disabled', 'type' => "url", 'required', 'placeholder' => 'http://exemple.com']); ?>
    </div>
    <hr />
    <?= $this->Html->link('Voltar', '/urls', ['class' => "btn btn-danger"]) ?>
    <?= $this->Form->end() ?>
</div>