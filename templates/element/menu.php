<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo $this->Url->build('/') ?>">
            <?php echo $this->Html->image('logo.png', ['width' => "30", 'height' => "30", 'class' => "d-inline-block align-top"]); ?>
            CredPago
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <?= $this->Html->link('Home', '/', ['class' => "nav-link"]) ?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link('Gerenciar URLs', '/urls', ['class' => "nav-link"]) ?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link('Requisições', '/requisicoes', ['class' => "nav-link"]) ?>
                </li>
                <?php if ($this->request->getSession()->read('Auth.id') == 1) { ?>
                    <li class="nav-item">
                        <?= $this->Html->link('Usuarios', '/usuarios', ['class' => "nav-link"]) ?>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="d-flex">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $this->request->getSession()->read('Auth.nome') ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><?= $this->Html->link('Editar', '/usuarios/edit/' . $this->request->getSession()->read('Auth.id'), ['class' => "dropdown-item"]) ?></li>
                        <li><?= $this->Html->link('Alterar Senha', '/usuarios/senha/' . $this->request->getSession()->read('Auth.id'), ['class' => "dropdown-item"]) ?></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><?= $this->Html->link('Sair', '/usuarios/logout/', ['class' => "dropdown-item", 'style' => 'color:red']) ?></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>