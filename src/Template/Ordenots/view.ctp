<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ordenot $ordenot
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Ordenot'), ['action' => 'edit', $ordenot->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Ordenot'), ['action' => 'delete', $ordenot->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ordenot->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Ordenots'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ordenot'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Extrusoras'), ['controller' => 'Extrusoras', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Extrusora'), ['controller' => 'Extrusoras', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Impresoras'), ['controller' => 'Impresoras', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Impresora'), ['controller' => 'Impresoras', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cortadoras'), ['controller' => 'Cortadoras', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cortadora'), ['controller' => 'Cortadoras', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Ordenesdetrabajos'), ['controller' => 'Ordenesdetrabajos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ordenesdetrabajo'), ['controller' => 'Ordenesdetrabajos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="ordenots view large-9 medium-8 columns content">
    <h3><?= h($ordenot->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Extrusora') ?></th>
            <td><?= $ordenot->has('extrusora') ? $this->Html->link($ordenot->extrusora->id, ['controller' => 'Extrusoras', 'action' => 'view', $ordenot->extrusora->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Impresora') ?></th>
            <td><?= $ordenot->has('impresora') ? $this->Html->link($ordenot->impresora->id, ['controller' => 'Impresoras', 'action' => 'view', $ordenot->impresora->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cortadora') ?></th>
            <td><?= $ordenot->has('cortadora') ? $this->Html->link($ordenot->cortadora->id, ['controller' => 'Cortadoras', 'action' => 'view', $ordenot->cortadora->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ordenesdetrabajo') ?></th>
            <td><?= $ordenot->has('ordenesdetrabajo') ? $this->Html->link($ordenot->ordenesdetrabajo->id, ['controller' => 'Ordenesdetrabajos', 'action' => 'view', $ordenot->ordenesdetrabajo->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($ordenot->id) ?></td>
        </tr>
    </table>
</div>
