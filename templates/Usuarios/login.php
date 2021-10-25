<div class="col-md-6 col-sm-12">
    <div class="login-form">
        <?= $this->Flash->render() ?>
        <?= $this->Form->create(null, ['class' => 'mt-4']) ?>
        <div class="form-group">
            <label>Usuário</label>
            <?= $this->Form->control('usuario', ['required' => true, 'class' => 'form-control', 'div' => false, 'label' => false, 'placeholder' => 'Digite o usuário']) ?>
        </div>
        <div class="form-group">
            <label>Senha</label>
            <?= $this->Form->control('password', ['required' => true, 'type' => 'password', 'class' => 'form-control', 'div' => false, 'label' => false, 'placeholder' => 'Digite a senha']) ?>
        </div>
        <?= $this->Form->submit(__('Logar'), ['class' => 'btn btn-black', 'style' => 'float: left;margin-right: 5px;']); ?>
        <?= $this->Html->link('Registrar', '/usuarios/cadastrar', ['class' => "btn btn-success"]) ?>
        </form>
    </div>
</div>