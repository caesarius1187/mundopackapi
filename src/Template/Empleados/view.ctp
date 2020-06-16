<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Empleado $empleado
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Empleado'), ['action' => 'edit', $empleado->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Empleado'), ['action' => 'delete', $empleado->id], ['confirm' => __('Are you sure you want to delete # {0}?', $empleado->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Empleados'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Empleado'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bobinasdecortes'), ['controller' => 'Bobinasdecortes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bobinasdecorte'), ['controller' => 'Bobinasdecortes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bobinasdeextrusions'), ['controller' => 'Bobinasdeextrusions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bobinasdeextrusion'), ['controller' => 'Bobinasdeextrusions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bobinasdeimpresions'), ['controller' => 'Bobinasdeimpresions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bobinasdeimpresion'), ['controller' => 'Bobinasdeimpresions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="empleados view large-9 medium-8 columns content">
    <h3><?= h($empleado->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($empleado->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Legajo') ?></th>
            <td><?= h($empleado->legajo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rol') ?></th>
            <td><?= h($empleado->rol) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Direccion') ?></th>
            <td><?= h($empleado->direccion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Celular') ?></th>
            <td><?= h($empleado->celular) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($empleado->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($empleado->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($empleado->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Bobinasdecortes') ?></h4>
        <?php if (!empty($empleado->bobinasdecortes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Empleado Id') ?></th>
                <th scope="col"><?= __('Impresora Id') ?></th>
                <th scope="col"><?= __('Fecha') ?></th>
                <th scope="col"><?= __('Horas') ?></th>
                <th scope="col"><?= __('Kilogramos') ?></th>
                <th scope="col"><?= __('Scrap') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($empleado->bobinasdecortes as $bobinasdecortes): ?>
            <tr>
                <td><?= h($bobinasdecortes->id) ?></td>
                <td><?= h($bobinasdecortes->empleado_id) ?></td>
                <td><?= h($bobinasdecortes->impresora_id) ?></td>
                <td><?= h($bobinasdecortes->fecha) ?></td>
                <td><?= h($bobinasdecortes->horas) ?></td>
                <td><?= h($bobinasdecortes->kilogramos) ?></td>
                <td><?= h($bobinasdecortes->scrap) ?></td>
                <td><?= h($bobinasdecortes->created) ?></td>
                <td><?= h($bobinasdecortes->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Bobinasdecortes', 'action' => 'view', $bobinasdecortes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Bobinasdecortes', 'action' => 'edit', $bobinasdecortes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Bobinasdecortes', 'action' => 'delete', $bobinasdecortes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bobinasdecortes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Bobinasdeextrusions') ?></h4>
        <?php if (!empty($empleado->bobinasdeextrusions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Empleado Id') ?></th>
                <th scope="col"><?= __('Extrusora Id') ?></th>
                <th scope="col"><?= __('Fecha') ?></th>
                <th scope="col"><?= __('Horas') ?></th>
                <th scope="col"><?= __('Kilogramos') ?></th>
                <th scope="col"><?= __('Scrap') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($empleado->bobinasdeextrusions as $bobinasdeextrusions): ?>
            <tr>
                <td><?= h($bobinasdeextrusions->id) ?></td>
                <td><?= h($bobinasdeextrusions->empleado_id) ?></td>
                <td><?= h($bobinasdeextrusions->extrusora_id) ?></td>
                <td><?= h($bobinasdeextrusions->fecha) ?></td>
                <td><?= h($bobinasdeextrusions->horas) ?></td>
                <td><?= h($bobinasdeextrusions->kilogramos) ?></td>
                <td><?= h($bobinasdeextrusions->scrap) ?></td>
                <td><?= h($bobinasdeextrusions->created) ?></td>
                <td><?= h($bobinasdeextrusions->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Bobinasdeextrusions', 'action' => 'view', $bobinasdeextrusions->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Bobinasdeextrusions', 'action' => 'edit', $bobinasdeextrusions->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Bobinasdeextrusions', 'action' => 'delete', $bobinasdeextrusions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bobinasdeextrusions->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Bobinasdeimpresions') ?></h4>
        <?php if (!empty($empleado->bobinasdeimpresions)): ?>
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
            <?php foreach ($empleado->bobinasdeimpresions as $bobinasdeimpresions): ?>
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
