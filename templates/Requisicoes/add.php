<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Requisico $requisico
 * @var \Cake\Collection\CollectionInterface|string[] $urls
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Requisicoes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="requisicoes form content">
            <?= $this->Form->create($requisico) ?>
            <fieldset>
                <legend><?= __('Add Requisico') ?></legend>
                <?php
                    echo $this->Form->control('url_id', ['options' => $urls, 'empty' => true]);
                    echo $this->Form->control('data_requisicao', ['empty' => true]);
                    echo $this->Form->control('http');
                    echo $this->Form->control('corpo');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
