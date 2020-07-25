
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Empleado[]|\Cake\Collection\CollectionInterface $empleados
 */
echo $this->Html->script('empleados/dashboard',array('inline'=>false));

?>
<div class="empleados index large-9 medium-8 columns content">
    <div class="row">
	 	<?php foreach ($extrusoras as $extrusora): ?>
     	<div class="col-lg-4" onclick="loadOTExtrusora(<?= $extrusora->id?>)">
            <div class="card" style="width: 100%">
              <?= $this->Html->image('prod-1.jpg',["class"=>"card-img-top",'alt' => 'CakePHP','style'=>'width:150px;height:150px;']); ?>
              <div class="card-body">
                <h5 class="card-title"><?= $extrusora->nombre?></h5>
                <p class="card-text">Estado: <?= count($extrusora->ordenot)>0?$extrusora->ordenot->first()->numero:'sin trabajo'?></p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
            </div>
            
 		</div>  
        <?php endforeach; ?>
    </div>  
    <div class="row">
	 	<?php foreach ($impresoras as $impresora): ?>
     	<div class="col-lg-6" onclick="loadOTImpresora(<?= $impresora->id?>)">
     		 <div class="card" style="width: 100%">
              <?= $this->Html->image('prod-1.jpg',["class"=>"card-img-top",'alt' => 'CakePHP','style'=>'width:150px;height:150px;']); ?>
              <div class="card-body">
                <h5 class="card-title"><?= $impresora->nombre?></h5>
                <p class="card-text">Estado: <?= count($impresora->ordenot)>0?$impresora->ordenot->first()->numero:'sin trabajo'?></p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
            </div>
 		</div>  
        <?php endforeach; ?>
    </div>  
    <div class="row">
	 	<?php foreach ($cortadoras as $cortadora): ?>
     	<div class="col" onclick="loadOTCortadora(<?= $cortadora->id?>)">
     		 <div class="card" style="width: 100%">
              <?= $this->Html->image('prod-1.jpg',["class"=>"card-img-top",'alt' => 'CakePHP','style'=>'width:150px;height:150px;']); ?>
              <div class="card-body">
                <h5 class="card-title"><?= $cortadora->nombre?></h5>
                <p class="card-text">Estado: <?= count($cortadora->ordenot)>0?$cortadora->ordenot->first()->numero:'sin trabajo'?></p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
            </div>
 		</div>  
        <?php endforeach; ?>
    </div>   
</div>
