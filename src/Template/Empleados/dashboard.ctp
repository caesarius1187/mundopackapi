
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

    <!-- small card -->
    <?php
    foreach ($extrusoras as $ke => $extrusora) {
       ?>
      <div class="col-lg-2 col-6">
        <div class="small-box bg-info">
          <div class="inner" style="height: 110px">
            <h4><strong><?= $extrusora->nombre ?></strong></h4>
            <?php
            foreach ($extrusora->ordenots as $ko => $ordenot) {
              ?>
                <p>OT N°<?= $ordenot->ordenesdetrabajo->numero ?></p>
              <?php
            }
            ?>
          </div>
          <div class="icon">
            <i class="fas fa-industry"></i>
          </div>
          <a href="#modal" class="small-box-footer" onclick="loadOTExtrusora(<?= $extrusora->id ?>)">
            Más info <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>

       <?php
    }
    ?>
  <div class="col-lg-3 col-6">
  </div>
</div>

<!-- IMPRESORAS -->

<div class="row">
  <div class="col-lg-4 col-6">
  </div>
  <?php
  foreach ($impresoras as $ki => $impresora) {
     ?>
    <div class="col-lg-2 col-6">
      <div class="small-box bg-warning">
        <div class="inner" style="height: 110px">
          <h4><strong><?= $impresora->nombre ?></strong></h4>
          <?php
          foreach ($impresora->ordenots as $ko => $ordenot) {
            ?>
              <p>OT N°<?= $ordenot->ordenesdetrabajo->numero ?></p>
            <?php
          }
          ?>
        </div>
        <div class="icon">
          <i class="fas fa-print"></i>
        </div>
        <a href="#modal" class="small-box-footer" onclick="loadOTImpresora(<?= $impresora->id ?>)">
          Más info <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
     <?php
  }
  ?>
  <div class="col-lg-4 col-6">
  </div>
</div>

<!-- CORTADORAS -->

<div class="row">
  <div class="col-lg-1 col-6">
  </div>
  <?php
  foreach ($cortadoras as $kc => $cortadora) {
     ?>
    <div class="col-lg-2 col-6">
      <div class="small-box bg-success">
        <div class="inner" style="height: 110px">
          <h4><strong><?= $cortadora->nombre ?></strong></h4>
          <?php
          foreach ($cortadora->ordenots as $ko => $ordenot) {
            ?>
              <p>OT N°<?= $ordenot->ordenesdetrabajo->numero ?></p>
            <?php
          }
          ?>
        </div>
        <div class="icon">
          <i class="fas fa-cut"></i>
        </div>
        <a href="#modal" class="small-box-footer" onclick="loadOTCortadora(<?= $cortadora->id ?>)">
          Más info <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
     <?php
  }
  ?>
  <div class="col-lg-1 col-6">
  </div>
</div>

<div class="modal fade" id="myModalMaquina">
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
          <table class="table table-sm" id="tblPendientes">
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

  </div>

</div>
