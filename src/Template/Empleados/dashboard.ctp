
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
        <h1 class="m-0 text-dark">Produccion</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Inicio</a></li>
          <li class="breadcrumb-item active">Produccion</li>
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
            $ordenOtMenorPrioridad=null;
            $menorPrioridad = 1000;
            foreach ($extrusora->ordenots as $ko => $ordenot) {
              //vamos a buscar la ordrenot con menor prioridad
              if($ordenot->prioridadextrusion<$menorPrioridad){
                $menorPrioridad = $ordenot->prioridadextrusion;
                $ordenOtMenorPrioridad = $ordenot;
              }
            }
            if($ordenOtMenorPrioridad){
              ?>
              <?=$this->Html->link('<p>OT N° '.$ordenOtMenorPrioridad->ordenesdetrabajo->ordenesdepedido->numero."-".$ordenOtMenorPrioridad->ordenesdetrabajo->numero.'</p>', ['controller'=>'ordenesdetrabajos','action' => 'view',$ordenOtMenorPrioridad->ordenesdetrabajo->id], [
                    'escape' => false,
                    'style' => ['color:black'],
              ]) ?>

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
            $ordenOtMenorPrioridad=null;
            $menorPrioridad = 1000;
            foreach ($impresora->ordenots as $ko => $ordenot) {
              //vamos a buscar la ordrenot con menor prioridad
              if($ordenot->prioridadimpresion<$menorPrioridad){
                $menorPrioridad = $ordenot->prioridadimpresion;
                $ordenOtMenorPrioridad = $ordenot;
              }
            }
            if($ordenOtMenorPrioridad){
              ?>
              <?=$this->Html->link('<p>OT N° '.$ordenOtMenorPrioridad->ordenesdetrabajo->ordenesdepedido->numero."-".$ordenOtMenorPrioridad->ordenesdetrabajo->numero.'</p>', ['controller'=>'ordenesdetrabajos','action' => 'view',$ordenOtMenorPrioridad->ordenesdetrabajo->id], [
                    'escape' => false,
              ]) ?>

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
          <h5><strong><?= $cortadora->nombre ?></strong></h5>
          <?php
            $ordenOtMenorPrioridad=null;
            $menorPrioridad = 1000;
            foreach ($cortadora->ordenots as $ko => $ordenot) {
              //vamos a buscar la ordrenot con menor prioridad
              if($ordenot->prioridadcorte<$menorPrioridad){
                $menorPrioridad = $ordenot->prioridadcorte;
                $ordenOtMenorPrioridad = $ordenot;
              }
            }
            if($ordenOtMenorPrioridad){
              ?>
              <?=$this->Html->link('<p>OT N° '.$ordenOtMenorPrioridad->ordenesdetrabajo->ordenesdepedido->numero."-".$ordenOtMenorPrioridad->ordenesdetrabajo->numero.'</p>', ['controller'=>'ordenesdetrabajos','action' => 'view',$ordenOtMenorPrioridad->ordenesdetrabajo->id], [
                    'escape' => false,
                    'style' => ['color:black'],
              ]) ?>

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
              <tr id="tblHeader">
                <th>Prioridad</th>
                <th>Inicio</th>
                <th>Fin</th>
                <th>Cliente</th>
                <th>OT</th>
                <th>Medidas</th>
                <th>Cant.</th>
                <th>Materiales</th>
                <th>Extr.</th>
                <th>Impr.</th>
                <th>Cort.</th>
                <th>Obs.</th>
                <th>Inicio Trabajo</th>
                <th style="text-align:center">Acción</th>
              </tr>
            </thead>
            <tbody id="tblPendientes">
              <!-- Ejemplo -->
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
