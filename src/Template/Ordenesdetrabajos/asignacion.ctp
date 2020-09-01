
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Empleado[]|\Cake\Collection\CollectionInterface $empleados
 */
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
          <li class="breadcrumb-item"><a href="#">Inicio</a></li>
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
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Listado de OT's:</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th>OT</th>
                  <th>
                      Cant.
                  </th>
                  <th>
                      Ext.
                  </th>
                  <th>
                      Imp.
                  </th>
                  <th>
                      Cort.
                  </th>
                  <th>
                      Acción
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($ordenesdetrabajos as $ordenesdetrabajo){
                    ?>
                    <tr onclick="">
                        <td>
                            <label><?= $ordenesdetrabajo->numero ?></label>
                        </td>

                        <td><?= $ordenesdetrabajo->aextrusar?></td>
                        <td><?= $ordenesdetrabajo->extrusadas?></td>
                        <td><?= $ordenesdetrabajo->impreso?$ordenesdetrabajo->impresas:'-'?></td>
                        <td><?= $ordenesdetrabajo->cortado?$ordenesdetrabajo->cortadas:'-'?></td>
                        <td><?php
                            if($ordenesdetrabajo->estado!='En Proceso'){
                                echo '<button type="button" onclick="playOT('.$ordenesdetrabajo->id.')" class="btn btn-default btn-xs"><i class="fas fa-play"></i></button> ';
                            }
                            if($ordenesdetrabajo->estado!='Pausado'){
                                echo '<button type="button" onclick="pausarOT('.$ordenesdetrabajo->id.')" class="btn btn-default btn-xs"><i class="fas fa-pause"></i></button> ';
                            }
                            echo '<button type="button" onclick="cancelarOT('.$ordenesdetrabajo->id.')" class="btn btn-default btn-xs"><i class="fas fa-ban"></i></button>  ';
                            echo '<button type="button" class="btn btn-default btn-xs"><i class="fas fa-search"></i></button> ';
                        ?></td>
                    </tr>
                    <tr>

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
                    </tr>
                    <tr>
                      <td><span class="badge bg-danger"><?= number_format($porcentaje,0,'','')?>%</span></td>
                      <td colspan="5" class="align-middle">
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

    <div class="col-md-8">
      <div class="row">
        <?php foreach ($extrusoras as $extrusora){ ?>
            <div class="col-md-4 col-sm-6 col-12">
              <div class="info-box bg-info" style="height: 125px">
                <span class="info-box-icon" onclick="loadFormPrioridad('extrusora','<?= $extrusora->nombre ?>',<?= $extrusora->id ?>)"><i class="fas fa-industry"></i></span>
                <div class="info-box-content">
                  <span class="info-box-number"><?= $extrusora->nombre?></span>
                    <ul id="ulExtrusora<?= $extrusora->id ?>" class="nav flex-column">
                      <?php foreach ($extrusora->ordenots as $ordenot){ ?>
                          <li id="liOrdenOt<?= $ordenot->id ?>">
                              OT <?= $ordenot->ordenesdetrabajo->numero?>
                              <a class="badge bg-secondary swalDefaultSuccess" onclick="levelUp(<?= $ordenot->id ?>)"><i class="fas fa-angle-up"></i></a>
                              <a class="badge bg-secondary" onclick="levelDown(<?= $ordenot->id ?>)"><i class="fas fa-angle-down"></i></a>
                              <a class="badge bg-secondary" onclick="deleteOrdOt(<?= $ordenot->id ?>)"><i class="fas fa-trash-alt"></i></a>
                          </li>
                      <?php } ?>
                    </ul>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
        <?php } ?>
      </div>
      <!-- Fin fila -->

      <div class="row">
        <div class="col-md-2 col-sm-6 col-12"></div>
        <?php foreach ($impresoras as $impresora): ?>
          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-warning text-center" style="height: 125px">
              <span class="info-box-icon" onclick="loadFormPrioridad('impresora','<?= $impresora->nombre ?>',<?= $impresora->id ?>)"><i class="fas fa-print"></i></span>

              <div class="info-box-content">
                <span class="info-box-number"><?= $impresora->nombre?></span>
                  <ul id="ulImpresora<?= $impresora->id ?>" class="nav flex-column">
                    <?php foreach ($impresora->ordenots as $ordenot){ ?>
                        <li id="liOrdenOt<?= $ordenot->id ?>">
                            OT <?= $ordenot->ordenesdetrabajo->numero?>
                            <a class="badge bg-secondary swalDefaultSuccess" onclick="levelUp(<?= $ordenot->id ?>)"><i class="fas fa-angle-up"></i></a>
                            <a class="badge bg-secondary" onclick="levelDown(<?= $ordenot->id ?>)"><i class="fas fa-angle-down"></i></a>
                            <a class="badge bg-secondary" onclick="deleteOrdOt(<?= $ordenot->id ?>)"><i class="fas fa-trash-alt"></i></a>
                        </li>
                    <?php } ?>
                  </ul>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        <?php endforeach; ?>
        <!-- /.info-box -->
        <div class="col-md-2 col-sm-6 col-12"></div>
      </div>
      <!-- Fin fila -->

      <div class="row">
        <?php foreach ($cortadoras as $cortadora): ?>
          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-success" style="height: 125px">
              <span class="info-box-icon" onclick="loadFormPrioridad('cortadora','<?= $cortadora->nombre ?>',<?= $cortadora->id ?>)"><i class="fas fa-cut"></i></span>

              <div class="info-box-content">
                <span class="info-box-number"><?= $cortadora->nombre?></span>
                  <ul id="ulCortadora<?= $cortadora->id ?>" class="nav flex-column">
                    <?php foreach ($cortadora->ordenots as $ordenot){ ?>
                        <li id="liOrdenOt<?= $ordenot->id ?>">
                            OT <?= $ordenot->ordenesdetrabajo->numero?>
                            <a class="badge bg-secondary swalDefaultSuccess" onclick="levelUp(<?= $ordenot->id ?>)"><i class="fas fa-angle-up"></i></a>
                            <a class="badge bg-secondary" onclick="levelDown(<?= $ordenot->id ?>)"><i class="fas fa-angle-down"></i></a>
                            <a class="badge bg-secondary" onclick="deleteOrdOt(<?= $ordenot->id ?>)"><i class="fas fa-trash-alt"></i></a>
                        </li>
                    <?php } ?>
                  </ul>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        <?php endforeach; ?>
        <!-- /.info-box -->
      </div>
    </div>
<div class="modal" id="myModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
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
        <fieldset>
            <legend><?= __('Agregar Orden') ?></legend>
            <?php
                echo $this->Form->control('extrusora_id', ['type' => 'hidden']);
                echo $this->Form->control('impresora_id', ['type' => 'hidden']);
                echo $this->Form->control('cortadora_id', ['type' => 'hidden']);
                echo $this->Form->control('ordenesdetrabajo_id', [
                    'optios' => [],
                    'label' => 'Ordenes de Trabajo'
                ]);
            ?>
        </fieldset>
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
