<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Empleado $empleado
 */
echo $this->Html->script('empleados/view',array('inline'=>false));
?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row">
      <?= $this->Html->link(__('<i class="fas fa-reply"></i> Volver'), ['action' => 'index'], [
          'escape' => false,
          'class' => 'btn btn-warning btn-sm'
          ]) ?>
      <?= $this->Html->link(__('<i class="fas fa-edit"></i> Editar'), ['action' => 'edit', $empleado->id], [
          'escape' => false,
          'class' => 'btn btn-info btn-sm',
          'style' => 'margin-left: 5px'
          ]) ?>
    </div>
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Vista del empleado</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Inicio</a></li>
          <li class="breadcrumb-item active">Vista del empleado</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row justify-content-md-center">
      <div class="col-md-6">
        <div class="card">
            <div class="card-header">
              <h1 class="card-title">
                <i class="fas fa-address-card"></i>
                <?= h($empleado->nombre) ?>
              </h1>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <dl class="row">
                <dt class="col-sm-4 text-right">LEGAJO:</dt>
                <dd class="col-sm-8"><?= h($empleado->legajo) ?></dd>
                <dt class="col-sm-4 text-right">ROL:</dt>
                <dd class="col-sm-8"><?= h($empleado->rol) ?></dd>
                <dt class="col-sm-4 text-right">DIRECCIÓN:</dt>
                <dd class="col-sm-8"><?= h($empleado->direccion) ?></dd>
                <dt class="col-sm-4 text-right">CELULAR:</dt>
                <dd class="col-sm-8"><?= h($empleado->celular) ?></dd>
              </dl>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>

      <div class="row">
        <h5>Tareas realizadas:</h5>
      </div>

      <div class="row" style="margin: 0 0 15px 150px">
        <?= $this->Form->create($empleadoconsulta,[
          'id'=>'empleadoConsultaForm',
          'class'=>'form-inline'
        ]) ?>

        <div class="col-1">Desde:</div>
        <div class="form-group col-4">
          <?= $this->Form->control('fechadesde',[
            'type'=>'text',
            'required'=>true,
            'templates'=>[
              'inputContainer'=>'
                <div class="input-group date" id="desde" data-target-input="nearest">
                  {{content}}
                  <div class="input-group-append" data-target="#desde" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
                </div>']
          ]); ?>
        </div>
        <div class="col-1">Hasta:</div>
        <div class="form-group col-4">
          <?= $this->Form->control('fechahasta',[
            'type'=>'text',
            'required'=>true,
            'templates'=>[
              'inputContainer'=>'
                <div class="input-group date" id="hasta" data-target-input="nearest">
                  {{content}}
                  <div class="input-group-append" data-target="#hasta" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
                </div>']
          ]); ?>
        </div>
        <div class="form-group col-2">
          <?= $this->Form->button(__('<i class="fas fa-search"></i> Consultar'), [
            'escape' => false,
            'class' => 'btn btn-success float-right'
            ]) ?>
        </div>
        <?= $this->Form->end() ?>
      </div>

      <div class="row">
        <div class="col-12">
          <!-- Custom Tabs -->
          <div class="card">
            <div class="card-header d-flex p-0">
              <h3 class="card-title p-3">Seleccionar la pestaña con la maquinaria que desee.</h3>
              <ul class="nav nav-pills ml-auto p-2">
                <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Extrusoras</a></li>
                <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Impresoras</a></li>
                <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Cortadoras</a></li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane" id="tab_3">
                  <div class="related">
                      <h4><?= __('Bobinas de cortes:') ?></h4>
                      <?php if (!empty($empleado->bobinasdecortes)): ?>
                        <div class="card-body">
                          <table id="tblBobinasdeEstrusion" class="table table-bordered table-hover">
                            <tr>
                                <th scope="col"><?= __('Cortadora') ?></th>
                                <th scope="col"><?= __('Fecha') ?></th>
                                <th scope="col"><?= __('Horas') ?></th>
                                <th scope="col"><?= __('Kilogramos') ?></th>
                                <th scope="col"><?= __('Scrap') ?></th>
                                <th scope="col"><?= __('Creado') ?></th>
                                <th scope="col"><?= __('Modificado') ?></th>
                            </tr>
                            <?php foreach ($empleado->bobinasdecortes as $bobinasdecorte): ?>
                            <tr>
                                <td><?= h($bobinasdecorte->cortadora->nombre) ?></td>
                                <td><?= date('d-m-Y',strtotime($bobinasdecorte->fecha)) ?></td>
                                <td><?= h($bobinasdecorte->horas) ?></td>
                                <td><?= h($bobinasdecorte->kilogramos) ?></td>
                                <td><?= h($bobinasdecorte->scrap) ?></td>
                                <td><?= h($bobinasdecorte->created) ?></td>
                                <td><?= h($bobinasdecorte->modified) ?></td>
                            </tr>
                          <?php endforeach; ?>
                        </table>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane active" id="tab_1">
                  <div class="related">
                      <h4><?= __('Bobinas de extrusión:') ?></h4>
                      <?php if (!empty($empleado->bobinasdeextrusions)): ?>
                        <div class="card-body">
                          <table id="tblBobinasdeEstrusion" class="table table-bordered table-hover">
                            <tr>
                                <th scope="col"><?= __('Extrusora') ?></th>
                                <th scope="col"><?= __('Fecha') ?></th>
                                <th scope="col"><?= __('Horas') ?></th>
                                <th scope="col"><?= __('Kilogramos') ?></th>
                                <th scope="col"><?= __('Scrap') ?></th>
                                <th scope="col"><?= __('Creado') ?></th>
                                <th scope="col"><?= __('Modificado') ?></th>
                            </tr>
                            <?php foreach ($empleado->bobinasdeextrusions as $bobinasdeextrusion): ?>
                            <tr>
                                <td><?= h($bobinasdeextrusion->extrusora->nombre) ?></td>
                                <td><?= date('d-m-Y',strtotime($bobinasdeextrusion->fecha)) ?></td>
                                <td><?= h($bobinasdeextrusion->horas) ?></td>
                                <td><?= h($bobinasdeextrusion->kilogramos) ?></td>
                                <td><?= h($bobinasdeextrusion->scrap) ?></td>
                                <td><?= h($bobinasdeextrusion->created) ?></td>
                                <td><?= h($bobinasdeextrusion->modified) ?></td>
                            </tr>
                            <?php endforeach; ?>
                          </table>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                  <div class="related">
                      <h4><?= __('Bobinas de impresión:') ?></h4>
                      <?php if (!empty($empleado->bobinasdeimpresions)): ?>
                        <div class="card-body">
                          <table id="tblBobinasdeEstrusion" class="table table-bordered table-hover">
                            <tr>
                                <th scope="col"><?= __('Impresora') ?></th>
                                <th scope="col"><?= __('Fecha') ?></th>
                                <th scope="col"><?= __('Horas') ?></th>
                                <th scope="col"><?= __('Kilogramos') ?></th>
                                <th scope="col"><?= __('Scrap') ?></th>
                                <th scope="col"><?= __('Creado') ?></th>
                                <th scope="col"><?= __('Modificado') ?></th>
                            </tr>
                            <?php foreach ($empleado->bobinasdeimpresions as $bobinasdeimpresions): ?>
                            <tr>
                                <td><?= h($bobinasdeimpresions->impresora->nombre) ?></td>
                                <td><?= date('d-m-Y',strtotime($bobinasdeimpresions->fecha)) ?></td>
                                <td><?= h($bobinasdeimpresions->horas) ?></td>
                                <td><?= h($bobinasdeimpresions->kilogramos) ?></td>
                                <td><?= h($bobinasdeimpresions->scrap) ?></td>
                                <td><?= h($bobinasdeimpresions->created) ?></td>
                                <td><?= h($bobinasdeimpresions->modified) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>
          <!-- ./card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
  </div>
</div>
