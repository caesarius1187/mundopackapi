<?php
echo $this->Html->script('ordenesdepedidos/add',array('inline'=>false));
?>
<style media="screen">
.btn-circle {
  width: 30px;
  height: 30px;
  padding: 6px 0px;
  border-radius: 15px;
  text-align: center;
  font-size: 12px;
  line-height: 1.42857;
}
form input{
font-size:12px !important;
}
form select{
font-size:14px !important;
}
</style>
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title">MODIFICAR ORDEN DE TRABAJO</h3>
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
            <div class="col-sm-1">

            </div>
            <div class="col-sm-2">
              <?= $this->Form->control('color',[
                'label'=>'Color:'
              ]); ?>
            </div>
            <div class="col-sm-3">
              <?= $this->Form->control('fuelle',[
                'label'=>'Fuelle:',
                'type'=>'select',
                'options'=>[
                  'No'=>'No',
                  '3cm' => '3cm' , 
                  '3.5cm' => '3.5cm' , 
                  '4cm' => '4cm' , 
                  '4.5cm' => '4.5cm' , 
                  '5.5cm' => '5.5cm' , 
                  '6cm' => '6cm' , 
                  '6.5cm' => '6.5cm' , 
                  '7.2cm' => '7.2cm' , 
                  '7.5cm' => '7.5cm' , 
                  '8.5cm' => '8.5cm' , 
                  '9cm' => '9cm' , 
                  '9.5cm' => '9.5cm' , 
                  '10cm' => '10cm' , 
                  '11 cm' => '11 cm' , 
                  '12.5cm' => '12.5cm' , 
                  '15 cm' => '15 cm' , 
                  '16 cm' => '16 cm' , 
                  '25 cm' => '25 cm' 
                ]
              ]); ?>
            </div>
            <div class="col-sm-3">
              <?= $this->Form->control('tipofuelle',[
                'label'=>'Lamina:',
                'type'=>'select',
                'options'=>[
                  'No'=>'No',
                  'abierto 1 lado'=>'abierto 1 lado',
                  'abierto 2 lados'=>'abierto 2 lados',
                ]
              ]); ?>
            </div>
            <div class="col-sm-2">
              <?= $this->Form->control('tratado',[
                'type'=>'select',
                'label'=>' Tratado',
                'options'=>[
                    'No'=>'No',
                    '1 Cara'=>'1 Cara',
                    '2 Caras'=>'2 Caras'
                ]
              ]); ?>
              <?= $this->Form->control('perf',[
                'type'=>'checkbox',
                'class'=>'form-check-input align-middle',
                'label'=>' Perforado'
              ]); ?>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-1">
              <?= $this->Form->control('ancho',[
                'label'=>'Ancho:',
                'class'=>'inputCalculoOT'
              ]); ?>
            </div>
            <div class="col-sm-1">
              <?= $this->Form->control('largo',[
                'label'=>'Largo:',
                'class'=>'inputCalculoOT'
              ]); ?>
            </div>
            <div class="col-sm-1">
              <?= $this->Form->control('espesor',[
                'label'=>'Espesor:',
                'class'=>'inputCalculoOT'
              ]); ?>
            </div>
            <div class="col-sm-1">
              <?= $this->Form->control('cantidad',[
                'label'=>'Cant.:',
                'class'=>'inputCalculoOT'
              ]); ?>
            </div>
            <div class="col-sm-1">
              <?= $this->Form->control('pesoxmil',[
                'label'=>'Peso:',
                'class'=>'inputCalculoOT'
              ]); ?>
            </div>
            <div class="col-sm-2">
              <?= $this->Form->control('metrototal',[
                'label'=>'Metros:'
              ]); ?>
            </div>
            <div class="col-sm-1">
              <?= $this->Form->control('aextrusar',[
                'label'=>'Extrusar:',
                'class'=>'inputCalculoOT'
              ]); ?>
            </div>
            <div class="col-sm-2">
              <?= $this->Form->control('pesobob',[
                'label'=>'Peso por bobina:'
              ]); ?>
            </div>
            <div class="col-sm-2">
              <?= $this->Form->control('metrobob',[
                'label'=>'Metros por bobina:'
              ]); ?>
            </div>
          </div>
          <div class="row">

            <div class="col-sm-3">
            </div>

            <div class="col-sm-2">
              <?= $this->Form->control('manija',[
                  'label'=>'Manija:',
                  'type'=>'select',
                  'options'=>[
                    'no'=>'No',
                    'camiseta'=>'Camiseta',
                    'rinon'=>'Riñon',
                  ]
                ]) ; ?>
            </div>
            <div class="col-sm-2">
              <?= $this->Form->control('impreso',[
                'type'=>'hidden',
              ]); ?>
              <?= $this->Form->control('tipoimpresion',[
                  'label'=>'Tipo de impresión:',
                  'type'=>'select',
                  'onchange'=>'cambiarImpreso()',
                  'options'=>[
                    'sin impresion'=>'No',
                    'centrado'=>'Centrado',
                    'corrido'=>'Corrido'
                  ]
                ]); ?>
            </div>
            <div class="col-sm-2">
              <?= $this->Form->control('cortado',[
                'type'=>'hidden',
              ]); ?>
              <?= $this->Form->control('tipocorte',[
                'label'=>'Tipo de corte:',
                'class'=>'inputCalculoOT',
                'type'=>'select',
                'onchange'=>'cambiarCortado()',
                'options'=>[
                  'sin corte'=>'No',
                  'fondo'=>'Fondo',
                  'lateral'=>'Lateral',
                  'troquelado'=>'Troquelado',
                ]
              ]); ?>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <table class="table" id="tblMateriales">
                <thead class="thead-dark">
                  <tr>
                    <th class="align-middle">Material</th>
                    <th class="align-middle">Tipo</th>
                    <th class="align-middle">Porcentaje (%)</th>
                    <th class="align-middle">Kilos</th>
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
                            'onchange'=>'calcularKilosDeMateriales()',
                          ]); ?>
                        </td>
                        <td><h4><span class="spankilos badge badge-warning">0.00</span><h4></td>
                        <td> <button onclick="deleteMaterial(this)" type="button" name="button" class="btn btn-danger btn-sm btn-circle"><i class="fas fa-minus"></i></button> </td>
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
                        <td><h4><span class="spankilos badge badge-warning">0.00</span><h4></td>
                        <td> <button onclick="deleteMaterial(this)" type="button" name="button" class="btn btn-danger btn-sm btn-circle"><i class="fas fa-minus"></i></button> </td>
                      </tr>
                      <?php
                  }
                  echo $this->Form->control('cantmateriales',['type'=>'hidden','value'=>$cantMateriales ]); 
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-2">
              <?= $this->Form->control('preciounitario',[
                'label'=>'Precio ($):',
              ]); ?>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3">
              <?= $this->Form->control('observaciones',[
                'label'=>'Observaciones:',
                'type' => 'textarea', 'escape' => false
              ]); ?>
            </div>
            <div class="col-sm-3">
              <?= $this->Form->control('observacionesextrusion',[
                'label'=>'Observacion Extrusion:',
                'type' => 'textarea', 'escape' => false
              ]); ?>
            </div>
            <div class="col-sm-3">
              <?= $this->Form->control('observacionesimpresion',[
                'label'=>'Observacion Impresion:',
                'type' => 'textarea', 'escape' => false
              ]); ?>
            </div>
            <div class="col-sm-3s">
              <?= $this->Form->control('observacionescorte',[
                'label'=>'Observacion Corte:',
                'type' => 'textarea', 'escape' => false
              ]); ?>
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
