<?php
  echo $this->Html->script('bobinasdeextrusions/printtickets',array('inline'=>false));
  echo $this->Form->control('bobinasdeextrusion', [
    'type'=>'hidden',
    'value'=>$bobinasdeextrusion
  ]);
 ?>
  <lablel>Cuando se imprima el ticket cierre esta ventana.</lablel>
