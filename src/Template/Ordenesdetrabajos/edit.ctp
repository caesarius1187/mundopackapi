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
                  'Fuelle 3 cm – bolsas 15 cm de ancho'=>'Fuelle 3 cm – bolsas 15 cm de ancho',
                  'Fuelle 3.5 cm – bol 20 cm para Vino, Fcia. San Francisco '=>'Fuelle 3.5 cm – bol 20 cm para Vino, Fcia. San Francisco ',
                  'Fuelle 4 cm – bol 18 cm, 20 cm, 34 cm Artur'=>'Fuelle 4 cm – bol 18 cm, 20 cm, 34 cm Artur',
                  'Fuelle 4.5 cm – bol 25 cm La Provincial'=>'Fuelle 4.5 cm – bol 25 cm La Provincial',
                  'Fuelle 5 cm – bol 28 cm para Vino'=>'Fuelle 5 cm – bol 28 cm para Vino',
                  'Fuelle 5.5 cm – bol 25 cm'=>'Fuelle 5.5 cm – bol 25 cm',
                  'Fuelle 6 cm – bol 30 cm, 36 cm Mas Brillo, 36 cm Tierre Fuerte '=>'Fuelle 6 cm – bol 30 cm, 36 cm Mas Brillo, 36 cm Tierre Fuerte ',
                  'Fuelle 6.5 cm – bol 35 cm, 37 cm'=>'Fuelle 6.5 cm – bol 35 cm, 37 cm',
                  'Fuelle 7.2 cm – bol 43 cm Marilian'=>'Fuelle 7.2 cm – bol 43 cm Marilian',
                  'Fuelle 7.5 cm – bol 40 cm'=>'Fuelle 7.5 cm – bol 40 cm',
                  'Fuelle 8.5 cm – bol 45 cm, 47 cm'=>'Fuelle 8.5 cm – bol 45 cm, 47 cm',
                  'Fuelle de 9 cm – bol 70 cm'=>'Fuelle de 9 cm – bol 70 cm',
                  'Fuelle 9.5 cm – bol 50 cm'=>'Fuelle 9.5 cm – bol 50 cm',
                  'Fuelle de 10 cm – bol 55 cm, 80 cm, 45 cm Mas Brillo'=>'Fuelle de 10 cm – bol 55 cm, 80 cm, 45 cm Mas Brillo',
                  'Fuelle de 11 cm – bol 60 cm, 62 cm'=>'Fuelle de 11 cm – bol 60 cm, 62 cm',
                  'Fuelle de 12.5 cm – bol 85 cm, 60 cm Mas Brillo'=>'Fuelle de 12.5 cm – bol 85 cm, 60 cm Mas Brillo',
                  'Fuelle de 15 cm – bol 90 cm'=>'Fuelle de 15 cm – bol 90 cm',
                  'Fuelle de 16 cm – bol 100 cm'=>'Fuelle de 16 cm – bol 100 cm',
                  'Fuelle 25 cm – bol 120 cm '=>'Fuelle 25 cm – bol 120 cm ',
                ]
              ]); ?>
            </div>
            <div class="col-sm-3">
              <?= $this->Form->control('lamina',[
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
                      <tr numMaterial="<?= $cantMateriales ?>" class="rowMaterial">
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
                      <tr numMaterial="<?= $cantMateriales ?>" class="rowMaterial">
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
