<?php
echo $this->Html->script('ordenesdepedidos/edit',array('inline'=>false));
?>
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title">Modificar ORDEN DE TRABAJO</h3>
    </div>
      <!-- /.card-header -->
    <div class="card-body">
        <?= $this->Form->create($ordenesdetrabajo,[
            'id'=>'OrdenesDeTrabajoEditForm',
            'url'=>[
              'controller'=>'ordenesdetrabajos',
              'action'=>'edit',
            ],
        ]) ?>
        <?= $this->Form->control('estado',[
              'value'=>'En Proceso', 
              'type'=>'hidden' 
            ]); ?>
        <?= $this->Form->control('id',[
            'type'=>'hidden', 
            'value'=>$ordenesdetrabajo->id
        ]); ?>
        <?= $this->Form->control('ordenesdepedido_id',[
            'type'=>'hidden' ,
            'value'=>$ordenesdetrabajo->ordenesdepedido_id
          ]); ?>
        <div class="row">
            <div class="col-sm-12">
                <table class="table" id="tblMateriales">
                    <thead>
                      <tr>
                        <th>Material</th>
                        <th>Tipo</th>
                        <th>Porcentaje</th>
                        <th><button type="button" name="button" class="btn btn-success" onclick="loadMaterial()"><i class="fas fa-plus"></i></button></th>
                      </tr>
                    </thead>
                    <tbody id="tblMaterialesBody">
                        <?php
                        $cantMateriales = 0;
                        foreach ($ordenesdetrabajo['materialesots'] as $key => $materialesot) {
                            $cantMateriales++;
                            ?>
                            <tr>
                              <td>
                                <?= $this->Form->control('Materialesots.'.$key.'.id',[
                                  'type'=>'hidden',
                                  'value'=>$materialesot->id
                                ]); ?>
                                <?= $this->Form->control('Materialesots.'.$key.'.ordenesdetrabajo_id',[
                                  'type'=>'hidden',
                                  'value'=>$materialesot->ordenesdetrabajo_id
                                ]); ?>
                                <?= $this->Form->control('Materialesots.'.$key.'.material',[
                                  'label'=>false,
                                  'value'=>$materialesot->material,
                                  'type'=>'select',
                                  'options'=>[$materiales]
                                ]); ?>
                              </td>
                              <td>
                                <?= $this->Form->control('Materialesots.'.$key.'.tipo',[
                                  'label'=>false,
                                  'value'=>$materialesot->tipo,
                                  'type'=>'select',
                                  'options'=>[
                                    'Nuevo'=>'Nuevo',
                                    'Reciclado'=>'Reciclado',
                                  ]
                                ]); ?>
                              </td>
                              <td>
                                <?= $this->Form->control('Materialesots.'.$key.'.porcentaje',[
                                  'label'=>false,
                                  'value'=>$materialesot->porcentaje,
                                  'class'=>'porcentaje',
                                ]); ?>
                              </td>
                            </tr>
                            <?php
                        }
                        if($cantMateriales==0){
                            $cantMateriales++;
                            ?>
                            <tr>
                              <td>
                                <?= $this->Form->control('Materialesots.0.id',[
                                  'type'=>'hidden',
                                ]); ?>
                                <?= $this->Form->control('Materialesots.0.ordenesdetrabajo_id',[
                                  'type'=>'hidden',
                                  'value'=>$ordenesdetrabajo->id
                                ]); ?>
                                <?= $this->Form->control('Materialesots.0.material',[
                                  'label'=>false,
                                  'type'=>'select',
                                  'options'=>[$materiales]
                                ]); ?>
                              </td>
                              <td>
                                <?= $this->Form->control('Materialesots.0.tipo',[
                                  'label'=>false,
                                  'type'=>'select',
                                  'options'=>[
                                    'Nuevo'=>'Nuevo',
                                    'Reciclado'=>'Reciclado',
                                  ]
                                ]); ?>
                              </td>
                              <td>
                                <?= $this->Form->control('Materialesots.0.porcentaje',[
                                  'label'=>false,
                                  'class'=>'porcentaje',
                                ]); ?>
                              </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">
                <?= $this->Form->control('cantMateriales',[
                    'type'=>'hidden' ,
                    'value'=>$cantMateriales
                ]); ?>
              <?= $this->Form->control('color',[ ]); ?>            
            </div>
            <div class="col-sm-3">
              <?= $this->Form->control('fuelle',[
                'type'=>'select',
                'options'=>[
                  '5cm'=>'5cm',
                  '7,5cm'=>'7,5cm',
                  '10cm'=>'10cm',
                ]
              ]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-1">
              <?= $this->Form->control('ancho',['class'=>'inputCalculoOT']); ?>
            </div>
            <div class="col-sm-1">
              <?= $this->Form->control('largo',['class'=>'inputCalculoOT']); ?>
            </div>
            <div class="col-sm-1">
              <?= $this->Form->control('espesor',['class'=>'inputCalculoOT']); ?>
            </div>
            <div class="col-sm-1">
              <?= $this->Form->control('cantidad',['class'=>'inputCalculoOT']); ?>
            </div>
            <div class="col-sm-1">
              <?= $this->Form->control('pesoxmil',[ ]); ?>
            </div>
            <div class="col-sm-1">
              <?= $this->Form->control('metrototal',[ ]); ?>
            </div>
            <div class="col-sm-1">
              <?= $this->Form->control('aextrusar',['class'=>'inputCalculoOT']); ?>
            </div>
            <div class="col-sm-1">
              <?= $this->Form->control('pesobob',[ ]); ?>
            </div>
            <div class="col-sm-1">
              <?= $this->Form->control('metrobob',[ ]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">
              <?= $this->Form->control('perf',[ ]); ?>
            </div>
            <div class="col-sm-3">
              <?= $this->Form->control('impreso',['type'=>'checkbox','label'=>' Imprimir' ]); ?>
              <?= $this->Form->control('cortado',[ 'type'=>'checkbox','label'=>' Cortar' ]); ?>
            </div>
            <div class="col-sm-2">
              <?= $this->Form->control('preciounitario',[ ]); ?>
            </div>
            <div class="col-sm-5">
              <?= $this->Form->control('observaciones',[ ]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 text-center" style="margin-top:15px">
                <button type="submit" name="button" class="btn btn-success"><i class="fas fa-plus"></i> Modificar</button>
            </div>
        </div>
        <?= $this->Form->end(); ?>
    </div>
</div>