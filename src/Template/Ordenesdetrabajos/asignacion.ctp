
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Empleado[]|\Cake\Collection\CollectionInterface $empleados
 */
echo $this->Html->script('ordenesdetrabajos/asignacion',array('inline'=>false));

?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Asignación de OT's</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Inicio</a></li>
          <li class="breadcrumb-item active">Asignación de OT's</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Listado de OT's:</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>OT's pendientes</th>
                  <th>Progreso</th>
                  <th style="width: 40px">Porc.</th>
                  <th style="width: 10px">Ver</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1.</td>
                  <td>Orden de Trab. N°1</td>
                  <td>
                    <div class="progress progress-xs">
                      <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-danger">55%</span></td>
                  <td><button type="button" class="btn btn-block btn-default btn-xs"><i class="fas fa-search"></i></button></td>
                </tr>
                <tr>
                  <td>2.</td>
                  <td>Orden de Trab. N°5</td>
                  <td>
                    <div class="progress progress-xs">
                      <div class="progress-bar bg-warning" style="width: 70%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-warning">70%</span></td>
                  <td><button type="button" class="btn btn-block btn-default btn-xs"><i class="fas fa-search"></i></button></td>
                </tr>
                <tr>
                  <td>3.</td>
                  <td>Orden de Trab. N°8</td>
                  <td>
                    <div class="progress progress-xs progress-striped active">
                      <div class="progress-bar bg-primary" style="width: 30%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-primary">30%</span></td>
                  <td><button type="button" class="btn btn-block btn-default btn-xs"><i class="fas fa-search"></i></button></td>
                </tr>
                <tr>
                  <td>4.</td>
                  <td>Orden de Trab. N°7</td>
                  <td>
                    <div class="progress progress-xs progress-striped active">
                      <div class="progress-bar bg-success" style="width: 90%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-success">90%</span></td>
                  <td><button type="button" class="btn btn-block btn-default btn-xs"><i class="fas fa-search"></i></button></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    <div class="col-md-8">
      <div class="row">
        <div class="col-md-4 col-sm-6 col-12">
          <div class="info-box bg-info">
            <span class="info-box-icon"><i class="fas fa-industry"></i></span>

            <div class="info-box-content">
              <span class="info-box-number">Extrusora 1</span>
                <ul class="nav flex-column">
                  <li class="nav-item">
                      OT 3
                      <a class="badge bg-secondary swalDefaultSuccess"><i class="fas fa-angle-up"></i></a>
                      <a class="badge bg-secondary"><i class="fas fa-angle-down"></i></a>
                  </li>
                  <li class="nav-item">
                      OT 1
                      <a class="badge bg-secondary"><i class="fas fa-angle-up"></i></a>
                      <a class="badge bg-secondary"><i class="fas fa-angle-down"></i></a>
                  </li>
                  <li class="nav-item">
                      OT 2
                      <a class="badge bg-secondary"><i class="fas fa-angle-up"></i></a>
                      <a class="badge bg-secondary"><i class="fas fa-angle-down"></i></a>
                  </li>
                  <li class="nav-item">
                      OT 5
                      <a class="badge bg-secondary"><i class="fas fa-angle-up"></i></a>
                      <a class="badge bg-secondary"><i class="fas fa-angle-down"></i></a>
                  </li>
                </ul>

            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-4 col-sm-6 col-12">
          <div class="info-box bg-info">
            <span class="info-box-icon"><i class="fas fa-industry"></i></span>

            <div class="info-box-content">
              <span class="info-box-number">Extrusora 2</span>
                <ul class="nav flex-column">
                  <li class="nav-item">
                      OT 3
                      <a class="badge bg-secondary swalDefaultSuccess"><i class="fas fa-angle-up"></i></a>
                      <a class="badge bg-secondary"><i class="fas fa-angle-down"></i></a>
                  </li>
                  <li class="nav-item">
                      OT 1
                      <a class="badge bg-secondary"><i class="fas fa-angle-up"></i></a>
                      <a class="badge bg-secondary"><i class="fas fa-angle-down"></i></a>
                  </li>
                  <li class="nav-item">
                      OT 2
                      <a class="badge bg-secondary"><i class="fas fa-angle-up"></i></a>
                      <a class="badge bg-secondary"><i class="fas fa-angle-down"></i></a>
                  </li>
                  <li class="nav-item">
                      OT 5
                      <a class="badge bg-secondary"><i class="fas fa-angle-up"></i></a>
                      <a class="badge bg-secondary"><i class="fas fa-angle-down"></i></a>
                  </li>
                </ul>

            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-4 col-sm-6 col-12">
          <div class="info-box bg-info">
            <span class="info-box-icon"><i class="fas fa-industry"></i></span>

            <div class="info-box-content">
              <span class="info-box-number">Extrusora 3</span>
                <ul class="nav flex-column">
                  <li class="nav-item">
                      OT 3
                      <a class="badge bg-secondary swalDefaultSuccess"><i class="fas fa-angle-up"></i></a>
                      <a class="badge bg-secondary"><i class="fas fa-angle-down"></i></a>
                  </li>
                  <li class="nav-item">
                      OT 1
                      <a class="badge bg-secondary"><i class="fas fa-angle-up"></i></a>
                      <a class="badge bg-secondary"><i class="fas fa-angle-down"></i></a>
                  </li>
                  <li class="nav-item">
                      OT 2
                      <a class="badge bg-secondary"><i class="fas fa-angle-up"></i></a>
                      <a class="badge bg-secondary"><i class="fas fa-angle-down"></i></a>
                  </li>
                  <li class="nav-item">
                      OT 5
                      <a class="badge bg-secondary"><i class="fas fa-angle-up"></i></a>
                      <a class="badge bg-secondary"><i class="fas fa-angle-down"></i></a>
                  </li>
                </ul>

            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      </div>
<!-- Fin fila -->
  <div class="row">


  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box bg-warning">
      <span class="info-box-icon"><i class="fas fa-print"></i></span>

      <div class="info-box-content">
        <span class="info-box-number">Impresora 1</span>
          <ul class="nav flex-column">
            <li class="nav-item">
                OT 3
                <a class="badge bg-secondary swalDefaultSuccess"><i class="fas fa-angle-up"></i></a>
                <a class="badge bg-secondary"><i class="fas fa-angle-down"></i></a>
            </li>
            <li class="nav-item">
                OT 1
                <a class="badge bg-secondary"><i class="fas fa-angle-up"></i></a>
                <a class="badge bg-secondary"><i class="fas fa-angle-down"></i></a>
            </li>
            <li class="nav-item">
                OT 2
                <a class="badge bg-secondary"><i class="fas fa-angle-up"></i></a>
                <a class="badge bg-secondary"><i class="fas fa-angle-down"></i></a>
            </li>
            <li class="nav-item">
                OT 5
                <a class="badge bg-secondary"><i class="fas fa-angle-up"></i></a>
                <a class="badge bg-secondary"><i class="fas fa-angle-down"></i></a>
            </li>
          </ul>

      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box bg-warning">
      <span class="info-box-icon"><i class="fas fa-print"></i></span>

      <div class="info-box-content">
        <span class="info-box-number">Impresora 1</span>
          <ul class="nav flex-column">
            <li class="nav-item">
                OT 3
                <a class="badge bg-secondary swalDefaultSuccess"><i class="fas fa-angle-up"></i></a>
                <a class="badge bg-secondary"><i class="fas fa-angle-down"></i></a>
            </li>
            <li class="nav-item">
                OT 1
                <a class="badge bg-secondary"><i class="fas fa-angle-up"></i></a>
                <a class="badge bg-secondary"><i class="fas fa-angle-down"></i></a>
            </li>
            <li class="nav-item">
                OT 2
                <a class="badge bg-secondary"><i class="fas fa-angle-up"></i></a>
                <a class="badge bg-secondary"><i class="fas fa-angle-down"></i></a>
            </li>
            <li class="nav-item">
                OT 5
                <a class="badge bg-secondary"><i class="fas fa-angle-up"></i></a>
                <a class="badge bg-secondary"><i class="fas fa-angle-down"></i></a>
            </li>
          </ul>

      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box bg-warning">
      <span class="info-box-icon"><i class="fas fa-print"></i></span>

      <div class="info-box-content">
        <span class="info-box-number">Impresora 2</span>
          <ul class="nav flex-column">
            <li class="nav-item">
                OT 3
                <a class="badge bg-secondary swalDefaultSuccess"><i class="fas fa-angle-up"></i></a>
                <a class="badge bg-secondary"><i class="fas fa-angle-down"></i></a>
            </li>
            <li class="nav-item">
                OT 1
                <a class="badge bg-secondary"><i class="fas fa-angle-up"></i></a>
                <a class="badge bg-secondary"><i class="fas fa-angle-down"></i></a>
            </li>
            <li class="nav-item">
                OT 2
                <a class="badge bg-secondary"><i class="fas fa-angle-up"></i></a>
                <a class="badge bg-secondary"><i class="fas fa-angle-down"></i></a>
            </li>
            <li class="nav-item">
                OT 5
                <a class="badge bg-secondary"><i class="fas fa-angle-up"></i></a>
                <a class="badge bg-secondary"><i class="fas fa-angle-down"></i></a>
            </li>
          </ul>

      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box bg-warning">
      <span class="info-box-icon"><i class="fas fa-print"></i></span>

      <div class="info-box-content">
        <span class="info-box-number">Impresora 3</span>
          <ul class="nav flex-column">
            <li class="nav-item">
                OT 3
                <a class="badge bg-secondary swalDefaultSuccess"><i class="fas fa-angle-up"></i></a>
                <a class="badge bg-secondary"><i class="fas fa-angle-down"></i></a>
            </li>
            <li class="nav-item">
                OT 1
                <a class="badge bg-secondary"><i class="fas fa-angle-up"></i></a>
                <a class="badge bg-secondary"><i class="fas fa-angle-down"></i></a>
            </li>
            <li class="nav-item">
                OT 2
                <a class="badge bg-secondary"><i class="fas fa-angle-up"></i></a>
                <a class="badge bg-secondary"><i class="fas fa-angle-down"></i></a>
            </li>
            <li class="nav-item">
                OT 5
                <a class="badge bg-secondary"><i class="fas fa-angle-up"></i></a>
                <a class="badge bg-secondary"><i class="fas fa-angle-down"></i></a>
            </li>
          </ul>

      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

</div>

<div class="row">

  <div class="col-md-6 col-sm-6 col-12">
    <div class="info-box bg-success">
      <span class="info-box-icon"><i class="fas fa-cut"></i></span>

      <div class="info-box-content">
        <span class="info-box-number">Cortadora 4</span>
          <ul class="nav flex-column">
            <li class="nav-item">
                OT 3
                <a class="badge bg-secondary swalDefaultSuccess"><i class="fas fa-angle-up"></i></a>
                <a class="badge bg-secondary"><i class="fas fa-angle-down"></i></a>
            </li>
            <li class="nav-item">
                OT 1
                <a class="badge bg-secondary"><i class="fas fa-angle-up"></i></a>
                <a class="badge bg-secondary"><i class="fas fa-angle-down"></i></a>
            </li>
            <li class="nav-item">
                OT 2
                <a class="badge bg-secondary"><i class="fas fa-angle-up"></i></a>
                <a class="badge bg-secondary"><i class="fas fa-angle-down"></i></a>
            </li>
            <li class="nav-item">
                OT 5
                <a class="badge bg-secondary"><i class="fas fa-angle-up"></i></a>
                <a class="badge bg-secondary"><i class="fas fa-angle-down"></i></a>
            </li>
          </ul>

      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

  <div class="col-md-6 col-sm-6 col-12">
    <div class="info-box bg-success">
      <span class="info-box-icon"><i class="fas fa-cut"></i></span>

      <div class="info-box-content">
        <span class="info-box-number">Cortadora 2</span>
          <ul class="nav flex-column">
            <li class="nav-item">
                OT 3
                <a class="badge bg-secondary swalDefaultSuccess"><i class="fas fa-angle-up"></i></a>
                <a class="badge bg-secondary"><i class="fas fa-angle-down"></i></a>
            </li>
            <li class="nav-item">
                OT 1
                <a class="badge bg-secondary"><i class="fas fa-angle-up"></i></a>
                <a class="badge bg-secondary"><i class="fas fa-angle-down"></i></a>
            </li>
            <li class="nav-item">
                OT 2
                <a class="badge bg-secondary"><i class="fas fa-angle-up"></i></a>
                <a class="badge bg-secondary"><i class="fas fa-angle-down"></i></a>
            </li>
            <li class="nav-item">
                OT 5
                <a class="badge bg-secondary"><i class="fas fa-angle-up"></i></a>
                <a class="badge bg-secondary"><i class="fas fa-angle-down"></i></a>
            </li>
          </ul>

      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

</div>


      <script>
        $(function() {
          var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
          });

          $('.swalDefaultSuccess').click(function() {
            Toast.fire({
              icon: 'success',
              title: 'Se cambió prioridad con éxito.'
            })
          });
        });
      </script>
