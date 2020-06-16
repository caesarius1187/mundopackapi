<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ordenesdetrabajo[]|\Cake\Collection\CollectionInterface $ordenesdetrabajos
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Ordenesdetrabajo'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Ordenesdepedidos'), ['controller' => 'Ordenesdepedidos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ordenesdepedido'), ['controller' => 'Ordenesdepedidos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="ordenesdetrabajos index large-9 medium-8 columns content">
    <h3><?= __('Ordenesdetrabajos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ordenesdepedido_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cantidad') ?></th>
                <th scope="col"><?= $this->Paginator->sort('material') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tipo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('color') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fuelle') ?></th>
                <th scope="col"><?= $this->Paginator->sort('medida') ?></th>
                <th scope="col"><?= $this->Paginator->sort('perf') ?></th>
                <th scope="col"><?= $this->Paginator->sort('impreso') ?></th>
                <th scope="col"><?= $this->Paginator->sort('preciounitario') ?></th>
                <th scope="col"><?= $this->Paginator->sort('observaciones') ?></th>
                <th scope="col"><?= $this->Paginator->sort('numero') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cierre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cierremicrones') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cierrescrap') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cierrediferenciakg') ?></th>
                <th scope="col"><?= $this->Paginator->sort('concluciones') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ordenesdetrabajos as $ordenesdetrabajo): ?>
            <tr>
                <td><?= $this->Number->format($ordenesdetrabajo->id) ?></td>
                <td><?= $ordenesdetrabajo->has('ordenesdepedido') ? $this->Html->link($ordenesdetrabajo->ordenesdepedido->id, ['controller' => 'Ordenesdepedidos', 'action' => 'view', $ordenesdetrabajo->ordenesdepedido->id]) : '' ?></td>
                <td><?= $this->Number->format($ordenesdetrabajo->cantidad) ?></td>
                <td><?= h($ordenesdetrabajo->material) ?></td>
                <td><?= h($ordenesdetrabajo->tipo) ?></td>
                <td><?= h($ordenesdetrabajo->color) ?></td>
                <td><?= h($ordenesdetrabajo->fuelle) ?></td>
                <td><?= h($ordenesdetrabajo->medida) ?></td>
                <td><?= h($ordenesdetrabajo->perf) ?></td>
                <td><?= h($ordenesdetrabajo->impreso) ?></td>
                <td><?= h($ordenesdetrabajo->preciounitario) ?></td>
                <td><?= h($ordenesdetrabajo->observaciones) ?></td>
                <td><?= h($ordenesdetrabajo->numero) ?></td>
                <td><?= h($ordenesdetrabajo->cierre) ?></td>
                <td><?= h($ordenesdetrabajo->cierremicrones) ?></td>
                <td><?= h($ordenesdetrabajo->cierrescrap) ?></td>
                <td><?= h($ordenesdetrabajo->cierrediferenciakg) ?></td>
                <td><?= h($ordenesdetrabajo->concluciones) ?></td>
                <td><?= h($ordenesdetrabajo->created) ?></td>
                <td><?= h($ordenesdetrabajo->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $ordenesdetrabajo->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $ordenesdetrabajo->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $ordenesdetrabajo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ordenesdetrabajo->id)]) ?>
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
