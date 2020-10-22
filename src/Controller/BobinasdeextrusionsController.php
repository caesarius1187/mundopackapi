<?php
namespace App\Controller;

use App\Controller\AppController;
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

/**
 * Bobinasdeextrusions Controller
 *
 * @property \App\Model\Table\BobinasdeextrusionsTable $Bobinasdeextrusions
 *
 * @method \App\Model\Entity\Bobinasdeextrusion[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BobinasdeextrusionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function printticket($id = null){
      $bobinasdeextrusion = $this->Bobinasdeextrusions->get($id, [
          'contain' => [
            'Empleados',
            'Extrusoras',
            'Bobinascorteorigens',
            'Bobinasdeimpresions',
            'Ordenesdetrabajos' => ['Ordenesdepedidos'=>'Clientes']
          ],
      ]);
      require_once(ROOT . DS . 'vendor' .  DS . "autoload.php");
      $nombre_impresora = "Ticketera";
      $connector = new WindowsPrintConnector($nombre_impresora);
      $printer = new Printer($connector);
      $printer->setJustification(Printer::JUSTIFY_CENTER);
      try{
      	$logo = EscposImage::load("img\bobina.png", false);
       $printer->bitImage($logo);
      }catch(Exception $e){/*No hacemos nada si hay error*/}
      date_default_timezone_set("America/Argentina/Salta");
      $printer->feed(1);
      $printer->text(date("Y-m-d H:i:s") . "\n");
      $printer->feed(2);
      $printer -> selectPrintMode(Printer::MODE_EMPHASIZED);
      $printer -> text("CLIENTE: ");
      $printer -> selectPrintMode(Printer::MODE_FONT_B);
      $printer -> text($bobinasdeextrusion->ordenesdetrabajo->ordenesdepedido->cliente->nombre."\n");
      $printer -> selectPrintMode(Printer::MODE_EMPHASIZED);
      $printer -> text("FECHA: ");
      $printer -> selectPrintMode(Printer::MODE_FONT_B);
      $printer -> text($bobinasdeextrusion->fecha."\n");
      $printer -> selectPrintMode(Printer::MODE_EMPHASIZED);
      $printer -> text("O.T. N°: ");
      $printer -> selectPrintMode(Printer::MODE_FONT_B);
      $printer -> text("P".$bobinasdeextrusion->ordenesdetrabajo->ordenesdepedido->numero." - ".$bobinasdeextrusion->ordenesdetrabajo->numero."\n");
      $printer -> selectPrintMode(Printer::MODE_EMPHASIZED);
      $printer -> text("Máquina N°: ");
      $printer -> selectPrintMode(Printer::MODE_FONT_B);
      $printer -> text($bobinasdeextrusion->numero."\n");
      $printer -> selectPrintMode(Printer::MODE_EMPHASIZED);
      $printer -> text("Medida: ");
      $printer -> selectPrintMode(Printer::MODE_FONT_B);
      $printer -> text($bobinasdeextrusion->ordenesdetrabajo->medida."\n");
      $printer -> selectPrintMode(Printer::MODE_EMPHASIZED);
      $printer -> text("Bobina: ");
      $printer -> selectPrintMode(Printer::MODE_FONT_B);
      $printer -> text($bobinasdeextrusion->numero."\n");
      $printer -> selectPrintMode(Printer::MODE_EMPHASIZED);
      $printer -> text("Kilogramos: ");
      $printer -> selectPrintMode(Printer::MODE_FONT_B);
      $printer -> text($bobinasdeextrusion->kilogramos."\n");
      $printer->feed(2);
      $printer -> cut();
      $printer -> close();
      $respuesta = 'imprimi';
      $this->set([
         'respuesta' => $respuesta,
         '_serialize' => ['respuesta']
      ]);
    }
    public function index()
    {
        $this->paginate = [
            'contain' => ['Empleados', 'Extrusoras'],
        ];
        $bobinasdeextrusions = $this->paginate($this->Bobinasdeextrusions);

        $this->set(compact('bobinasdeextrusions'));
    }

    public function getlist($ordenesdetrabajoId)
    {
        $this->loadModel('Bobinasdeimpresions');
        $this->loadModel('Bobinasdecortes');
        //tenemos que buscar las bobinas de extrusion que ya se usaron en las impresiones y excluirlas
        $bobinasdeimpresions  = $this->Bobinasdeimpresions->find('all', [
            'conditions'=>[
                'Bobinasdeimpresions.ordenesdetrabajo_id'=>$ordenesdetrabajoId
            ],
            'limit' => 200
        ]);
        $bobinasdeextrusionYaUsadas = [];
        $bobinasdeextrusionYaUsadas[0] = 0;
        foreach ($bobinasdeimpresions as $key => $bobinasdeimpresion) {
            $bobinasdeextrusionYaUsadas[] = $bobinasdeimpresion->bobinasdeextrusion_id;
        }        
        $bobinasyausadasenimpresion=$bobinasdeextrusionYaUsadas;
        //tenemos que buscar las bobinas de extrusion que ya se usaron en las cortes y excluirlas
        $bobinasdecortes  = $this->Bobinasdecortes->find('all', [
            'contain'=>[
                'Bobinascorteorigens',
            ],
            'conditions'=>[
                'Bobinasdecortes.ordenesdetrabajo_id'=>$ordenesdetrabajoId
            ],
            'limit' => 200
        ]);
        foreach ($bobinasdecortes as $key => $bobinasdecorte) {
            foreach ($bobinasdecorte['bobinascorteorigens'] as $key => $corteorigen) {
              if($corteorigen->bobinasdeextrusion_id){
                $bobinasdeextrusionYaUsadas[] = $corteorigen->bobinasdeextrusion_id;
              }
            }
        }
        $bobinasdeextrusionsConditions=[
            'conditions'=>[
                'Bobinasdeextrusions.id NOT IN'=>$bobinasdeextrusionYaUsadas,
                'Bobinasdeextrusions.ordenesdetrabajo_id'=>$ordenesdetrabajoId
            ],
            'limit' => 200
        ];
        $bobinasdeextrusions = $this->Bobinasdeextrusions->find('list',$bobinasdeextrusionsConditions );
        $respuesta['data'] = $bobinasdeextrusions;
        $respuesta['error'] = 0;
        $this->set([
            'bobinasdeextrusionsConditions' => $bobinasdeextrusionsConditions,
            'respuesta' => $respuesta,
            'bobinasdeextrusions' => $bobinasdeextrusions,
            '_serialize' => ['respuesta','bobinasdeextrusions','bobinasdeextrusionsConditions']
        ]);
    }

    public function getparciales($ordenesdetrabajoId)
    {
        $this->loadModel('Bobinasdeimpresions');
        $this->loadModel('Bobinasdecortes');
        //tenemos que buscar las bobinas de extrusion que ya se usaron en las impresiones y excluirlas
        $bobinasdeextrusionsparciales  = $this->Bobinasdeextrusions->find('list', [
            'conditions'=>[
                'Bobinasdeextrusions.ordenesdetrabajo_id'=>$ordenesdetrabajoId,
                'Bobinasdeextrusions.terminacion'=>'Parcial'
            ],
            'limit' => 200
        ]);
        $respuesta['data'] = $bobinasdeextrusionsparciales;
        $respuesta['error'] = 0;
        $this->set([
            'respuesta' => $respuesta,
            '_serialize' => ['respuesta','bobinasdeextrusionsparciales']
        ]);
    }
    /**
     * View method
     *
     * @param string|null $id Bobinasdeextrusion id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bobinasdeextrusion = $this->Bobinasdeextrusions->get($id, [
            'contain' => ['Empleados', 'Extrusoras', 'Bobinascorteorigens', 'Bobinasdeimpresions'],
        ]);

        $this->set('bobinasdeextrusion', $bobinasdeextrusion);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add(){
        $this->loadModel('Empleados');
        $this->loadModel('Ordenesdetrabajos');
        $this->loadModel('Ordenots');
        $this->loadModel('Extrusoras');
        $respuesta=[];
        $respuesta['respuesta'] = '';
        $respuesta['error'] = 0;
        $bobinasdeextrusion = $this->Bobinasdeextrusions->newEntity();
        $bobinasdeextrusion = $this->Bobinasdeextrusions->patchEntity($bobinasdeextrusion, $this->request->getData());
        //antes que nada vamos a consultar si puedo cargar una bobina de estrusion
        //aextrusar>estrusadas
        $ordenesdetrabajo = $this->Ordenesdetrabajos->get($bobinasdeextrusion->ordenesdetrabajo_id, [
            'contain' => [
            ],
        ]);
        //se permitiran cargar las bobinas parciales sin sumar ni afectar esto
        if($ordenesdetrabajo->aextrusar==$ordenesdetrabajo->extrusadas && $bobinasdeextrusion->terminacion!='Parcial'){
            //ya no se pueden agregar bobinas
            $respuesta['respuesta'] = 'Ya se cargaron todas las bobinas de estrusion que se necesitaban('.$ordenesdetrabajo->aextrusar.') para esta Orden de Trabajo';
            $respuesta['error'] = 1;
             $this->set([
                'respuesta' => $respuesta,
                '_serialize' => ['respuesta']
            ]);
            return;
        }
        date_default_timezone_set('America/Argentina/Salta');
        $bobinasdeextrusion->fecha = date('Y-m-d H:i:s');
        $respuesta['bobinasdeextrusion0'] = $bobinasdeextrusion;
        //vamos a cargar el numero de la bobina dinamicamente
        $maxBobinaNumero = 0;
        $bobinaNumeroMax = $this->Bobinasdeextrusions->find('all',[
            'conditions'=>[
                'Bobinasdeextrusions.ordenesdetrabajo_id'=>$bobinasdeextrusion->ordenesdetrabajo_id
            ],
            'fields' => array('maxprioridad' => 'MAX(Bobinasdeextrusions.numero)'),
        ]);
        foreach ($bobinaNumeroMax as $key => $value) {
            $maxBobinaNumero = $value->maxprioridad;
        }
        $bobinasdeextrusion->numero = $maxBobinaNumero+1;

        if ($this->Bobinasdeextrusions->save($bobinasdeextrusion)) {
            $respuesta['respuesta'] = 'La bobina de estrusion fue guardada.';
            $respuesta['bobinasdeextrusion'] = $bobinasdeextrusion;
            $respuesta['request'] = $this->request->getData();
            $respuesta['error'] = 0;
            $OPerrors = $bobinasdeextrusion->errors();
            $respuesta['errors'] = $OPerrors;
            //vamos a agregar el empleado para que podamos mostrar el nombre
            $empleados = $this->Empleados->findById($bobinasdeextrusion->empleado_id);
            $respuesta['empleado'] = $empleados->first();
            $extrusoras = $this->Extrusoras->findById($bobinasdeextrusion->extrusora_id);
            $respuesta['extrusora'] = $extrusoras->first();
            //vamos a sumar 1 en las bobinas extrusoras de la orden de trabajo

            //actualizaremos la orden de trabajo solo si no es parcial
            if($bobinasdeextrusion->terminacion!='Parcial'){
              $ordenesdetrabajo->extrusadas = $ordenesdetrabajo->extrusadas+1 ;
              if ($this->Ordenesdetrabajos->save($ordenesdetrabajo)) {
                  $respuesta['respuesta'] .= "Se actualizo las bobinas estrusadas de la orden de pedido.";
              }else{
                  $respuesta['error'] = 2;
                  $respuesta['respuesta'] .= "No se pudo actualizar las bobinas estrusadas de la orden de pedido.";
              }
              //Si las extrusadas = aetxrusar entonces tengo que sacarla de las prioridades de las Extrusoras
              //no vamos a hacer esto ya por que cambio el sistema de prioridades y se ajusta por fecha
              /*if($ordenesdetrabajo->extrusadas==$ordenesdetrabajo->aextrusar){
                  //buscamos las OrdenOts de la OT que debemos eliminar
                   $conditionsOrdenOts=[
                      'conditions'=>[
                          'Ordenots.extrusora_id <> 0',
                          'Ordenots.ordenesdetrabajo_id'=>$ordenesdetrabajo->id,
                      ]
                  ];
                  $myOrderOtsTosDelete = $this->Ordenots->find('all',$conditionsOrdenOts);
                  $respuesta['myOrderOtsTosDelete'] = $myOrderOtsTosDelete;
                  foreach ($myOrderOtsTosDelete as $key => $myOrderOtToDelete) {
                      //ahora borramos la OT y actualizamos las que le siguen
                      //vamos a reducir en 1 las ordenes posteriores
                      $newPrioridad = $myOrderOtToDelete->prioridad;
                      //subimos a la que estaba abajo
                      $conditionsOrdenOtsToUpdate=[
                          'conditions'=>[
                              'Ordenots.extrusora_id'=>$myOrderOtToDelete->extrusora_id,
                              'Ordenots.impresora_id'=>$myOrderOtToDelete->impresora_id,
                              'Ordenots.cortadora_id'=>$myOrderOtToDelete->cortadora_id,
                              'Ordenots.prioridad >='=>$newPrioridad
                          ]
                      ];
                      $myOrderOtsToUpdate = $this->Ordenots->find('all',$conditionsOrdenOtsToUpdate);
                      $respuesta['myOrderOtsToUpdate'] = $myOrderOtsToUpdate;
                      foreach ($myOrderOtsToUpdate as $key => $myOrderOtToUpdate) {
                          $secOrdenot = $this->Ordenots->get($myOrderOtToUpdate->id , [
                              'contain' => [
                              ],
                          ]);
                          $secOrdenot->prioridad = $secOrdenot->prioridad - 1 ;
                          if ($this->Ordenots->save($secOrdenot)) {
                              $subiOrden=true;
                          }else{
                              $respuesta['error'] = 1;
                              $respuesta['respuesta'] .= "No se pudo cambiar la prioridad de las ordenes posteriories.";
                          }
                      }

                      if ($this->Ordenots->delete($myOrderOtToDelete)) {

                      } else {
                          $respuesta['error'] =2 ;
                          $respuesta['respuesta'] .= "No se pudo eliminar la prioridad seleccionada.";
                      }
                  }
              }*/
            }
            
        }else{
            $respuesta['respuesta'] = 'Error. La orden de pedido NO fue guardada. Intente de nuevo mas tarde';
            $respuesta['error'] = 1;
            $OPerrors = $bobinasdeextrusion->errors();
            $respuesta['errors'] = $OPerrors;
        }
        $this->set([
            'respuesta' => $respuesta,
            '_serialize' => ['respuesta']
        ]);

    }

    /**
     * Edit method
     *
     * @param string|null $id Bobinasdeextrusion id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bobinasdeextrusion = $this->Bobinasdeextrusions->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bobinasdeextrusion = $this->Bobinasdeextrusions->patchEntity($bobinasdeextrusion, $this->request->getData());
            if ($this->Bobinasdeextrusions->save($bobinasdeextrusion)) {
                $this->Flash->success(__('The bobinasdeextrusion has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bobinasdeextrusion could not be saved. Please, try again.'));
        }
        $empleados = $this->Bobinasdeextrusions->Empleados->find('list', ['limit' => 200]);
        $extrusoras = $this->Bobinasdeextrusions->Extrusoras->find('list', ['limit' => 200]);
        $this->set(compact('bobinasdeextrusion', 'empleados', 'extrusoras'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Bobinasdeextrusion id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bobinasdeextrusion = $this->Bobinasdeextrusions->get($id);
        if ($this->Bobinasdeextrusions->delete($bobinasdeextrusion)) {
            $this->Flash->success(__('The bobinasdeextrusion has been deleted.'));
        } else {
            $this->Flash->error(__('The bobinasdeextrusion could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
