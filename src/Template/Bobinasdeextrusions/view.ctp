<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bobinasdeextrusion $bobinasdeextrusion
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Bobinasdeextrusion'), ['action' => 'edit', $bobinasdeextrusion->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Bobinasdeextrusion'), ['action' => 'delete', $bobinasdeextrusion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bobinasdeextrusion->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Bobinasdeextrusions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bobinasdeextrusion'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Empleados'), ['controller' => 'Empleados', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Empleado'), ['controller' => 'Empleados', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Extrusoras'), ['controller' => 'Extrusoras', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Extrusora'), ['controller' => 'Extrusoras', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bobinascorteorigen'), ['controller' => 'Bobinascorteorigen', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bobinascorteorigen'), ['controller' => 'Bobinascorteorigen', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bobinasdeimpresions'), ['controller' => 'Bobinasdeimpresions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bobinasdeimpresion'), ['controller' => 'Bobinasdeimpresions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="bobinasdeextrusions view large-9 medium-8 columns content">
    <h3><?= h($bobinasdeextrusion->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Empleado') ?></th>
            <td><?= $bobinasdeextrusion->has('empleado') ? $this->Html->link($bobinasdeextrusion->empleado->id, ['controller' => 'Empleados', 'action' => 'view', $bobinasdeextrusion->empleado->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Extrusora') ?></th>
            <td><?= $bobinasdeextrusion->has('extrusora') ? $this->Html->link($bobinasdeextrusion->extrusora->id, ['controller' => 'Extrusoras', 'action' => 'view', $bobinasdeextrusion->extrusora->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Horas') ?></th>
            <td><?= h($bobinasdeextrusion->horas) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Kilogramos') ?></th>
            <td><?= h($bobinasdeextrusion->kilogramos) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Scrap') ?></th>
            <td><?= h($bobinasdeextrusion->scrap) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($bobinasdeextrusion->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha') ?></th>
            <td><?= h($bobinasdeextrusion->fecha) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($bobinasdeextrusion->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($bobinasdeextrusion->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Bobinascorteorigen') ?></h4>
        <?php if (!empty($bobinasdeextrusion->bobinascorteorigens)): ?>
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
            <?php foreach ($bobinasdeextrusion->bobinascorteorigens as $bobinascorteorigen): ?>
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
    <div class="related">
        <h4><?= __('Related Bobinasdeimpresions') ?></h4>
        <?php if (!empty($bobinasdeextrusion->bobinasdeimpresions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Empleado Id') ?></th>
                <th scope="col"><?= __('Cortadora Id') ?></th>
                <th scope="col"><?= __('Bobinasdeextrusion Id') ?></th>
                <th scope="col"><?= __('Fecha') ?></th>
                <th scope="col"><?= __('Horas') ?></th>
                <th scope="col"><?= __('Kilogramos') ?></th>
                <th scope="col"><?= __('Scrap') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($bobinasdeextrusion->bobinasdeimpresions as $bobinasdeimpresions): ?>
            <tr>
                <td><?= h($bobinasdeimpresions->id) ?></td>
                <td><?= h($bobinasdeimpresions->empleado_id) ?></td>
                <td><?= h($bobinasdeimpresions->cortadora_id) ?></td>
                <td><?= h($bobinasdeimpresions->bobinasdeextrusion_id) ?></td>
                <td><?= h($bobinasdeimpresions->fecha) ?></td>
                <td><?= h($bobinasdeimpresions->horas) ?></td>
                <td><?= h($bobinasdeimpresions->kilogramos) ?></td>
                <td><?= h($bobinasdeimpresions->scrap) ?></td>
                <td><?= h($bobinasdeimpresions->created) ?></td>
                <td><?= h($bobinasdeimpresions->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Bobinasdeimpresions', 'action' => 'view', $bobinasdeimpresions->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Bobinasdeimpresions', 'action' => 'edit', $bobinasdeimpresions->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Bobinasdeimpresions', 'action' => 'delete', $bobinasdeimpresions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bobinasdeimpresions->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
