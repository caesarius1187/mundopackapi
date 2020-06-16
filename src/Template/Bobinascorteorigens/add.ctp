<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bobinascorteorigen $bobinascorteorigen
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Bobinascorteorigens'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Bobinasdeimpresions'), ['controller' => 'Bobinasdeimpresions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bobinasdeimpresion'), ['controller' => 'Bobinasdeimpresions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bobinasdecortes'), ['controller' => 'Bobinasdecortes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bobinasdecorte'), ['controller' => 'Bobinasdecortes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bobinasdeextrusions'), ['controller' => 'Bobinasdeextrusions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bobinasdeextrusion'), ['controller' => 'Bobinasdeextrusions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bobinascorteorigens form large-9 medium-8 columns content">
    <?= $this->Form->create($bobinascorteorigen) ?>
    <fieldset>
        <legend><?= __('Add Bobinascorteorigen') ?></legend>
        <?php
            echo $this->Form->control('bobinasdeimpresion_id', ['options' => $bobinasdeimpresions, 'empty' => true]);
            echo $this->Form->control('bobinasdecorte_id', ['options' => $bobinasdecortes, 'empty' => true]);
            echo $this->Form->control('bobinasdeextrusion_id', ['options' => $bobinasdeextrusions, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
