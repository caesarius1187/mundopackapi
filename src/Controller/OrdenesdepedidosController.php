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
            'contain'=>['Clientes']
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
            'contain' => ['Ordenesdetrabajos'],
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
        $fechaconsultadesde = date('Y-m-d',strtotime($fecha));
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

    public function add()
    {
        $this->loadModel('Clientes');
        $ordenesdepedido = $this->Ordenesdepedidos->newEntity();
        
        $maxNumOrdenPedido = 0;
        $orderopMax = $this->Ordenesdepedidos->find('all',[
            'conditions'=>[                
            ],
            'fields' => array('maxprioridad' => 'MAX(Ordenesdepedidos.numero)'),
        ]); 
        foreach ($orderopMax as $key => $value) {
            $maxNumOrdenPedido = $value->maxprioridad;
        }
        $maxNumOrdenPedido++;

        $clientes = $this->Clientes->find('list',[
            'conditions'=>[                
            ],
        ]); 

        $this->set(compact('ordenesdepedido','maxNumOrdenPedido','clientes'));
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

    /**
     * Delete method
     *
     * @param string|null $id Ordenesdepedido id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ordenesdepedido = $this->Ordenesdepedidos->get($id);
        if ($this->Ordenesdepedidos->delete($ordenesdepedido)) {
            $this->Flash->success(__('The ordenesdepedido has been deleted.'));
        } else {
            $this->Flash->error(__('The ordenesdepedido could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
