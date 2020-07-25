<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ordenesdetrabajo $ordenesdetrabajo
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Ordenesdetrabajo'), ['action' => 'edit', $ordenesdetrabajo->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Ordenesdetrabajo'), ['action' => 'delete', $ordenesdetrabajo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ordenesdetrabajo->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Ordenesdetrabajos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ordenesdetrabajo'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Ordenesdepedidos'), ['controller' => 'Ordenesdepedidos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ordenesdepedido'), ['controller' => 'Ordenesdepedidos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="ordenesdetrabajos view large-9 medium-8 columns content">
    <h3><?= h($ordenesdetrabajo->id) ?></h3>
    <table class=".table-bordered">
        <tr>
            <th scope="row"><?= __('Ordenesdepedido') ?></th>
            <td><?= $ordenesdetrabajo->has('ordenesdepedido') ? $this->Html->link($ordenesdetrabajo->ordenesdepedido->id, ['controller' => 'Ordenesdepedidos', 'action' => 'view', $ordenesdetrabajo->ordenesdepedido->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Material') ?></th>
            <td><?= h($ordenesdetrabajo->material) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tipo') ?></th>
            <td><?= h($ordenesdetrabajo->tipo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Color') ?></th>
            <td><?= h($ordenesdetrabajo->color) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fuelle') ?></th>
            <td><?= h($ordenesdetrabajo->fuelle) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Medida') ?></th>
            <td><?= h($ordenesdetrabajo->medida) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Perf') ?></th>
            <td><?= h($ordenesdetrabajo->perf) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Impreso') ?></th>
            <td><?= h($ordenesdetrabajo->impreso) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Preciounitario') ?></th>
            <td><?= h($ordenesdetrabajo->preciounitario) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Observaciones') ?></th>
            <td><?= h($ordenesdetrabajo->observaciones) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Numero') ?></th>
            <td><?= h($ordenesdetrabajo->numero) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cierremicrones') ?></th>
            <td><?= h($ordenesdetrabajo->cierremicrones) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cierrescrap') ?></th>
            <td><?= h($ordenesdetrabajo->cierrescrap) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cierrediferenciakg') ?></th>
            <td><?= h($ordenesdetrabajo->cierrediferenciakg) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Concluciones') ?></th>
            <td><?= h($ordenesdetrabajo->concluciones) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($ordenesdetrabajo->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cantidad') ?></th>
            <td><?= $this->Number->format($ordenesdetrabajo->cantidad) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cierre') ?></th>
            <td><?= h($ordenesdetrabajo->cierre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($ordenesdetrabajo->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($ordenesdetrabajo->modified) ?></td>
        </tr>
    </table>
</div>
