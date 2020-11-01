<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Ordenesdepedidos Controller
 *
 * @property \App\Model\Table\OrdenesdepedidosTable $Ordenesdepedidos
 *
 * @method \App\Model\Entity\Ordenesdepedido[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrdenesdepedidosController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $ordenesdepedidos = $this->Ordenesdepedidos->find('all',[
            'conditions'=>[
                'Ordenesdepedidos.id <> '=> 1
            ],
            'contain'=>[
                'Clientes'
            ]
        ]);

        $this->set(compact('ordenesdepedidos'));
    }

    public function informe($opid = null)
    {
        $ordenesdepedidos = $this->Ordenesdepedidos->find('all',[
            'conditions'=>[
                'Ordenesdepedidos.id'=>$opid,
            ],
            'contain'=>[
                'Clientes',
                'Ordenesdetrabajos'=>[
                    'Bobinasdeextrusions'=>[
                        'Extrusoras',
                        'Empleados'
                    ],
                    'Bobinasdeimpresions'=>[
                        'Impresoras',
                        'Empleados'
                    ],
                    'Bobinasdecortes'=>[
                        'Cortadoras',
                        'Empleados'
                    ],
                    'Materialesots'
                ],
            ]
        ]);

        $this->set(compact('ordenesdepedidos'));
    }

    public function search()
    {
        $ordenesdepedidos = $this->Ordenesdepedidos->find('all',[
            'contain'=>['Clientes','Ordenesdetrabajos']
        ]);

        $this->set(compact('ordenesdepedidos'));
    }

    /**
     * View method
     *
     * @param string|null $id Ordenesdepedido id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ordenesdepedido = $this->Ordenesdepedidos->get($id, [
            'contain' => [
              'Clientes',
              'Ordenesdetrabajos'
            ],
        ]);

        $this->set('ordenesdepedido', $ordenesdepedido);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function addsingle(){
        $respuesta=[];
        $respuesta['respuesta'] = '';
        $respuesta['error'] = 0;
        $ordenesdepedido = $this->Ordenesdepedidos->newEntity();
        $ordenesdepedido = $this->Ordenesdepedidos->patchEntity($ordenesdepedido, $this->request->getData());
        $fecha = $this->request->getData()['fecha'];
        // strtotime no sirve con dd/mm/yyyy ñaño
        $fechaconsultadesde = date('Y-m-d',strtotime(str_replace('/', '-',$fecha)));
        $respuesta['ordenesdepedido0'] = $ordenesdepedido;
        if($this->request->getData()['id']!=0){
            $ordenesdepedido->id=$this->request->getData()['id'];
        }
        $ordenesdepedido->fecha = $fechaconsultadesde;
        if ($this->Ordenesdepedidos->save($ordenesdepedido)) {
            $respuesta['respuesta'] = 'La orden de pedido fue guardada';
            $respuesta['ordenesdepedido'] = $ordenesdepedido;
            $respuesta['request'] = $this->request->getData();
            $respuesta['error'] = 0;
            $OPerrors = $ordenesdepedido->errors();
            $respuesta['errors'] = $OPerrors;
        }else{
            $respuesta['respuesta'] = 'Error. La orden de pedido NO fue guardada. Intente de nuevo mas tarde';
            $respuesta['error'] = 1;
            $OPerrors = $ordenesdepedido->errors();
            $respuesta['errors'] = $OPerrors;
        }
        $this->set([
            'respuesta' => $respuesta,
            '_serialize' => ['respuesta']
        ]);

    }

    public function add($ordenPedidoId = null)
    {
        $this->loadModel('Clientes');
        $this->loadModel('Ordenesdetrabajos');
        $ordenesdepedido = $this->Ordenesdepedidos->newEntity();

        $maxNumOrdenPedido = 1;

        if($ordenPedidoId!=null){
            $newordenesdepedidos =  $this->Ordenesdepedidos->get($ordenPedidoId,['contain'=>['Ordenesdetrabajos'=>['Materialesots']]]);
            $ordenesdepedido = $newordenesdepedidos;
            $maxNumOrdenPedido = $ordenesdepedido->numero;
        }else{
            $orderopMax = $this->Ordenesdepedidos->find('all',[
                'conditions'=>[
                ],
                'fields' => array('maxprioridad' => 'MAX(Ordenesdepedidos.numero)'),
            ]);
            foreach ($orderopMax as $key => $value) {
                $maxNumOrdenPedido = $value->maxprioridad;
            }
            $maxNumOrdenPedido++;
        }
        $clientes = $this->Clientes->find('list',[
            'conditions'=>[
            ],
        ]);
        $materiales = $this->Ordenesdetrabajos->materiales;
        $this->set(compact('ordenesdepedido','maxNumOrdenPedido','clientes','materiales'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Ordenesdepedido id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ordenesdepedido = $this->Ordenesdepedidos->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ordenesdepedido = $this->Ordenesdepedidos->patchEntity($ordenesdepedido, $this->request->getData());
            if ($this->Ordenesdepedidos->save($ordenesdepedido)) {
                $this->Flash->success(__('The ordenesdepedido has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ordenesdepedido could not be saved. Please, try again.'));
        }
        $this->set(compact('ordenesdepedido'));
    }

    public function playop($opid){
        $this->loadModel('Ordenots');
        $data=[
            'respuesta'=>'',
            'error'=>0,
        ];
       $ordenesdepedido = $this->Ordenesdepedidos->get($opid, [
            'contain' => [
            ],
        ]);
        $ordenesdepedido->estado = 'Pausado';
        $ordenesdepedido->estado = 'En Proceso';
        if ($this->Ordenesdetrabajos->save($ordenesdetrabajo)) {
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
    public function pausarop($opid){
        $this->loadModel('Ordenesdetrabajos');
        $this->loadModel('Ordenots');

        $data=[
            'respuesta'=>'',
            'error'=>0,
        ];
        $ordenesdepedido = $this->Ordenesdepedidos->get($opid, [
            'contain' => [
            ],
        ]);
        $ordenesdepedido->estado = 'Pausado';
        if ($this->Ordenesdepedidos->save($ordenesdepedido)) {
            $data['respuesta'] .= "La OP fue pausada y se saco de las listas de prioridades de las maquinas a sus OT's.";
            $ordenesdetrabajos = $this->Ordenesdetrabajos->find('all',[
                'contain' => [
                ],
                'conditions' => [
                    'Ordenesdetrabajos.ordenesdepedido_id'=>$opid
                ]
            ]);
            foreach ($ordenesdetrabajos as $otkey => $valot) {
                 $ordenesdetrabajo = $this->Ordenesdetrabajos->get($valot->id, [
                        'contain' => [
                    ],
                ]);
                $ordenesdetrabajo->estado = 'Pausado';
                if ($this->Ordenesdetrabajos->save($ordenesdetrabajo)) {
                    //si la or tiene ordenot asignadas las eliminamos
                    $this->Ordenots->deleteAll(['ordenesdetrabajo_id' => $valot->id]);
                }else{
                    $data['error'] = 1;
                    $data['respuesta'] .= "No se pudo pausar la OT seleccionada.";
                }
            }
        }else{
            $data['error'] = 1;
            $data['respuesta'] .= "No se pudo pausar la OT seleccionada.";
        }

        $this->set([
            'data' => $data,
            '_serialize' => ['data']
        ]);
    }

    public function cancelarop($opid){
         $this->loadModel('Ordenesdetrabajos');
        $this->loadModel('Ordenots');

        $data=[
            'respuesta'=>'',
            'error'=>0,
        ];
        $ordenesdepedido = $this->Ordenesdepedidos->get($opid, [
            'contain' => [
            ],
        ]);
        $ordenesdepedido->estado = 'Cancelado';
        if ($this->Ordenesdepedidos->save($ordenesdepedido)) {
            $data['respuesta'] .= "La OP fue pausada y se saco de las listas de prioridades de las maquinas a sus OT's.";
            $ordenesdetrabajos = $this->Ordenesdetrabajos->find('all',[
                'contain' => [
                ],
                'conditions' => [
                    'Ordenesdetrabajos.ordenesdepedido_id'=>$opid
                ]
            ]);
            foreach ($ordenesdetrabajos as $otkey => $valot) {
                 $ordenesdetrabajo = $this->Ordenesdetrabajos->get($valot->id, [
                        'contain' => [
                    ],
                ]);
                $ordenesdetrabajo->estado = 'Cancelado';
                if ($this->Ordenesdetrabajos->save($ordenesdetrabajo)) {
                    //si la or tiene ordenot asignadas las eliminamos
                    $this->Ordenots->deleteAll(['ordenesdetrabajo_id' => $valot->id]);
                }else{
                    $data['error'] = 1;
                    $data['respuesta'] .= "No se pudo pausar la OT seleccionada.";
                }
            }
        }else{
            $data['error'] = 1;
            $data['respuesta'] .= "No se pudo pausar la OT seleccionada.";
        }

        $this->set([
            'data' => $data,
            '_serialize' => ['data']
        ]);
    }
}
