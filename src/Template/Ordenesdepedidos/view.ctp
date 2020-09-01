<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ordenesdepedido $ordenesdepedido
 */
?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Vista de Pedido</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><?=$this->Html->link(__('Inicio'), ['action' => 'index'], [
                'escape' => false,
                ]) ?>
          </li>
          <li class="breadcrumb-item active">Vista de Pedido</li>
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
            <h3 class="card-title">ORDEN DE PEDIDO N° <?= h($ordenesdepedido->id) ?></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <dt class="text-center">CLIENTE:</dt>
                <dd class="text-center"><?= h($ordenesdepedido->cliente->nombre) ?></dd>
              </div>
              <div class="col-md-4">
                <dt class="text-center">COMUNICACIÓN:</dt>
                <dd class="text-center">E-mail</dd>
              </div>
              <div class="col-md-4">
                <dt class="text-center">FECHA:</dt>
                <dd class="text-center">20/05/2020</dd>
              </div>
            </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Órdenes de trabajo cargadas:</h3>
            <?php if (!empty($ordenesdepedido->ordenesdetrabajos)): ?>
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
                  <th scope="col"><?= __('Id') ?></th>
                  <th scope="col"><?= __('Ordenesdepedido Id') ?></th>
                  <th scope="col"><?= __('Cantidad') ?></th>
                  <th scope="col"><?= __('Material') ?></th>
                  <th scope="col"><?= __('Tipo') ?></th>
                  <th scope="col"><?= __('Color') ?></th>
                  <th scope="col"><?= __('Fuelle') ?></th>
                  <th scope="col"><?= __('Medida') ?></th>
                  <th scope="col"><?= __('Perf') ?></th>
                  <th scope="col"><?= __('Impreso') ?></th>
                  <th scope="col"><?= __('Preciounitario') ?></th>
                  <th scope="col"><?= __('Observaciones') ?></th>
                  <th scope="col"><?= __('Numero') ?></th>
                  <th scope="col"><?= __('Cierre') ?></th>
                  <th scope="col"><?= __('Cierremicrones') ?></th>
                  <th scope="col"><?= __('Cierrescrap') ?></th>
                  <th scope="col"><?= __('Cierrediferenciakg') ?></th>
                  <th scope="col"><?= __('Concluciones') ?></th>
                  <th scope="col"><?= __('Created') ?></th>
                  <th scope="col"><?= __('Modified') ?></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                <?php foreach ($ordenesdepedido->ordenesdetrabajos as $ordenesdetrabajos): ?>
                  <td><?= h($ordenesdetrabajos->id) ?></td>
                  <td><?= h($ordenesdetrabajos->ordenesdepedido_id) ?></td>
                  <td><?= h($ordenesdetrabajos->cantidad) ?></td>
                  <td><?= h($ordenesdetrabajos->material) ?></td>
                  <td><?= h($ordenesdetrabajos->tipo) ?></td>
                  <td><?= h($ordenesdetrabajos->color) ?></td>
                  <td><?= h($ordenesdetrabajos->fuelle) ?></td>
                  <td><?= h($ordenesdetrabajos->medida) ?></td>
                  <td><?= h($ordenesdetrabajos->perf) ?></td>
                  <td><?= h($ordenesdetrabajos->impreso) ?></td>
                  <td><?= h($ordenesdetrabajos->preciounitario) ?></td>
                  <td><?= h($ordenesdetrabajos->observaciones) ?></td>
                  <td><?= h($ordenesdetrabajos->numero) ?></td>
                  <td><?= h($ordenesdetrabajos->cierre) ?></td>
                  <td><?= h($ordenesdetrabajos->cierremicrones) ?></td>
                  <td><?= h($ordenesdetrabajos->cierrescrap) ?></td>
                  <td><?= h($ordenesdetrabajos->cierrediferenciakg) ?></td>
                  <td><?= h($ordenesdetrabajos->concluciones) ?></td>
                  <td><?= h($ordenesdetrabajos->created) ?></td>
                  <td><?= h($ordenesdetrabajos->modified) ?></td>
                </tr>
              <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    <!-- /.row -->
</div>
</div>
</div>
</div>
</div>
</section>
