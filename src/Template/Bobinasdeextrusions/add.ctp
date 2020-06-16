<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bobinasdeextrusion $bobinasdeextrusion
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Bobinasdeextrusions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Empleados'), ['controller' => 'Empleados', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Empleado'), ['controller' => 'Empleados', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Extrusoras'), ['controller' => 'Extrusoras', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Extrusora'), ['controller' => 'Extrusoras', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bobinascorteorigen'), ['controller' => 'Bobinascorteorigen', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bobinascorteorigen'), ['controller' => 'Bobinascorteorigen', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bobinasdeimpresions'), ['controller' => 'Bobinasdeimpresions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bobinasdeimpresion'), ['controller' => 'Bobinasdeimpresions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bobinasdeextrusions form large-9 medium-8 columns content">
    <?= $this->Form->create($bobinasdeextrusion) ?>
    <fieldset>
        <legend><?= __('Add Bobinasdeextrusion') ?></legend>
        <?php
            echo $this->Form->control('empleado_id', ['options' => $empleados]);
            echo $this->Form->control('extrusora_id', ['options' => $extrusoras]);
            echo $this->Form->control('fecha', ['empty' => true]);
            echo $this->Form->control('horas');
            echo $this->Form->control('kilogramos');
            echo $this->Form->control('scrap');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
