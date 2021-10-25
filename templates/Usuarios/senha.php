<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario $usuario
 */
?>
<div>
    <?= $this->Form->create($usuario) ?>
    <div class="mb-3">
        <?php echo $this->Form->control('password', ['class' => "form-control", 'required', 'type' => 'password', 'value' => '', 'autocomplete' => "off"]); ?>
    </div>
    <div class="mb-3">
        <?php echo $this->Form->control('c_password', ['class' => "form-control", 'required', 'label' => 'Confirmar senha', 'type' => 'password', 'autocomplete' => "off"]); ?>
        <div class="senhas alert alert-danger" role="alert" style="display: none;">
            As Senhas não são iguais!
        </div>
    </div>
    <hr />
    <?= $this->Form->button(__('Editar'), ['class' => 'btn-usuario button btn btn-warning', 'disabled']) ?>
    <?= $this->Html->link('Voltar', '/usuarios', ['class' => "btn btn-danger"]) ?>
    <?= $this->Form->end() ?>
</div>