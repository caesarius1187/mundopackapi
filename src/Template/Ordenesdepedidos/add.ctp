<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ordenesdepedido $ordenesdepedido
 */

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

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Nueva orden de Pedido</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><?=$this->Html->link(__('Inicio'), ['action' => 'index'], [
                'escape' => false,
                ]) ?>
          </li>
          <li class="breadcrumb-item active">Nueva orden de Pedido</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">ORDEN DE PEDIDO N° <?= $maxNumOrdenPedido ?></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <?= $this->Form->create($ordenesdepedido,[
              'id'=>'OrdenesDePedidoAddForm',
              'url'=>[
                'controller'=>'ordenesdepedidos',
                'action'=>'addsingle',
              ],
            ]) ?>
            <div class="row">
              <div class="col-md-5">
                <?= $this->Form->control('id'); ?>
                <?= $this->Form->control('cliente_id'); ?>
                <?= $this->Form->control('numero',[
                  'type'=>'hidden',
                  'value'=>$maxNumOrdenPedido,
                ]); ?>
                <?= $this->Form->control('id',[
                  'type'=>'hidden',
                ]); ?>
              </div>
              <div class="col-md-4">
                <?= $this->Form->control('metodocomunicacion',[
                  'type'=>'select',
                  'options'=>[
                    'Mitre'=>'Mitre',
                    'Whatsapp'=>'Whatsapp',
                    'Mail'=>'Mail',
                    'Telefono'=>'Telefono',
                    'Fabrica'=>'Fabrica',
                    'Cliente'=>'Cliente',
                  ]
                ]); ?>
              </div>
              <div class="col-md-3">
                <?= $this->Form->control('fecha',[
                  'type'=>'text',
                  'required'=>true,
                  'onkeydown'=>'return false',
                  'label'=>[
                    'text'=>'Fecha',
                    'style'=>'width:100%'
                  ],
                  'templates'=>[
                    'inputContainer'=>'
                      <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        {{content}}
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>']
                ]); ?>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 text-center" style="margin-bottom:15px">
                <button type="submit" name="button" class="btn btn-success"><i class="fas fa-plus"></i><?= ($ordenesdepedido->id==0)?' AGREGAR':'Modificar'?></button>
              </div>
            </div>
            <?= $this->Form->end(); ?>
            <?php
            if($ordenesdepedido->id==0){
              $display='display:';
            }
            ?>

            <div class="card card-secondary" style="<?= ($ordenesdepedido->id==0)?'display: none':''?>;">
              <div class="card-header">
                <h3 class="card-title">AGREGAR ORDEN DE TRABAJO</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?= $this->Form->create($ordenesdepedido,[
                    'id'=>'OrdenesDeTrabajoAddForm',
                    'url'=>[
                      'controller'=>'ordenesdetrabajos',
                      'action'=>'addsingle',
                    ],
                  ]) ?>
                  <?= $this->Form->control('estado',[
                          'value'=>'En Proceso',
                          'type'=>'hidden'
                        ]); ?>
                <?= $this->Form->control('ordenesdepedido_id',[
                        'type'=>'hidden' ,
                        'value'=>$ordenesdepedido->id
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
                          '5cm'=>'5cm',
                          '7,5cm'=>'7,5cm',
                          '10cm'=>'10cm',
                          '12.5cm'=>'12.5cm',
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
                    <div class="col-sm-2 form-check m-3">
                      <?= $this->Form->control('tratado',[
                        'type'=>'checkbox',
                        'class'=>'form-check-input align-middle',
                        'label'=>' Tratado'
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
                        'value'=>'0'
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
                        'value'=>'0'
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
                            <tr>
                              <td >
                                <?= $this->Form->control('Materialesots.0.ordenesdetrabajo_id',[
                                  'type'=>'hidden',
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
                                  'onclick'=>'calcularKilosDeMateriales()',
                                  'value'=>'100',
                                ]); ?>
                              </td>
                              <td><h4><span class="spankilos badge badge-warning">0.00</span><h4></td>
                              <td> <button onclick="deleteMaterial(this)" type="button" name="button" class="btn btn-danger btn-sm btn-circle"><i class="fas fa-minus"></i></button> </td>
                            </tr>
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
                    <div class="col-sm-10">
                      <?= $this->Form->control('observaciones',[
                        'label'=>'Observaciones:',
                      ]); ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12 text-center" style="margin-top:15px">
                      <button type="button" name="button" class="btn btn-primary" onclick="buscarOt()"><i class="fas fa-search"></i> BUSCAR</button>
                      <button type="submit" name="button" class="btn btn-success"><i class="fas fa-plus"></i> AGREGAR</button>
                    </div>
                  </div>

                <?= $this->Form->end(); ?>
              </div>
            </div>

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Órdenes de trabajo cargadas:</h3>

                    <div class="card-tools">
                      <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Buscar">

                        <div class="input-group-append">
                          <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0" style="height: 300px;">
                    <table id="tblOrdenesDeTrabajo" class="table table-head-fixed text-nowrap">
                      <thead>
                        <tr>
                          <th>Numero</th>
                          <th>Cant.</th>
                          <th>A Extrusar</th>
                          <th>Material</th>
                          <th>Color</th>
                          <th>Fuelle</th>
                          <th>Medida</th>
                          <th>Perf.</th>
                          <th>Imp.</th>
                          <th>Cor.</th>
                          <th>Precio U.</th>
                          <th>Obs.</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      if(isset($ordenesdepedido->ordenesdetrabajos)){
                        foreach ($ordenesdepedido->ordenesdetrabajos as $key => $ordendetrabajo) {
                            ?>
                            <tr>
                              <td><?= $ordendetrabajo->numero?></td>
                              <td><?= $ordendetrabajo->cantidad?></td>
                              <td><?= $ordendetrabajo->aextrusar?></td>
                              <?php
                              $materialtext = "";
                              foreach ($ordendetrabajo['materialesots'] as $key => $material) {
                                 $materialtext .= $material['material'].":".$material['tipo']." al ".$material['porcentaje']."% /";
                              }
                              ?>
                              <td title="<?= $materialtext ?>">
                                <label style=" display:block; width: 150px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
                                  <?= $materialtext ?>
                                </label>
                              </td>
                              <td><?= $ordendetrabajo->color?></td>
                              <td><?= $ordendetrabajo->fuelle?></td>
                              <td><?= $ordendetrabajo->medida?></td>
                              <td><?= $ordendetrabajo->perf?></td>
                              <td><?= $ordendetrabajo->impreso?'SI':'NO'?></td>
                              <td><?= $ordendetrabajo->cortado?'SI':'NO'?></td>
                              <td><?= $ordendetrabajo->preciounitario?></td>
                              <td><?= $ordendetrabajo->observaciones?></td>
                              <td>
                              <?=$this->Html->link('<i class="fas fa-search"></i>',
                                  [
                                    'controller' => 'ordenesdetrabajos',
                                    'action' => 'view',
                                    $ordendetrabajo->id
                                  ],
                                  [
                                    'escape' => false,
                                    'class' => "btn btn-info btn-sm",
                                ]) ?>
                              <?=$this->Html->link('<i class="fas fa-edit"></i>',
                                  [
                                    'controller' => 'ordenesdetrabajos',
                                    'action' => 'edit',
                                    $ordendetrabajo->id
                                  ],
                                  [
                                    'escape' => false,
                                    'class' => "btn btn-success btn-sm",
                                ]) ?>
                              </td>
                            </tr>
                            <?php
                        }
                      }
                      ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
            </div>
            <!-- /.row -->
            <div class="row">
              <div class="col-md-12" style="text-align:center">
                <?php
                echo $this->Html->link(__('<i class="fas fa-save"></i>
                    <p>
                      Finalizar pedido
                    </p>'),
                    array ( 'plugin' => null, 'controller' => 'ordenesdetrabajos', 'action' => 'asignacion', '_ext' => NULL),
                    [
                        'escape' => false,
                        'class'=> 'btn btn-primary'
                    ]
                );
                 ?>
              </div>
            </div>
            <!-- <div class="row">
              <div class="col-12 text-center">
                <button type="button" name="button" class="btn btn-secondary"><i class="fas fa-save"></i> GUARDAR</button>
              </div>
            </div> -->
        </div>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="myModalMaquina">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title"><i class="fas fa-industry"></i> EXTRUSORA 1</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body p-0" style="overflow-x: auto;">
          <table class="table table-sm" >
            <thead>
              <tr>
                <th>Ini</th>
                <th>Cli</th>
                <th>OT</th>
                <th>Medidas</th>
                <th>Cant.</th>
                <th>Materiales</th>
                <th>Imp.</th>
                <th>Cort.</th>
                <th>Obs.</th>
                <th style="text-align:center">Acción</th>
              </tr>
            </thead>
            <tbody id="tblOrdenesAntiguas">
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <div class="modal-footer right-content-between">
        <button type="button" class="btn btn-primary" data-dismiss="modal">SALIR</button>
      </div>

    </div>

  </div>

</div>
