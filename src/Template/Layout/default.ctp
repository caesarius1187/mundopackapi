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

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>
    <!-- Bootstrap core CSS -->
    <?= $this->Html->css('bootstrap/bootstrap.min.css') ?>
    <!-- Custom styles for this template -->
    <?= $this->Html->css('simple-sidebar.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <!DOCTYPE html>
<html lang="en">

    <head>

      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">

      <title>Simple Sidebar - Start Bootstrap Template</title>

    </head>

    <body>

      <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="sidebar-heading">Mundo Pack<?php //$this->fetch('title') ?></div>
            <div class="list-group list-group-flush">
                <?php
                echo $this->Html->link(__('Dashboard'), 
                    array ( 'plugin' => null, 'controller' => 'empleados', 'action' => 'dashboard', '_ext' => NULL),
                    [
                        'class'=>'list-group-item list-group-item-action bg-light'
                    ] 
                );   
                echo $this->Html->link(__("Asignacion OT's"), 
                    array ( 'plugin' => null, 'controller' => 'ordenesdetrabajos', 'action' => 'asignacion', '_ext' => NULL),
                    [
                        'class'=>'list-group-item list-group-item-action bg-light'
                    ] 
                );    
                echo $this->Html->link(__('O. Pedidos'), 
                    array ( 'plugin' => null, 'controller' => 'Ordenesdepedidos', 'action' => 'index', '_ext' => NULL),
                    [
                        'class'=>'list-group-item list-group-item-action bg-light'
                    ] 
                );  
                echo $this->Html->link(__('Clientes'), 
                    array ( 'plugin' => null, 'controller' => 'Clientes', 'action' => 'index', '_ext' => NULL),
                    [
                        'class'=>'list-group-item list-group-item-action bg-light'
                    ] 
                );    
                echo $this->Html->link(__('Empleados'), 
                    array ( 'plugin' => null, 'controller' => 'Empleados', 'action' => 'index', '_ext' => NULL),
                    [
                        'class'=>'list-group-item list-group-item-action bg-light'
                    ] 
                );  
                echo $this->Html->link(__('Extrusoras'), 
                    array ( 'plugin' => null, 'controller' => 'Extrusoras', 'action' => 'index', '_ext' => NULL),
                    [
                        'class'=>'list-group-item list-group-item-action bg-light'
                    ] 
                );  
                echo $this->Html->link(__('Impresoras'), 
                    array ( 'plugin' => null, 'controller' => 'Impresoras', 'action' => 'index', '_ext' => NULL),
                    [
                        'class'=>'list-group-item list-group-item-action bg-light'
                    ] 
                );  
                echo $this->Html->link(__('Cortadoras'), 
                    array ( 'plugin' => null, 'controller' => 'Cortadoras', 'action' => 'index', '_ext' => NULL),
                    [
                        'class'=>'list-group-item list-group-item-action bg-light'
                    ] 
                );  
                ?>              
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

          <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                  <a class="nav-link" href="#">Menu</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link">
                    <?php
                    $session = $this->request->getSession(); // less than 3.5
                    // $session = $this->request->getSession(); // 3.5 or more
                    $user_data = $session->read('Auth.User');
                    if(!empty($user_data)){
                        ?>
                        <p><?php
                        echo $user_data['first_name']." ".$user_data['last_name'];
                        ?></p>
                        <?php
                    }else{
                        echo "Iniciar sesion";
                    }   
                    ?>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <?php
                        if(!empty($user_data)){
                            echo $this->Html->link(__('Salir'), 
                                array ( 'plugin' => 'CakeDC/Users', 'controller' => 'Users', 'action' => 'logout', '_ext' =>   NULL),
                                [
                                    'class'=>'dropdown-item'
                                ] 
                            );                  
                        }else{
                            echo $this->Html->link(__('Iniciar'), 
                                        array ( 'plugin' => 'CakeDC/Users', 'controller' => 'Users', 'action' => 'login', '   _ext' => NULL ),
                                        [
                                            'class'=>'dropdown-item'
                                        ] 
                                    );
                        }   
                        ?>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
              </ul>
            </div>
          </nav>

          <div class="container-fluid">
            <?= $this->fetch('content') ?>
          </div>
        </div>
        <!-- /#page-content-wrapper -->

      </div>
        <!-- /#wrapper -->

        <!-- Bootstrap core JavaScript -->
        <?php
        echo $this->Html->script('jquery/jquery.min.js' );
        echo $this->Html->script('bootstrap/bootstrap.bundle.min.js');
        ?>

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
