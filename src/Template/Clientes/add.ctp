<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cliente $cliente
 */

 echo $this->Html->script('clientes/add',array('inline'=>false));
?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row">
      <?= $this->Html->link(__('<i class="fas fa-reply"></i> Volver'), ['action' => 'index'], [
          'escape' => false,
          'class' => 'btn btn-warning btn-sm'
          ]) ?>
    </div>
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Agregar cliente</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Inicio</a></li>
          <li class="breadcrumb-item active">Agregar cliente</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row justify-content-md-center">
      <div class="col-6">
        <!-- general form elements -->
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">DATOS DEL CLIENTE</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <?= $this->Form->create($cliente) ?>
            <div class="card-body">
              <div class="form-group">
                <?php echo $this->Form->control('nombre',['label'=>['text'=>'Nombre:']]); ?>
              </div>
              <div class="form-group">
                <?php echo $this->Form->control('direccion',['label'=>['text'=>'Dirección:']]); ?>
              </div>
              <div class="form-group">
                <?php echo $this->Form->control('celular',['label'=>['text'=>'Celular:']]); ?>
              </div>
              <div class="form-group">
                <?php echo $this->Form->control('tipofactura',[
                  'label'=>['text'=>'Tipo de Factura:'],
                  'type'=>'select',
                  'options'=>[
                    'Nota de Pedido'=>'Nota de Pedido',
                    'Factura A'=>'Factura A',
                    'Factura B'=>'Factura B',
                  ]
                ]); ?>
              </div>
              <div class="form-group">
                <?php echo $this->Form->control('cuit',['label'=>['text'=>'CUIT:']]); ?>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <?= $this->Form->button(__('<i class="fas fa-save"></i> GUARDAR'), [
                'escape' => false,
                'class' => 'btn btn-success float-right'
                ]) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
        <!-- /.card -->
