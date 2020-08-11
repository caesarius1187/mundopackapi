<?php
namespace App\Controller;

use App\Controller\AppController;

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
    public function index()
    {
        $this->paginate = [
            'contain' => ['Empleados', 'Extrusoras'],
        ];
        $bobinasdeextrusions = $this->paginate($this->Bobinasdeextrusions);

        $this->set(compact('bobinasdeextrusions'));
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
        if($ordenesdetrabajo->aextrusar==$ordenesdetrabajo->extrusadas){
            //ya no se pueden agregar bobinas
            $respuesta['respuesta'] = 'Ya se cargaron todas las bobinas de estrusion que se necesitaban('.$ordenesdetrabajo->aextrusar.') para esta Orden de Trabajo';
            $respuesta['error'] = 1;
             $this->set([
                'respuesta' => $respuesta,
                '_serialize' => ['respuesta']
            ]);
            return;
        }

        $fecha = $this->request->getData()['fecha'];
        $fechaconsultadesde = date('Y-m-d',strtotime($fecha));
        $respuesta['bobinasdeextrusion0'] = $bobinasdeextrusion;        
        $bobinasdeextrusion->fecha = $fechaconsultadesde;
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
            //vamos a sumar 1 en las bobinas extrusoras de la orden de trabajo

            
            $ordenesdetrabajo->extrusadas = $ordenesdetrabajo->extrusadas+1 ;

            if ($this->Ordenesdetrabajos->save($ordenesdetrabajo)) {
                $respuesta['respuesta'] .= "Se actualizo las bobinas estrusadas de la orden de pedido.";
            }else{
                $respuesta['error'] = 2;
                $respuesta['respuesta'] .= "No se pudo actualizar las bobinas estrusadas de la orden de pedido.";
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
