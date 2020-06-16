<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Impresora $impresora
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Impresora'), ['action' => 'edit', $impresora->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Impresora'), ['action' => 'delete', $impresora->id], ['confirm' => __('Are you sure you want to delete # {0}?', $impresora->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Impresoras'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Impresora'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bobinasdecortes'), ['controller' => 'Bobinasdecortes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bobinasdecorte'), ['controller' => 'Bobinasdecortes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="impresoras view large-9 medium-8 columns content">
    <h3><?= h($impresora->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($impresora->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($impresora->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Bobinasdecortes') ?></h4>
        <?php if (!empty($impresora->bobinasdecortes)): ?>
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
            <?php foreach ($impresora->bobinasdecortes as $bobinasdecortes): ?>
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
</div>
