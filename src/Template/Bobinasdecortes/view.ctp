<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bobinasdecorte $bobinasdecorte
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Bobinasdecorte'), ['action' => 'edit', $bobinasdecorte->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Bobinasdecorte'), ['action' => 'delete', $bobinasdecorte->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bobinasdecorte->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Bobinasdecortes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bobinasdecorte'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Empleados'), ['controller' => 'Empleados', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Empleado'), ['controller' => 'Empleados', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Impresoras'), ['controller' => 'Impresoras', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Impresora'), ['controller' => 'Impresoras', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bobinascorteorigen'), ['controller' => 'Bobinascorteorigen', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bobinascorteorigen'), ['controller' => 'Bobinascorteorigen', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="bobinasdecortes view large-9 medium-8 columns content">
    <h3><?= h($bobinasdecorte->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Empleado') ?></th>
            <td><?= $bobinasdecorte->has('empleado') ? $this->Html->link($bobinasdecorte->empleado->id, ['controller' => 'Empleados', 'action' => 'view', $bobinasdecorte->empleado->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Impresora') ?></th>
            <td><?= $bobinasdecorte->has('impresora') ? $this->Html->link($bobinasdecorte->impresora->id, ['controller' => 'Impresoras', 'action' => 'view', $bobinasdecorte->impresora->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Horas') ?></th>
            <td><?= h($bobinasdecorte->horas) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Kilogramos') ?></th>
            <td><?= h($bobinasdecorte->kilogramos) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Scrap') ?></th>
            <td><?= h($bobinasdecorte->scrap) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($bobinasdecorte->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha') ?></th>
            <td><?= h($bobinasdecorte->fecha) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($bobinasdecorte->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($bobinasdecorte->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Bobinascorteorigen') ?></h4>
        <?php if (!empty($bobinasdecorte->bobinascorteorigens)): ?>
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
            <?php foreach ($bobinasdecorte->bobinascorteorigens as $bobinascorteorigen): ?>
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
