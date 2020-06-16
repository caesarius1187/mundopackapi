<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bobinasdecorte[]|\Cake\Collection\CollectionInterface $bobinasdecortes
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Bobinasdecorte'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Empleados'), ['controller' => 'Empleados', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Empleado'), ['controller' => 'Empleados', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Impresoras'), ['controller' => 'Impresoras', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Impresora'), ['controller' => 'Impresoras', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bobinascorteorigen'), ['controller' => 'Bobinascorteorigen', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bobinascorteorigen'), ['controller' => 'Bobinascorteorigen', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bobinasdecortes index large-9 medium-8 columns content">
    <h3><?= __('Bobinasdecortes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('empleado_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('impresora_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fecha') ?></th>
                <th scope="col"><?= $this->Paginator->sort('horas') ?></th>
                <th scope="col"><?= $this->Paginator->sort('kilogramos') ?></th>
                <th scope="col"><?= $this->Paginator->sort('scrap') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bobinasdecortes as $bobinasdecorte): ?>
            <tr>
                <td><?= $this->Number->format($bobinasdecorte->id) ?></td>
                <td><?= $bobinasdecorte->has('empleado') ? $this->Html->link($bobinasdecorte->empleado->id, ['controller' => 'Empleados', 'action' => 'view', $bobinasdecorte->empleado->id]) : '' ?></td>
                <td><?= $bobinasdecorte->has('impresora') ? $this->Html->link($bobinasdecorte->impresora->id, ['controller' => 'Impresoras', 'action' => 'view', $bobinasdecorte->impresora->id]) : '' ?></td>
                <td><?= h($bobinasdecorte->fecha) ?></td>
                <td><?= h($bobinasdecorte->horas) ?></td>
                <td><?= h($bobinasdecorte->kilogramos) ?></td>
                <td><?= h($bobinasdecorte->scrap) ?></td>
                <td><?= h($bobinasdecorte->created) ?></td>
                <td><?= h($bobinasdecorte->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $bobinasdecorte->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $bobinasdecorte->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $bobinasdecorte->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bobinasdecorte->id)]) ?>
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
