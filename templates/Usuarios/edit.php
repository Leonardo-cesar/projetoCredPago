<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario $usuario
 */
?>
<div>
    <?= $this->Form->create($usuario) ?>
    <div class="mb-3">
        <?php echo $this->Form->control('nome', ['class' => "form-control", 'required']); ?>
    </div>
    <div class="mb-3">
        <?php echo $this->Form->control('usuario', ['class' => "form-control", 'required']); ?>
    </div>
    <hr />
    <?= $this->Form->button(__('Editar'), ['class' => 'button btn btn-warning']) ?>
    <?= $this->Html->link('Voltar', '/urls', ['class' => "btn btn-danger"]) ?>
    <?= $this->Form->end() ?>
</div>
