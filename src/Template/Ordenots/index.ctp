<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ordenot[]|\Cake\Collection\CollectionInterface $ordenots
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Ordenot'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Extrusoras'), ['controller' => 'Extrusoras', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Extrusora'), ['controller' => 'Extrusoras', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Impresoras'), ['controller' => 'Impresoras', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Impresora'), ['controller' => 'Impresoras', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cortadoras'), ['controller' => 'Cortadoras', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cortadora'), ['controller' => 'Cortadoras', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Ordenesdetrabajos'), ['controller' => 'Ordenesdetrabajos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ordenesdetrabajo'), ['controller' => 'Ordenesdetrabajos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="ordenots index large-9 medium-8 columns content">
    <h3><?= __('Ordenots') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('extrusora_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('impresora_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cortadora_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ordenesdetrabajo_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ordenots as $ordenot): ?>
            <tr>
                <td><?= $this->Number->format($ordenot->id) ?></td>
                <td><?= $ordenot->has('extrusora') ? $this->Html->link($ordenot->extrusora->id, ['controller' => 'Extrusoras', 'action' => 'view', $ordenot->extrusora->id]) : '' ?></td>
                <td><?= $ordenot->has('impresora') ? $this->Html->link($ordenot->impresora->id, ['controller' => 'Impresoras', 'action' => 'view', $ordenot->impresora->id]) : '' ?></td>
                <td><?= $ordenot->has('cortadora') ? $this->Html->link($ordenot->cortadora->id, ['controller' => 'Cortadoras', 'action' => 'view', $ordenot->cortadora->id]) : '' ?></td>
                <td><?= $ordenot->has('ordenesdetrabajo') ? $this->Html->link($ordenot->ordenesdetrabajo->id, ['controller' => 'Ordenesdetrabajos', 'action' => 'view', $ordenot->ordenesdetrabajo->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $ordenot->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $ordenot->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $ordenot->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ordenot->id)]) ?>
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
