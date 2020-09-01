<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bobinasdeextrusion[]|\Cake\Collection\CollectionInterface $bobinasdeextrusions
 */

echo $this->Html->script('bobinasdeextrusions/printtickets',array('inline'=>false));

?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Bobinasdeextrusion'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Empleados'), ['controller' => 'Empleados', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Empleado'), ['controller' => 'Empleados', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Extrusoras'), ['controller' => 'Extrusoras', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Extrusora'), ['controller' => 'Extrusoras', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bobinascorteorigen'), ['controller' => 'Bobinascorteorigen', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bobinascorteorigen'), ['controller' => 'Bobinascorteorigen', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bobinasdeimpresions'), ['controller' => 'Bobinasdeimpresions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bobinasdeimpresion'), ['controller' => 'Bobinasdeimpresions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bobinasdeextrusions index large-9 medium-8 columns content">
    <h3><?= __('Bobinasdeextrusions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('empleado_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('extrusora_id') ?></th>
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
            <?php foreach ($bobinasdeextrusions as $bobinasdeextrusion): ?>
            <tr>
                <td><?= $this->Number->format($bobinasdeextrusion->id) ?></td>
                <td><?= $bobinasdeextrusion->has('empleado') ? $this->Html->link($bobinasdeextrusion->empleado->id, ['controller' => 'Empleados', 'action' => 'view', $bobinasdeextrusion->empleado->id]) : '' ?></td>
                <td><?= $bobinasdeextrusion->has('extrusora') ? $this->Html->link($bobinasdeextrusion->extrusora->id, ['controller' => 'Extrusoras', 'action' => 'view', $bobinasdeextrusion->extrusora->id]) : '' ?></td>
                <td><?= h($bobinasdeextrusion->fecha) ?></td>
                <td><?= h($bobinasdeextrusion->horas) ?></td>
                <td><?= h($bobinasdeextrusion->kilogramos) ?></td>
                <td><?= h($bobinasdeextrusion->scrap) ?></td>
                <td><?= h($bobinasdeextrusion->created) ?></td>
                <td><?= h($bobinasdeextrusion->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $bobinasdeextrusion->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $bobinasdeextrusion->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $bobinasdeextrusion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bobinasdeextrusion->id)]) ?>
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

<button type="button" name="button" onclick="imprimir()">Imprimir</button>
