<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Materialesot $materialesot
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Materialesot'), ['action' => 'edit', $materialesot->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Materialesot'), ['action' => 'delete', $materialesot->id], ['confirm' => __('Are you sure you want to delete # {0}?', $materialesot->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Materialesots'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Materialesot'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Ordenesdetrabajos'), ['controller' => 'Ordenesdetrabajos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ordenesdetrabajo'), ['controller' => 'Ordenesdetrabajos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="materialesots view large-9 medium-8 columns content">
    <h3><?= h($materialesot->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Ordenesdetrabajo') ?></th>
            <td><?= $materialesot->has('ordenesdetrabajo') ? $this->Html->link($materialesot->ordenesdetrabajo->numero, ['controller' => 'Ordenesdetrabajos', 'action' => 'view', $materialesot->ordenesdetrabajo->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Material') ?></th>
            <td><?= h($materialesot->material) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($materialesot->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Porcentaje') ?></th>
            <td><?= $this->Number->format($materialesot->porcentaje) ?></td>
        </tr>
    </table>
</div>
