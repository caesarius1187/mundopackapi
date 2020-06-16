<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Impresora $impresora
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $impresora->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $impresora->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Impresoras'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Bobinasdecortes'), ['controller' => 'Bobinasdecortes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bobinasdecorte'), ['controller' => 'Bobinasdecortes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="impresoras form large-9 medium-8 columns content">
    <?= $this->Form->create($impresora) ?>
    <fieldset>
        <legend><?= __('Edit Impresora') ?></legend>
        <?php
            echo $this->Form->control('nombre');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
