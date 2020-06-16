<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Extrusora $extrusora
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Extrusora'), ['action' => 'edit', $extrusora->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Extrusora'), ['action' => 'delete', $extrusora->id], ['confirm' => __('Are you sure you want to delete # {0}?', $extrusora->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Extrusoras'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Extrusora'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bobinasdeextrusions'), ['controller' => 'Bobinasdeextrusions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bobinasdeextrusion'), ['controller' => 'Bobinasdeextrusions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="extrusoras view large-9 medium-8 columns content">
    <h3><?= h($extrusora->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($extrusora->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($extrusora->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Bobinasdeextrusions') ?></h4>
        <?php if (!empty($extrusora->bobinasdeextrusions)): ?>
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
            <?php foreach ($extrusora->bobinasdeextrusions as $bobinasdeextrusions): ?>
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
</div>
