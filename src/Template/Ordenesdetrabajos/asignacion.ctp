
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Empleado[]|\Cake\Collection\CollectionInterface $empleados
 */
use Cake\Routing\Router;

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
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col">
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link active" target="programacionPendientes" onclick="loadTab(this)">Pendientes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" target="programacionEstrusoras" onclick="loadTab(this)">A Estrusar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" target="programacionImpresoras" onclick="loadTab(this)">A Imprimir</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" target="programacionCortadoras" onclick="loadTab(this)">A Cortar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" target="programacionFinalizadas" onclick="loadTab(this)">Finalizadas</a>
            </li>
          </ul>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 programacionPendientes tabbedDiv" >
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Listado de OT's Pendientes de Programacion:</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th>Ingreso</th>
                  <th>Terminacion</th>
                  <th>Cliente</th>
                  <th>OT</th>
                  <th>Medidas</th>
                  <th>Cant.</th>
                  <th>Materiales</th>
                  <th>Imp.</th>
                  <th>Cort.</th>
                  <th>Obs.</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($ordenesdetrabajos as $ordenesdetrabajo){
                    ?>
                    <tr onclick="">
                      <td>
                          <label><?= date('d-m-Y',strtotime($ordenesdetrabajo->ordenesdepedido->fecha)) ?></label>
                      </td>
                      <td>
                           <label><?= date('d-m-Y',strtotime($ordenesdetrabajo->ordenesdepedido->fecha." +1 Months ")) ?></label>
                      </td>
                      <td>
                        <?php $nombrecliente =  $ordenesdetrabajo->ordenesdepedido->cliente->nombre; ?> 
                          <label><?= $nombrecliente ?></label>
                      </td>
                      <td>
                        <?php $numeroOT =  $ordenesdetrabajo->ordenesdepedido->numero.'-'.$ordenesdetrabajo->numero ; ?> 
                          <label><?= $numeroOT ?></label>
                      </td>
                      <td>
                          <label><?= $ordenesdetrabajo->medida ?></label>
                      </td>
                      <td><label><?= $ordenesdetrabajo->aextrusar?></label></td>
                      <td>
                      <?php
                      $pesoxmil = $ordenesdetrabajo->pesoxmil;
                      foreach ($ordenesdetrabajo->materialesots as $key => $materialesot) {
                          ?>
                          <label>
                          <?= h($materialesot->material) ?>
                          <?= h($materialesot->tipo) ?>
                          </label>
                          <?= ($materialesot->porcentaje*$pesoxmil/100)."Kg" ?>
                          <?php
                      }
                      ?>
                      </td>
                      <td><?= $ordenesdetrabajo->impreso?'Si':'No'?></td>
                      <td><?= $ordenesdetrabajo->cortado?'Si':'No'?></td>
                      <td><?= $ordenesdetrabajo->observaciones ?></td>
                      <td>
                          <button type="button" onclick="programarOT(<?= $ordenesdetrabajo->id?>, '<?=$numeroOT?>','<?=$nombrecliente?>')" class="btn btn-default btn-xs"><i class="fas fa-calendar"></i></button>
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
                                'target' => '_blank',
                          ]) ?>
                          </button>
                      </td>
                    </tr>
                    <?php
                    $porentaje = 0;
                    $cantidad = $ordenesdetrabajo->aextrusar;
                    $cantidad += $ordenesdetrabajo->impreso?$ordenesdetrabajo->aextrusar:0;
                    $cantidad += $ordenesdetrabajo->cortado?$ordenesdetrabajo->aextrusar:0;

                    $echas = $ordenesdetrabajo->extrusadas;
                    $echas += $ordenesdetrabajo->impresas;
                    $echas += $ordenesdetrabajo->cortadas;

                    // Solucion a error de división por cero
                    $porcentaje = $cantidad==0?0:$echas/$cantidad*100;
                    $classProgress = '';
                    if($porcentaje>=30 && $porcentaje<60){
                      $classProgress = 'bg-warning';
                    }
                    if($porcentaje>=60){
                      $classProgress = 'bg-success';
                    }
                    ?>
                    <tr>
                      <td><span class="badge bg-danger"><?= number_format($porcentaje,0,'','')?>%</span></td>
                      <td colspan="11" class="align-middle">
                          <div class="progress progress-xs">
                            <div class="progress-bar <?=$classProgress?>" style="width: <?= number_format($porcentaje,0,'','')?>%"></div>
                          </div>
                      </td>
                    </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-12 programacionEstrusoras tabbedDiv">
        <div class="row">
          <?php foreach ($extrusoras as $extrusora){ ?>
              <div class="col-sm-12">
                <div class="info-box bg-info">                  
                  <div class="info-box-content">
                    <span class="info-box-number"><?= $extrusora->nombre?></span>
                      <table id="tblExtrusora<?= $extrusora->id ?>" class="table table-responsive">
                        <thead>
                          <tr>
                            <th>Ini</th>
                            <th>Fin</th>
                            <th>Cli</th>
                            <th>OT</th>
                            <th>Medidas</th>
                            <th>Cant.</th>
                            <th>Materiales</th>
                            <th>Imp.</th>
                            <th>Cort.</th>
                            <th>Obs.</th>
                            <?php
                            //vamos a crear un header de 30 dias a partir de hoy
                            for($i=0; $i<20; $i++){
                              ?><th><?= date('d-m',strtotime("+".$i." days")) ?></th><?php
                            }
                            ?>
                          </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($extrusora->ordenots as $ordenot){ 
                            $fecha = $ordenot->ordenesdetrabajo->ordenesdepedido->fecha;
                            $numeroOT =  $ordenot->ordenesdetrabajo->ordenesdepedido->numero.'-'.$ordenot->ordenesdetrabajo->numero;
                            $nombrecliente =  $ordenot->ordenesdetrabajo->ordenesdepedido->cliente->nombre;
                            $inicioEstrusion = $ordenot->fechainicioextrusora?date('d-m-Y',strtotime($ordenot->fechainicioextrusora)):'';
                            $inicioImpresion = $ordenot->fechainicioimpresora?date('d-m-Y',strtotime($ordenot->fechainicioimpresora)):'';
                            $inicioCorte = $ordenot->fechainiciocortadora?date('d-m-Y',strtotime($ordenot->fechainiciocortadora)):'';
                            ?>
                            <tr id="trOrdenOt<?= $ordenot->id ?>" onclick="editarProgramacionOt(<?= $ordenot->id?>,<?= $ordenot->ordenesdetrabajo->id?>, '<?=$numeroOT?>','<?=$nombrecliente?>',<?= $ordenot->extrusora_id?>,'<?= $inicioEstrusion ?>',<?= $ordenot->impresora_id?>,'<?= $inicioImpresion?>',<?= $ordenot->cortadora_id?>,'<?= $inicioCorte?>')">
                              <td>
                                  <label><?= date('d-m',strtotime($fecha)) ?></label>
                              </td>
                              <td>
                                   <label><?= date('d-m',strtotime($fecha." +1 Months ")) ?></label>
                              </td>
                                            
                              <td>
                                <?php  ?> 
                                  <label><?= $nombrecliente ?></label>
                              </td>                             
                              <td>
                                <?php ?> 
                                  <label><?= $numeroOT ?></label>
                              </td>
                              <td>
                                  <label><?= $ordenot->ordenesdetrabajo->medida ?></label>
                              </td>
                              <td><?= $ordenot->ordenesdetrabajo->aextrusar?></td>
                              <td>
                              <?php
                              $pesoxmil = $ordenot->ordenesdetrabajo->pesoxmil;
                              foreach ($ordenot->ordenesdetrabajo->materialesots as $key => $materialesot) {
                                  ?>
                                  <label>
                                  <?= h($materialesot->material) ?>
                                  <?= h($materialesot->tipo) ?>
                                  </label>
                                  <?= ($materialesot->porcentaje*$pesoxmil/100)."Kg" ?>
                                  <?php
                              }
                              ?>
                              </td>
                              <td><?= $ordenot->ordenesdetrabajo->impreso?'Si':'No'?></td>
                              <td><?= $ordenot->ordenesdetrabajo->cortado?'Si':'No'?></td>
                              <td><?= $ordenot->ordenesdetrabajo->observaciones ?></td>   
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
                                  $class = "table-danger";
                                  $contenido = "Est";
                                }
                                if($dateToAnalyze==$iniImpresion){
                                  $class = "table-primary";
                                  $contenido = "Imp";
                                }
                                if($dateToAnalyze==$iniCorte){
                                  $class = "table-info";
                                  $contenido = "Cor";
                                }
                                ?><th class="<?= $class ?>"><?= $contenido ?></th><?php
                              }    
                              ?>       
                            </tr>
                        <?php } ?>
                        </tbody>
                      </table>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
          <?php } ?>
        </div>
        <!-- Fin fila -->
      </div>
      <div class="col-md-12 programacionImpresoras tabbedDiv">
        <div class="row">
          <?php foreach ($impresoras as $impresora){ ?>
              <div class="col-sm-12">
                <div class="info-box bg-warning">                  
                  <div class="info-box-content">
                    <span class="info-box-number"><?= $impresora->nombre?></span>
                      <table id="tblImpresora<?= $extrusora->id ?>" class="table table-responsive">
                        <thead>
                          <tr>
                            <th>Ini</th>
                            <th>Fin</th>
                            <th>Cli</th>
                            <th>OT</th>
                            <th>Medidas</th>
                            <th>Cant.</th>
                            <th>Materiales</th>
                            <th>Imp.</th>
                            <th>Cort.</th>
                            <th>Obs.</th>
                            <?php
                            //vamos a crear un header de 30 dias a partir de hoy
                            for($i=0; $i<20; $i++){
                              ?><th><?= date('d-m',strtotime("+".$i." days")) ?></th><?php
                            }
                            ?>
                          </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($impresora->ordenots as $ordenot){ 
                            $fecha = $ordenot->ordenesdetrabajo->ordenesdepedido->fecha;
                            $numeroOT =  $ordenot->ordenesdetrabajo->ordenesdepedido->numero.'-'.$ordenot->ordenesdetrabajo->numero;
                            $nombrecliente =  $ordenot->ordenesdetrabajo->ordenesdepedido->cliente->nombre;
                            $inicioEstrusion = $ordenot->fechainicioextrusora?date('d-m-Y',strtotime($ordenot->fechainicioextrusora)):'';
                            $inicioImpresion = $ordenot->fechainicioimpresora?date('d-m-Y',strtotime($ordenot->fechainicioimpresora)):'';
                            $inicioCorte = $ordenot->fechainiciocortadora?date('d-m-Y',strtotime($ordenot->fechainiciocortadora)):'';
                            ?>
                            <tr id="trOrdenOt<?= $ordenot->id ?>" onclick="editarProgramacionOt(<?= $ordenot->id?>,<?= $ordenot->ordenesdetrabajo->id?>, '<?=$numeroOT?>','<?=$nombrecliente?>',<?= $ordenot->extrusora_id?>,'<?= $inicioEstrusion ?>',<?= $ordenot->impresora_id?>,'<?= $inicioImpresion?>',<?= $ordenot->cortadora_id?>,'<?= $inicioCorte?>')">
                              <td>
                                  <label><?= date('d-m',strtotime($fecha)) ?></label>
                              </td>
                              <td>
                                   <label><?= date('d-m',strtotime($fecha." +1 Months ")) ?></label>
                              </td>
                                            
                              <td>
                                <?php  ?> 
                                  <label><?= $nombrecliente ?></label>
                              </td>                             
                              <td>
                                <?php ?> 
                                  <label><?= $numeroOT ?></label>
                              </td>
                              <td>
                                  <label><?= $ordenot->ordenesdetrabajo->medida ?></label>
                              </td>
                              <td><?= $ordenot->ordenesdetrabajo->aextrusar?></td>
                              <td>
                              <?php
                              $pesoxmil = $ordenot->ordenesdetrabajo->pesoxmil;
                              foreach ($ordenot->ordenesdetrabajo->materialesots as $key => $materialesot) {
                                  ?>
                                  <label>
                                  <?= h($materialesot->material) ?>
                                  <?= h($materialesot->tipo) ?>
                                  </label>
                                  <?= ($materialesot->porcentaje*$pesoxmil/100)."Kg" ?>
                                  <?php
                              }
                              ?>
                              </td>
                              <td><?= $ordenot->ordenesdetrabajo->impreso?'Si':'No'?></td>
                              <td><?= $ordenot->ordenesdetrabajo->cortado?'Si':'No'?></td>
                              <td><?= $ordenot->ordenesdetrabajo->observaciones ?></td>   
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
                                  $class = "table-danger";
                                  $contenido = "Est";
                                }
                                if($dateToAnalyze==$iniImpresion){
                                  $class = "table-primary";
                                  $contenido = "Imp";
                                }
                                if($dateToAnalyze==$iniCorte){
                                  $class = "table-info";
                                  $contenido = "Cor";
                                }
                                ?><th class="<?= $class ?>"><?= $contenido ?></th><?php
                              }    
                              ?>       
                            </tr>
                        <?php } ?>
                        </tbody>
                      </table>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
          <?php } ?>
        </div>
        <!-- Fin fila -->
      </div>
       <div class="col-md-12 programacionCortadoras tabbedDiv">
        <div class="row">
          <?php foreach ($cortadoras as $cortadora){ ?>
              <div class="col-sm-12">
                <div class="info-box bg-success">                  
                  <div class="info-box-content">
                    <span class="info-box-number"><?= $cortadora->nombre?></span>
                      <table id="tblCortadora<?= $cortadora->id ?>" class="table table-responsive">
                        <thead>
                          <tr>
                            <th>Ini</th>
                            <th>Fin</th>
                            <th>Cli</th>
                            <th>OT</th>
                            <th>Medidas</th>
                            <th>Cant.</th>
                            <th>Materiales</th>
                            <th>Imp.</th>
                            <th>Cort.</th>
                            <th>Obs.</th>
                            <?php
                            //vamos a crear un header de 30 dias a partir de hoy
                            for($i=0; $i<20; $i++){
                              ?><th><?= date('d-m',strtotime("+".$i." days")) ?></th><?php
                            }
                            ?>
                          </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($cortadora->ordenots as $ordenot){ 
                            $fecha = $ordenot->ordenesdetrabajo->ordenesdepedido->fecha;
                            $numeroOT =  $ordenot->ordenesdetrabajo->ordenesdepedido->numero.'-'.$ordenot->ordenesdetrabajo->numero;
                            $nombrecliente =  $ordenot->ordenesdetrabajo->ordenesdepedido->cliente->nombre;
                            $inicioEstrusion = $ordenot->fechainicioextrusora?date('d-m-Y',strtotime($ordenot->fechainicioextrusora)):'';
                            $inicioImpresion = $ordenot->fechainicioimpresora?date('d-m-Y',strtotime($ordenot->fechainicioimpresora)):'';
                            $inicioCorte = $ordenot->fechainiciocortadora?date('d-m-Y',strtotime($ordenot->fechainiciocortadora)):'';
                            ?>
                            <tr id="trOrdenOt<?= $ordenot->id ?>" onclick="editarProgramacionOt(<?= $ordenot->id?>,<?= $ordenot->ordenesdetrabajo->id?>, '<?=$numeroOT?>','<?=$nombrecliente?>',<?= $ordenot->extrusora_id?>,'<?= $inicioEstrusion ?>',<?= $ordenot->impresora_id?>,'<?= $inicioImpresion?>',<?= $ordenot->cortadora_id?>,'<?= $inicioCorte?>')">
                              <td>
                                  <label><?= date('d-m',strtotime($fecha)) ?></label>
                              </td>
                              <td>
                                   <label><?= date('d-m',strtotime($fecha." +1 Months ")) ?></label>
                              </td>
                                            
                              <td>
                                <?php  ?> 
                                  <label><?= $nombrecliente ?></label>
                              </td>                             
                              <td>
                                <?php ?> 
                                  <label><?= $numeroOT ?></label>
                              </td>
                              <td>
                                  <label><?= $ordenot->ordenesdetrabajo->medida ?></label>
                              </td>
                              <td><?= $ordenot->ordenesdetrabajo->aextrusar?></td>
                              <td>
                              <?php
                              $pesoxmil = $ordenot->ordenesdetrabajo->pesoxmil;
                              foreach ($ordenot->ordenesdetrabajo->materialesots as $key => $materialesot) {
                                  ?>
                                  <label>
                                  <?= h($materialesot->material) ?>
                                  <?= h($materialesot->tipo) ?>
                                  </label>
                                  <?= ($materialesot->porcentaje*$pesoxmil/100)."Kg" ?>
                                  <?php
                              }
                              ?>
                              </td>
                              <td><?= $ordenot->ordenesdetrabajo->impreso?'Si':'No'?></td>
                              <td><?= $ordenot->ordenesdetrabajo->cortado?'Si':'No'?></td>
                              <td><?= $ordenot->ordenesdetrabajo->observaciones ?></td>   
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
                                  $class = "table-danger";
                                  $contenido = "Est";
                                }
                                if($dateToAnalyze==$iniImpresion){
                                  $class = "table-primary";
                                  $contenido = "Imp";
                                }
                                if($dateToAnalyze==$iniCorte){
                                  $class = "table-info";
                                  $contenido = "Cor";
                                }
                                ?><th class="<?= $class ?>"><?= $contenido ?></th><?php
                              }    
                              ?>       
                            </tr>
                        <?php } ?>
                        </tbody>
                      </table>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
          <?php } ?>
        </div>
        <!-- Fin fila -->
      </div>
    </div>
  </div>
</section>
<div class="modal" id="myModal" tabindex="-1" role="dialog">
  <div class="modal-dialog  modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
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
          <div class="row"> 
            <div class="col-sm-2">
                <?php
                echo $this->Form->control('id', ['type'=>'hidden']);
                echo $this->Form->control('extrusora_id', [
                  'options'=>$listextrusoras
                ]);
                ?>
            </div>
            <div class="col-sm-2">
                <?php
                echo $this->Form->control('fechainicioextrusora',[
                  'type'=>'text',
                  'required'=>true,
                  'label'=>[
                    'text'=>'Inicio Extrusion',
                    'style'=>'width:100%'
                  ],
                  'templates'=>[
                    'inputContainer'=>'
                      <div class="input-group date" id="fechainicioextrusora" data-target-input="nearest">
                        {{content}}
                        <div class="input-group-append" data-target="#fechainicioextrusora" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>']
                ]); 
                ?>
            </div>
            <div class="col-sm-2">
                <?php
                echo $this->Form->control('impresora_id', [
                  'options'=>$listimpresoras
                ]);
                ?>
            </div>
            <div class="col-sm-2">
                <?php
                echo $this->Form->control('fechainicioimpresora',[
                  'type'=>'text',
                  'required'=>true,
                  'label'=>[
                    'text'=>'Inicio Impresion',
                    'style'=>'width:100%'
                  ],
                  'templates'=>[
                    'inputContainer'=>'
                      <div class="input-group date" id="fechainicioimpresora" data-target-input="nearest">
                        {{content}}
                        <div class="input-group-append" data-target="#fechainicioimpresora" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>']
                ]); 
                ?>
            </div>
            <div class="col-sm-2">
                <?php
                echo $this->Form->control('cortadora_id', [
                  'options'=>$listcortadoras
                ]);
                ?>
            </div>
            <div class="col-sm-2">
                <?php
                echo $this->Form->control('fechainiciocortadora',[
                  'type'=>'text',
                  'required'=>true,
                  'label'=>[
                    'text'=>'Inicio Impresion',
                    'style'=>'width:100%'
                  ],
                  'templates'=>[
                    'inputContainer'=>'
                      <div class="input-group date" id="fechainiciocortadora" data-target-input="nearest">
                        {{content}}
                        <div class="input-group-append" data-target="#fechainiciocortadora" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>']
                ]); 
                ?>
            </div>
            <div class="col-sm-2">
                <?php
                echo $this->Form->control('ordenesdetrabajo_id', [
                    'type' => 'hidden'
                ]);
                ?>
            </div>
          </div>
        </div>
        <?= $this->Form->end() ?>
      </div>
      <div class="modal-footer">
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
