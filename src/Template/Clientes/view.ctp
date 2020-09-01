<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cliente $cliente
 */
?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row">
      <?= $this->Html->link(__('<i class="fas fa-reply"></i> Volver'), ['action' => 'index'], [
          'escape' => false,
          'class' => 'btn btn-warning btn-sm'
          ]) ?>
      <?= $this->Html->link(__('<i class="fas fa-edit"></i> Editar'), ['action' => 'edit', $cliente->id], [
          'escape' => false,
          'class' => 'btn btn-info btn-sm',
          'style' => 'margin-left: 5px'
          ]) ?>
    </div>
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Vista del cliente</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Inicio</a></li>
          <li class="breadcrumb-item active">Vista del cliente</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row justify-content-md-center">
      <div class="col-md-6">
        <div class="card">
            <div class="card-header">
              <h1 class="card-title">
                <i class="fas fa-address-card"></i>
                <?= h($cliente->nombre) ?>
              </h1>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <dl class="row">
                <dt class="col-sm-4 text-right">DIRECCIÓN:</dt>
                <dd class="col-sm-8"><?= h($cliente->direccion) ?></dd>
                <dt class="col-sm-4 text-right">CELULAR:</dt>
                <dd class="col-sm-8"><?= h($cliente->celular) ?></dd>
              </dl>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    <!-- /.tab-pane -->
  </div>
  <!-- /.tab-content -->
</div><!-- /.card-body -->
