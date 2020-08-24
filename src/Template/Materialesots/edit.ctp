<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Materialesot $materialesot
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $materialesot->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $materialesot->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Materialesots'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Ordenesdetrabajos'), ['controller' => 'Ordenesdetrabajos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ordenesdetrabajo'), ['controller' => 'Ordenesdetrabajos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="materialesots form large-9 medium-8 columns content">
    <?= $this->Form->create($materialesot) ?>
    <fieldset>
        <legend><?= __('Edit Materialesot') ?></legend>
        <?php
            echo $this->Form->control('ordenesdetrabajo_id', ['options' => $ordenesdetrabajos]);
            echo $this->Form->control('material');
            echo $this->Form->control('porcentaje');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
