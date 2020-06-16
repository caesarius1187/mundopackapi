<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bobinasdeimpresion[]|\Cake\Collection\CollectionInterface $bobinasdeimpresions
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Bobinasdeimpresion'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Empleados'), ['controller' => 'Empleados', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Empleado'), ['controller' => 'Empleados', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cortadoras'), ['controller' => 'Cortadoras', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cortadora'), ['controller' => 'Cortadoras', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bobinasdeextrusions'), ['controller' => 'Bobinasdeextrusions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bobinasdeextrusion'), ['controller' => 'Bobinasdeextrusions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bobinascorteorigen'), ['controller' => 'Bobinascorteorigen', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bobinascorteorigen'), ['controller' => 'Bobinascorteorigen', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bobinasdeimpresions index large-9 medium-8 columns content">
    <h3><?= __('Bobinasdeimpresions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('empleado_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cortadora_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bobinasdeextrusion_id') ?></th>
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
            <?php foreach ($bobinasdeimpresions as $bobinasdeimpresion): ?>
            <tr>
                <td><?= $this->Number->format($bobinasdeimpresion->id) ?></td>
                <td><?= $bobinasdeimpresion->has('empleado') ? $this->Html->link($bobinasdeimpresion->empleado->id, ['controller' => 'Empleados', 'action' => 'view', $bobinasdeimpresion->empleado->id]) : '' ?></td>
                <td><?= $bobinasdeimpresion->has('cortadora') ? $this->Html->link($bobinasdeimpresion->cortadora->id, ['controller' => 'Cortadoras', 'action' => 'view', $bobinasdeimpresion->cortadora->id]) : '' ?></td>
                <td><?= $bobinasdeimpresion->has('bobinasdeextrusion') ? $this->Html->link($bobinasdeimpresion->bobinasdeextrusion->id, ['controller' => 'Bobinasdeextrusions', 'action' => 'view', $bobinasdeimpresion->bobinasdeextrusion->id]) : '' ?></td>
                <td><?= h($bobinasdeimpresion->fecha) ?></td>
                <td><?= h($bobinasdeimpresion->horas) ?></td>
                <td><?= h($bobinasdeimpresion->kilogramos) ?></td>
                <td><?= h($bobinasdeimpresion->scrap) ?></td>
                <td><?= h($bobinasdeimpresion->created) ?></td>
                <td><?= h($bobinasdeimpresion->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $bobinasdeimpresion->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $bobinasdeimpresion->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $bobinasdeimpresion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bobinasdeimpresion->id)]) ?>
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
