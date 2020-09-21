<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Mundo Pack';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(['https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback',
                          '/plugins/fontawesome-free/css/all.min.css',
                          'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
                          '/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
                          '/plugins/icheck-bootstrap/icheck-bootstrap.min.css',
                          '/plugins/jqvmap/jqvmap.min.css',
                          '/plugins/overlayScrollbars/css/OverlayScrollbars.min.css',
                          '/plugins/daterangepicker/daterangepicker.css',
                          '/plugins/summernote/summernote-bs4.min.css',
                          // DataTable
                          '/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css',
                          '/plugins/datatables-responsive/css/responsive.bootstrap4.min.css',
                          // Select2
                          '/plugins/select2/css/select2.min.css',
                          '/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css',
                          //SweetAlert2
                          '/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
                          // Toast
                          '/plugins/toastr/toastr.min.css',
                          //icheck
                          '/plugins/icheck-bootstrap/icheck-bootstrap.min.css',
                          'adminlte.min.css'
    ]) ?>

    <?= $this->Html->script(['/plugins/jquery/jquery.min.js',
                              '/plugins/jquery-ui/jquery-ui.min.js',
                              '/plugins/bootstrap/js/bootstrap.bundle.min.js',
                              '/plugins/chart.js/Chart.min.js',
                              '/plugins/sparklines/sparkline.js',
                              '/plugins/jqvmap/jquery.vmap.min.js',
                              '/plugins/jqvmap/maps/jquery.vmap.usa.js',
                              '/plugins/jquery-knob/jquery.knob.min.js',
                              '/plugins/moment/moment.min.js',
                              '/plugins/daterangepicker/daterangepicker.js',
                              '/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
                              '/plugins/summernote/summernote-bs4.min.js',
                              '/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
                              // DataTable
                              '/plugins/datatables/jquery.dataTables.min.js',
                              '/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js',
                              '/plugins/datatables-responsive/js/dataTables.responsive.min.js',
                              '/plugins/datatables-responsive/js/responsive.bootstrap4.min.js',
                              // Select2
                              '/plugins/select2/js/select2.full.min.js',
                              //SweetAlert2
                              '/plugins/sweetalert2/sweetalert2.min.js',
                              // Toast
                              '/plugins/toastr/toastr.min.js',
                              'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/locale/es.js',
                              'adminlte.js',
                              'pages/dashboard.js',
                              'demo.js'
                              ]) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Inicio</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contacto</a>
      </li> -->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <?=$this->Html->link('<span class="badge badge-danger">Cerrar sesión</span>', [
          'plugin'=>'CakeDC/Users',
          'controller'=>'users',
          'action' => 'logout'
        ], [
          'escape' => false,
          'class' => "nav-link",
          "data-slide"=>true,
          "role"=>"button",
        ]); ?>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <?php echo $this->Html->image('mp.png', [
          'alt' => 'AdminLTE Logo',
          'class' => 'brand-image img-circle elevation-3',
          'style' => 'opacity: .8']);?>
      <span class="brand-text font-weight-light">Mundo Pack S.R.L.</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php echo $this->Html->image('user2-160x160.jpg', [
              'alt' => 'User Image',
              'class' => 'img-circle elevation-2']);?>
        </div>
        <div class="info">
          <?php
          $session = $this->request->getSession();
          $user_data = $session->read('Auth.User');
          ?>
          <a href="#" class="d-block"><?= $user_data['first_name']." ".$user_data['last_name'] ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Buscar" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <?php

              $classToItem = (($this->request->getParam('controller')=='Empleados')&&($this->request->getParam('action')=='dashboard'))?'nav-link active':'nav-link';
              echo '<li class="nav-item">';
              echo $this->Html->link(__('<i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>'),
                  array ( 'plugin' => null, 'controller' => 'empleados', 'action' => 'dashboard', '_ext' => NULL),
                  [
                      'escape' => false,
                      'class'=> $classToItem
                  ]
              );
              echo '</li>';
              if($user_data['role']=='administativo'||$user_data['role']=='superuser'){
                $classToItem = (($this->request->getParam('controller')=='Ordenesdetrabajos')&&($this->request->getParam('action')=='asignacion'))?'nav-link active':'nav-link';
                echo '<li class="nav-item">';
                echo $this->Html->link(__('<i class="nav-icon fas fa-hand-pointer"></i>
                    <p>
                      Asignacion OTs
                    </p>'),
                    array ( 'plugin' => null, 'controller' => 'ordenesdetrabajos', 'action' => 'asignacion', '_ext' => NULL),
                    [
                        'escape' => false,
                        'class'=> $classToItem
                    ]
                );
                echo '</li>';
                $classToItem = (($this->request->getParam('controller')=='Clientes')&&($this->request->getParam('action')=='index'))?'nav-link active':'nav-link';
                echo '<li class="nav-item">';
                echo $this->Html->link(__('<i class="nav-icon fas fa-child"></i>
                    <p>
                      Clientes
                    </p>'),
                    array ( 'plugin' => null, 'controller' => 'Clientes', 'action' => 'index', '_ext' => NULL),
                    [
                        'escape' => false,
                        'class'=> $classToItem
                    ]
                );
                echo '</li>';
                $classToItem = (($this->request->getParam('controller')=='Empleados')&&($this->request->getParam('action')=='index'))?'nav-link active':'nav-link';
                echo '<li class="nav-item">';
                echo $this->Html->link(__('<i class="nav-icon fas fa-address-card"></i>
                    <p>
                      Empleados
                    </p>'),
                    array ( 'plugin' => null, 'controller' => 'Empleados', 'action' => 'index', '_ext' => NULL),
                    [
                        'escape' => false,
                        'class'=> $classToItem
                    ]
                );
                echo '</li>';
              }


              $classToItem = (($this->request->getParam('controller')=='Ordenesdepedidos')&&($this->request->getParam('action')=='index'))?'nav-link active':'nav-link';
              echo '<li class="nav-item">';
              echo $this->Html->link(__('<i class="nav-icon fas fa-shopping-cart"></i>
                  <p>
                    Ordenes de Pedido
                  </p>'),
                  array ( 'plugin' => null, 'controller' => 'ordenesdepedidos', 'action' => 'index', '_ext' => NULL),
                  [
                      'escape' => false,
                      'class'=> $classToItem
                  ]
              );
              echo '</li>';




              ?>
         </ul>

              </div>

      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

        <!-- Page Content -->
        <div id="page-content-wrapper">
          <div class="container-fluid">
            <?= $this->fetch('content') ?>
          </div>
        </div>
        <!-- /#page-content-wrapper -->

      </div>
        <!-- /#wrapper -->

      <!-- Menu Toggle Script -->
      <script>
        $("#menu-toggle").click(function(e) {
          e.preventDefault();
          $("#wrapper").toggleClass("toggled");
        });
        var serverLayoutURL = "http://localhost/mundopack/";
      </script>
    <nav class="top-bar expanded" data-topbar role="navigation">

        <div class="top-bar-section">
            <ul class="right">

            </ul>
        </div>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">

    </div>
    <footer>
    </footer>
</body>
</html>

<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
