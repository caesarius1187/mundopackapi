<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ordenot $ordenot
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $ordenot->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $ordenot->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Ordenots'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Extrusoras'), ['controller' => 'Extrusoras', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Extrusora'), ['controller' => 'Extrusoras', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Impresoras'), ['controller' => 'Impresoras', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Impresora'), ['controller' => 'Impresoras', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cortadoras'), ['controller' => 'Cortadoras', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cortadora'), ['controller' => 'Cortadoras', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Ordenesdetrabajos'), ['controller' => 'Ordenesdetrabajos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ordenesdetrabajo'), ['controller' => 'Ordenesdetrabajos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="ordenots form large-9 medium-8 columns content">
    <?= $this->Form->create($ordenot) ?>
    <fieldset>
        <legend><?= __('Edit Ordenot') ?></legend>
        <?php
            echo $this->Form->control('extrusora_id', ['options' => $extrusoras]);
            echo $this->Form->control('impresora_id', ['options' => $impresoras]);
            echo $this->Form->control('cortadora_id', ['options' => $cortadoras]);
            echo $this->Form->control('ordenesdetrabajo_id', ['options' => $ordenesdetrabajos]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
