<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ordenesdepedido[]|\Cake\Collection\CollectionInterface $ordenesdepedidos
 */
echo $this->Html->script('ordenesdepedidos/index',array('inline'=>false));

?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Ordenes de Pedidos Informe</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><?=$this->Html->link(__('Inicio'), ['action' => 'index'], [
                'escape' => false,
                ]) ?>
          </li>
          <li class="breadcrumb-item active">Ordenes de Pedido</li>
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
            <?php
            $session = $this->request->getSession(); // less than 3.5
            $user_data = $session->read('Auth.User');
            if($user_data['role']=='superuser'){
                echo $this->Html->link(__('<i class="fas fa-plus"></i> Nueva orden de pedido'), ['action' => 'add'], [
                'escape' => false,
                'class' => 'btn btn-primary float-right'
                ]);
            }  
            ?>
            <table id="example" class="table table-bordered table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('Numero') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('Cliente') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('Fecha') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('Estado') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('Creado') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('Modificado') ?></th>
                    </tr>
                </thead>
                <tbody>                    
                    <?php foreach ($ordenesdepedidos as $ordenesdepedido): ?>
                      <tr>
                          <td><?= $this->Number->format($ordenesdepedido->numero) ?></td>
                          <td><?= h($ordenesdepedido->cliente->nombre) ?></td>
                          <td><?= h($ordenesdepedido->fecha) ?></td>
                          <td><?= h($ordenesdepedido->estado) ?></td>
                          <td><?= h($ordenesdepedido->created) ?></td>
                          <td><?= h($ordenesdepedido->modified) ?></td>                      
                      </tr>                      
                      <tr>
                        <td colspan="6">
                          <table id="tblOrdenesDeTrabajo" class="table table-head-fixed text-nowrap">
                            <thead>
                              <tr>
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
                              <?php foreach ($ordenesdepedido->ordenesdetrabajos as $ordenesdetrabajo): ?>
                                <tr>
                                  <td colspan="20">Orden de Trabajo</td>
                                </tr>
                                <tr>
                                  <td><?= h($ordenesdetrabajo->cantidad) ?></td>
                                  <td><?= h($ordenesdetrabajo->material) ?></td>
                                  <td><?= h($ordenesdetrabajo->tipo) ?></td>
                                  <td><?= h($ordenesdetrabajo->color) ?></td>
                                  <td><?= h($ordenesdetrabajo->fuelle) ?></td>
                                  <td><?= h($ordenesdetrabajo->medida) ?></td>
                                  <td><?= h($ordenesdetrabajo->perf) ?></td>
                                  <td><?= h($ordenesdetrabajo->impreso) ?></td>
                                  <td><?= h($ordenesdetrabajo->preciounitario) ?></td>
                                  <td><?= h($ordenesdetrabajo->observaciones) ?></td>
                                  <td><?= h($ordenesdetrabajo->numero) ?></td>
                                  <td><?= h($ordenesdetrabajo->cierre) ?></td>
                                  <td><?= h($ordenesdetrabajo->cierremicrones) ?></td>
                                  <td><?= h($ordenesdetrabajo->cierrescrap) ?></td>
                                  <td><?= h($ordenesdetrabajo->cierrediferenciakg) ?></td>
                                  <td><?= h($ordenesdetrabajo->concluciones) ?></td>
                                  <td><?= h($ordenesdetrabajo->created) ?></td>
                                  <td><?= h($ordenesdetrabajo->modified) ?></td>
                                </tr>
                                <tr><td colspan="20">Bobinas de extrusion</td></tr>
                                <tr>
                                  <td colspan="20">
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
                                  </td>
                                </tr>
                                <tr><td colspan="20">Bobinas de Impresion</td></tr>
                                <tr>
                                  <td colspan="20">
                                    <table id="tblBobinasdeImpresion" class="table table-bordered table-hover">
                                      <thead>
                                        <tr>
                                          <th>Numero</th>
                                          <th>Impresora</th>
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
                                  </td>
                                </tr>
                                <tr><td colspan="20">Bobinas de Corte</td></tr>
                                <tr>
                                  <td colspan="20">
                                    <table id="tblBobinasdeCorte" class="table table-bordered table-hover">
                                      <thead>
                                        <tr>
                                          <th>Numero</th>
                                          <th>Cortadora</th>
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
                                  </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                          </table>
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