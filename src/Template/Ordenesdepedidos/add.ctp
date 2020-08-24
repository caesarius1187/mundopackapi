<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ordenesdepedido $ordenesdepedido
 */

echo $this->Html->script('ordenesdepedidos/add',array('inline'=>false));

?>

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
              <div class="col-sm-12 text-center" style="margin-top:15px">
                <button type="submit" name="button" class="btn btn-success"><i class="fas fa-plus"></i> AGREGAR</button>
              </div>
            </div>
            <?= $this->Form->end(); ?>
            
            <div class="card card-secondary" style="display: none;">
              <div class="card-header">
                <h3 class="card-title">AGREGAR ORDEN DE TRABAJO</h3>
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
                        'type'=>'hidden' 
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
                          <tr>
                            <td>
                              <?= $this->Form->control('Materialesots.0.ordenesdetrabajo_id',[
                                'type'=>'hidden'
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
                                'value'=>'100',                                
                              ]); ?>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-2">
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
                      <button type="button" name="button" class="btn btn-primary"><i class="fas fa-search"></i> BUSCAR</button>
                      <button type="submit" name="button" class="btn btn-success"><i class="fas fa-plus"></i> AGREGAR</button>
                      <button type="button" name="button" class="btn btn-danger"><i class="fas fa-trash"></i> QUITAR</button>
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
                          <th>Tipo</th>
                          <th>Color</th>
                          <th>Fuelle</th>
                          <th>Medida</th>
                          <th>Perf.</th>
                          <th>Imp.</th>
                          <th>Cor.</th>
                          <th>Precio U.</th>
                          <th>Obs.</th>
                        </tr>
                      </thead>
                      <tbody>                          
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
              <div class="col-12 text-center">
                <button type="button" name="button" class="btn btn-secondary"><i class="fas fa-save"></i> GUARDAR</button>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script type="text/javascript">
$(function () {
  $('#reservationdate').datetimepicker({
        format: 'L',
        locale: 'es'
    });
  $('.select2').select2()
});
</script>
