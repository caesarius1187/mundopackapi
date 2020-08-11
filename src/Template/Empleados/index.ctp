<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Empleado[]|\Cake\Collection\CollectionInterface $empleados
 */
?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Empleados</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Inicio</a></li>
          <li class="breadcrumb-item active">Empleados</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">

              <?= $this->Html->link(__('<i class="fas fa-plus"></i> Nuevo empleado'), ['action' => 'add'], [
                'escape' => false,
                'class' => 'btn btn-primary float-right'
                ]) ?>

              <table id="example" class="table table-bordered table-hover table-sm">
                  <thead>
                      <tr>
                        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('nombre') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('legajo') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('rol') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('direccion') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('celular') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php foreach ($empleados as $empleado): ?>
                      <tr>
                          <td><?= $this->Number->format($empleado->id) ?></td>
                          <td><?= h($empleado->nombre) ?></td>
                          <td><?= h($empleado->legajo) ?></td>
                          <td><?= h($empleado->rol) ?></td>
                          <td><?= h($empleado->direccion) ?></td>
                          <td><?= h($empleado->celular) ?></td>
                          <td><?= h($empleado->created) ?></td>
                          <td><?= h($empleado->modified) ?></td>
                          <td class="actions">
                              <?= $this->Html->link(__('<i class="fas fa-search"></i>'), ['action' => 'view', $empleado->id],[
                                'escape' => false,
                                'class' => 'btn btn-info btn-sm'
                                ]) ?>
                              <?= $this->Html->link(__('<i class="fas fa-edit"></i>'), ['action' => 'edit', $empleado->id],[
                                'escape' => false,
                                'class' => 'btn btn-success btn-sm'
                                ]) ?>
                              <?= $this->Form->postLink(__('<i class="fas fa-trash"></i>'), ['action' => 'delete', $empleado->id], [
                                'confirm' => __('¿Está seguro que desea eliminar al empleado con ID#{0}?', $empleado->id),
                                'escape' => false,
                                'class' => 'btn btn-danger btn-sm'
                                ]) ?>
                          </td>
                      </tr>
                      <?php endforeach; ?>
                  </tbody>
              </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  $(function () {
    $('#example').DataTable( {
    "language": {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla =(",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar: ",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        },
        "buttons": {
            "copy": "Copiar",
            "colvis": "Visibilidad"
        }
    },
    "autoWidth": true
    } );
  });
</script>
