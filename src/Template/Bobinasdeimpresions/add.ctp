<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bobinasdeimpresion $bobinasdeimpresion
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Bobinasdeimpresions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Empleados'), ['controller' => 'Empleados', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Empleado'), ['controller' => 'Empleados', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cortadoras'), ['controller' => 'Cortadoras', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cortadora'), ['controller' => 'Cortadoras', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bobinasdeextrusions'), ['controller' => 'Bobinasdeextrusions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bobinasdeextrusion'), ['controller' => 'Bobinasdeextrusions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bobinascorteorigen'), ['controller' => 'Bobinascorteorigen', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bobinascorteorigen'), ['controller' => 'Bobinascorteorigen', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bobinasdeimpresions form large-9 medium-8 columns content">
    <?= $this->Form->create($bobinasdeimpresion) ?>
    <fieldset>
        <legend><?= __('Add Bobinasdeimpresion') ?></legend>
        <?php
            echo $this->Form->control('empleado_id', ['options' => $empleados]);
            echo $this->Form->control('cortadora_id', ['options' => $cortadoras]);
            echo $this->Form->control('bobinasdeextrusion_id', ['options' => $bobinasdeextrusions]);
            echo $this->Form->control('fecha', ['empty' => true]);
            echo $this->Form->control('horas');
            echo $this->Form->control('kilogramos');
            echo $this->Form->control('scrap');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
