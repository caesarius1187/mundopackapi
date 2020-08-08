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
        <h1 class="m-0 text-dark">Vista de OT's (línea de tiempo)</h1>
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
        <!-- The time line -->
        <div class="timeline">
          <!-- timeline time label -->
          <div class="time-label">
            <span class="bg-red">8 de Julio del 2020</span>
          </div>
          <!-- /.timeline-label -->

          <!-- timeline item -->
          <div>
            <i class="fas fa-industry bg-blue"></i>
            <div class="timeline-item">
              <span class="time"><i class="fas fa-clock"></i> 13:05 Hs.</span>
              <h3 class="timeline-header no-border"><a href="#">Operador 1</a> fabricó la Bobina 1 desde la Extrusora 2.</h3>
            </div>
          </div>
          <!-- END timeline item -->

          <!-- timeline item -->
          <div>
            <i class="fas fa-industry bg-blue"></i>
            <div class="timeline-item">
              <span class="time"><i class="fas fa-clock"></i> 14:20 Hs.</span>
              <h3 class="timeline-header no-border"><a href="#">Operador 2</a> fabricó la Bobina 2 desde la Extrusora 3.</h3>
            </div>
          </div>
          <!-- END timeline item -->

          <!-- timeline item -->
          <div>
            <i class="fas fa-print bg-yellow"></i>
            <div class="timeline-item">
              <span class="time"><i class="fas fa-clock"></i> 15:05 Hs.</span>
              <h3 class="timeline-header no-border"><a href="#" class="text-warning">Operador 4</a> imprimió la Bobina 1 desde la Impresora 2.</h3>
            </div>
          </div>
          <!-- END timeline item -->

          <!-- timeline time label -->
          <div class="time-label">
            <span class="bg-red">9 de Julio del 2020</span>
          </div>
          <!-- /.timeline-label -->

          <!-- timeline item -->
          <div>
            <i class="fas fa-industry bg-blue"></i>
            <div class="timeline-item">
              <span class="time"><i class="fas fa-clock"></i> 10:15 Hs.</span>
              <h3 class="timeline-header no-border"><a href="#">Operador 1</a> fabricó la Bobina 3 desde la Extrusora 2.</h3>
            </div>
          </div>
          <!-- END timeline item -->

          <!-- timeline item -->
          <div>
            <i class="fas fa-cut bg-green"></i>
            <div class="timeline-item">
              <span class="time"><i class="fas fa-clock"></i> 10:15 Hs.</span>
              <h3 class="timeline-header no-border"><a href="#" class="text-success">Operador 1</a> cortó la Bobina 1 desde la Cortadora 2.</h3>
            </div>
          </div>
          <!-- END timeline item -->

          <!-- timeline item -->
          <div>
            <i class="fas fa-print bg-yellow"></i>
            <div class="timeline-item">
              <span class="time"><i class="fas fa-clock"></i> 11:25 Hs.</span>
              <h3 class="timeline-header no-border"><a href="#" class="text-warning">Operador 4</a> imprimió la Bobina 2 desde la Impresora 2.</h3>
            </div>
          </div>
          <!-- END timeline item -->

          <!-- END timeline item -->
          <div>
            <i class="fas fa-handshake bg-gray"></i>
          </div>
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
