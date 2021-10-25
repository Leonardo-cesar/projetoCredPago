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
        <div class="usuario alert alert-danger" role="alert" style="display: none;">
            O usuário já esta cadastrado
        </div>
    </div>
    <div class="mb-3">
        <?php echo $this->Form->control('password', ['class' => "form-control", 'required', 'type' => 'password']); ?>
    </div>
    <div class="mb-3">
        <?php echo $this->Form->control('c_password', ['class' => "form-control", 'type' => 'password', 'label' => 'Confirmar Senha', 'required']); ?>
        <div class="senhas alert alert-danger" role="alert" style="display: none;">
            As Senhas não são iguais!
        </div>
    </div>
    <hr />
    <?= $this->Form->button(__('Cadastrar'), ['class' => 'btn-usuario button btn btn-success', 'disabled']) ?>
    <?= $this->Html->link('Voltar', '/usuarios/login', ['class' => "btn btn-danger"]) ?>
    <?= $this->Form->end() ?>
</div>