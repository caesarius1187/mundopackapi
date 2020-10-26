<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ordenesdepedido[]|\Cake\Collection\CollectionInterface $ordenesdepedidos
 */
echo $this->Html->script('ordenesdepedidos/index',array('inline'=>false));

?>
<style>
    .loading {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: black;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        transition: 1s all;
        opacity: 0.5;
    }
    .loading .spin {
        border: 3px solid hsla(185, 100%, 62%, 0.2);
        border-top-color: #3cefff;
        border-radius: 50%;
        width: 3em;
        height: 3em;
        animation: spin 1s linear infinite;
    }
    @keyframes spin {
      to {
        transform: rotate(360deg);
      }
    }
</style>

<div class="loading" id="loader">
    <div class="spin"></div>
</div>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Informe de orden de pedido</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><?=$this->Html->link(__('Inicio'), ['action' => 'index'], [
                'escape' => false,
                ]) ?>
          </li>
          <li class="breadcrumb-item active">Informe de orden de pedido </li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
  <div class="container-fluid">

        <?php foreach ($ordenesdepedidos as $ordenesdepedido): ?>
        <div class="card">
          <div class="card-body">
            <div class="row d-print-none">
              <div class="col-md-12" style="text-align:center">
                <button onclick="window.print();" type="button" name="imprimir" class="btn btn-primary"><i class="fas fa-print"></i> Imprimir informe</button>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2">
                <dt class="text-center">N°:</dt>
                <dd class="text-center"><?= $this->Number->format($ordenesdepedido->numero) ?></dd>
              </div>
              <div class="col-md-4">
                <dt class="text-center">CLIENTE:</dt>
                <dd class="text-center"><?= h($ordenesdepedido->cliente->nombre) ?></dd>
              </div>
              <div class="col-md-4">
                <dt class="text-center">ESTADO:</dt>
                <dd class="text-center"><?= h($ordenesdepedido->estado) ?></dd>
              </div>
              <div class="col-md-2">
                <dt class="text-center">FECHA:</dt>
                <dd class="text-center"><?= h($ordenesdepedido->fecha) ?></dd>
              </div>
            </div>

            <?php foreach ($ordenesdepedido->ordenesdetrabajos as $ordenesdetrabajo): ?>

              <!-- OT -->
              <div class="card card-secondary">
                <div class="card-header">
                  <h3 class="card-title">ORDEN DE TRABAJO N° <?= h($ordenesdetrabajo->numero) ?></h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>

                <div class="card-body">
                  <section class="col-lg-12">

                  <div class="row">
                      <div class="col-sm-2">
                        <h3>Datos de OT:</h3>
                      </div>
                      <div class="col-sm-2">
                          <h5><span class="badge badge-secondary"><?= __('Cantidad: ') ?></span> <?= $this->Number->format($ordenesdetrabajo->cantidad) ?></h5>
                      </div>
                      <div class="col-sm-2">
                          <h5><span class="badge badge-secondary"><?= __('Bobinas a extrusar: ') ?></span> <?= $this->Number->format($ordenesdetrabajo->aextrusar) ?></h5>
                      </div>
                      <div class="col-sm-2">
                          <h5><span class="badge badge-secondary"><?= __('Extrusadas: ') ?></span> <?= $this->Number->format($ordenesdetrabajo->extrusadas) ?></h5>
                      </div>
                      <?php
                      if($ordenesdetrabajo->impreso){
                          ?>
                          <div class="col-sm-2">
                              <h5><span class="badge badge-secondary"><?= __('Impresas: ') ?></span> <?= $this->Number->format($ordenesdetrabajo->impresas) ?></h5>
                          </div>
                          <?php
                      }else{
                          ?>
                          <div class="col-sm-2">
                              <h5><span class="badge badge-secondary"><?= __('NO se imprime') ?></span></h5>
                          </div>
                          <?php
                      }
                      if($ordenesdetrabajo->cortado){
                          ?>
                          <div class="col-sm-2">
                              <h5><span class="badge badge-secondary"><?= __('Cortadas: ') ?></span> <?= $this->Number->format($ordenesdetrabajo->cortadas) ?></h5>
                              <?= $this->Form->control('tienecorte',['type'=>'hidden','value'=>$ordenesdetrabajo->cortado]); ?>
                              <?= $this->Form->control('tieneimpresion',['type'=>'hidden','value'=>$ordenesdetrabajo->impreso]); ?>
                          </div>
                          <?php
                      }else{
                          ?>
                          <div class="col-sm-2">
                              <h5><span class="badge badge-secondary"><?= __('NO se corta') ?></span></h5>
                          </div>
                          <?php
                      }
                      ?>
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                        <h5><span class="badge badge-secondary"><?= __('Materiales: ') ?></span>
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
                      </h5>
                    </div>
                    <div class="col-sm-2">
                        <h5><span class="badge badge-secondary"><?= __('Color: ') ?></span> <?= h($ordenesdetrabajo->color) ?></h5>
                    </div>
                    <div class="col-sm-2">
                        <h5><span class="badge badge-secondary"><?= __('Fuelle: ') ?></span> <?= h($ordenesdetrabajo->fuelle) ?></h5>
                    </div>
                    <div class="col-sm-2">
                        <h5><span class="badge badge-secondary"><?= __('Medidas: ') ?></span> <?= h($ordenesdetrabajo->medida) ?></h5>
                    </div>
                    <div class="col-sm-3">
                        <h5><span class="badge badge-secondary"><?= __('Perforación: ') ?></span> <?= h($ordenesdetrabajo->perf) ?></h5>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-2">
                        <h5><span class="badge badge-secondary"><?= __('Tipo impr. : ') ?></span> <?= h($ordenesdetrabajo->impreso) ?></h5>
                    </div>
                    <div class="col-sm-2">
                        <h5><span class="badge badge-secondary"><?= __('Precio unitario: ') ?></span> <?= h($ordenesdetrabajo->preciounitario) ?></h5>
                    </div>
                    <div class="col-sm-4">
                        <h5><span class="badge badge-secondary"><?= __('Observación: ') ?></span> <?= h($ordenesdetrabajo->observaciones) ?></h5>
                    </div>
                    <div class="col-sm-4">
                        <h5><span class="badge badge-secondary"><?= __('Conclusiones: ') ?></span> <?= h($ordenesdetrabajo->concluciones) ?></h5>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                        <h5><span class="badge badge-secondary"><?= __('Cierre micrones: ') ?></span> <?= h($ordenesdetrabajo->cierremicrones) ?></h5>
                    </div>
                    <div class="col-sm-3">
                        <h5><span class="badge badge-secondary"><?= __('Cierre scrap: ') ?></span> <?= h($ordenesdetrabajo->cierrescrap) ?></h5>
                    </div>
                    <div class="col-sm-3">
                        <h5><span class="badge badge-secondary"><?= __('Cierre diferencia (Kg.): ') ?></span> <?= h($ordenesdetrabajo->cierrediferenciakg) ?></h5>
                    </div>
                    <div class="col-sm-3">
                        <h5><span class="badge badge-secondary"><?= __('Cierre: ') ?></span> <?= h($ordenesdetrabajo->cierre) ?></h5>
                    </div>
                  </div>

                  </section>
                </div>

                <div class="card-body">
                  <section class="col-lg-12 connectedSortable">
                    <!-- EXTRUSORAS -->
                    <div class="card card-info">
                      <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-industry"></i> EXTRUSORAS</h3>
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                          <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-12">
                            <div class="card">
                              <div class="card-body table-responsive p-0">
                                <table id="tblOrdenesDeTrabajo" class="table table-head-fixed text-nowrap">
                                  <thead>
                                    <tr>
                                      <th scope="col">Numero</th>
                                      <th scope="col">Extrusora</th>
                                      <th scope="col">Fecha</th>
                                      <th scope="col">Extrusor</th>
                                      <th scope="col">Hs.</th>
                                      <th scope="col">Kg.</th>
                                      <th scope="col">Scrap cant.</th>
                                      <th scope="col">Observación</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                    foreach ($ordenesdetrabajo->bobinasdeextrusions as $kbe=> $bobinasdeextrusion) {
                                        ?>
                                        <tr>
                                          <td><?=$bobinasdeextrusion->numero; ?></td>
                                          <td><?=$bobinasdeextrusion->extrusora->nombre; ?></td>
                                          <td><?=$bobinasdeextrusion->fecha->i18nFormat('d-m-Y'); ?></td>
                                          <td><?=$bobinasdeextrusion->empleado->nombre; ?></td>
                                          <td><?=$bobinasdeextrusion->horas; ?></td>
                                          <td><?=$bobinasdeextrusion->kilogramos; ?></td>
                                          <td><?=$bobinasdeextrusion->scrap; ?></td>
                                          <td><?=$bobinasdeextrusion->observacion; ?></td>
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
                    <!-- FIN EXTRUSORAS -->

                    <!-- IMPRESORAS -->
                    <div class="card card-warning">
                      <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-print"></i> IMPRESORAS</h3>
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                          <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-12">
                            <div class="card">
                              <div class="card-body table-responsive p-0">
                                <table id="tblOrdenesDeTrabajo" class="table table-head-fixed text-nowrap">
                                  <thead>
                                    <tr>
                                      <th scope="col">Numero</th>
                                      <th scope="col">Impresora</th>
                                      <th scope="col">Fecha</th>
                                      <th scope="col">Empleado</th>
                                      <th scope="col">Hs.</th>
                                      <th scope="col">Kg.</th>
                                      <th scope="col">Scrap cant.</th>
                                      <th scope="col">Observación</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                    foreach ($ordenesdetrabajo->bobinasdeimpresions as $kbe=> $bobinasdeimpresion) {
                                        ?>
                                        <tr>
                                          <th><?=$bobinasdeimpresion->numero; ?></th>
                                          <th><?=$bobinasdeimpresion->impresora->nombre; ?></th>
                                          <th><?=$bobinasdeimpresion->fecha->i18nFormat('d-m-Y'); ?></th>
                                          <th><?=$bobinasdeimpresion->empleado->nombre; ?></th>
                                          <th><?=$bobinasdeimpresion->horas; ?></th>
                                          <th><?=$bobinasdeimpresion->kilogramos; ?></th>
                                          <th><?=$bobinasdeimpresion->scrap; ?></th>
                                          <th><?=$bobinasdeimpresion->observacion; ?></th>
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
                    <!-- FIN IMPRESORAS -->

                    <!-- CORTADORAS -->
                    <div class="card card-success">
                      <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-cut"></i> CORTADORAS</h3>
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                          <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-12">
                            <div class="card">
                              <div class="card-body table-responsive p-0">
                                <table id="tblOrdenesDeTrabajo" class="table table-head-fixed text-nowrap">
                                  <thead>
                                    <tr>
                                      <th scope="col">Numero</th>
                                      <th scope="col">Cortadora</th>
                                      <th scope="col">Fecha</th>
                                      <th scope="col">Empleado</th>
                                      <th scope="col">Hs.</th>
                                      <th scope="col">Kg.</th>
                                      <th scope="col">Scrap cant.</th>
                                      <th scope="col">Observación</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                    foreach ($ordenesdetrabajo->bobinasdecortes as $kbe=> $bobinasdecorte) {
                                        ?>
                                        <tr>
                                          <th><?=$bobinasdecorte->numero; ?></th>
                                          <th><?=$bobinasdecorte->cortadora->nombre; ?></th>
                                          <th><?=$bobinasdecorte->fecha->i18nFormat('d-m-Y'); ?></th>
                                          <th><?=$bobinasdecorte->empleado->nombre; ?></th>
                                          <th><?=$bobinasdecorte->horas; ?></th>
                                          <th><?=$bobinasdecorte->kilogramos; ?></th>
                                          <th><?=$bobinasdecorte->scrap; ?></th>
                                          <th><?=$bobinasdecorte->observacion; ?></th>
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
                    <!-- FIN CORTADORAS -->
                  </section>
                </div>
              </div>
              <!-- FIN OT -->
            <?php endforeach; ?>
          <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<script type="text/javascript">
$(document).ready(function() {
  setTimeout(ocultar,1000);
  });
  function ocultar(){
    $("#loader").remove();
  }
</script>
