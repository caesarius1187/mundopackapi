<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Extrusora $extrusora
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $extrusora->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $extrusora->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Extrusoras'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Bobinasdeextrusions'), ['controller' => 'Bobinasdeextrusions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bobinasdeextrusion'), ['controller' => 'Bobinasdeextrusions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="extrusoras form large-9 medium-8 columns content">
    <?= $this->Form->create($extrusora) ?>
    <fieldset>
        <legend><?= __('Edit Extrusora') ?></legend>
        <?php
            echo $this->Form->control('nombre');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
