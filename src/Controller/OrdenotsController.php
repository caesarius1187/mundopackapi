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
        $maxprioridadextrusora = 0;
        $orderotMax = $this->Ordenots->find('all',[
            'conditions'=>[
                'Ordenots.extrusora_id'=>$ordenot->extrusora_id
            ],
            'fields' => array('maxprioridadextrusora' => 'MAX(Ordenots.prioridadextrusion)'),
        ]);
        foreach ($orderotMax as $key => $value) {
          $maxprioridadextrusora = $value['maxprioridadextrusora'];
        }
        $ordenot->prioridadextrusion = $maxprioridadextrusora+1;
        //vamos a poner la prioridad mas alta +1
        $maxprioridadimpresion = 0;
        $orderotMax = $this->Ordenots->find('all',[
            'conditions'=>[
                'Ordenots.impresora_id'=>$ordenot->impresora_id
            ],
            'fields' => array('maxprioridadimpresion' => 'MAX(Ordenots.prioridadimpresion)'),
        ]);
        foreach ($orderotMax as $key => $value) {
            $maxprioridadimpresion = $value['$maxprioridadimpresion'];
        }
        $ordenot->prioridadimpresion = $maxprioridadimpresion+1;
        //vamos a poner la prioridad mas alta +1
        $maxprioridadcorte = 0;
        $orderotMax = $this->Ordenots->find('all',[
            'conditions'=>[
                'Ordenots.cortadora_id'=>$ordenot->cortadora_id
            ],
            'fields' => array('maxprioridadcorte' => 'MAX(Ordenots.prioridadcorte)'),
        ]);
        foreach ($orderotMax as $key => $value) {
            $maxprioridadcorte = $value['$maxprioridadcorte'];
        }
        $ordenot->prioridadcorte = $maxprioridadcorte+1;
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

    public function reorderE() {
      $this->request->allowMethod('ajax');

      $listPriority = $this->request->getData()['data'];

      $this->set('_serialize', $listPriority);

      foreach ($listPriority as $value) {
        if($value[1]!=''){
          $ordenot = $this->Ordenots->get($value[1]);
          $ordenot->prioridadextrusion = $value[0];
          $this->Ordenots->save($ordenot);
        }
      }
      $data=[
          'respuesta'=>'',
          'error'=>0,
      ];
      $this->set([
          'data' => $data,
          '_serialize' => ['data']
      ]);
    }
    public function reorderI() {
      $this->request->allowMethod('ajax');

      $listPriority = $this->request->getData()['data'];

      $this->set('_serialize', $listPriority);

      foreach ($listPriority as $value) {
        if($value[1]!=''){
          $ordenot = $this->Ordenots->get($value[1]);
          $ordenot->prioridadimpresion = $value[0];
          $this->Ordenots->save($ordenot);
        }
      }
      $data=[
          'respuesta'=>'',
          'error'=>0,
      ];
      $this->set([
          'data' => $data,
          '_serialize' => ['data']
      ]);
    }
    public function reorderC() {
      $this->request->allowMethod('ajax');

      $listPriority = $this->request->getData()['data'];

      $this->set('_serialize', $listPriority);

      foreach ($listPriority as $value) {
        if($value[1]!=''){
          $ordenot = $this->Ordenots->get($value[1]);
          $ordenot->prioridadcorte = $value[0];
          $this->Ordenots->save($ordenot);
        }
      }
      $data=[
          'respuesta'=>'',
          'error'=>0,
      ];
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
        //vamos a reducir en 1 las ordenes posteriores
        $newPrioridadExtrusion = $ordenot->prioridadextrusion;
        $newPrioridadImpresion = $ordenot->prioridadimpresion;
        $newPrioridadCorte = $ordenot->prioridadcorte;
        //subimos a la que estaba abajo
        $conditionsOrdenOts=[
            'conditions'=>[
                'Ordenots.extrusora_id'=>$ordenot->extrusora_id,
                'Ordenots.prioridadextrusion >='=>$newPrioridadExtrusion
            ]
        ];
        $data=[
            'respuesta'=>'',
            'error'=>0,
        ];
        $myOrderOts = $this->Ordenots->find('all',$conditionsOrdenOts);
        foreach ($myOrderOts as $key => $myOrderOt) {
            $secOrdenot = $this->Ordenots->get($myOrderOt->id , [
                'contain' => [
                ],
            ]);
            $secOrdenot->prioridadextrusion = $secOrdenot->prioridadextrusion - 1 ;
            if ($this->Ordenots->save($secOrdenot)) {
                $subiOrden=true;
            }else{
                $data['error'] = 1;
                $data['respuesta'] .= "No se pudo cambiar la prioridad de las ordenes posteriories.";
            }
        }
        //subimos a la que estaba abajo
        $conditionsOrdenOts=[
            'conditions'=>[
                'Ordenots.impresora_id'=>$ordenot->impresora_id,
                'Ordenots.prioridadimpresion >='=>$newPrioridadImpresion
            ]
        ];
        $data=[
            'respuesta'=>'',
            'error'=>0,
        ];
        $myOrderOts = $this->Ordenots->find('all',$conditionsOrdenOts);
        foreach ($myOrderOts as $key => $myOrderOt) {
            $secOrdenot = $this->Ordenots->get($myOrderOt->id , [
                'contain' => [
                ],
            ]);
            $secOrdenot->prioridadimpresion = $secOrdenot->prioridadimpresion - 1 ;
            if ($this->Ordenots->save($secOrdenot)) {
                $subiOrden=true;
            }else{
                $data['error'] = 1;
                $data['respuesta'] .= "No se pudo cambiar la prioridad de las ordenes posteriories.";
            }
        }
        //subimos a la que estaba abajo
        $conditionsOrdenOts=[
            'conditions'=>[
                'Ordenots.cortadora_id'=>$ordenot->cortadora_id,
                'Ordenots.prioridadcorte >='=>$newPrioridadCorte
            ]
        ];
        $data=[
            'respuesta'=>'',
            'error'=>0,
        ];
        $myOrderOts = $this->Ordenots->find('all',$conditionsOrdenOts);
        foreach ($myOrderOts as $key => $myOrderOt) {
            $secOrdenot = $this->Ordenots->get($myOrderOt->id , [
                'contain' => [
                ],
            ]);
            $secOrdenot->prioridadcorte = $secOrdenot->prioridadcorte - 1 ;
            if ($this->Ordenots->save($secOrdenot)) {
                $subiOrden=true;
            }else{
                $data['error'] = 1;
                $data['respuesta'] .= "No se pudo cambiar la prioridad de las ordenes posteriories.";
            }
        }
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
