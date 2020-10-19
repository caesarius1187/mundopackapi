<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Ordenots Controller
 *
 * @property \App\Model\Table\OrdenotsTable $Ordenots
 *
 * @method \App\Model\Entity\Ordenot[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrdenotsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Extrusoras', 'Impresoras', 'Cortadoras', 'Ordenesdetrabajos'],
        ];
        $ordenots = $this->paginate($this->Ordenots);

        $this->set(compact('ordenots'));
    }

    /**
     * View method
     *
     * @param string|null $id Ordenot id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ordenot = $this->Ordenots->get($id, [
            'contain' => ['Extrusoras', 'Impresoras', 'Cortadoras', 'Ordenesdetrabajos'],
        ]);

        $this->set('ordenot', $ordenot);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ordenot = $this->Ordenots->newEntity();
        $respuesta = "";
        if($this->request->getData()['id']!=0){
            $ordenot = $this->Ordenots->get($this->request->getData()['id'], [
                'contain' => [],
            ]);
            $ordenot = $this->Ordenots->patchEntity($ordenot, $this->request->getData());
        }else{
            $ordenot = $this->Ordenots->patchEntity($ordenot, $this->request->getData());
        }
        //vamos a poner la prioridad mas alta +1
        $maxprioridad = 0;
        $orderotMax = $this->Ordenots->find('all',[
            'conditions'=>[
                'Ordenots.extrusora_id'=>$ordenot->extrusora_id,
                'Ordenots.impresora_id'=>$ordenot->impresora_id,
                'Ordenots.cortadora_id'=>$ordenot->cortadora_id
            ],
            'fields' => array('maxprioridad' => 'MAX(Ordenots.prioridad)'),
        ]); 
        foreach ($orderotMax as $key => $value) {
            $maxprioridad = $value->maxprioridad;
        }
        $ordenot->prioridad = $maxprioridad+1;
        if($ordenot->fechainicioextrusora!=''){
            $fechainicioestrusion = $ordenot->fechainicioextrusora;
            $fechainicioestrusion = date('Y-m-d',strtotime($fechainicioestrusion));
            $ordenot->fechainicioextrusora = $fechainicioestrusion;    
        }
        if($ordenot->fechainicioimpresora!=''){
            $fechainicioimpresora = $ordenot->fechainicioimpresora;
            $fechainicioimpresora = date('Y-m-d',strtotime($fechainicioimpresora));
            $ordenot->fechainicioimpresora = $fechainicioimpresora;    
        }
        if($ordenot->fechainiciocortadora!=''){
            $fechainiciocortadora = $ordenot->fechainiciocortadora;
            $fechainiciocortadora = date('Y-m-d',strtotime($fechainiciocortadora));
            $ordenot->fechainiciocortadora = $fechainiciocortadora;    
        }
       
        if ($this->Ordenots->save($ordenot)) {
            $respuesta = 'Se ha asignado esta orden para esta maquina.';
        }else{
            $respuesta = 'ERROR no se pudo asignar la orden en la lista de prioridades de la maquina';
        }
        $data = [$respuesta,$ordenot];
        $this->set([
            'data' => $data,
            '_serialize' => ['data']
        ]);
    }
    public function modificarprioridad($ordenotId,$prioridad){
        $data=[
            'respuesta'=>'',
            'error'=>0,
        ];
        $ordenot = $this->Ordenots->get($ordenotId, [
            'contain' => [
            ],
        ]);
        $ordenot->prioridad = $prioridad;
        if ($this->Ordenots->save($ordenot)) {
            $data['respuesta'] .= "Prioridad Modificada.";
        }else{
            $data['error'] = 2;
            $data['respuesta'] .= "No se pudo cambiar la prioridad de la orden seleccionada.";
        }
        $this->set([
            'data' => $data,
            '_serialize' => ['data']
        ]);
    }
    public function levelup($ordenotId){
        $data=[
            'respuesta'=>'',
            'error'=>0,
        ];
        $ordenot = $this->Ordenots->get($ordenotId, [
            'contain' => [
            ],
        ]);
        //si la prioridad es 1 no se hace nada
        if($ordenot->prioridad==1){
            $data=[
                'respuesta'=>'Esta Orden ya tiene prioridad 1. No se modifico.',
                'error'=>1,
            ];
            $this->set([
                'data' => $data,
                '_serialize' => ['data']
            ]);
            return;
        }
        $newPrioridad = $ordenot->prioridad*1 - 1;
       
        //bajamos a la que estaba en ese lugar
        $conditionsOrdenOts=[
            'conditions'=>[
                'Ordenots.extrusora_id'=>$ordenot->extrusora_id,
                'Ordenots.impresora_id'=>$ordenot->impresora_id,
                'Ordenots.cortadora_id'=>$ordenot->cortadora_id,
                'Ordenots.prioridad'=>$newPrioridad
            ]
        ];
        $myOrderOts = $this->Ordenots->find('all',$conditionsOrdenOts);
        foreach ($myOrderOts as $key => $myOrderOt) {
            $secOrdenot = $this->Ordenots->get($myOrderOt->id , [
                'contain' => [
                ],
            ]);
            $secOrdenot->prioridad = $secOrdenot->prioridad + 1 ;
            if ($this->Ordenots->save($secOrdenot)) {

            }else{
                $data['error'] = 3;
                $data['respuesta'] .= "No se pudo cambiar la prioridad de la orden predecesora.";
            }
        }
        $ordenot->prioridad = $ordenot->prioridad-1 ;
        if ($this->Ordenots->save($ordenot)) {
            $data['respuesta'] .= "si guarde.";
        }else{
            $data['error'] = 2;
            $data['respuesta'] .= "No se pudo cambiar la prioridad de la orden seleccionada.";
        }
        $this->set([
            'data' => $data,
            '_serialize' => ['data']
        ]);
    }
    public function leveldown($ordenotId){
        $data=[
            'respuesta'=>'',
            'error'=>0,
        ];
        //buscamos la selecicionada
        $ordenot = $this->Ordenots->get($ordenotId, [
            'contain' => [
            ],
        ]);
        $newPrioridad = $ordenot->prioridad+1;
        //subimos a la que estaba abajo
        $conditionsOrdenOts=[
            'conditions'=>[
                'Ordenots.extrusora_id'=>$ordenot->extrusora_id,
                'Ordenots.impresora_id'=>$ordenot->impresora_id,
                'Ordenots.cortadora_id'=>$ordenot->cortadora_id,
                'Ordenots.prioridad'=>$newPrioridad
            ]
        ];
        $myOrderOts = $this->Ordenots->find('all',$conditionsOrdenOts);
        $subiOrden=false;
        foreach ($myOrderOts as $key => $myOrderOt) {
            $secOrdenot = $this->Ordenots->get($myOrderOt->id , [
                'contain' => [
                ],
            ]);
            $secOrdenot->prioridad = $secOrdenot->prioridad - 1 ;
            if ($this->Ordenots->save($secOrdenot)) {
                $subiOrden=true;
            }else{
                $data['error'] = 3;
                $data['respuesta'] .= "No se pudo cambiar la prioridad de la orden predecesora.";
            }
        }
        if(!$subiOrden){
            $data=[
                'respuesta'=>'Esta Orden ya estaba al ultimo. No se modifico.',
                'error'=>1,
            ];
            $this->set([
                'data' => $data,
                '_serialize' => ['data']
            ]);
            return;
        }

        //bajamos la seleccionada
        
        
        $ordenot->prioridad = $newPrioridad ;
        if ($this->Ordenots->save($ordenot)) {

        }else{
            $data['error'] = 2;
            $data['respuesta'] .= "No se pudo cambiar la prioridad de la orden seleccionada.";
        }

        $this->set([
            'data' => $data,
            '_serialize' => ['data']
        ]);
    }
    /**
     * Edit method
     *
     * @param string|null $id Ordenot id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ordenot = $this->Ordenots->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $ordenot = $this->Ordenots->patchEntity($ordenot, $this->request->getData());
            if ($this->Ordenots->save($ordenot)) {
                $this->Flash->success(__('The ordenot has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ordenot could not be saved. Please, try again.'));
        }
        $extrusoras = $this->Ordenots->Extrusoras->find('list', ['limit' => 200]);
        $impresoras = $this->Ordenots->Impresoras->find('list', ['limit' => 200]);
        $cortadoras = $this->Ordenots->Cortadoras->find('list', ['limit' => 200]);
        $ordenesdetrabajos = $this->Ordenots->Ordenesdetrabajos->find('list', ['limit' => 200]);
        $this->set(compact('ordenot', 'extrusoras', 'impresoras', 'cortadoras', 'ordenesdetrabajos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Ordenot id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ordenot = $this->Ordenots->get($id);
        $data=[
            'respuesta'=>'',
            'error'=>0,
        ];
        if ($this->Ordenots->delete($ordenot)) {
           
        } else {
            $data['error'] =2 ;
            $data['respuesta'] .= "No se pudo eliminar la prioridad seleccionada.";
        }

        $this->set([
            'data' => $data,
            '_serialize' => ['data']
        ]);
    }
}
