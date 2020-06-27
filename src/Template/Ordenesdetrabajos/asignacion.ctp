
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Empleado[]|\Cake\Collection\CollectionInterface $empleados
 */
echo $this->Html->script('ordenesdetrabajos/asignacion',array('inline'=>false));

?>
<div class="asignacion index large-12 medium-8 columns content">
    <div class="row">
        <div class="col-lg-4">
            <h6>Ordenes de Trabajo en Proceso</h6>
            <table>
                <thead>
                    <tr>
                        <th>
                            Numero
                        </th>
                    </tr>
                </thead>
                <tbody>
            	 	<?php 
                    foreach ($ordenesdetrabajos as $ordenesdetrabajo){ 
                        ?>
                     	<tr class="col" onclick="">
                            <td>
                         		<label><?= $ordenesdetrabajo->numero ?></label>
                            </td>
                 		</tr>  
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-8">
            <h6>Proridades</h6>
            <div class="row">
                <?php foreach ($extrusoras as $extrusora): ?>
                    <div class="col" onclick="loadFormPrioridad('extrusora',<?= $extrusora->id ?>)">
                        <table>
                            <thead><tr><td><?= $extrusora->nombre?></td></tr></thead>
                            <tbody>
                                <?php foreach ($extrusora->ordenots as $ordenot){ ?>
                                    <tr><td><?= $ordenot->ordenesdetrabajo->numero?></td></tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php endforeach; ?>
            </div>  
            <div class="row">
                <?php foreach ($impresoras as $impresora): ?>
                    <div class="col" onclick="loadFormPrioridad('impresora',<?= $extrusora->id ?>)">
                        <table>
                            <thead><tr><td><?= $impresora->nombre?></td></tr></thead>
                            <tbody>
                                <?php foreach ($impresora->ordenots as $ordenot){ ?>
                                    <tr><td><?= $ordenot->ordenesdetrabajo->numero?></td></tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>  
                <?php endforeach; ?>
            </div>  
            <div class="row">
                <?php foreach ($cortadoras as $cortadora): ?>
                    <div class="col" onclick="loadFormPrioridad('cortadora',<?= $extrusora->id ?>)">
                        <table>
                            <thead><tr><td><?= $cortadora->nombre?></td></tr></thead>
                            <tbody>
                                <?php foreach ($cortadora->ordenots as $ordenot){ ?>
                                    <tr><td><?= $ordenot->ordenesdetrabajo->numero?></td></tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php endforeach; ?>
            </div>   
        </div>
    </div>      
</div>
<div class="modal" id="myModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?= $this->Form->create($ordenot) ?>
        <fieldset>
            <legend><?= __('Add Ordenot') ?></legend>
            <?php
                echo $this->Form->control('extrusora_id', ['type' => 'hidden']);
                echo $this->Form->control('impresora_id', ['type' => 'hidden']);
                echo $this->Form->control('cortadora_id', ['type' => 'hidden']);
                echo $this->Form->control('ordenesdetrabajo_id', ['options' => $listordenesdetrabajos]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>