<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ordenesdetrabajo $ordenesdetrabajo
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $ordenesdetrabajo->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $ordenesdetrabajo->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Ordenesdetrabajos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Ordenesdepedidos'), ['controller' => 'Ordenesdepedidos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ordenesdepedido'), ['controller' => 'Ordenesdepedidos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="ordenesdetrabajos form large-9 medium-8 columns content">
    <?= $this->Form->create($ordenesdetrabajo) ?>
    <fieldset>
        <legend><?= __('Edit Ordenesdetrabajo') ?></legend>
        <?php
            echo $this->Form->control('ordenesdepedido_id', ['options' => $ordenesdepedidos]);
            echo $this->Form->control('cantidad');
            echo $this->Form->control('material');
            echo $this->Form->control('tipo');
            echo $this->Form->control('color');
            echo $this->Form->control('fuelle');
            echo $this->Form->control('medida');
            echo $this->Form->control('perf');
            echo $this->Form->control('impreso');
            echo $this->Form->control('preciounitario');
            echo $this->Form->control('observaciones');
            echo $this->Form->control('numero');
            echo $this->Form->control('cierre', ['empty' => true]);
            echo $this->Form->control('cierremicrones');
            echo $this->Form->control('cierrescrap');
            echo $this->Form->control('cierrediferenciakg');
            echo $this->Form->control('concluciones');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
