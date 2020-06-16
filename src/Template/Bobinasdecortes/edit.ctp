<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bobinasdecorte $bobinasdecorte
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $bobinasdecorte->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $bobinasdecorte->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Bobinasdecortes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Empleados'), ['controller' => 'Empleados', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Empleado'), ['controller' => 'Empleados', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Impresoras'), ['controller' => 'Impresoras', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Impresora'), ['controller' => 'Impresoras', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bobinascorteorigen'), ['controller' => 'Bobinascorteorigen', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bobinascorteorigen'), ['controller' => 'Bobinascorteorigen', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bobinasdecortes form large-9 medium-8 columns content">
    <?= $this->Form->create($bobinasdecorte) ?>
    <fieldset>
        <legend><?= __('Edit Bobinasdecorte') ?></legend>
        <?php
            echo $this->Form->control('empleado_id', ['options' => $empleados]);
            echo $this->Form->control('impresora_id', ['options' => $impresoras]);
            echo $this->Form->control('fecha', ['empty' => true]);
            echo $this->Form->control('horas');
            echo $this->Form->control('kilogramos');
            echo $this->Form->control('scrap');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
