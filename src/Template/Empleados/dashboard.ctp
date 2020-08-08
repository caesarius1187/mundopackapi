
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Empleado[]|\Cake\Collection\CollectionInterface $empleados
 */
echo $this->Html->script('empleados/dashboard',array('inline'=>false));

?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Dashboard</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Inicio</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- EXTRUSORAS -->
<div class="row">
  <div class="col-lg-3 col-6">
  </div>
  <div class="col-lg-2 col-6">
    <!-- small card -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3>EX1</h3>
        <p>OT N°1</p>
      </div>
      <div class="icon">
        <i class="fas fa-industry"></i>
      </div>
      <a href="#modal" class="small-box-footer" data-toggle="modal" data-target="#modal">
        Más info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <div class="col-lg-2 col-6">
    <!-- small card -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3>EX2</h3>
        <p>OT N°2</p>
      </div>
      <div class="icon">
        <i class="fas fa-industry"></i>
      </div>
      <a href="#" class="small-box-footer">
        Más info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <div class="col-lg-2 col-6">
    <!-- small card -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3>EX3</h3>
        <p>OT N°3</p>
      </div>
      <div class="icon">
        <i class="fas fa-industry"></i>
      </div>
      <a href="#" class="small-box-footer">
        Más info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <div class="col-lg-3 col-6">
  </div>
</div>

<!-- IMPRESORAS -->

<div class="row">
  <div class="col-lg-4 col-6">
  </div>
  <div class="col-lg-2 col-6">
    <!-- small card -->
    <div class="small-box bg-warning">
      <div class="inner">
        <h3>IMP1</h3>
        <p>OT N°4</p>
      </div>
      <div class="icon">
        <i class="fas fa-print"></i>
      </div>
      <a href="#" class="small-box-footer">
        Más info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <div class="col-lg-2 col-6">
    <!-- small card -->
    <div class="small-box bg-warning">
      <div class="inner">
        <h3>IMP2</h3>
        <p>OT N°5</p>
      </div>
      <div class="icon">
        <i class="fas fa-print"></i>
      </div>
      <a href="#" class="small-box-footer">
        Más info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <div class="col-lg-4 col-6">
  </div>
</div>

<!-- CORTADORAS -->

<div class="row">
  <div class="col-lg-1 col-6">
  </div>
  <div class="col-lg-2 col-6">
    <!-- small card -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>CO1</h3>
        <p>OT N°6</p>
      </div>
      <div class="icon">
        <i class="fas fa-cut"></i>
      </div>
      <a href="#" class="small-box-footer">
        Más info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <div class="col-lg-2 col-6">
    <!-- small card -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>CO2</h3>
        <p>OT N°7</p>
      </div>
      <div class="icon">
        <i class="fas fa-cut"></i>
      </div>
      <a href="#" class="small-box-footer">
        Más info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <div class="col-lg-2 col-6">
    <!-- small card -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>CO3</h3>
        <p>OT N°8</p>
      </div>
      <div class="icon">
        <i class="fas fa-cut"></i>
      </div>
      <a href="#" class="small-box-footer">
        Más info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <div class="col-lg-2 col-6">
    <!-- small card -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>CO4</h3>
        <p>OT N°9</p>
      </div>
      <div class="icon">
        <i class="fas fa-cut"></i>
      </div>
      <a href="#" class="small-box-footer">
        Más info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <div class="col-lg-2 col-6">
    <!-- small card -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>CO5</h3>
        <p>OT N°10</p>
      </div>
      <div class="icon">
        <i class="fas fa-cut"></i>
      </div>
      <a href="#" class="small-box-footer">
        Más info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <div class="col-lg-1 col-6">
  </div>
</div>

<div class="modal fade" id="modal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title"><i class="fas fa-industry"></i> EXTRUSORA 1</h1>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="card-body p-0">
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
                      <td>Orden de Trab. N° 1</td>
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
                      <td>Orden de Trab. N° 5</td>
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
                      <td>Orden de Trab. N° 10</td>
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
                      <td>Orden de Trab. N° 7</td>
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
              <!-- /.card-body -->
            </div>
            <div class="modal-footer right-content-between">
              <button type="button" class="btn btn-primary" data-dismiss="modal">SALIR</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
