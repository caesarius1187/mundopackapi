<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Bobinasdecortes Controller
 *
 * @property \App\Model\Table\BobinasdecortesTable $Bobinasdecortes
 *
 * @method \App\Model\Entity\Bobinasdecorte[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BobinasdecortesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Empleados', 'Impresoras'],
        ];
        $bobinasdecortes = $this->paginate($this->Bobinasdecortes);

        $this->set(compact('bobinasdecortes'));
    }

    /**
     * View method
     *
     * @param string|null $id Bobinasdecorte id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bobinasdecorte = $this->Bobinasdecortes->get($id, [
            'contain' => ['Empleados', 'Impresoras', 'Bobinascorteorigens'],
        ]);

        $this->set('bobinasdecorte', $bobinasdecorte);
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
        $this->loadModel('Cortadoras');
        $this->loadModel('Bobinascorteorigens');
        $respuesta=[];
        $respuesta['respuesta'] = '';
        $respuesta['error'] = 0;
        $bobinasdecorte = $this->Bobinasdecortes->newEntity();
        $bobinasdecorte = $this->Bobinasdecortes->patchEntity($bobinasdecorte, $this->request->getData());
        //antes que nada vamos a consultar si puedo cargar una bobina de estrusion 
        //aextrusar>estrusadas
        $ordenesdetrabajo = $this->Ordenesdetrabajos->get($bobinasdecorte->ordenesdetrabajo_id, [
            'contain' => [
            ],
        ]);
        if($ordenesdetrabajo->aextrusar==$ordenesdetrabajo->cortadas){
            //ya no se pueden agregar bobinas
            //las bobinas de corte se van a incrementar con las bobinas origens asi usamos todas las bobinas ya cortadas
            $respuesta['respuesta'] = 'Ya se cargaron todas las bobinas de corte que se necesitaban('.$ordenesdetrabajo->aextrusar.') para esta Orden de Trabajo';
            $respuesta['error'] = 1;
             $this->set([
                'respuesta' => $respuesta,
                '_serialize' => ['respuesta']
            ]);
            return;
        }

        date_default_timezone_set('America/Argentina/Salta');
        $bobinasdecorte->fecha = date('Y-m-d H:i:s');
        $respuesta['bobinasdecorte0'] = $bobinasdecorte;        
        //vamos a cargar el numero de la bobina dinamicamente
        $maxBobinaNumero = 0;
        $bobinaNumeroMax = $this->Bobinasdecortes->find('all',[
            'conditions'=>[    
                'Bobinasdecortes.ordenesdetrabajo_id'=>$bobinasdecorte->ordenesdetrabajo_id
            ],
            'fields' => array('maxprioridad' => 'MAX(Bobinasdecortes.numero)'),
        ]); 
        foreach ($bobinaNumeroMax as $key => $value) {
            $maxBobinaNumero = $value->maxprioridad;
        }
        $bobinasdecorte->numero = $maxBobinaNumero+1;
        if ($this->Bobinasdecortes->save($bobinasdecorte)) {
            $respuesta['respuesta'] = 'La bobina de corte fue guardada.';
            $respuesta['bobinasdecorte'] = $bobinasdecorte;
            $respuesta['request'] = $this->request->getData();
            $respuesta['error'] = 0;
            $OPerrors = $bobinasdecorte->errors();
            $respuesta['errors'] = $OPerrors;
            //vamos a agregar el empleado para que podamos mostrar el nombre
            $empleados = $this->Empleados->findById($bobinasdecorte->empleado_id);
            $respuesta['empleado'] = $empleados->first();
            $cortadora = $this->Cortadoras->findById($bobinasdecorte->cortadora_id);
            $respuesta['cortadora'] = $cortadora->first();
            
            //vamos a sumar 1 en las bobinas cortadora de la orden de trabajo
            //TODO: pero vamos a sumar 1 por cada bobinascorteorigens
            $cantCortadas = 0;
            if(isset($this->request->getData()['bobinasdeextrusion_id'])){
                $bobinasDeExtrusionCortadas = $this->request->getData()['bobinasdeextrusion_id'];
                foreach ($bobinasDeExtrusionCortadas as $key => $bobinaextrusioncortada) {
                    $bobinacorteorigen = $this->Bobinascorteorigens->newEntity();
                    $bobinacorteorigen->bobinasdecorte_id = $bobinasdecorte->id;
                    $bobinacorteorigen->bobinasdeextrusion_id = $bobinaextrusioncortada;
                    $this->Bobinascorteorigens->save($bobinacorteorigen);
                    $cantCortadas++;
                }
            }
            if(isset($this->request->getData()['bobinasdeimpresion_id'])){
                $bobinasDeImpresionCortadas = $this->request->getData()['bobinasdeimpresion_id'];
                foreach ($bobinasDeImpresionCortadas as $key => $bobinaimpresioncortada) {
                    $bobinacorteorigen = $this->Bobinascorteorigens->newEntity();
                    $bobinacorteorigen->bobinasdecorte_id = $bobinasdecorte->id;
                    $bobinacorteorigen->bobinasdeimpresion_id = $bobinaimpresioncortada;
                    $this->Bobinascorteorigens->save($bobinacorteorigen);
                    $cantCortadas++;
                }
            }
            $respuesta['bobinasorigens'] = $this->Bobinascorteorigens->find('all',[
                'contain'=>['Bobinasdeimpresions','Bobinasdeextrusions'],
                'conditions'=>['Bobinascorteorigens.bobinasdecorte_id'=>$bobinacorteorigen->bobinasdecorte_id]
            ]);

            $ordenesdetrabajo->cortadas = $ordenesdetrabajo->cortadas+$cantCortadas ;

            if ($this->Ordenesdetrabajos->save($ordenesdetrabajo)) {
                $respuesta['respuesta'] .= "Se actualizo las bobinas estrusadas de la orden de pedido.";
            }else{
                $respuesta['error'] = 2;
                $respuesta['respuesta'] .= "No se pudo actualizar las bobinas estrusadas de la orden de pedido.";
            }
            //Si las extrusadas = aetxrusar entonces tengo que sacarla de las prioridades de las Extrusoras
            //no vamos a hacer esto ya por que cambio el sistema de prioridades y se ajusta por fecha
            /*if($ordenesdetrabajo->cortadas==$ordenesdetrabajo->aextrusar){
                //buscamos las OrdenOts de la OT que debemos eliminar
                 $conditionsOrdenOts=[
                    'conditions'=>[
                        'Ordenots.cortadora_id <> 0',
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
        }else{
            $respuesta['respuesta'] = 'Error. La orden de pedido NO fue guardada. Intente de nuevo mas tarde';
            $respuesta['error'] = 1;
            $OPerrors = $bobinasdecorte->errors();
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
     * @param string|null $id Bobinasdecorte id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bobinasdecorte = $this->Bobinasdecortes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bobinasdecorte = $this->Bobinasdecortes->patchEntity($bobinasdecorte, $this->request->getData());
            if ($this->Bobinasdecortes->save($bobinasdecorte)) {
                $this->Flash->success(__('The bobinasdecorte has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bobinasdecorte could not be saved. Please, try again.'));
        }
        $empleados = $this->Bobinasdecortes->Empleados->find('list', ['limit' => 200]);
        $impresoras = $this->Bobinasdecortes->Impresoras->find('list', ['limit' => 200]);
        $this->set(compact('bobinasdecorte', 'empleados', 'impresoras'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Bobinasdecorte id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bobinasdecorte = $this->Bobinasdecortes->get($id);
        if ($this->Bobinasdecortes->delete($bobinasdecorte)) {
            $this->Flash->success(__('The bobinasdecorte has been deleted.'));
        } else {
            $this->Flash->error(__('The bobinasdecorte could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
