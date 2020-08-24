<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Materialesot[]|\Cake\Collection\CollectionInterface $materialesots
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Materialesot'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Ordenesdetrabajos'), ['controller' => 'Ordenesdetrabajos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ordenesdetrabajo'), ['controller' => 'Ordenesdetrabajos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="materialesots index large-9 medium-8 columns content">
    <h3><?= __('Materialesots') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ordenesdetrabajo_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('material') ?></th>
                <th scope="col"><?= $this->Paginator->sort('porcentaje') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($materialesots as $materialesot): ?>
            <tr>
                <td><?= $this->Number->format($materialesot->id) ?></td>
                <td><?= $materialesot->has('ordenesdetrabajo') ? $this->Html->link($materialesot->ordenesdetrabajo->numero, ['controller' => 'Ordenesdetrabajos', 'action' => 'view', $materialesot->ordenesdetrabajo->id]) : '' ?></td>
                <td><?= h($materialesot->material) ?></td>
                <td><?= $this->Number->format($materialesot->porcentaje) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $materialesot->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $materialesot->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $materialesot->id], ['confirm' => __('Are you sure you want to delete # {0}?', $materialesot->id)]) ?>
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
