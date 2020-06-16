<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Empleado $empleado
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $empleado->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $empleado->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Empleados'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Bobinasdecortes'), ['controller' => 'Bobinasdecortes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bobinasdecorte'), ['controller' => 'Bobinasdecortes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bobinasdeextrusions'), ['controller' => 'Bobinasdeextrusions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bobinasdeextrusion'), ['controller' => 'Bobinasdeextrusions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bobinasdeimpresions'), ['controller' => 'Bobinasdeimpresions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bobinasdeimpresion'), ['controller' => 'Bobinasdeimpresions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="empleados form large-9 medium-8 columns content">
    <?= $this->Form->create($empleado) ?>
    <fieldset>
        <legend><?= __('Edit Empleado') ?></legend>
        <?php
            echo $this->Form->control('nombre');
            echo $this->Form->control('legajo');
            echo $this->Form->control('rol');
            echo $this->Form->control('direccion');
            echo $this->Form->control('celular');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
