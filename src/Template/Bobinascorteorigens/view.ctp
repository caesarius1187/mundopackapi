<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bobinascorteorigen $bobinascorteorigen
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Bobinascorteorigen'), ['action' => 'edit', $bobinascorteorigen->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Bobinascorteorigen'), ['action' => 'delete', $bobinascorteorigen->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bobinascorteorigen->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Bobinascorteorigens'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bobinascorteorigen'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bobinasdeimpresions'), ['controller' => 'Bobinasdeimpresions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bobinasdeimpresion'), ['controller' => 'Bobinasdeimpresions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bobinasdecortes'), ['controller' => 'Bobinasdecortes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bobinasdecorte'), ['controller' => 'Bobinasdecortes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bobinasdeextrusions'), ['controller' => 'Bobinasdeextrusions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bobinasdeextrusion'), ['controller' => 'Bobinasdeextrusions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="bobinascorteorigens view large-9 medium-8 columns content">
    <h3><?= h($bobinascorteorigen->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Bobinasdeimpresion') ?></th>
            <td><?= $bobinascorteorigen->has('bobinasdeimpresion') ? $this->Html->link($bobinascorteorigen->bobinasdeimpresion->id, ['controller' => 'Bobinasdeimpresions', 'action' => 'view', $bobinascorteorigen->bobinasdeimpresion->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bobinasdecorte') ?></th>
            <td><?= $bobinascorteorigen->has('bobinasdecorte') ? $this->Html->link($bobinascorteorigen->bobinasdecorte->id, ['controller' => 'Bobinasdecortes', 'action' => 'view', $bobinascorteorigen->bobinasdecorte->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bobinasdeextrusion') ?></th>
            <td><?= $bobinascorteorigen->has('bobinasdeextrusion') ? $this->Html->link($bobinascorteorigen->bobinasdeextrusion->id, ['controller' => 'Bobinasdeextrusions', 'action' => 'view', $bobinascorteorigen->bobinasdeextrusion->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($bobinascorteorigen->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($bobinascorteorigen->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($bobinascorteorigen->modified) ?></td>
        </tr>
    </table>
</div>
