<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cortadora $cortadora
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $cortadora->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $cortadora->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Cortadoras'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Bobinasdeimpresions'), ['controller' => 'Bobinasdeimpresions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bobinasdeimpresion'), ['controller' => 'Bobinasdeimpresions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="cortadoras form large-9 medium-8 columns content">
    <?= $this->Form->create($cortadora) ?>
    <fieldset>
        <legend><?= __('Edit Cortadora') ?></legend>
        <?php
            echo $this->Form->control('nombre');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
