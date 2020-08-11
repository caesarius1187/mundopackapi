<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Empleado $empleado
 */
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

      <h5 class="mt-4 mb-2">Tareas realizadas:</h5>

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
                      <h4><?= __('Related Bobinasdecortes') ?></h4>
                      <?php if (!empty($empleado->bobinasdecortes)): ?>
                      <table cellpadding="0" cellspacing="0">
                          <tr>
                              <th scope="col"><?= __('Id') ?></th>
                              <th scope="col"><?= __('Empleado Id') ?></th>
                              <th scope="col"><?= __('Impresora Id') ?></th>
                              <th scope="col"><?= __('Fecha') ?></th>
                              <th scope="col"><?= __('Horas') ?></th>
                              <th scope="col"><?= __('Kilogramos') ?></th>
                              <th scope="col"><?= __('Scrap') ?></th>
                              <th scope="col"><?= __('Created') ?></th>
                              <th scope="col"><?= __('Modified') ?></th>
                              <th scope="col" class="actions"><?= __('Actions') ?></th>
                          </tr>
                          <?php foreach ($empleado->bobinasdecortes as $bobinasdecortes): ?>
                          <tr>
                              <td><?= h($bobinasdecortes->id) ?></td>
                              <td><?= h($bobinasdecortes->empleado_id) ?></td>
                              <td><?= h($bobinasdecortes->impresora_id) ?></td>
                              <td><?= h($bobinasdecortes->fecha) ?></td>
                              <td><?= h($bobinasdecortes->horas) ?></td>
                              <td><?= h($bobinasdecortes->kilogramos) ?></td>
                              <td><?= h($bobinasdecortes->scrap) ?></td>
                              <td><?= h($bobinasdecortes->created) ?></td>
                              <td><?= h($bobinasdecortes->modified) ?></td>
                              <td class="actions">
                                  <?= $this->Html->link(__('View'), ['controller' => 'Bobinasdecortes', 'action' => 'view', $bobinasdecortes->id]) ?>
                                  <?= $this->Html->link(__('Edit'), ['controller' => 'Bobinasdecortes', 'action' => 'edit', $bobinasdecortes->id]) ?>
                                  <?= $this->Form->postLink(__('Delete'), ['controller' => 'Bobinasdecortes', 'action' => 'delete', $bobinasdecortes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bobinasdecortes->id)]) ?>
                              </td>
                          </tr>
                          <?php endforeach; ?>
                      </table>
                      <?php endif; ?>
                  </div>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane active" id="tab_1">
                  <div class="related">
                      <h4><?= __('Related Bobinasdeextrusions') ?></h4>
                      <?php if (!empty($empleado->bobinasdeextrusions)): ?>
                      <table cellpadding="0" cellspacing="0">
                          <tr>
                              <th scope="col"><?= __('Id') ?></th>
                              <th scope="col"><?= __('Empleado Id') ?></th>
                              <th scope="col"><?= __('Extrusora Id') ?></th>
                              <th scope="col"><?= __('Fecha') ?></th>
                              <th scope="col"><?= __('Horas') ?></th>
                              <th scope="col"><?= __('Kilogramos') ?></th>
                              <th scope="col"><?= __('Scrap') ?></th>
                              <th scope="col"><?= __('Created') ?></th>
                              <th scope="col"><?= __('Modified') ?></th>
                              <th scope="col" class="actions"><?= __('Actions') ?></th>
                          </tr>
                          <?php foreach ($empleado->bobinasdeextrusions as $bobinasdeextrusions): ?>
                          <tr>
                              <td><?= h($bobinasdeextrusions->id) ?></td>
                              <td><?= h($bobinasdeextrusions->empleado_id) ?></td>
                              <td><?= h($bobinasdeextrusions->extrusora_id) ?></td>
                              <td><?= h($bobinasdeextrusions->fecha) ?></td>
                              <td><?= h($bobinasdeextrusions->horas) ?></td>
                              <td><?= h($bobinasdeextrusions->kilogramos) ?></td>
                              <td><?= h($bobinasdeextrusions->scrap) ?></td>
                              <td><?= h($bobinasdeextrusions->created) ?></td>
                              <td><?= h($bobinasdeextrusions->modified) ?></td>
                              <td class="actions">
                                  <?= $this->Html->link(__('View'), ['controller' => 'Bobinasdeextrusions', 'action' => 'view', $bobinasdeextrusions->id]) ?>
                                  <?= $this->Html->link(__('Edit'), ['controller' => 'Bobinasdeextrusions', 'action' => 'edit', $bobinasdeextrusions->id]) ?>
                                  <?= $this->Form->postLink(__('Delete'), ['controller' => 'Bobinasdeextrusions', 'action' => 'delete', $bobinasdeextrusions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bobinasdeextrusions->id)]) ?>
                              </td>
                          </tr>
                          <?php endforeach; ?>
                      </table>
                      <?php endif; ?>
                  </div>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                  <div class="related">
                      <h4><?= __('Related Bobinasdeimpresions') ?></h4>
                      <?php if (!empty($empleado->bobinasdeimpresions)): ?>
                      <table cellpadding="0" cellspacing="0">
                          <tr>
                              <th scope="col"><?= __('Id') ?></th>
                              <th scope="col"><?= __('Empleado Id') ?></th>
                              <th scope="col"><?= __('Cortadora Id') ?></th>
                              <th scope="col"><?= __('Bobinasdeextrusion Id') ?></th>
                              <th scope="col"><?= __('Fecha') ?></th>
                              <th scope="col"><?= __('Horas') ?></th>
                              <th scope="col"><?= __('Kilogramos') ?></th>
                              <th scope="col"><?= __('Scrap') ?></th>
                              <th scope="col"><?= __('Created') ?></th>
                              <th scope="col"><?= __('Modified') ?></th>
                              <th scope="col" class="actions"><?= __('Actions') ?></th>
                          </tr>
                          <?php foreach ($empleado->bobinasdeimpresions as $bobinasdeimpresions): ?>
                          <tr>
                              <td><?= h($bobinasdeimpresions->id) ?></td>
                              <td><?= h($bobinasdeimpresions->empleado_id) ?></td>
                              <td><?= h($bobinasdeimpresions->cortadora_id) ?></td>
                              <td><?= h($bobinasdeimpresions->bobinasdeextrusion_id) ?></td>
                              <td><?= h($bobinasdeimpresions->fecha) ?></td>
                              <td><?= h($bobinasdeimpresions->horas) ?></td>
                              <td><?= h($bobinasdeimpresions->kilogramos) ?></td>
                              <td><?= h($bobinasdeimpresions->scrap) ?></td>
                              <td><?= h($bobinasdeimpresions->created) ?></td>
                              <td><?= h($bobinasdeimpresions->modified) ?></td>
                              <td class="actions">
                                  <?= $this->Html->link(__('View'), ['controller' => 'Bobinasdeimpresions', 'action' => 'view', $bobinasdeimpresions->id]) ?>
                                  <?= $this->Html->link(__('Edit'), ['controller' => 'Bobinasdeimpresions', 'action' => 'edit', $bobinasdeimpresions->id]) ?>
                                  <?= $this->Form->postLink(__('Delete'), ['controller' => 'Bobinasdeimpresions', 'action' => 'delete', $bobinasdeimpresions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bobinasdeimpresions->id)]) ?>
                              </td>
                          </tr>
                          <?php endforeach; ?>
                      </table>
                      <?php endif; ?>
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
