<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ordenesdetrabajo $ordenesdetrabajo
 */
echo $this->Html->script('ordenesdetrabajos/view',array('inline'=>false));
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Pedido Numero <?= $ordenesdetrabajo->ordenesdepedido->numero ?> - Orden de Trabajo N°<?= $ordenesdetrabajo->numero ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><?=$this->Html->link(__('Inicio'), ['action' => 'index'], [
                      'escape' => false,
                      ]) ?>
                </li>
                <li class="breadcrumb-item active">Vista de OT's</li>
              </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="row mb-2">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-2">
                        <label><?= __('Cantidad:') ?></label>
                        <td><?= $this->Number->format($ordenesdetrabajo->cantidad) ?></td>
                    </div>
                    <div class="col-sm-2">
                        <label><?= __('Bobinas a Estrusar:') ?></label>
                        <td><?= $this->Number->format($ordenesdetrabajo->aextrusar) ?></td>
                    </div>
                    <div class="col-sm-2">
                        <label><?= __('Estrusadas:') ?></label>
                        <td><?= $this->Number->format($ordenesdetrabajo->extrusadas) ?></td>
                    </div>
                    <?php
                    if($ordenesdetrabajo->impreso){
                        ?>
                        <div class="col-sm-2">
                            <label><?= __('Impresas:') ?></label>
                            <td><?= $this->Number->format($ordenesdetrabajo->impresas) ?></td>
                        </div>
                        <?php
                    }else{
                        ?>
                        <div class="col-sm-2">
                            <label><?= __('NO se imprime') ?></label>
                        </div>
                        <?php
                    }
                    if($ordenesdetrabajo->cortado){
                        ?>
                        <div class="col-sm-2">
                            <label><?= __('Cortadas:') ?></label>
                            <td><?= $this->Number->format($ordenesdetrabajo->cortadas) ?></td>
                        </div>
                        <?php
                    }else{
                        ?>
                        <div class="col-sm-2">
                            <label><?= __('NO se corta') ?></label>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
         <div class="row mb-2">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-3">
                        <label><?= __('Materiales:') ?></label>
                        <ul>
                        <?php                         
                        foreach ($ordenesdetrabajo->materialesots as $key => $materialesot) {
                            ?>
                            <li><?= h($materialesot->material) ?>
                            <?= h($materialesot->tipo) ?>
                            <?= h($materialesot->porcentaje."%") ?>
                            </li>
                            <?php
                        }
                        ?>
                        </ul>
                    </div>
                    <div class="col-sm-2">
                        <label><?= __('Color:') ?></label>
                        <td><?= h($ordenesdetrabajo->color) ?></td>
                    </div>
                    <div class="col-sm-2">
                        <label><?= __('Fuelle:') ?></label>
                        <td><?= h($ordenesdetrabajo->fuelle) ?></td>
                    </div>
                    <div class="col-sm-2">
                        <label><?= __('Medida:') ?></label>
                        <td><?= h($ordenesdetrabajo->medida) ?></td>
                    </div>
                    <div class="col-sm-2">
                        <label><?= __('Perf:') ?></label>
                        <td><?= h($ordenesdetrabajo->perf) ?></td>
                    </div>
                    <div class="col-sm-2">
                        <label><?= __('Impreso:') ?></label>
                        <td><?= h($ordenesdetrabajo->impreso) ?></td>
                    </div>
                    <div class="col-sm-2">
                        <label><?= __('Preciounitario:') ?></label>
                        <td><?= h($ordenesdetrabajo->preciounitario) ?></td>
                    </div>
                    <div class="col-sm-2">
                        <label><?= __('Observaciones:') ?></label>
                        <td><?= h($ordenesdetrabajo->observaciones) ?></td>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <label><?= __('Cierre micrones:') ?></label>
                        <td><?= h($ordenesdetrabajo->cierremicrones) ?></td>
                    </div>
                    <div class="col-sm-2">
                        <label><?= __('Cierre scrap:') ?></label>
                        <td><?= h($ordenesdetrabajo->cierrescrap) ?></td>
                    </div>
                    <div class="col-sm-2">
                        <label><?= __('Cierre diferencia kg:') ?></label>
                        <td><?= h($ordenesdetrabajo->cierrediferenciakg) ?></td>
                    </div>
                    <div class="col-sm-2">
                        <label><?= __('Concluciones:') ?></label>
                        <td><?= h($ordenesdetrabajo->concluciones) ?></td>
                    </div>
                    <div class="col-sm-2">
                        <label><?= __('Cantidad:') ?></label>
                        <td><?= $this->Number->format($ordenesdetrabajo->cantidad) ?></td>
                    </div>
                    <div class="col-sm-2">
                        <label><?= __('Cierre:') ?></label>
                        <td><?= h($ordenesdetrabajo->cierre) ?></td>
                    </div>
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">

    <!-- Timelime example  -->
    <div class="row">
      <div class="col-md-12">

        <div class="card card-primary card-tabs">
          <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
              <li class="pt-2 px-3"><h3 class="card-title">Máquina</h3></li>
              <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-industry-tab" data-toggle="pill" href="#custom-tabs-industry" role="tab" aria-controls="custom-tabs-industry" aria-selected="true">EXTRUSORA</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-tabs-print-tab" data-toggle="pill" href="#custom-tabs-print" role="tab" aria-controls="custom-tabs-print" aria-selected="false">IMPRESORA</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-tabs-cut-tab" data-toggle="pill" href="#custom-tabs-cut" role="tab" aria-controls="custom-tabs-cut" aria-selected="false">CORTADORA</a>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content" id="custom-tabs-one-tabContent">
              <div class="tab-pane fade show active" id="custom-tabs-industry" role="tabpanel" aria-labelledby="custom-tabs-industry-tab">

                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Bobinas cargadas en las extrusoras:</h3>
                        <button type="button" name="button" onclick="$('#modalAddBobinaEstrusion').modal('show')" class="btn btn-success float-sm-right"><i class="fas fa-plus"></i> AGREGAR</button>
                      </div>
                      <!-- ./card-header -->
                      <div class="card-body">
                        <table id="tblBobinasdeEstrusion" class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>Numero</th>
                              <th>Estrusora</th>
                              <th>Fecha</th>
                              <th>Estrusor</th>
                              <th>Hs.</th>
                              <th>Kg.</th>
                              <th>Scrap cant.</th>
                              <th>Observación</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            foreach ($ordenesdetrabajo->bobinasdeextrusions as $kbe=> $bobinasdeextrusion) {
                                ?>
                                <tr>
                                  <th><?=$bobinasdeextrusion->numero; ?></th>
                                  <th><?=$bobinasdeextrusion->extrusora->nombre; ?></th>
                                  <th><?=$bobinasdeextrusion->fecha->i18nFormat('d-m-Y'); ?></th>
                                  <th><?=$bobinasdeextrusion->empleado->nombre; ?></th>
                                  <th><?=$bobinasdeextrusion->horas; ?></th>
                                  <th><?=$bobinasdeextrusion->kilogramos; ?></th>
                                  <th><?=$bobinasdeextrusion->scrap; ?></th>
                                  <th><?=$bobinasdeextrusion->observacion; ?></th>
                                </tr>
                                <?php
                            }
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
              <div class="tab-pane fade" id="custom-tabs-print" role="tabpanel" aria-labelledby="custom-tabs-print-tab">

                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Bobinas cargadas en las impresoras:</h3>
                        <button type="button" name="button" onclick="$('#modalAddBobinaImpresion').modal('show')" class="btn btn-success float-sm-right"><i class="fas fa-plus"></i> AGREGAR</button>
                      </div>
                      <!-- ./card-header -->
                      <div class="card-body">
                        <table id="tblBobinasdeImpresion" class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>Numero</th>
                              <th>Impresora</th>
                              <th>Bobina Extrusion N°</th>
                              <th>Fecha</th>
                              <th>Extrusor</th>
                              <th>Hs.</th>
                              <th>Kg.</th>
                              <th>Scrap cant.</th>
                              <th>Observación</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            foreach ($ordenesdetrabajo->bobinasdeimpresions as $kbi=> $bobinasdeimpresion) {
                                ?>
                                <tr>
                                  <th><?= $bobinasdeimpresion->numero; ?></th>
                                  <th><?= $bobinasdeimpresion->impresora->nombre; ?></th>
                                  <th><?= $bobinasdeimpresion->bobinasdeextrusion->numero; ?></th>
                                  <th><?= $bobinasdeimpresion->fecha->i18nFormat('d-m-Y'); ?></th>
                                  <th><?= $bobinasdeimpresion->empleado_id; ?></th>
                                  <th><?= $bobinasdeimpresion->horas; ?></th>
                                  <th><?= $bobinasdeimpresion->kilogramos; ?></th>
                                  <th><?= $bobinasdeimpresion->scrap; ?></th>
                                  <th><?= $bobinasdeimpresion->observacion; ?></th>
                                </tr>
                                <?php
                            }
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
              <div class="tab-pane fade" id="custom-tabs-cut" role="tabpanel" aria-labelledby="custom-tabs-cut-tab">

                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Bobinas cargadas en las cortadoras:</h3>
                         <button type="button" name="button" onclick="$('#modalAddBobinaCorte').modal('show')" class="btn btn-success float-sm-right"><i class="fas fa-plus"></i> AGREGAR</button>
                      </div>
                      <!-- ./card-header -->
                      <div class="card-body">
                        <table id="tblBobinasdeCorte" class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>Fecha</th>
                              <th>Cortadora</th>
                              <th>Maq.</th>
                              <th>Hs.</th>
                              <th>Kg.</th>
                              <th>Bob. cant.</th>
                              <th>Scrap cant.</th>
                              <th>Observación</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            foreach ($ordenesdetrabajo->bobinasdecortes as $kbc=> $bobinasdecorte) {
                                ?>
                                <tr>
                                  <th><?= $bobinasdecorte->numero; ?></th>
                                  <th><?= $bobinasdecorte->bobinasdeextrusion->numero; ?></th>
                                  <th><?= $bobinasdecorte->fecha->i18nFormat('d-m-Y'); ?></th>
                                  <th><?= $bobinasdecorte->empleado_id; ?></th>
                                  <th><?= $bobinasdecorte->horas; ?></th>
                                  <th><?= $bobinasdecorte->kilogramos; ?></th>
                                  <th><?= $bobinasdecorte->scrap; ?></th>
                                  <th><?= $bobinasdecorte->observacion; ?></th>
                                </tr>
                                <?php
                            }
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <!-- /.card -->
        </div>

      </div>
      <!-- /.col -->
    </div>
  </div>
  <!-- /.timeline -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal" id="modalAddBobinaEstrusion" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?= __('Agregar Bobina de Extrusion') ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?= $this->Form->create($newbobinasdeextrusion,[
            'id'=>'bobinaEstrusionAddForm',
            'url'=>[
                'controller'=>'bobinasdeextrusions',
                'action'=>'add',
            ]
        ]) ?>
        <div class="row">
            <div class="col-sm-3">
                <?= $this->Form->control('empleado_id', ['options' => $empleados]); ?>
                <?= $this->Form->control('ordenesdetrabajo_id', ['type' => 'hidden','value'=>$ordenesdetrabajo->id]); ?>
            </div>
            <div class="col-sm-3">
                <?= $this->Form->control('extrusora_id', ['options' => $extrusoras]); ?>
            </div>
            <div class="col-sm-4">
                <?= $this->Form->control('fecha',[
                  'type'=>'text',
                  'required'=>true,
                  'label'=>[
                    'text'=>'Fecha',
                    'style'=>'width:100%'
                  ],
                  'templates'=>[
                    'inputContainer'=>'
                      <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        {{content}}
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>']
                ]); ?>
            </div>
            <div class="col-sm-2">
                <?= $this->Form->control('horas'); ?>
            </div>
            <div class="col-sm-2">
                <?= $this->Form->control('kilogramos'); ?>
            </div>
            <div class="col-sm-2">
                <?= $this->Form->control('scrap'); ?>
            </div>
            <div class="col-sm-4">
                <?= $this->Form->control('observacion'); ?>
            </div>
        </div>
        <?= $this->Form->end() ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="$('#bobinaEstrusionAddForm').submit()">Agregar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
</div>

<div class="modal" id="modalAddBobinaImpresion" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?= __('Agregar Bobina de Impresion') ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?= $this->Form->create($newbobinasdeimpresion,[
            'id'=>'bobinaImpresionAddForm',
            'url'=>[
                'controller'=>'bobinasdeimpresions',
                'action'=>'add',
            ]
        ]) ?>
        <div class="row">
            <div class="col-sm-3">
                <?= $this->Form->control('empleado_id', ['options' => $empleados]); ?>
                <?= $this->Form->control('ordenesdetrabajo_id', ['type' => 'hidden','value'=>$ordenesdetrabajo->id]); ?>
            </div>
            <div class="col-sm-3">
                <?= $this->Form->control('impresora_id', ['options' => $impresoras]); ?>
            </div>
            <div class="col-sm-3">
                <?= $this->Form->control('bobinasdeextrusion_id', [
                    'options' => [],
                    'label' => 'Bobina de estrusion',
                ]); ?>
            </div>
            <div class="col-sm-4">
                <?= $this->Form->control('fecha',[
                  'type'=>'text',
                  'required'=>true,
                  'label'=>[
                    'text'=>'Fecha',
                    'style'=>'width:100%'
                  ],
                  'templates'=>[
                    'inputContainer'=>'
                      <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        {{content}}
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>']
                ]); ?>
            </div>
            <div class="col-sm-2">
                <?= $this->Form->control('horas'); ?>
            </div>
            <div class="col-sm-2">
                <?= $this->Form->control('kilogramos'); ?>
            </div>
            <div class="col-sm-2">
                <?= $this->Form->control('scrap'); ?>
            </div>
            <div class="col-sm-4">
                <?= $this->Form->control('observacion'); ?>
            </div>
        </div>
        <?= $this->Form->end() ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="$('#bobinaImpresionAddForm').submit()">Agregar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
</div>

<div class="modal" id="modalAddBobinaCorte" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?= __('Agregar Bobina de Impresion') ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?= $this->Form->create($newbobinasdecorte,[
            'id'=>'bobinaCorteAddForm',
            'url'=>[
                'controller'=>'bobinasdecortes',
                'action'=>'add',
            ]
        ]) ?>
        <div class="row">
            <div class="col-sm-3">
                <?= $this->Form->control('empleado_id', ['options' => $empleados]); ?>
                <?= $this->Form->control('ordenesdetrabajo_id', ['type' => 'hidden','value'=>$ordenesdetrabajo->id]); ?>
            </div>
            <div class="col-sm-3">
                <?= $this->Form->control('cortadora_id', ['options' => $cortadoras]); ?>
            </div>
            <div class="col-sm-4">
                <?= $this->Form->control('bobinasdeextrusion_id', [
                    'options' => [],
                    'multiple' => true,
                    'label' => 'Bobina de estrusion',
                ]); ?>
                <?= $this->Form->control('bobinasdeimpresion_id', [
                    'options' => [],
                    'multiple' => true,
                    'label' => 'Bobina de impresion',
                ]); ?>
            </div>
            <div class="col-sm-4">
                <?= $this->Form->control('fecha',[
                  'type'=>'text',
                  'required'=>true,
                  'label'=>[
                    'text'=>'Fecha',
                    'style'=>'width:100%'
                  ],
                  'templates'=>[
                    'inputContainer'=>'
                      <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        {{content}}
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>']
                ]); ?>
            </div>
            <div class="col-sm-2">
                <?= $this->Form->control('horas'); ?>
            </div>
            <div class="col-sm-2">
                <?= $this->Form->control('kilogramos'); ?>
            </div>
            <div class="col-sm-2">
                <?= $this->Form->control('scrap'); ?>
            </div>
            <div class="col-sm-4">
                <?= $this->Form->control('observacion'); ?>
            </div>
        </div>
        <?= $this->Form->end() ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="$('#bobinaCorteAddForm').submit()">Agregar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
</div>
