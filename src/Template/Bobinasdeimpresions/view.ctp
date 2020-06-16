<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bobinasdeimpresion $bobinasdeimpresion
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Bobinasdeimpresion'), ['action' => 'edit', $bobinasdeimpresion->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Bobinasdeimpresion'), ['action' => 'delete', $bobinasdeimpresion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bobinasdeimpresion->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Bobinasdeimpresions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bobinasdeimpresion'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Empleados'), ['controller' => 'Empleados', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Empleado'), ['controller' => 'Empleados', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cortadoras'), ['controller' => 'Cortadoras', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cortadora'), ['controller' => 'Cortadoras', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bobinasdeextrusions'), ['controller' => 'Bobinasdeextrusions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bobinasdeextrusion'), ['controller' => 'Bobinasdeextrusions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bobinascorteorigen'), ['controller' => 'Bobinascorteorigen', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bobinascorteorigen'), ['controller' => 'Bobinascorteorigen', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="bobinasdeimpresions view large-9 medium-8 columns content">
    <h3><?= h($bobinasdeimpresion->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Empleado') ?></th>
            <td><?= $bobinasdeimpresion->has('empleado') ? $this->Html->link($bobinasdeimpresion->empleado->id, ['controller' => 'Empleados', 'action' => 'view', $bobinasdeimpresion->empleado->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cortadora') ?></th>
            <td><?= $bobinasdeimpresion->has('cortadora') ? $this->Html->link($bobinasdeimpresion->cortadora->id, ['controller' => 'Cortadoras', 'action' => 'view', $bobinasdeimpresion->cortadora->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bobinasdeextrusion') ?></th>
            <td><?= $bobinasdeimpresion->has('bobinasdeextrusion') ? $this->Html->link($bobinasdeimpresion->bobinasdeextrusion->id, ['controller' => 'Bobinasdeextrusions', 'action' => 'view', $bobinasdeimpresion->bobinasdeextrusion->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Horas') ?></th>
            <td><?= h($bobinasdeimpresion->horas) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Kilogramos') ?></th>
            <td><?= h($bobinasdeimpresion->kilogramos) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Scrap') ?></th>
            <td><?= h($bobinasdeimpresion->scrap) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($bobinasdeimpresion->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha') ?></th>
            <td><?= h($bobinasdeimpresion->fecha) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($bobinasdeimpresion->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($bobinasdeimpresion->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Bobinascorteorigen') ?></h4>
        <?php if (!empty($bobinasdeimpresion->bobinascorteorigens)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Bobinasdeimpresion Id') ?></th>
                <th scope="col"><?= __('Bobinasdecorte Id') ?></th>
                <th scope="col"><?= __('Bobinasdeextrusion Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($bobinasdeimpresion->bobinascorteorigens as $bobinascorteorigen): ?>
            <tr>
                <td><?= h($bobinascorteorigen->id) ?></td>
                <td><?= h($bobinascorteorigen->bobinasdeimpresion_id) ?></td>
                <td><?= h($bobinascorteorigen->bobinasdecorte_id) ?></td>
                <td><?= h($bobinascorteorigen->bobinasdeextrusion_id) ?></td>
                <td><?= h($bobinascorteorigen->created) ?></td>
                <td><?= h($bobinascorteorigen->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Bobinascorteorigen', 'action' => 'view', $bobinascorteorigen->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Bobinascorteorigen', 'action' => 'edit', $bobinascorteorigen->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Bobinascorteorigen', 'action' => 'delete', $bobinascorteorigen->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bobinascorteorigen->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
