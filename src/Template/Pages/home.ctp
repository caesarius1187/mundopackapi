<?php
/**
 * Copyright 2010 - 2017, Cake Development Corporation (https://www.cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2017, Cake Development Corporation (https://www.cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

use Cake\Core\Configure;

?>

<?php
/**
 * Copyright 2010 - 2017, Cake Development Corporation (https://www.cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2017, Cake Development Corporation (https://www.cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
$this->layout= '';
?>
<!DOCTYPE html>
<html>
    <head>
        <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            MP - Ingreso
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

    <body class="hold-transition login-page">
    <div class="login-box">
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <img src="img/logo-mundopack-fabrica.png" alt="Logo MP">
            <div class="users form">
                <fieldset>
                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col-8">
                          <div class="icheck-primary">
                            <?php                          
                            echo $this->Html->link('<span class="">Iniciar sesión</span>', [
                                'controller' => 'login'
                              ], [
                                'escape' => false,
                                'class' => "btn btn-primary btn-block",
                                "data-slide"=>true,
                                "role"=>"button",
                              ]); 
                            ?>
                          </div>
                        </div>
                        <div class="col-2"></div>
                        
                        <!-- /.col -->
                    </div>
                    
                </fieldset>               
            </div>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->

        <!--BACKSTRETCH-->
        <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
        <script type="text/javascript" src="js/jquery.backstretch.min.js"></script>
        <script>
          $.backstretch("img/login-bg.jpg", {
            speed: 500
          });
        </script>
    </body>
</html>

