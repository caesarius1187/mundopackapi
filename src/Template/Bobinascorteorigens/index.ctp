<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bobinascorteorigen[]|\Cake\Collection\CollectionInterface $bobinascorteorigens
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Bobinascorteorigen'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bobinasdeimpresions'), ['controller' => 'Bobinasdeimpresions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bobinasdeimpresion'), ['controller' => 'Bobinasdeimpresions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bobinasdecortes'), ['controller' => 'Bobinasdecortes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bobinasdecorte'), ['controller' => 'Bobinasdecortes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bobinasdeextrusions'), ['controller' => 'Bobinasdeextrusions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bobinasdeextrusion'), ['controller' => 'Bobinasdeextrusions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bobinascorteorigens index large-9 medium-8 columns content">
    <h3><?= __('Bobinascorteorigens') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bobinasdeimpresion_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bobinasdecorte_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bobinasdeextrusion_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bobinascorteorigens as $bobinascorteorigen): ?>
            <tr>
                <td><?= $this->Number->format($bobinascorteorigen->id) ?></td>
                <td><?= $bobinascorteorigen->has('bobinasdeimpresion') ? $this->Html->link($bobinascorteorigen->bobinasdeimpresion->id, ['controller' => 'Bobinasdeimpresions', 'action' => 'view', $bobinascorteorigen->bobinasdeimpresion->id]) : '' ?></td>
                <td><?= $bobinascorteorigen->has('bobinasdecorte') ? $this->Html->link($bobinascorteorigen->bobinasdecorte->id, ['controller' => 'Bobinasdecortes', 'action' => 'view', $bobinascorteorigen->bobinasdecorte->id]) : '' ?></td>
                <td><?= $bobinascorteorigen->has('bobinasdeextrusion') ? $this->Html->link($bobinascorteorigen->bobinasdeextrusion->id, ['controller' => 'Bobinasdeextrusions', 'action' => 'view', $bobinascorteorigen->bobinasdeextrusion->id]) : '' ?></td>
                <td><?= h($bobinascorteorigen->created) ?></td>
                <td><?= h($bobinascorteorigen->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $bobinascorteorigen->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $bobinascorteorigen->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $bobinascorteorigen->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bobinascorteorigen->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
