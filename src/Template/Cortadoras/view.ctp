<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cortadora $cortadora
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Cortadora'), ['action' => 'edit', $cortadora->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Cortadora'), ['action' => 'delete', $cortadora->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cortadora->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Cortadoras'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cortadora'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bobinasdeimpresions'), ['controller' => 'Bobinasdeimpresions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bobinasdeimpresion'), ['controller' => 'Bobinasdeimpresions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="cortadoras view large-9 medium-8 columns content">
    <h3><?= h($cortadora->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($cortadora->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($cortadora->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Bobinasdeimpresions') ?></h4>
        <?php if (!empty($cortadora->bobinasdeimpresions)): ?>
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
            <?php foreach ($cortadora->bobinasdeimpresions as $bobinasdeimpresions): ?>
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
