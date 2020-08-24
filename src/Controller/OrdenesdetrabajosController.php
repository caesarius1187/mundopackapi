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
            'contain' => ['Ordenesdepedidos','Bobinasdeextrusions','Bobinasdeimpresions','Bobinasdecortes'],
        ];
        $ordenesdetrabajos = $this->paginate($this->Ordenesdetrabajos);

        $this->set(compact('ordenesdetrabajos'));
    }

    public function index2()
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
            'contain'=>['Ordenesdepedidos'],
            'conditions'=>[
                'Ordenesdetrabajos.estado IN ("En Proceso","Pausado")',
            ]
        ];
        $ordenesdetrabajos = $this->Ordenesdetrabajos->find('all',$conditions);
        $this->set(compact('ordenesdetrabajos'));



        $extrusoras = $this->Extrusoras->find('all',[
            'contain'=>[
                'Ordenots'=>[
                    'Ordenesdetrabajos'=>['Ordenesdepedidos'],
                    'sort'=>['Ordenots.prioridad']
                ],
            ],
        ]);
        $impresoras = $this->Impresoras->find('all',[
            'contain'=>[
                'Ordenots'=>[
                    'Ordenesdetrabajos'=>['Ordenesdepedidos'],
                    'sort'=>['Ordenots.prioridad']

                ]
            ]
        ]);
        $cortadoras = $this->Cortadoras->find('all',[
            'contain'=>[
                'Ordenots'=>[
                    'Ordenesdetrabajos'=>['Ordenesdepedidos'],
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
            'contain'=>['Ordenesdepedidos'],
            'conditions'=>[
                'Ordenesdetrabajos.estado'=>"En Proceso"
            ]
        ];
        switch ($tipomaquina) {
            case 'extrusora':
                $listaconditions['conditions']['OR'] = ['Ordenesdetrabajos.aextrusar > Ordenesdetrabajos.extrusadas','Ordenesdetrabajos.extrusadas is null'];
                $condirionsOrderOTs = ['conditions'=>['Ordenots.extrusora_id'=>$maquinaid]];
                break;
            case 'impresora':
                $listaconditions['conditions']['OR'] = ['Ordenesdetrabajos.aextrusar > Ordenesdetrabajos.impresas','Ordenesdetrabajos.impresas is null'];
                $listaconditions['conditions']['Ordenesdetrabajos.impreso'] = true;
                $condirionsOrderOTs = ['conditions'=>['Ordenots.impresora_id'=>$maquinaid]];
                break;
            case 'cortadora':
                $listaconditions['conditions']['OR'] = ['Ordenesdetrabajos.aextrusar > Ordenesdetrabajos.cortadas','Ordenesdetrabajos.cortadas is null'];
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
        $this->loadModel('Bobinasdeextrusions');
        $this->loadModel('Bobinasdeimpresions');
        $this->loadModel('Bobinasdecortes');
        $this->loadModel('Empleados');
        $this->loadModel('Extrusoras');
        $this->loadModel('Impresoras');
        $this->loadModel('Cortadoras');
        $ordenesdetrabajo = $this->Ordenesdetrabajos->get($id, [
            'contain' => [
                'Ordenesdepedidos',
                'Bobinasdeextrusions'=>[
                    'Extrusoras',
                    'Empleados',
                ],
                'Bobinasdeimpresions'=>[
                    'Impresoras',
                    'Empleados',
                    'Bobinasdeextrusions'
                ],
                'Bobinasdecortes'=>[
                    'Cortadoras',
                    'Empleados'
                ],
                'Materialesots'
            ],
        ]);
        $newbobinasdeextrusion = $this->Bobinasdeextrusions->newEntity();
        $newbobinasdeimpresion = $this->Bobinasdeimpresions->newEntity();
        $newbobinasdecorte = $this->Bobinasdecortes->newEntity();
        $empleados = $this->Empleados->find('list', ['limit' => 200]);
        $extrusoras = $this->Extrusoras->find('list', ['limit' => 200]);
        $impresoras = $this->Impresoras->find('list', ['limit' => 200]);
        $cortadoras = $this->Cortadoras->find('list', ['limit' => 200]);
        $this->set(compact('ordenesdetrabajo','newbobinasdeextrusion','newbobinasdeimpresion','newbobinasdecorte','empleados','extrusoras','impresoras','cortadoras'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function addsingle(){
        $this->loadModel('Materialesots');
        $respuesta=[];
        $respuesta['respuesta'] = '';
        $respuesta['error'] = 0;
        $ordenesdetrabajo = $this->Ordenesdetrabajos->newEntity();
        $ordenesdetrabajo = $this->Ordenesdetrabajos->patchEntity($ordenesdetrabajo, $this->request->getData());
        $respuesta['ordenesdetrabajo0'] = $ordenesdetrabajo;
        //vamos a crear el numero dinamicamente
        $maxNumOrdenTrabajo = 0;
        $orderopMax = $this->Ordenesdetrabajos->find('all',[
            'conditions'=>[    
                'Ordenesdetrabajos.ordenesdepedido_id'=>$ordenesdetrabajo->ordenesdepedido_id
            ],
            'fields' => array('maxprioridad' => 'MAX(Ordenesdetrabajos.numero)'),
        ]); 
        foreach ($orderopMax as $key => $value) {
            $maxNumOrdenPedido = $value->maxprioridad;
        }
        $maxNumOrdenPedido++;
        $ordenesdetrabajo->numero = $maxNumOrdenPedido;
        $ordenesdetrabajo->medida = $ordenesdetrabajo->ancho."x".$ordenesdetrabajo->largo."x".$ordenesdetrabajo->espesor;
        $result  = $this->Ordenesdetrabajos->save($ordenesdetrabajo);
        if ($result) {
            foreach ($this->request->getData()['Materialesots'] as $kmots => $materialesot) {
                $newmaterialOt = $this->Materialesots->newEntity();
                $newmaterialOt = $this->Materialesots->patchEntity($newmaterialOt, $materialesot);
                $newmaterialOt->ordenesdetrabajo_id = $result->id;
                $this->Materialesots->save($newmaterialOt);
            }
            $respuesta['respuesta'] = 'La orden de trabajo fue guardada';
            $respuesta['ordenesdetrabajo'] = $ordenesdetrabajo;
            $respuesta['request'] = $this->request->getData();
            $respuesta['error'] = 0;
            $OTerrors = $ordenesdetrabajo->errors();
            $respuesta['errors'] = $OTerrors;
        }else{
            $respuesta['respuesta'] = 'Error. La orden de pedido NO fue guardada. Intente de nuevo mas tarde';
            $respuesta['error'] = 1;
            $OTerrors = $ordenesdetrabajo->errors();
            $respuesta['errors'] = $OTerrors;
        }
        $this->set([
            'respuesta' => $respuesta,
            '_serialize' => ['respuesta']
        ]);

    }

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
