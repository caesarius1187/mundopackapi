
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
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th>
                            Numero
                        </th>
                        <th>
                            Cantidad
                        </th>
                        <th>
                            Extrusadas
                        </th>
                        <th>
                            Impresas
                        </th>
                        <th>
                            Cortadas
                        </th>
                        <th>
                            Acciones
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
                            <td><?= $ordenesdetrabajo->aextrusar?></td>
                            <td><?= $ordenesdetrabajo->extrusadas?></td>
                            <td><?= $ordenesdetrabajo->impreso?$ordenesdetrabajo->impresas:'-'?></td>
                            <td><?= $ordenesdetrabajo->cortado?$ordenesdetrabajo->cortadas:'-'?></td>
                            <td><?php
                                if($ordenesdetrabajo->estado!='En Proceso'){
                                    echo '<i onclick="playOT('.$ordenesdetrabajo->id.')" class="fas fa-play"></i>';
                                }
                                if($ordenesdetrabajo->estado!='Pausado'){
                                    echo '<i onclick="pausarOT('.$ordenesdetrabajo->id.')" class="fas fa-pause"></i>';
                                }
                                echo '<i onclick="cancelarOT('.$ordenesdetrabajo->id.')" class="fas fa-ban"></i>';
                            ?></td>
                 		</tr>  
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-8">
            <h6>Proridades</h6>
            <div class="row">
                <?php foreach ($extrusoras as $extrusora): ?>
                    <div class="col" >
                        <table id="tblExtrusora<?= $extrusora->id ?>">
                            <thead>
                                <tr>
                                    <td colspan="4" onclick="loadFormPrioridad('extrusora','<?= $extrusora->nombre ?>',<?= $extrusora->id ?>)"><?= $extrusora->nombre?>                                        
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($extrusora->ordenots as $ordenot){ ?>
                                    <tr id="rowOrdenOt<?= $ordenot->id ?>">
                                        <td><?= $ordenot->ordenesdetrabajo->numero?></td>                                       
                                        <td><i class="fas fa-level-up-alt" onclick="levelUp(<?= $ordenot->id ?>)"></i></td>
                                        <td><i class="fas fa-level-down-alt" onclick="levelDown(<?= $ordenot->id ?>)"></i></td>
                                        <td><i class="fas fa-trash-alt" onclick="deleteOrdOt(<?= $ordenot->id ?>)"></i></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php endforeach; ?>
            </div>  
            <div class="row">
                <?php foreach ($impresoras as $impresora): ?>
                    <div class="col" >
                        <table id="tblImpresora<?= $impresora->id ?>">
                            <thead>
                                <tr>
                                    <td onclick="loadFormPrioridad('impresora','<?= $impresora->nombre ?>',<?= $impresora->id ?>)"><?= $impresora->nombre?>                                        
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($impresora->ordenots as $ordenot){ ?>
                                    <tr id="rowOrdenOt<?= $ordenot->id ?>">
                                        <td><?= $ordenot->ordenesdetrabajo->numero?></td>                                       
                                        <td><i class="fas fa-level-up-alt" onclick="levelUp(<?= $ordenot->id ?>)"></i></td>
                                        <td><i class="fas fa-level-down-alt" onclick="levelDown(<?= $ordenot->id ?>)"></i></td>
                                        <td><i class="fas fa-trash-alt" onclick="deleteOrdOt(<?= $ordenot->id ?>)"></i></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>  
                <?php endforeach; ?>
            </div>  
            <div class="row">
                <?php foreach ($cortadoras as $cortadora): ?>
                    <div class="col" >
                        <table id="tblCortadora<?= $cortadora->id ?>">
                            <thead>
                                <tr>
                                    <td onclick="loadFormPrioridad('cortadora','<?= $cortadora->nombre ?>',<?= $cortadora->id ?>)"><?= $cortadora->nombre?>                                        
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cortadora->ordenots as $ordenot){ ?>
                                    <tr id="rowOrdenOt<?= $ordenot->id ?>">
                                        <td><?= $ordenot->ordenesdetrabajo->numero?></td>                                       
                                        <td><i class="fas fa-level-up-alt" onclick="levelUp(<?= $ordenot->id ?>)"></i></td>
                                        <td><i class="fas fa-level-down-alt" onclick="levelDown(<?= $ordenot->id ?>)"></i></td>
                                        <td><i class="fas fa-trash-alt" onclick="deleteOrdOt(<?= $ordenot->id ?>)"></i></td>
                                    </tr>
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
        <?= $this->Form->create($ordenot,[
            'id'=>'ordenOtAddForm',
            'url'=>[
                'controller'=>'ordenots',
                'action'=>'add',
            ]
        ]) ?>
        <fieldset>
            <legend><?= __('Agregar Orden') ?></legend>
            <?php
                echo $this->Form->control('extrusora_id', ['type' => 'hidden']);
                echo $this->Form->control('impresora_id', ['type' => 'hidden']);
                echo $this->Form->control('cortadora_id', ['type' => 'hidden']);
                echo $this->Form->control('ordenesdetrabajo_id', [
                    'optios' => [],
                    'label' => 'Ordenes de Trabajo'
                ]);
            ?>
        </fieldset>
        <?= $this->Form->end() ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="$('#ordenOtAddForm').submit()">Agregar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>