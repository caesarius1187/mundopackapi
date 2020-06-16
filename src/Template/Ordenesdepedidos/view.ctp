<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ordenesdepedido $ordenesdepedido
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Ordenesdepedido'), ['action' => 'edit', $ordenesdepedido->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Ordenesdepedido'), ['action' => 'delete', $ordenesdepedido->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ordenesdepedido->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Ordenesdepedidos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ordenesdepedido'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Ordenesdetrabajos'), ['controller' => 'Ordenesdetrabajos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ordenesdetrabajo'), ['controller' => 'Ordenesdetrabajos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="ordenesdepedidos view large-9 medium-8 columns content">
    <h3><?= h($ordenesdepedido->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($ordenesdepedido->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha') ?></th>
            <td><?= h($ordenesdepedido->fecha) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($ordenesdepedido->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($ordenesdepedido->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Ordenesdetrabajos') ?></h4>
        <?php if (!empty($ordenesdepedido->ordenesdetrabajos)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Ordenesdepedido Id') ?></th>
                <th scope="col"><?= __('Cantidad') ?></th>
                <th scope="col"><?= __('Material') ?></th>
                <th scope="col"><?= __('Tipo') ?></th>
                <th scope="col"><?= __('Color') ?></th>
                <th scope="col"><?= __('Fuelle') ?></th>
                <th scope="col"><?= __('Medida') ?></th>
                <th scope="col"><?= __('Perf') ?></th>
                <th scope="col"><?= __('Impreso') ?></th>
                <th scope="col"><?= __('Preciounitario') ?></th>
                <th scope="col"><?= __('Observaciones') ?></th>
                <th scope="col"><?= __('Numero') ?></th>
                <th scope="col"><?= __('Cierre') ?></th>
                <th scope="col"><?= __('Cierremicrones') ?></th>
                <th scope="col"><?= __('Cierrescrap') ?></th>
                <th scope="col"><?= __('Cierrediferenciakg') ?></th>
                <th scope="col"><?= __('Concluciones') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($ordenesdepedido->ordenesdetrabajos as $ordenesdetrabajos): ?>
            <tr>
                <td><?= h($ordenesdetrabajos->id) ?></td>
                <td><?= h($ordenesdetrabajos->ordenesdepedido_id) ?></td>
                <td><?= h($ordenesdetrabajos->cantidad) ?></td>
                <td><?= h($ordenesdetrabajos->material) ?></td>
                <td><?= h($ordenesdetrabajos->tipo) ?></td>
                <td><?= h($ordenesdetrabajos->color) ?></td>
                <td><?= h($ordenesdetrabajos->fuelle) ?></td>
                <td><?= h($ordenesdetrabajos->medida) ?></td>
                <td><?= h($ordenesdetrabajos->perf) ?></td>
                <td><?= h($ordenesdetrabajos->impreso) ?></td>
                <td><?= h($ordenesdetrabajos->preciounitario) ?></td>
                <td><?= h($ordenesdetrabajos->observaciones) ?></td>
                <td><?= h($ordenesdetrabajos->numero) ?></td>
                <td><?= h($ordenesdetrabajos->cierre) ?></td>
                <td><?= h($ordenesdetrabajos->cierremicrones) ?></td>
                <td><?= h($ordenesdetrabajos->cierrescrap) ?></td>
                <td><?= h($ordenesdetrabajos->cierrediferenciakg) ?></td>
                <td><?= h($ordenesdetrabajos->concluciones) ?></td>
                <td><?= h($ordenesdetrabajos->created) ?></td>
                <td><?= h($ordenesdetrabajos->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Ordenesdetrabajos', 'action' => 'view', $ordenesdetrabajos->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Ordenesdetrabajos', 'action' => 'edit', $ordenesdetrabajos->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Ordenesdetrabajos', 'action' => 'delete', $ordenesdetrabajos->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ordenesdetrabajos->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
