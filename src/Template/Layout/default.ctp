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
                          'adminlte.min.css',
                          '/plugins/overlayScrollbars/css/OverlayScrollbars.min.css',
                          '/plugins/daterangepicker/daterangepicker.css',
                          '/plugins/summernote/summernote-bs4.min.css'
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
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
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
          <a href="#" class="d-block">Augusto Guerrero</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
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

              echo $this->Html->link(__('<i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>'),
                  array ( 'plugin' => null, 'controller' => 'empleados', 'action' => 'dashboard', '_ext' => NULL),
                  [
                      'escape' => false,
                      'class'=>'nav-link active'
                  ]
              );

              echo $this->Html->link(__('<i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Asignacion OTs
                  </p>'),
                  array ( 'plugin' => null, 'controller' => 'ordenesdetrabajos', 'action' => 'asignacion', '_ext' => NULL),
                  [
                      'escape' => false,
                      'class'=>'nav-link'
                  ]
              );

              echo $this->Html->link(__('<i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Ordenes de Pedido
                  </p>'),
                  array ( 'plugin' => null, 'controller' => 'ordenesdepedidos', 'action' => 'index', '_ext' => NULL),
                  [
                      'escape' => false,
                      'class'=>'nav-link'
                  ]
              );

              echo $this->Html->link(__('<i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Clientes
                  </p>'),
                  array ( 'plugin' => null, 'controller' => 'Clientes', 'action' => 'index', '_ext' => NULL),
                  [
                      'escape' => false,
                      'class'=>'nav-link'
                  ]
              );

              echo $this->Html->link(__('<i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Empleados
                  </p>'),
                  array ( 'plugin' => null, 'controller' => 'Empleados', 'action' => 'index', '_ext' => NULL),
                  [
                      'escape' => false,
                      'class'=>'nav-link'
                  ]
              );

              echo $this->Html->link(__('<i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Extrusoras
                  </p>'),
                  array ( 'plugin' => null, 'controller' => 'Extrusoras', 'action' => 'asignacion', '_ext' => NULL),
                  [
                      'escape' => false,
                      'class'=>'nav-link'
                  ]
              );

              echo $this->Html->link(__('<i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Impresoras
                  </p>'),
                  array ( 'plugin' => null, 'controller' => 'Impresoras', 'action' => 'asignacion', '_ext' => NULL),
                  [
                      'escape' => false,
                      'class'=>'nav-link'
                  ]
              );

              echo $this->Html->link(__('<i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Cortadoras
                  </p>'),
                  array ( 'plugin' => null, 'controller' => 'Cortadoras', 'action' => 'index', '_ext' => NULL),
                  [
                      'escape' => false,
                      'class'=>'nav-link'
                  ]
              );
             ?>
           </li>
         </ul>

              </div>

      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
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
