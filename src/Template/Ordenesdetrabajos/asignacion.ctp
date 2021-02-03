
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Empleado[]|\Cake\Collection\CollectionInterface $empleados
 */
use Cake\Routing\Router;

echo $this->Html->script('ordenesdetrabajos/asignacion',array('inline'=>false));

?>
<style>
  .table{
    table-layout: fixed;
  }
  .table tr td {
    cursor: move;
  }
  .placeholder {
    background-color: #edf2f7;
    border: 2px dashed #cbd5e0;
  }
  .selected
  {
    background: rgba(255, 255, 255, .5);
    border-style: daseh solid;
    opacity: 0.5;
  }
</style>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Asignación de OT's</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><?=$this->Html->link(__('Inicio'), ['action' => 'index'], [
                      'escape' => false,
                ]) ?>
          </li>
          <li class="breadcrumb-item active">Asignación de OT's</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content ml-2">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary card-tabs">
          <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs">
              <li class="nav-item">
                <a class="nav-link active" id="programacionPendientesTab" data-toggle="pill" href="#programacionPendientes" role="tab" aria-controls="programacionPendientes" aria-selected="true">Pendientes</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="programacionExtrusorasTab" data-toggle="pill" href="#programacionExtrusoras" role="tab" aria-controls="programacionExtrusoras" aria-selected="false">A extrudar</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="programacionImpresorasTab" data-toggle="pill" href="#programacionImpresoras" role="tab" aria-controls="programacionImpresoras" aria-selected="false">A imprimir</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="programacionCortadorasTab" data-toggle="pill" href="#programacionCortadoras" role="tab" aria-controls="programacionCortadoras" aria-selected="false">A cortar</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="programacionFinalizadasTab" data-toggle="pill" href="#programacionFinalizadas" role="tab" aria-controls="programacionFinalizadas" aria-selected="false">Finalizadas</a>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content" id="custom-tabs-one-tabContent">
              <div class="tab-pane fade show active" id="programacionPendientes" role="tabpanel" aria-labelledby="programacionPendientesTab">
                <div class="card-body table-responsive p-0">
                  <div style="width:1360px" class="text-left bg-secondary">
                    <span style="font-weight:bold;padding-left:50px;">MATRIZ CHICA</span>
                  </div>
                  <table id="tblPendientesMatrizMediana" class="table table-sm text-nowrap text-center">
                  <tbody>
                    <tr class="thead-light">
                      <th style="width:70px">Orden</th>
                      <th style="width:120px">Acción</th>
                      <th style="width:80px">Ingreso</th>
                      <th style="width:80px">Terminación</th>
                      <th style="width:180px">Cliente</th>
                      <th style="width:50px">OT</th>
                      <th style="width:80px">Medidas</th>
                      <th style="width:50px">Cant.</th>
                      <th style="width:250px">Materiales</th>
                      <th style="width:50px">Imp.</th>
                      <th style="width:50px">Cort.</th>
                      <th style="width:250px">Observación</th>
                      <th style="width:50px">Porc.</th>
                    </tr>
                    <?php
                    foreach ($ordenesdetrabajos as $ordenesdetrabajo){
                        //matriz chica
                        if($ordenesdetrabajo->ancho>=49){
                          continue;
                        }
                        $porentaje = 0;
                        $cantidad = $ordenesdetrabajo->aextrusar;
                        $cantidad += $ordenesdetrabajo->impreso?$ordenesdetrabajo->aextrusar:0;
                        $cantidad += $ordenesdetrabajo->cortado?$ordenesdetrabajo->aextrusar:0;
                        $echas = $ordenesdetrabajo->extrusadas;
                        $echas += $ordenesdetrabajo->impresas;
                        $echas += $ordenesdetrabajo->cortadas;
                        // Solucion a error de división por cero
                        $porcentaje = $cantidad==0?0:$echas/$cantidad*100;
                        $nombrecliente =  $ordenesdetrabajo->ordenesdepedido->cliente->nombre;
                        $numeroOT =  $ordenesdetrabajo->ordenesdepedido->numero.'-'.$ordenesdetrabajo->numero ;
                        ?>
                        <tr id="trOrdenOtP<?= $ordenesdetrabajo->ordenots[0]->id ?>">
                          <td style="width:70px">
                            <?= $ordenesdetrabajo->ordenots[0]->prioridadpendientes ?></td>
                          </td>
                          <td>
                              <button type="button" onclick="programarOT(<?= $ordenesdetrabajo->id?>, <?= $ordenesdetrabajo->ordenots[0]->id ?>,'<?=$numeroOT?>','<?=$nombrecliente?>')" class="btn btn-default btn-xs"><i class="fas fa-calendar"></i></button>
                              <?php
                              if($ordenesdetrabajo->estado=='Pausado'||$ordenesdetrabajo->estado=='Cancelado'){
                                echo '<button type="button" onclick="playOT('.$ordenesdetrabajo->id.')" class="btn btn-default btn-xs"><i class="fas fa-play"></i></button> ';
                              }
                              if($ordenesdetrabajo->estado=='En Proceso'){
                                echo '<button type="button" onclick="pausarOT('.$ordenesdetrabajo->id.')" class="btn btn-default btn-xs"><i class="fas fa-pause"></i></button> ';
                              }
                              if($ordenesdetrabajo->estado=='En Proceso'){
                                echo '<button type="button" onclick="cancelarOT('.$ordenesdetrabajo->id.')" class="btn btn-default btn-xs"><i class="fas fa-ban"></i></button>';
                              }?>
                              <button type="button" class="btn btn-default btn-xs">
                              <?=$this->Html->link('<i class="fas fa-search"></i>', ['action' => 'view',$ordenesdetrabajo->id], [
                                    'escape' => false,
                                    'target' => '_self',
                              ]) ?>
                              </button>
                          </td>
                          <td><?= date('d-m-Y',strtotime($ordenesdetrabajo->ordenesdepedido->fecha)) ?></td>
                          <td><?= date('d-m-Y',strtotime($ordenesdetrabajo->ordenesdepedido->fecha." +1 Months ")) ?></td>
                          <td><small><?= $nombrecliente ?></small></td>
                          <td><?= $numeroOT ?></td>
                          <td><?= $ordenesdetrabajo->medida ?></td>
                          <td><?= $ordenesdetrabajo->aextrusar?></td>
                          <td>
                          <?php
                          $pesoxmil = $ordenesdetrabajo->pesoxmil;
                          foreach ($ordenesdetrabajo->materialesots as $key => $materialesot) {
                              ?>
                              <small class="font-weight-bold">
                                <?= $materialesot->material ?>
                              </small>
                              <small class="font-italic">
                                <?= $materialesot->tipo ?>
                              </small>
                              <small>(<?= ($materialesot->porcentaje*$pesoxmil/100)."Kg" ?>)</small>
                              <br />
                              <?php
                            }
                            ?>
                          </td>
                          <td><?= $ordenesdetrabajo->impreso?'Si':'No'?></td>
                          <td><?= $ordenesdetrabajo->cortado?'Si':'No'?></td>
                          <td><?= $ordenesdetrabajo->observaciones ?></td>
                          <td><span class="badge bg-danger"><?= number_format($porcentaje,0,'','')?>%</span></td>
                        </tr>
                      <?php } ?>
                      </tbody>
                    </table>
                    <div style="width:1360px" class="text-left bg-secondary">
                      <span style="font-weight:bold;padding-left:50px;">MATRIZ MEDIANA</span>
                    </div>
                    <table id="tblPendientesMatrizMediana" class="table table-sm text-nowrap text-center">
                      <tbody>
                        <tr class="thead-light">
                          <th style="width:70px">Orden</th>
                          <th style="width:120px">Acción</th>
                          <th style="width:80px">Ingreso</th>
                          <th style="width:80px">Terminación</th>
                          <th style="width:180px">Cliente</th>
                          <th style="width:50px">OT</th>
                          <th style="width:80px">Medidas</th>
                          <th style="width:50px">Cant.</th>
                          <th style="width:250px">Materiales</th>
                          <th style="width:50px">Imp.</th>
                          <th style="width:50px">Cort.</th>
                          <th style="width:250px">Observación</th>
                          <th style="width:50px">Porc.</th>
                        </tr>
                      <?php
                      foreach ($ordenesdetrabajos as $ordenesdetrabajo){
                          //matriz mediana
                          if($ordenesdetrabajo->ancho<=49||$ordenesdetrabajo->ancho>69){
                            continue;
                          }
                          $porentaje = 0;
                          $cantidad = $ordenesdetrabajo->aextrusar;
                          $cantidad += $ordenesdetrabajo->impreso?$ordenesdetrabajo->aextrusar:0;
                          $cantidad += $ordenesdetrabajo->cortado?$ordenesdetrabajo->aextrusar:0;
                          $echas = $ordenesdetrabajo->extrusadas;
                          $echas += $ordenesdetrabajo->impresas;
                          $echas += $ordenesdetrabajo->cortadas;
                          // Solucion a error de división por cero
                          $porcentaje = $cantidad==0?0:$echas/$cantidad*100;
                          $nombrecliente =  $ordenesdetrabajo->ordenesdepedido->cliente->nombre;
                          $numeroOT =  $ordenesdetrabajo->ordenesdepedido->numero.'-'.$ordenesdetrabajo->numero ;
                          ?>
                          <tr>
                            <td style="width:70px">
                              <?= $ordenesdetrabajo->ordenots[0]->prioridadpendientes ?></td>
                            </td>
                            <td>
                                <button type="button" onclick="programarOT(<?= $ordenesdetrabajo->id?> , <?= $ordenesdetrabajo->ordenots[0]->id?>, '<?=$numeroOT?>','<?=$nombrecliente?>')" class="btn btn-default btn-xs"><i class="fas fa-calendar"></i></button>
                                <?php
                                if($ordenesdetrabajo->estado=='Pausado'||$ordenesdetrabajo->estado=='Cancelado'){
                                  echo '<button type="button" onclick="playOT('.$ordenesdetrabajo->id.')" class="btn btn-default btn-xs"><i class="fas fa-play"></i></button> ';
                                }
                                if($ordenesdetrabajo->estado=='En Proceso'){
                                  echo '<button type="button" onclick="pausarOT('.$ordenesdetrabajo->id.')" class="btn btn-default btn-xs"><i class="fas fa-pause"></i></button> ';
                                }
                                if($ordenesdetrabajo->estado=='En Proceso'){
                                  echo '<button type="button" onclick="cancelarOT('.$ordenesdetrabajo->id.')" class="btn btn-default btn-xs"><i class="fas fa-ban"></i></button>';
                                }?>
                                <button type="button" class="btn btn-default btn-xs">
                                <?=$this->Html->link('<i class="fas fa-search"></i>', ['action' => 'view',$ordenesdetrabajo->id], [
                                      'escape' => false,
                                      'target' => '_self',
                                ]) ?>
                                </button>
                            </td>
                            <td><?= date('d-m-Y',strtotime($ordenesdetrabajo->ordenesdepedido->fecha)) ?></td>
                            <td><?= date('d-m-Y',strtotime($ordenesdetrabajo->ordenesdepedido->fecha." +1 Months ")) ?></td>
                            <td><?= $nombrecliente ?></td>
                            <td><?= $numeroOT ?></td>
                            <td><?= $ordenesdetrabajo->medida ?></td>
                            <td><?= $ordenesdetrabajo->aextrusar?></td>
                            <td>
                            <?php
                            $pesoxmil = $ordenesdetrabajo->pesoxmil;
                            foreach ($ordenesdetrabajo->materialesots as $key => $materialesot) {
                                ?>
                                <small class="font-weight-bold">
                                  <?= $materialesot->material ?>
                                </small>
                                <small class="font-italic">
                                  <?= $materialesot->tipo ?>
                                </small>
                                <small>(<?= ($materialesot->porcentaje*$pesoxmil/100)."Kg" ?>)</small>
                                <br />
                                <?php
                              }
                              ?>
                            </td>
                            <td><?= $ordenesdetrabajo->impreso?'Si':'No'?></td>
                            <td><?= $ordenesdetrabajo->cortado?'Si':'No'?></td>
                            <td><?= $ordenesdetrabajo->observaciones ?></td>
                            <td><span class="badge bg-danger"><?= number_format($porcentaje,0,'','')?>%</span></td>
                          </tr>
                        <?php } ?>
                        </tbody>
                      </table>
                      <div style="width:1360px" class="text-left bg-secondary">
                        <span style="font-weight:bold;padding-left:50px;">MATRIZ GRANDE</span>
                      </div>
                      <table id="tblPendientesMatrizGrande" class="table table-sm text-nowrap text-center">
                        <tbody>
                          <tr class="thead-light">
                            <th style="width:70px">Orden</th>
                            <th style="width:120px">Acción</th>
                            <th style="width:80px">Ingreso</th>
                            <th style="width:80px">Terminación</th>
                            <th style="width:180px">Cliente</th>
                            <th style="width:50px">OT</th>
                            <th style="width:80px">Medidas</th>
                            <th style="width:50px">Cant.</th>
                            <th style="width:250px">Materiales</th>
                            <th style="width:50px">Imp.</th>
                            <th style="width:50px">Cort.</th>
                            <th style="width:250px">Observación</th>
                            <th style="width:50px">Porc.</th>
                          </tr>
                      <?php
                      foreach ($ordenesdetrabajos as $ordenesdetrabajo){
                        //matriz grande
                        if($ordenesdetrabajo->ancho<=70){
                          continue;
                        }

                        $porentaje = 0;
                        $cantidad = $ordenesdetrabajo->aextrusar;
                        $cantidad += $ordenesdetrabajo->impreso?$ordenesdetrabajo->aextrusar:0;
                        $cantidad += $ordenesdetrabajo->cortado?$ordenesdetrabajo->aextrusar:0;
                        $echas = $ordenesdetrabajo->extrusadas;
                        $echas += $ordenesdetrabajo->impresas;
                        $echas += $ordenesdetrabajo->cortadas;
                        // Solucion a error de división por cero
                        $porcentaje = $cantidad==0?0:$echas/$cantidad*100;
                        $nombrecliente =  $ordenesdetrabajo->ordenesdepedido->cliente->nombre;
                        $numeroOT =  $ordenesdetrabajo->ordenesdepedido->numero.'-'.$ordenesdetrabajo->numero ;
                        ?>
                        <tr>
                          <td style="width:70px">
                            <?= $ordenesdetrabajo->ordenots[0]->prioridadpendientes ?></td>
                          </td>
                          <td>
                              <button type="button" onclick="programarOT(<?= $ordenesdetrabajo->id?>, <?= $ordenesdetrabajo->ordenots[0]->id ?>, '<?=$numeroOT?>','<?=$nombrecliente?>')" class="btn btn-default btn-xs"><i class="fas fa-calendar"></i></button>
                              <?php
                              if($ordenesdetrabajo->estado=='Pausado'||$ordenesdetrabajo->estado=='Cancelado'){
                                echo '<button type="button" onclick="playOT('.$ordenesdetrabajo->id.')" class="btn btn-default btn-xs"><i class="fas fa-play"></i></button> ';
                              }
                              if($ordenesdetrabajo->estado=='En Proceso'){
                                echo '<button type="button" onclick="pausarOT('.$ordenesdetrabajo->id.')" class="btn btn-default btn-xs"><i class="fas fa-pause"></i></button> ';
                              }
                              if($ordenesdetrabajo->estado=='En Proceso'){
                                echo '<button type="button" onclick="cancelarOT('.$ordenesdetrabajo->id.')" class="btn btn-default btn-xs"><i class="fas fa-ban"></i></button>';
                              }?>
                              <button type="button" class="btn btn-default btn-xs">
                              <?=$this->Html->link('<i class="fas fa-search"></i>', ['action' => 'view',$ordenesdetrabajo->id], [
                                    'escape' => false,
                                    'target' => '_self',
                              ]) ?>
                              </button>
                          </td>
                          <td><?= date('d-m-Y',strtotime($ordenesdetrabajo->ordenesdepedido->fecha)) ?></td>
                          <td><?= date('d-m-Y',strtotime($ordenesdetrabajo->ordenesdepedido->fecha." +1 Months ")) ?></td>
                          <td><?= $nombrecliente ?></td>
                          <td><?= $numeroOT ?></td>
                          <td><?= $ordenesdetrabajo->medida ?></td>
                          <td><?= $ordenesdetrabajo->aextrusar?></td>
                          <td>
                          <?php
                          $pesoxmil = $ordenesdetrabajo->pesoxmil;
                          foreach ($ordenesdetrabajo->materialesots as $key => $materialesot) {
                              ?>
                              <small class="font-weight-bold">
                                <?= $materialesot->material ?>
                              </small>
                              <small class="font-italic">
                                <?= $materialesot->tipo ?>
                              </small>
                              <small>(<?= ($materialesot->porcentaje*$pesoxmil/100)."Kg" ?>)</small>
                              <br />
                              <?php
                            }
                            ?>
                          </td>
                          <td><?= $ordenesdetrabajo->impreso?'Si':'No'?></td>
                          <td><?= $ordenesdetrabajo->cortado?'Si':'No'?></td>
                          <td><?= $ordenesdetrabajo->observaciones ?></td>
                          <td><span class="badge bg-danger"><?= number_format($porcentaje,0,'','')?>%</span></td>
                        </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              </div>

              <div class="tab-pane fade" id="programacionExtrusoras" role="tabpanel" aria-labelledby="programacionExtrusorasTab">
                <h4>Listado de OT's programas para extrudar:</h4>
                <div class="card-body table-responsive p-0 divExtrusoras">
                  <?php foreach ($extrusoras as $extrusora){ ?>
                    <div style="width:2250px" class="text-left bg-info">
                      <span style="text-transform:uppercase;font-weight:bold;padding-left:50px;"><?= $extrusora->nombre ?></span>
                    </div>
                    <table id="tblExtrusora<?= $extrusora->id ?>" class="table table-sm text-nowrap text-center">
                      <tbody>
                        <tr class="thead-light">
                          <head>
                            <th style="width:70px">Orden</th>
                            <th style="width:120px">Acción</th>
                            <th style="width:50px">Inicio</th>
                            <th style="width:50px">Fin</th>
                            <th style="width:180px">Cliente</th>
                            <th style="width:50px">OT</th>
                            <th style="width:80px">Medidas</th>
                            <th style="width:50px">Cant.</th>
                            <th style="width:250px">Materiales</th>
                            <th style="width:50px">Ext.</th>
                            <th style="width:50px">Imp.</th>
                            <th style="width:50px">Cort.</th>
                            <th style="width:250px">Observación</th>
                          </head>
                          <?php
                          //vamos a crear un header de 30 dias a partir de hoy
                          for($i=0; $i<20; $i++){
                            ?><th style="width:50px"><?= date('d-m',strtotime("+".$i." days")) ?></th><?php
                          }
                          ?>
                        </tr>
                        <?php foreach ($extrusora->ordenots as $ordenot){
                          $fecha = $ordenot->ordenesdetrabajo->ordenesdepedido->fecha;
                          $numeroOT =  $ordenot->ordenesdetrabajo->ordenesdepedido->numero.'-'.$ordenot->ordenesdetrabajo->numero;
                          $linkOT =  $this->Html->link(
                              $ordenot->ordenesdetrabajo->ordenesdepedido->numero.'-'.$ordenot->ordenesdetrabajo->numero,
                              [
                                'action' => 'view',$ordenot->ordenesdetrabajo->id], [
                                'escape' => false,
                                'target' => '_self',
                              ]
                          );
                          $nombrecliente =  $ordenot->ordenesdetrabajo->ordenesdepedido->cliente->nombre;
                          $inicioEstrusion = $ordenot->fechainicioextrusora?date('d-m-Y',strtotime($ordenot->fechainicioextrusora)):'';
                          $inicioImpresion = $ordenot->fechainicioimpresora?date('d-m-Y',strtotime($ordenot->fechainicioimpresora)):'';
                          $inicioCorte = $ordenot->fechainiciocortadora?date('d-m-Y',strtotime($ordenot->fechainiciocortadora)):'';
                          ?>
                          <tr id="trOrdenOtE<?= $ordenot->id ?>">
                            <td style="width:70px">
                              <?= $ordenot->prioridadextrusion ?></td>
                            </td>
                            <td style="width:120px">
                              <button type="button" class="btn btn-secondary btn-sm" onclick="editarProgramacionOt(<?= $ordenot->id?>,<?= $ordenot->ordenesdetrabajo->id?>, '<?=$numeroOT?>','<?=$nombrecliente?>',<?= $ordenot->extrusora_id?>,'<?= $inicioEstrusion ?>',<?= $ordenot->impresora_id?>,'<?= $inicioImpresion?>',<?= $ordenot->cortadora_id?>,'<?= $inicioCorte?>')"><i class="far fa-calendar-alt"></i></button>
                              <button type="button" class="btn btn-secondary btn-sm" onclick="clonarProgramacionOt(<?= $ordenot->ordenesdetrabajo->id?>, '<?=$numeroOT?>','<?=$nombrecliente?>',<?= $ordenot->extrusora_id?>,'<?= $inicioEstrusion ?>',<?= $ordenot->impresora_id?>,'<?= $inicioImpresion?>',<?= $ordenot->cortadora_id?>,'<?= $inicioCorte?>')" title="Duplicar Programacion"><i class="far fa-clone"></i></button>
                              <button type="button" class="btn btn-secondary btn-sm" onclick="pausarOT(<?= $ordenot->ordenesdetrabajo->id ?>)" ><i class="fas fa-pause"></i></button>
                            </td>
                            <td style="width:50px"><?= date('d-m',strtotime($fecha)) ?></td>
                            <td style="width:50px"><?= date('d-m',strtotime($fecha." +1 Months ")) ?></td>
                            <td style="width:180px"><small><?= $nombrecliente ?></small></td>
                            <td style="width:50px"><?= $linkOT ?></td>
                            <td style="width:80px"><?= $ordenot->ordenesdetrabajo->medida ?></td>
                            <td style="width:50px"><?= $ordenot->ordenesdetrabajo->aextrusar?></td>
                            <td style="width:180px">
                            <?php
                            $pesoxmil = $ordenot->ordenesdetrabajo->pesoxmil;
                            foreach ($ordenot->ordenesdetrabajo->materialesots as $key => $materialesot) {
                                ?>
                                <small class="font-weight-bold">
                                  <?= $materialesot->material ?>
                                </small>
                                <small class="font-italic">
                                  <?= $materialesot->tipo ?>
                                </small>
                                <small>(<?= ($materialesot->porcentaje*$pesoxmil/100)."Kg" ?>)</small>
                                <br />
                                <?php
                            }
                            ?>
                            </td>
                            <?php 
                              if($ordenot->ordenesdetrabajo->aextrusar > $ordenot->ordenesdetrabajo->extrusadas){
                                $BtnClassExtrusion="warning";
                              }else{
                                $BtnClassExtrusion="success";                          
                              }
                              if($ordenot->ordenesdetrabajo->extrusadas*1==0){
                                $BtnClassExtrusion="danger";                          
                              }
                              if($ordenot->ordenesdetrabajo->aextrusar > $ordenot->ordenesdetrabajo->impresas){
                                $BtnClassImpresion="warning";
                              }else{
                                $BtnClassImpresion="success";                          
                              }
                              if($ordenot->ordenesdetrabajo->impresas*1==0){
                                $BtnClassImpresion="danger";                          
                              }
                              if($ordenot->ordenesdetrabajo->aextrusar > $ordenot->ordenesdetrabajo->cortadas){
                                $BtnClassCorte="warning";
                              }else{
                                $BtnClassCorte="success";                          
                              }
                              if($ordenot->ordenesdetrabajo->cortadas*1==0){
                                $BtnClassCorte="danger";                          
                              }
                            ?>
                            <td>
                              <button type="button" class="btn btn-<?= $BtnClassExtrusion?>"><?= ($ordenot->ordenesdetrabajo->extrusadas*1)."/".($ordenot->ordenesdetrabajo->aextrusar*1)?>
                              </button>
                            </td>
                            <td>
                              <?php
                              if($ordenot->ordenesdetrabajo->impreso){ ?>
                                <button type="button" class="btn btn-<?= $BtnClassImpresion?>"><?= ($ordenot->ordenesdetrabajo->impresas*1)."/".($ordenot->ordenesdetrabajo->aextrusar*1) ?>
                                </button>
                                <?php
                              }else{
                                ?>
                                <button type="button" class="btn btn-success">NO</button>
                                <?php
                              }?>                          
                            </td>
                            <td>
                              <?php
                              if($ordenot->ordenesdetrabajo->cortado){ ?>
                                <button type="button" class="btn btn-<?= $BtnClassCorte?>"><?= ($ordenot->ordenesdetrabajo->acortar*1)."/".($ordenot->ordenesdetrabajo->aextrusar*1)?>                          
                                </button>
                              <?php
                              }else{
                                ?>
                                <button type="button" class="btn btn-success">NO</button>
                                <?php
                              }?>        
                            </td>
                            <td style="width:50px"><?= $ordenot->ordenesdetrabajo->observaciones ?></td>
                            <?php
                            for($i=0; $i<20; $i++){
                              $class = "";
                              $contenido = "";
                              $dateToAnalyze = date('d-m-Y',strtotime("+".$i." days"));
                              $ini = date('d-m-Y',strtotime($fecha));
                              $fin = date('d-m-Y',strtotime($fecha." +1 Months "));
                              $iniEstrusion = date('d-m-Y',strtotime($ordenot->fechainicioextrusora));
                              $iniImpresion = date('d-m-Y',strtotime($ordenot->fechainicioimpresora));
                              $iniCorte = date('d-m-Y',strtotime($ordenot->fechainiciocortadora));
                              if($dateToAnalyze==$ini){
                                $class = "table-warning";
                                $contenido = "Ini";
                              }
                              if($dateToAnalyze==$fin){
                                $class = "table-success";
                                $contenido = "Ini";
                              }
                              if($dateToAnalyze==$iniEstrusion){
                                // $class = "table-danger";
                                $contenido = '<h4><span class="badge badge-pill badge-info"><i class="fas fa-industry"></i></span></h4>';
                              }
                              if($dateToAnalyze==$iniImpresion){
                                // $class = "table-primary";
                                $contenido = '<h4><span class="badge badge-pill badge-warning"><i class="fas fa-print"></i></span></h4>';
                              }
                              if($dateToAnalyze==$iniCorte){
                                // $class = "table-info";
                                $contenido = '<h4><span class="badge badge-pill badge-success"><i class="fas fa-cut"></i></span></h4>';
                              }
                              ?><th class="<?= $class ?>"><?= $contenido ?></th><?php
                            }
                            ?>
                          </tr>
                        <?php
                        }
                        ?>
                      </tbody>
                    </table>
                    <?php
                  }
                  ?>
                </div>
              </div>

              <div class="tab-pane fade" id="programacionImpresoras" role="tabpanel" aria-labelledby="programacionImpresorasTab">
                <h4>Listado de OT's programas para imprimir:</h4>
                <div class="card-body table-responsive p-0">
                    <?php foreach ($impresoras as $impresora){ ?>
                    <div style="width:2250px" class="text-left bg-warning">
                      <span style="text-transform:uppercase;font-weight:bold;padding-left:50px;"><?= $impresora->nombre ?></span>
                    </div>
                    <table id="tblImpresora<?= $impresora->id ?>" class="table table-sm text-nowrap text-center">
                      <tbody>
                        <head>
                          <tr class="thead-light">
                            <th style="width:70px">Orden</th>
                            <th style="width:120px">Acción</th>
                            <th style="width:50px">Inicio</th>
                            <th style="width:50px">Fin</th>
                            <th style="width:180px">Cliente</th>
                            <th style="width:50px">OT</th>
                            <th style="width:80px">Medidas</th>
                            <th style="width:50px">Cant.</th>
                            <th style="width:180px">Materiales</th>
                            <th style="width:50px">Ext.</th>
                            <th style="width:50px">Imp.</th>
                            <th style="width:50px">Cort.</th>
                            <th style="width:250px">Observación</th>
                            <?php
                            //vamos a crear un header de 30 dias a partir de hoy
                            for($i=0; $i<20; $i++){
                              ?><th style="width:50px"><?= date('d-m',strtotime("+".$i." days")) ?></th><?php
                            }
                            ?>
                          </tr>
                        </head>

                        <?php foreach ($impresora->ordenots as $ordenot){
                          $fecha = $ordenot->ordenesdetrabajo->ordenesdepedido->fecha;
                          $numeroOT =  $ordenot->ordenesdetrabajo->ordenesdepedido->numero.'-'.$ordenot->ordenesdetrabajo->numero;
                          $linkOT =  $this->Html->link(
                              $ordenot->ordenesdetrabajo->ordenesdepedido->numero.'-'.$ordenot->ordenesdetrabajo->numero,
                              [
                                'action' => 'view',$ordenot->ordenesdetrabajo->id], [
                                'escape' => false,
                                'target' => '_self',
                              ]
                          );
                          $nombrecliente =  $ordenot->ordenesdetrabajo->ordenesdepedido->cliente->nombre;
                          $inicioEstrusion = $ordenot->fechainicioextrusora?date('d-m-Y',strtotime($ordenot->fechainicioextrusora)):'';
                          $inicioImpresion = $ordenot->fechainicioimpresora?date('d-m-Y',strtotime($ordenot->fechainicioimpresora)):'';
                          $inicioCorte = $ordenot->fechainiciocortadora?date('d-m-Y',strtotime($ordenot->fechainiciocortadora)):'';
                          ?>
                          <tr id="trOrdenOtI<?= $ordenot->id ?>">
                            <td style="width:70px">
                              <?= $ordenot->prioridadimpresion ?></td>
                            </td>
                            <td style="width:120px">
                              <button type="button" class="btn btn-secondary btn-sm" onclick="editarProgramacionOt(<?= $ordenot->id?>,<?= $ordenot->ordenesdetrabajo->id?>, '<?=$numeroOT?>','<?=$nombrecliente?>',<?= $ordenot->extrusora_id?>,'<?= $inicioEstrusion ?>',<?= $ordenot->impresora_id?>,'<?= $inicioImpresion?>',<?= $ordenot->cortadora_id?>,'<?= $inicioCorte?>')"><i class="far fa-calendar-alt"></i></button>
                              <button type="button" class="btn btn-secondary btn-sm" onclick="clonarProgramacionOt(<?= $ordenot->ordenesdetrabajo->id?>, '<?=$numeroOT?>','<?=$nombrecliente?>',<?= $ordenot->extrusora_id?>,'<?= $inicioEstrusion ?>',<?= $ordenot->impresora_id?>,'<?= $inicioImpresion?>',<?= $ordenot->cortadora_id?>,'<?= $inicioCorte?>')" title="Duplicar Programacion"><i class="far fa-clone"></i></button>
                              <button type="button" class="btn btn-secondary btn-sm" onclick="pausarOT(<?= $ordenot->ordenesdetrabajo->id ?>)" ><i class="fas fa-pause"></i></button>
                            </td>
                            <td style="width:50px"><?= date('d-m',strtotime($fecha)) ?></td>
                            <td style="width:50px"><?= date('d-m',strtotime($fecha." +1 Months ")) ?></td>
                            <td style="width:180px"><small><?= $nombrecliente ?></small></td>
                            <td style="width:50px"><?= $linkOT ?></td>
                            <td style="width:80px"><?= $ordenot->ordenesdetrabajo->medida ?></td>
                            <td style="width:50px"><?= $ordenot->ordenesdetrabajo->aextrusar?></td>
                            <td style="width:180px">
                            <?php
                            $pesoxmil = $ordenot->ordenesdetrabajo->pesoxmil;
                            foreach ($ordenot->ordenesdetrabajo->materialesots as $key => $materialesot) {
                                ?>
                                <small class="font-weight-bold">
                                  <?= $materialesot->material ?>
                                </small>
                                <small class="font-italic">
                                  <?= $materialesot->tipo ?>
                                </small>
                                <small>(<?= ($materialesot->porcentaje*$pesoxmil/100)."Kg" ?>)</small>
                                <br />
                                <?php
                            }
                            ?>
                            </td>
                            <?php 
                              if($ordenot->ordenesdetrabajo->aextrusar > $ordenot->ordenesdetrabajo->extrusadas){
                                $BtnClassExtrusion="warning";
                              }else{
                                $BtnClassExtrusion="success";                          
                              }
                              if($ordenot->ordenesdetrabajo->extrusadas*1==0){
                                $BtnClassExtrusion="danger";                          
                              }
                              if($ordenot->ordenesdetrabajo->aextrusar > $ordenot->ordenesdetrabajo->impresas){
                                $BtnClassImpresion="warning";
                              }else{
                                $BtnClassImpresion="success";                          
                              }
                              if($ordenot->ordenesdetrabajo->impresas*1==0){
                                $BtnClassImpresion="danger";                          
                              }
                              if($ordenot->ordenesdetrabajo->aextrusar > $ordenot->ordenesdetrabajo->cortadas){
                                $BtnClassCorte="warning";
                              }else{
                                $BtnClassCorte="success";                          
                              }
                              if($ordenot->ordenesdetrabajo->cortadas*1==0){
                                $BtnClassCorte="danger";                          
                              }
                            ?>
                            <td>
                              <button type="button" class="btn btn-<?= $BtnClassExtrusion?>"><?= ($ordenot->ordenesdetrabajo->extrusadas*1)."/".($ordenot->ordenesdetrabajo->aextrusar*1)?>
                              </button>
                            </td>
                            <td>
                              <?php
                              if($ordenot->ordenesdetrabajo->impreso){ ?>
                                <button type="button" class="btn btn-<?= $BtnClassImpresion?>"><?= ($ordenot->ordenesdetrabajo->impresas*1)."/".($ordenot->ordenesdetrabajo->aextrusar*1) ?>
                                </button>
                                <?php
                              }else{
                                ?>
                                <button type="button" class="btn btn-success">NO</button>
                                <?php
                              }?>                          
                            </td>
                            <td>
                              <?php
                              if($ordenot->ordenesdetrabajo->cortado){ ?>
                                <button type="button" class="btn btn-<?= $BtnClassCorte?>"><?= ($ordenot->ordenesdetrabajo->acortar*1)."/".($ordenot->ordenesdetrabajo->aextrusar*1)?>                          
                                </button>
                              <?php
                              }else{
                                ?>
                                <button type="button" class="btn btn-success">NO</button>
                                <?php
                              }?>        
                            </td>
                            <td style="width:50px"><?= $ordenot->ordenesdetrabajo->observaciones ?></td>
                            <?php
                            for($i=0; $i<20; $i++){
                              $class = "";
                              $contenido = "";
                              $dateToAnalyze = date('d-m-Y',strtotime("+".$i." days"));
                              $ini = date('d-m-Y',strtotime($fecha));
                              $fin = date('d-m-Y',strtotime($fecha." +1 Months "));
                              $iniEstrusion = date('d-m-Y',strtotime($ordenot->fechainicioextrusora));
                              $iniImpresion = date('d-m-Y',strtotime($ordenot->fechainicioimpresora));
                              $iniCorte = date('d-m-Y',strtotime($ordenot->fechainiciocortadora));
                              if($dateToAnalyze==$ini){
                                $class = "table-warning";
                                $contenido = "Ini";
                              }
                              if($dateToAnalyze==$fin){
                                $class = "table-success";
                                $contenido = "Ini";
                              }
                              if($dateToAnalyze==$iniEstrusion){
                                // $class = "table-danger";
                                $contenido = '<h4><span class="badge badge-pill badge-info"><i class="fas fa-industry"></i></span></h4>';
                              }
                              if($dateToAnalyze==$iniImpresion){
                                // $class = "table-primary";
                                $contenido = '<h4><span class="badge badge-pill badge-warning"><i class="fas fa-print"></i></span></h4>';
                              }
                              if($dateToAnalyze==$iniCorte){
                                // $class = "table-info";
                                $contenido = '<h4><span class="badge badge-pill badge-success"><i class="fas fa-cut"></i></span></h4>';
                              }
                              ?><th class="<?= $class ?>"><?= $contenido ?></th><?php
                            }
                            ?>
                          </tr>
                      <?php
                        }
                      ?>
                      </tbody>
                    </table>
                    <?php
                      }
                    ?>
                </div>
              </div>

              <div class="tab-pane fade" id="programacionCortadoras" role="tabpanel" aria-labelledby="programacionCortadorasTab">
                <h4>Listado de OT's pendientes de corte:</h4>
                <div class="card-body table-responsive p-0">
                  <?php foreach ($cortadoras as $cortadora){ ?>
                  <div style="width:2250px" class="text-left bg-success">
                    <span style="text-transform:uppercase;font-weight:bold;padding-left:50px;"><?= $cortadora->nombre ?></span>
                  </div>
                  <table id="tblCortadora<?= $cortadora->id ?>" class="table table-sm text-nowrap text-center">
                    <tbody>
                    <head>
                      <tr class="thead-light">
                        <th style="width:70px">Orden</th>
                        <th style="width:120px">Acción</th>
                        <th style="width:50px">Inicio</th>
                        <th style="width:50px">Fin</th>
                        <th style="width:180px">Cliente</th>
                        <th style="width:50px">OT</th>
                        <th style="width:80px">Medidas</th>
                        <th style="width:50px">Cant.</th>
                        <th style="width:250px">Materiales</th>
                        <th style="width:50px">Ext.</th>
                        <th style="width:50px">Imp.</th>
                        <th style="width:50px">Cort.</th>
                        <th style="width:250px">Observación</th>
                        <?php
                        //vamos a crear un header de 30 dias a partir de hoy
                        for($i=0; $i<20; $i++){
                          ?><th style="width:50px"><?= date('d-m',strtotime("+".$i." days")) ?></th><?php
                        }
                        ?>
                      </tr>
                    </head>
                      <?php foreach ($cortadora->ordenots as $ordenot){
                          $fecha = $ordenot->ordenesdetrabajo->ordenesdepedido->fecha;
                          $numeroOT =  $ordenot->ordenesdetrabajo->ordenesdepedido->numero.'-'.$ordenot->ordenesdetrabajo->numero;
                          $linkOT =  $this->Html->link(
                              $ordenot->ordenesdetrabajo->ordenesdepedido->numero.'-'.$ordenot->ordenesdetrabajo->numero,
                              [
                                'action' => 'view',$ordenot->ordenesdetrabajo->id], [
                                'escape' => false,
                                'target' => '_self',
                              ]
                          );
                          $nombrecliente =  $ordenot->ordenesdetrabajo->ordenesdepedido->cliente->nombre;
                          $inicioEstrusion = $ordenot->fechainicioextrusora?date('d-m-Y',strtotime($ordenot->fechainicioextrusora)):'';
                          $inicioImpresion = $ordenot->fechainicioimpresora?date('d-m-Y',strtotime($ordenot->fechainicioimpresora)):'';
                          $inicioCorte = $ordenot->fechainiciocortadora?date('d-m-Y',strtotime($ordenot->fechainiciocortadora)):'';
                          ?>
                          <tr id="trOrdenOtC<?= $ordenot->id ?>">
                            <td style="width:70px">
                              <?= $ordenot->prioridadcorte ?></td>
                            </td>
                            <td style="width:120px">
                              <button type="button" class="btn btn-secondary btn-sm" onclick="editarProgramacionOt(<?= $ordenot->id?>,<?= $ordenot->ordenesdetrabajo->id?>, '<?=$numeroOT?>','<?=$nombrecliente?>',<?= $ordenot->extrusora_id?>,'<?= $inicioEstrusion ?>',<?= $ordenot->impresora_id?>,'<?= $inicioImpresion?>',<?= $ordenot->cortadora_id?>,'<?= $inicioCorte?>')"><i class="far fa-calendar-alt"></i></button>
                              <button type="button" class="btn btn-secondary btn-sm" onclick="clonarProgramacionOt(<?= $ordenot->ordenesdetrabajo->id?>, '<?=$numeroOT?>','<?=$nombrecliente?>',<?= $ordenot->extrusora_id?>,'<?= $inicioEstrusion ?>',<?= $ordenot->impresora_id?>,'<?= $inicioImpresion?>',<?= $ordenot->cortadora_id?>,'<?= $inicioCorte?>')" title="Duplicar Programacion"><i class="far fa-clone"></i></button>
                              <button type="button" class="btn btn-secondary btn-sm" onclick="pausarOT(<?= $ordenot->ordenesdetrabajo->id ?>)" ><i class="fas fa-pause"></i></button>
                            </td>
                            <td style="width:50px"><?= date('d-m',strtotime($fecha)) ?></td>
                            <td style="width:50px"><?= date('d-m',strtotime($fecha." +1 Months ")) ?></td>
                            <td style="width:180px"><small><?= $nombrecliente ?></small></td>
                            <td style="width:50px"><?= $linkOT ?></td>
                            <td style="width:80px"><?= $ordenot->ordenesdetrabajo->medida ?></td>
                            <td style="width:50px"><?= $ordenot->ordenesdetrabajo->aextrusar?></td>
                            <td style="width:180px">
                            <?php
                            $pesoxmil = $ordenot->ordenesdetrabajo->pesoxmil;
                            foreach ($ordenot->ordenesdetrabajo->materialesots as $key => $materialesot) {
                                ?>
                                <small class="font-weight-bold">
                                  <?= $materialesot->material ?>
                                </small>
                                <small class="font-italic">
                                  <?= $materialesot->tipo ?>
                                </small>
                                <small>(<?= ($materialesot->porcentaje*$pesoxmil/100)."Kg" ?>)</small>
                                <br />
                                <?php
                            }
                            ?>
                            </td>
                            <?php 
                              if($ordenot->ordenesdetrabajo->aextrusar > $ordenot->ordenesdetrabajo->extrusadas){
                                $BtnClassExtrusion="warning";
                              }else{
                                $BtnClassExtrusion="success";                          
                              }
                              if($ordenot->ordenesdetrabajo->extrusadas*1==0){
                                $BtnClassExtrusion="danger";                          
                              }
                              if($ordenot->ordenesdetrabajo->aextrusar > $ordenot->ordenesdetrabajo->impresas){
                                $BtnClassImpresion="warning";
                              }else{
                                $BtnClassImpresion="success";                          
                              }
                              if($ordenot->ordenesdetrabajo->impresas*1==0){
                                $BtnClassImpresion="danger";                          
                              }
                              if($ordenot->ordenesdetrabajo->aextrusar > $ordenot->ordenesdetrabajo->cortadas){
                                $BtnClassCorte="warning";
                              }else{
                                $BtnClassCorte="success";                          
                              }
                              if($ordenot->ordenesdetrabajo->cortadas*1==0){
                                $BtnClassCorte="danger";                          
                              }
                            ?>
                            <td>
                              <button type="button" class="btn btn-<?= $BtnClassExtrusion?>"><?= ($ordenot->ordenesdetrabajo->extrusadas*1)."/".($ordenot->ordenesdetrabajo->aextrusar*1)?>
                              </button>
                            </td>
                            <td>
                              <?php
                              if($ordenot->ordenesdetrabajo->impreso){ ?>
                                <button type="button" class="btn btn-<?= $BtnClassImpresion?>"><?= ($ordenot->ordenesdetrabajo->impresas*1)."/".($ordenot->ordenesdetrabajo->aextrusar*1) ?>
                                </button>
                                <?php
                              }else{
                                ?>
                                <button type="button" class="btn btn-success">NO</button>
                                <?php
                              }?>                          
                            </td>
                            <td>
                              <?php
                              if($ordenot->ordenesdetrabajo->cortado){ ?>
                                <button type="button" class="btn btn-<?= $BtnClassCorte?>"><?= ($ordenot->ordenesdetrabajo->cortadas*1)."/".($ordenot->ordenesdetrabajo->aextrusar*1)?>
                                </button>
                              <?php
                              }else{
                                ?>
                                <button type="button" class="btn btn-success">NO</button>
                                <?php
                              }?>        
                            </td>
                            <td style="width:50px"><?= $ordenot->ordenesdetrabajo->observaciones ?></td>
                            <?php
                            for($i=0; $i<20; $i++){
                              $class = "";
                              $contenido = "";
                              $dateToAnalyze = date('d-m-Y',strtotime("+".$i." days"));
                              $ini = date('d-m-Y',strtotime($fecha));
                              $fin = date('d-m-Y',strtotime($fecha." +1 Months "));
                              $iniEstrusion = date('d-m-Y',strtotime($ordenot->fechainicioextrusora));
                              $iniImpresion = date('d-m-Y',strtotime($ordenot->fechainicioimpresora));
                              $iniCorte = date('d-m-Y',strtotime($ordenot->fechainiciocortadora));
                              if($dateToAnalyze==$ini){
                                $class = "table-warning";
                                $contenido = "Ini";
                              }
                              if($dateToAnalyze==$fin){
                                $class = "table-success";
                                $contenido = "Ini";
                              }
                              if($dateToAnalyze==$iniEstrusion){
                                // $class = "table-danger";
                                $contenido = '<h4><span class="badge badge-pill badge-info"><i class="fas fa-industry"></i></span></h4>';
                              }
                              if($dateToAnalyze==$iniImpresion){
                                // $class = "table-primary";
                                $contenido = '<h4><span class="badge badge-pill badge-warning"><i class="fas fa-print"></i></span></h4>';
                              }
                              if($dateToAnalyze==$iniCorte){
                                // $class = "table-info";
                                $contenido = '<h4><span class="badge badge-pill badge-success"><i class="fas fa-cut"></i></span></h4>';
                              }
                              ?><th class="<?= $class ?>"><?= $contenido ?></th><?php
                            }
                            ?>
                          </tr>
                      <?php
                        }
                      ?>
                    </tbody>
                  </table>
                    <?php
                      }
                    ?>
                </div>
              </div>

              <div class="tab-pane fade" id="programacionFinalizadas" role="tabpanel" aria-labelledby="programacionFinalizadasTab">
                <h4>Listado de OT's finalizadas:</h4>
                <div class="card-body table-responsive p-0">
                  <table id="tblOrdenesDeTrabajoFinalizadas" class="table-sm table-bordered text-nowrap table-head-fixed text-center">
                    <thead>
                      <tr>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Cliente</th>
                        <th>OT</th>
                        <th>Medidas</th>
                        <th>Cant.</th>
                        <th>Materiales</th>
                        <th>Imp.</th>
                        <th>Cort.</th>
                        <th>Observación</th>
                        <th>Acciones<th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($ordenesdetrabajosTerminadas as $ordenesdetrabajo){
                          $nombrecliente =  $ordenesdetrabajo->ordenesdepedido->cliente->nombre;
                          $numeroOT =  $ordenesdetrabajo->ordenesdepedido->numero.'-'.$ordenesdetrabajo->numero ;
                          $linkOT =  $this->Html->link(
                              $ordenesdetrabajo->ordenesdepedido->numero.'-'.$ordenesdetrabajo->numero,
                              [
                                'action' => 'view',$ordenesdetrabajo->id], [
                                'escape' => false,
                                'target' => '_self',
                              ]
                          );
                          ?>
                          <tr>
                            <td><?= date('d-m-Y',strtotime($ordenesdetrabajo->ordenesdepedido->fecha)) ?></td>
                            <td><?= date('d-m-Y',strtotime($ordenesdetrabajo->ordenesdepedido->fecha." +1 Months ")) ?></td>
                            <td><small><?= $nombrecliente ?></small></td>
                            <td><?= $linkOT ?></td>
                            <td><?= $ordenesdetrabajo->medida ?></td>
                            <td><?= $ordenesdetrabajo->aextrusar?></td>
                            <td><?php
                            $pesoxmil = $ordenot->ordenesdetrabajo->pesoxmil;
                            foreach ($ordenot->ordenesdetrabajo->materialesots as $key => $materialesot) {
                                ?>
                                <small class="font-weight-bold">
                                  <?= $materialesot->material ?>
                                </small>
                                <small class="font-italic">
                                  <?= $materialesot->tipo ?>
                                </small>
                                <small>(<?= ($materialesot->porcentaje*$pesoxmil/100)."Kg" ?>)</small>
                                <br />
                                <?php
                            }
                            ?></td>
                            <td><?= $ordenesdetrabajo->impreso?'Si':'No'?></td>
                            <td><?= $ordenesdetrabajo->cortado?'Si':'No'?></td>
                            <td><?= $ordenesdetrabajo->observaciones ?></td>
                            <td>
                              <button type="button" class="btn btn-default btn-xs">
                              <?=$this->Html->link('<i class="fas fa-search"></i>', ['action' => 'view',$ordenesdetrabajo->id], [
                                    'escape' => false,
                                    'target' => '_self',
                              ]) ?>
                              </button>
                            </td>
                          </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="modal" id="myModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?= $this->Form->create($ordenot,[
            'id'=>'ordenOtAddForm',
            'url'=>[
                'controller'=>'ordenots',
                'action'=>'add',
            ]
        ]) ?>
        <div class="container">
          <div class="row bg-info rounded my-2">
            <div class="col-sm-6">
                <?php
                echo $this->Form->control('id', ['type'=>'hidden']);
                echo $this->Form->control('extrusora_id', [
                  'options'=>$listextrusoras,
                  'label'=>'EXTRUSORA:'
                ]);
                ?>
            </div>
            <div class="col-sm-6">
                <?php
                echo $this->Form->control('fechainicioextrusora',[
                  'type'=>'text',
                  'required'=>true,
                  'label'=>[
                    'text'=>'Inicio de extrusión:',
                    'style'=>'width:100%'
                  ],
                  'templates'=>[
                    'inputContainer'=>'
                      <div class="input-group date" id="divfechainicioextrusora" data-target-input="nearest">
                        {{content}}
                        <div class="input-group-append" data-target="#fechainicioextrusora" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar-alt"></i></div>
                        </div>
                      </div>']
                ]);
                ?>
            </div>
          </div>
          <div class="row bg-warning rounded my-2">
            <div class="col-sm-6">
                <?php
                echo $this->Form->control('impresora_id', [
                  'options'=>$listimpresoras,
                  'label'=>'IMPRESORA:'
                ]);
                ?>
            </div>
            <div class="col-sm-6">
                <?php
                echo $this->Form->control('fechainicioimpresora',[
                  'type'=>'text',
                  'required'=>true,
                  'onkeydown'=>'return false',
                  'label'=>[
                    'text'=>'Inicio de impresión:',
                    'style'=>'width:100%'
                  ],
                  'templates'=>[
                    'inputContainer'=>'
                      <div class="input-group date" id="divfechainicioimpresora" data-target-input="nearest">
                        {{content}}
                        <div class="input-group-append" data-target="#fechainicioimpresora" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar-alt"></i></div>
                        </div>
                      </div>']
                ]);
                ?>
            </div>
          </div>
          <div class="row bg-success rounded my-2">
            <div class="col-sm-6">
                <?php
                echo $this->Form->control('cortadora_id', [
                  'options'=>$listcortadoras,
                  'label'=>'CORTADORA:'
                ]);
                ?>
            </div>
            <div class="col-sm-6">
                <?php
                echo $this->Form->control('fechainiciocortadora',[
                  'type'=>'text',
                  'required'=>true,
                  'label'=>[
                    'text'=>'Inicio de corte:',
                    'style'=>'width:100%'
                  ],
                  'templates'=>[
                    'inputContainer'=>'
                      <div class="input-group date" id="divfechainiciocortadora" data-target-input="nearest">
                        {{content}}
                        <div class="input-group-append" data-target="#fechainiciocortadora" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar-alt"></i></div>
                        </div>
                      </div>']
                ]);
                ?>
            </div>
          </div>
          <?php
          echo $this->Form->control('ordenesdetrabajo_id', [
              'type' => 'hidden'
          ]);
          ?>
        </div>
        <?= $this->Form->end() ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="borrarProgramacion()">Borrar Programacion</button>
        <button type="button" class="btn btn-primary" onclick="$('#ordenOtAddForm').submit()">Agregar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
