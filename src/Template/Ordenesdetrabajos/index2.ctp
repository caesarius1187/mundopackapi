<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ordenesdetrabajo[]|\Cake\Collection\CollectionInterface $ordenesdetrabajos
 */
?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Vista de OT's (pestañas)</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Inicio</a></li>
          <li class="breadcrumb-item active">Vista de OT's</li>
        </ol>
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
                        <h3 class="card-title">Tareas realizadas en las extrusoras:</h3>
                      </div>
                      <!-- ./card-header -->
                      <div class="card-body">
                        <table class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>Fecha</th>
                              <th>Extrusor</th>
                              <th>Maq.</th>
                              <th>Hs.</th>
                              <th>Kg.</th>
                              <th>Bob. cant.</th>
                              <th>Scrap cant.</th>
                              <th>Observación</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr data-widget="expandable-table" aria-expanded="false">
                              <td>04/07/2020</td>
                              <td>1</td>
                              <td>2</td>
                              <td>2:30</td>
                              <td>1,56</td>
                              <td>2</td>
                              <td>0,3</td>
                              <td>Ninguna</td>
                            </tr>
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
                        <h3 class="card-title">Tareas realizadas en las impresoras:</h3>
                      </div>
                      <!-- ./card-header -->
                      <div class="card-body">
                        <table class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>Fecha</th>
                              <th>Impresora</th>
                              <th>Maq.</th>
                              <th>Hs.</th>
                              <th>Kg.</th>
                              <th>Bob. cant.</th>
                              <th>Scrap cant.</th>
                              <th>Observación</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr data-widget="expandable-table" aria-expanded="false">
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr data-widget="expandable-table" aria-expanded="false">
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr data-widget="expandable-table" aria-expanded="false">
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr data-widget="expandable-table" aria-expanded="false">
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
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
                        <h3 class="card-title">Tareas realizadas en las cortadoras:</h3>
                      </div>
                      <!-- ./card-header -->
                      <div class="card-body">
                        <table class="table table-bordered table-hover">
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
                            <tr data-widget="expandable-table" aria-expanded="false">
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr data-widget="expandable-table" aria-expanded="false">
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr data-widget="expandable-table" aria-expanded="false">
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr data-widget="expandable-table" aria-expanded="false">
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
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
