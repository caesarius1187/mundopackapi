
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
     	<div class="col" onclick="loadOTExtrusora(<?= $extrusora->id?>)">
     		<label><?= $extrusora->nombre?></label>
     		<label>Estado: <?= count($extrusora->ordenot)>0?$extrusora->ordenot->first()->numero:'sin trabajo'?></label>
 		</div>  
        <?php endforeach; ?>
    </div>  
    <div class="row">
	 	<?php foreach ($impresoras as $impresora): ?>
     	<div class="col" onclick="loadOTImpresora(<?= $impresora->id?>)">
     		<label><?= $impresora->nombre?></label>
     		<label>Estado: <?= count($impresora->ordenot)>0?$impresora->ordenot->first()->numero:'sin trabajo'?></label>
 		</div>  
        <?php endforeach; ?>
    </div>  
    <div class="row">
	 	<?php foreach ($cortadoras as $cortadora): ?>
     	<div class="col" onclick="loadOTCortadora(<?= $cortadora->id?>)">
     		<label><?= $cortadora->nombre?></label>
     		<label>Estado: <?= count($cortadora->ordenot)>0?$cortadora->ordenot->first()->numero:'sin trabajo'?></label>
 		</div>  
        <?php endforeach; ?>
    </div>   
</div>
