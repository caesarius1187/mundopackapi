<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Ordenesdetrabajos Controller
 *
 * @property \App\Model\Table\OrdenesdetrabajosTable $Ordenesdetrabajos
 *
 * @method \App\Model\Entity\Ordenesdetrabajo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrdenesdetrabajosController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Ordenesdepedidos'],
        ];
        $ordenesdetrabajos = $this->paginate($this->Ordenesdetrabajos);

        $this->set(compact('ordenesdetrabajos'));
    }

    public function asignacion(){
        $this->loadModel('Extrusoras');
        $this->loadModel('Impresoras');
        $this->loadModel('Cortadoras');
        $this->loadModel('Ordenots');

        $conditions=[
            'conditions'=>[
                'Ordenesdetrabajos.estado IN ("En Proceso","Pausado")',
            ]
        ];
        $ordenesdetrabajos = $this->Ordenesdetrabajos->find('all',$conditions);
        $this->set(compact('ordenesdetrabajos'));

        

        $extrusoras = $this->Extrusoras->find('all',[
            'contain'=>[
                'Ordenots'=>[
                    'Ordenesdetrabajos',
                    'sort'=>['Ordenots.prioridad']
                ],
            ],
        ]);
        $impresoras = $this->Impresoras->find('all',[
            'contain'=>[
                'Ordenots'=>[
                    'Ordenesdetrabajos',
                    'sort'=>['Ordenots.prioridad']

                ]
            ]
        ]);
        $cortadoras = $this->Cortadoras->find('all',[
            'contain'=>[
                'Ordenots'=>[
                    'Ordenesdetrabajos',
                    'sort'=>['Ordenots.prioridad']
                ]
            ]
        ]);
        $ordenot = $this->Ordenots->newEntity();
        $this->set(compact('extrusoras','impresoras','cortadoras','ordenot'));
    }
    public function listaasignacion($tipomaquina,$maquinaid){
        $this->loadModel('Ordenots');
        //vamos a buscar las que ya estan en la maquina y no las vamos a permitir volver a agregar
        
        $listaconditions=[
            'conditions'=>[
               
                'Ordenesdetrabajos.estado'=>"En Proceso"
            ]
        ];
        switch ($tipomaquina) {
            case 'extrusora':
                $listaconditions['conditions'][] = 'Ordenesdetrabajos.aextrusar > Ordenesdetrabajos.extrusadas';
                $condirionsOrderOTs = ['conditions'=>['Ordenots.extrusora_id'=>$maquinaid]];
                break;
            case 'impresora':
                $listaconditions['conditions'][] = 'Ordenesdetrabajos.aextrusar > Ordenesdetrabajos.impresas';
                $listaconditions['conditions']['Ordenesdetrabajos.impreso'] = true;
                $condirionsOrderOTs = ['conditions'=>['Ordenots.impresora_id'=>$maquinaid]];
                break;
            case 'cortadora':
                $listaconditions['conditions'][] = 'Ordenesdetrabajos.aextrusar > Ordenesdetrabajos.cortadas';
                $listaconditions['conditions']['Ordenesdetrabajos.cortado'] = true;
                $condirionsOrderOTs = ['conditions'=>['Ordenots.cortadora_id'=>$maquinaid]];
                break;            
        }
        $listOrdenOrdenesDeTrabajo = $this->Ordenots->find('all',$condirionsOrderOTs);
        $ordenesyaagregadas = [];
        foreach ($listOrdenOrdenesDeTrabajo as $key => $orderOt) {
            $ordenesyaagregadas[] = $orderOt->ordenesdetrabajo_id; 
        }
        if(count($ordenesyaagregadas)>0){
            $listaconditions['conditions']['Ordenesdetrabajos.id NOT IN'] = $ordenesyaagregadas ;    
        }
        $listOrdenes = $this->Ordenesdetrabajos->find('all',$listaconditions);
        $this->set([
            'listOrdenes' => $listOrdenes,
            '_serialize' => ['listOrdenes']
        ]);

    }

    public function playot($otid){
        $this->loadModel('Ordenots');
        $data=[
            'respuesta'=>'',
            'error'=>0,
        ];
        $ordenesdetrabajo = $this->Ordenesdetrabajos->get($otid, [
            'contain' => [
            ],
        ]);
        $ordenesdetrabajo->estado = 'En Proceso';
        if ($this->Ordenesdetrabajos->save($ordenesdetrabajo)) {
            //si la or tiene ordenot asignadas las eliminamos
            $this->Ordenots->deleteAll(['ordenesdetrabajo_id' => $otid]);
            $data['respuesta'] .= "La OT fue retomada. Ya se puede ver en las listas de prioridades que se pueden agregar.";
        }else{
            $data['error'] = 1;
            $data['respuesta'] .= "No se pudo retomar la OT seleccionada.";
        }
        $this->set([
            'data' => $data,
            '_serialize' => ['data']
        ]);
    }
    public function pausarot($otid){
        $this->loadModel('Ordenots');
        $data=[
            'respuesta'=>'',
            'error'=>0,
        ];
        $ordenesdetrabajo = $this->Ordenesdetrabajos->get($otid, [
            'contain' => [
            ],
        ]);
        $ordenesdetrabajo->estado = 'Pausado';
        if ($this->Ordenesdetrabajos->save($ordenesdetrabajo)) {
            //si la or tiene ordenot asignadas las eliminamos
            $this->Ordenots->deleteAll(['ordenesdetrabajo_id' => $otid]);
            $data['respuesta'] .= "La OT fue pausada y se la saco de las listas de prioridades de las maquinas.";
        }else{
            $data['error'] = 1;
            $data['respuesta'] .= "No se pudo pausar la OT seleccionada.";
        }
        $this->set([
            'data' => $data,
            '_serialize' => ['data']
        ]);
    }

    public function cancelarot($otid){
        $this->loadModel('Ordenots');
        $data=[
            'respuesta'=>'',
            'error'=>0,
        ];
        $ordenesdetrabajo = $this->Ordenesdetrabajos->get($otid, [
            'contain' => [
            ],
        ]);
        $ordenesdetrabajo->estado = 'Cancelado';
        if ($this->Ordenesdetrabajos->save($ordenesdetrabajo)) {
            //si la or tiene ordenot asignadas las eliminamos
            $this->Ordenots->deleteAll(['ordenesdetrabajo_id' => $otid]);
            $data['respuesta'] .= "La OT fue cancelada y se la saco de las listas de prioridades de las maquinas.";
        }else{
            $data['error'] = 1;
            $data['respuesta'] .= "No se pudo cancelar la OT seleccionada.";
        }
        $this->set([
            'data' => $data,
            '_serialize' => ['data']
        ]);
    }
    /**
     * View method
     *
     * @param string|null $id Ordenesdetrabajo id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ordenesdetrabajo = $this->Ordenesdetrabajos->get($id, [
            'contain' => ['Ordenesdepedidos'],
        ]);

        $this->set('ordenesdetrabajo', $ordenesdetrabajo);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ordenesdetrabajo = $this->Ordenesdetrabajos->newEntity();
        if ($this->request->is('post')) {
            $ordenesdetrabajo = $this->Ordenesdetrabajos->patchEntity($ordenesdetrabajo, $this->request->getData());
            if ($this->Ordenesdetrabajos->save($ordenesdetrabajo)) {
                $this->Flash->success(__('The ordenesdetrabajo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ordenesdetrabajo could not be saved. Please, try again.'));
        }
        $ordenesdepedidos = $this->Ordenesdetrabajos->Ordenesdepedidos->find('list', ['limit' => 200]);
        $this->set(compact('ordenesdetrabajo', 'ordenesdepedidos'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Ordenesdetrabajo id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ordenesdetrabajo = $this->Ordenesdetrabajos->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ordenesdetrabajo = $this->Ordenesdetrabajos->patchEntity($ordenesdetrabajo, $this->request->getData());
            if ($this->Ordenesdetrabajos->save($ordenesdetrabajo)) {
                $this->Flash->success(__('The ordenesdetrabajo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ordenesdetrabajo could not be saved. Please, try again.'));
        }
        $ordenesdepedidos = $this->Ordenesdetrabajos->Ordenesdepedidos->find('list', ['limit' => 200]);
        $this->set(compact('ordenesdetrabajo', 'ordenesdepedidos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Ordenesdetrabajo id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ordenesdetrabajo = $this->Ordenesdetrabajos->get($id);
        if ($this->Ordenesdetrabajos->delete($ordenesdetrabajo)) {
            $this->Flash->success(__('The ordenesdetrabajo has been deleted.'));
        } else {
            $this->Flash->error(__('The ordenesdetrabajo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
