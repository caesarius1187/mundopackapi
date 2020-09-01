<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Bobinasdeimpresions Controller
 *
 * @property \App\Model\Table\BobinasdeimpresionsTable $Bobinasdeimpresions
 *
 * @method \App\Model\Entity\Bobinasdeimpresion[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BobinasdeimpresionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Empleados', 'Cortadoras', 'Bobinasdeextrusions'],
        ];
        $bobinasdeimpresions = $this->paginate($this->Bobinasdeimpresions);

        $this->set(compact('bobinasdeimpresions'));
    }
     public function getlist($ordenesdetrabajoId)
    {
        $this->loadModel('Bobinasdecortes');
        //tenemos que buscar las bobinas de impresions que ya se usaron en las cortes y excluirlas
        $bobinasdecortes  = $this->Bobinasdecortes->find('all', [
            'contain'=>[
                'Bobinascorteorigens',
            ],
            'conditions'=>[
                'Bobinasdecortes.ordenesdetrabajo_id'=>$ordenesdetrabajoId
            ],
            'limit' => 200
        ]);
        $bobinasdeimpresionYaUsadas = [];
        $bobinasdeimpresionYaUsadas[0] = 0;
        foreach ($bobinasdecortes as $key => $bobinasdecorte) {
            foreach ($bobinasdecorte['bobinascorteorigens'] as $key => $corteorigen) {
                $bobinasdeextrusionYaUsadas[] = $corteorigen->bobinasdeimpresion_id;
            }
        }

        $bobinasdeimpresions = $this->Bobinasdeimpresions->find('list', [
            'conditions'=>[
                'Bobinasdeimpresions.id NOT IN'=>$bobinasdeimpresionYaUsadas,
                'Bobinasdeimpresions.ordenesdetrabajo_id'=>$ordenesdetrabajoId
            ],
            'limit' => 200
        ]);
        $respuesta['data'] = $bobinasdeimpresions;
        $respuesta['error'] = 0;
        $this->set([
            'respuesta' => $respuesta,
            'bobinasdeimpresions' => $bobinasdeimpresions,
            '_serialize' => ['respuesta','bobinasdeimpresions']
        ]);
    }
    /**
     * View method
     *
     * @param string|null $id Bobinasdeimpresion id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bobinasdeimpresion = $this->Bobinasdeimpresions->get($id, [
            'contain' => ['Empleados', 'Cortadoras', 'Bobinasdeextrusions', 'Bobinascorteorigens'],
        ]);

        $this->set('bobinasdeimpresion', $bobinasdeimpresion);
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
        $this->loadModel('Bobinasdeextrusions');
        $this->loadModel('Impresoras');
        $respuesta=[];
        $respuesta['respuesta'] = '';
        $respuesta['error'] = 0;
        $bobinasdeimpresion = $this->Bobinasdeimpresions->newEntity();
        $bobinasdeimpresion = $this->Bobinasdeimpresions->patchEntity($bobinasdeimpresion, $this->request->getData());
        //antes que nada vamos a consultar si puedo cargar una bobina de estrusion 
        //aextrusar>estrusadas
        $ordenesdetrabajo = $this->Ordenesdetrabajos->get($bobinasdeimpresion->ordenesdetrabajo_id, [
            'contain' => [
            ],
        ]);
        if($ordenesdetrabajo->aextrusar==$ordenesdetrabajo->impresas){
            //ya no se pueden agregar bobinas
            $respuesta['respuesta'] = 'Ya se cargaron todas las bobinas de impresion que se necesitaban('.$ordenesdetrabajo->aextrusar.') para esta Orden de Trabajo';
            $respuesta['error'] = 1;
             $this->set([
                'respuesta' => $respuesta,
                '_serialize' => ['respuesta']
            ]);
            return;
        }

        $fecha = $this->request->getData()['fecha'];
        $fechaconsultadesde = date('Y-m-d',strtotime($fecha));
        $respuesta['bobinasdeimpresion0'] = $bobinasdeimpresion;        
        $bobinasdeimpresion->fecha = $fechaconsultadesde;
        //vamos a cargar el numero de la bobina dinamicamente
        $maxBobinaNumero = 0;
        $bobinaNumeroMax = $this->Bobinasdeimpresions->find('all',[
            'conditions'=>[    
                'Bobinasdeimpresions.ordenesdetrabajo_id'=>$bobinasdeimpresion->ordenesdetrabajo_id
            ],
            'fields' => array('maxprioridad' => 'MAX(Bobinasdeimpresions.numero)'),
        ]); 
        foreach ($bobinaNumeroMax as $key => $value) {
            $maxBobinaNumero = $value->maxprioridad;
        }
        $bobinasdeimpresion->numero = $maxBobinaNumero+1;

        if ($this->Bobinasdeimpresions->save($bobinasdeimpresion)) {
            $respuesta['respuesta'] = 'La bobina de estrusion fue guardada.';
            $respuesta['bobinasdeimpresion'] = $bobinasdeimpresion;
            $respuesta['request'] = $this->request->getData();
            $respuesta['error'] = 0;
            $OPerrors = $bobinasdeimpresion->errors();
            $respuesta['errors'] = $OPerrors;
            //vamos a agregar el empleado para que podamos mostrar el nombre
            $empleados = $this->Empleados->findById($bobinasdeimpresion->empleado_id);
            $respuesta['empleado'] = $empleados->first();
            $bobinasdeextrusion = $this->Bobinasdeextrusions->findById($bobinasdeimpresion->bobinasdeextrusion_id);
            $respuesta['bobinasdeextrusion'] = $bobinasdeextrusion->first();
            $impresoras = $this->Impresoras->findById($bobinasdeimpresion->impresora_id);
            $respuesta['impresora'] = $impresoras->first();
            //vamos a sumar 1 en las bobinas extrusoras de la orden de trabajo
            
            $ordenesdetrabajo->impresas = $ordenesdetrabajo->impresas+1 ;

            if ($this->Ordenesdetrabajos->save($ordenesdetrabajo)) {
                $respuesta['respuesta'] .= "Se actualizo las bobinas impresas de la orden de pedido.";
            }else{
                $respuesta['error'] = 2;
                $respuesta['respuesta'] .= "No se pudo actualizar las bobinas impresas de la orden de pedido.";
            }
            //Si las impresas = aetxrusar entonces tengo que sacarla de las prioridades de las Impresoras
            if($ordenesdetrabajo->impresas==$ordenesdetrabajo->aextrusar){
                //buscamos las OrdenOts de la OT que debemos eliminar
                 $conditionsOrdenOts=[
                    'conditions'=>[
                        'Ordenots.impresora_id <> 0',
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
            }
        }else{
            $respuesta['respuesta'] = 'Error. La orden de pedido NO fue guardada. Intente de nuevo mas tarde';
            $respuesta['error'] = 1;
            $OPerrors = $bobinasdeimpresion->errors();
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
     * @param string|null $id Bobinasdeimpresion id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bobinasdeimpresion = $this->Bobinasdeimpresions->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bobinasdeimpresion = $this->Bobinasdeimpresions->patchEntity($bobinasdeimpresion, $this->request->getData());
            if ($this->Bobinasdeimpresions->save($bobinasdeimpresion)) {
                $this->Flash->success(__('The bobinasdeimpresion has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bobinasdeimpresion could not be saved. Please, try again.'));
        }
        $empleados = $this->Bobinasdeimpresions->Empleados->find('list', ['limit' => 200]);
        $cortadoras = $this->Bobinasdeimpresions->Cortadoras->find('list', ['limit' => 200]);
        $bobinasdeextrusions = $this->Bobinasdeimpresions->Bobinasdeextrusions->find('list', ['limit' => 200]);
        $this->set(compact('bobinasdeimpresion', 'empleados', 'cortadoras', 'bobinasdeextrusions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Bobinasdeimpresion id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bobinasdeimpresion = $this->Bobinasdeimpresions->get($id);
        if ($this->Bobinasdeimpresions->delete($bobinasdeimpresion)) {
            $this->Flash->success(__('The bobinasdeimpresion has been deleted.'));
        } else {
            $this->Flash->error(__('The bobinasdeimpresion could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
