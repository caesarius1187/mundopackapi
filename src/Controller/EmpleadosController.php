<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Empleados Controller
 *
 * @property \App\Model\Table\EmpleadosTable $Empleados
 *
 * @method \App\Model\Entity\Empleado[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmpleadosController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function dashboard(){
        $this->loadModel('Extrusoras');
        $this->loadModel('Impresoras');
        $this->loadModel('Cortadoras');

        $extrusoras = $this->Extrusoras->find('all',[
            'contain'=>[
                'Ordenots'=>[
                    'Ordenesdetrabajos'=>[
                        'Ordenesdepedidos'
                    ],
                    'conditions'=>[
                        "Ordenots.ordenesdetrabajo_id IN (Select id from Ordenesdetrabajos where Ordenesdetrabajos.estado = 'En Proceso')"
                    ]
                ]
            ]
        ]);
        $impresoras = $this->Impresoras->find('all',[
            'contain'=>[
                'Ordenots'=>[
                    'Ordenesdetrabajos'=>['Ordenesdepedidos'],
                    'conditions'=>[
                        "Ordenots.ordenesdetrabajo_id IN (Select id from Ordenesdetrabajos where Ordenesdetrabajos.estado = 'En Proceso')"
                    ]
                ]
            ]
        ]);
        $cortadoras = $this->Cortadoras->find('all',[
            'contain'=>[
                'Ordenots'=>[
                    'Ordenesdetrabajos'=>['Ordenesdepedidos'],
                    'conditions'=>[
                        "Ordenots.ordenesdetrabajo_id IN (Select id from Ordenesdetrabajos where Ordenesdetrabajos.estado = 'En Proceso')"
                    ]
                ]
            ]
        ]);

        $this->set(compact('extrusoras','impresoras','cortadoras'));

    }
    public function index()
    {
        $empleados = $this->paginate($this->Empleados);

        $this->set(compact('empleados'));
    }

    /**
     * View method
     *
     * @param string|null $id Empleado id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $empleadoconsulta = $this->Empleados->newEntity();
        if ($this->request->is('post')) {
            $fechaDesde = date('Y-m-d',strtotime($this->request->getData()['fechadesde']));
            $fechaHasta = date('Y-m-d',strtotime($this->request->getData()['fechahasta']));
            $empleado = $this->Empleados->get($id, [
                'contain' => [
                    'Bobinasdecortes'=>[
                        'Cortadoras',
                        'conditions'=>[
                            'Bobinasdecortes.fecha >='=>$fechaDesde,
                            'Bobinasdecortes.fecha <='=>$fechaHasta,
                        ],
                    ],
                    'Bobinasdeextrusions'=>[
                        'Extrusoras',
                        'conditions'=>[
                            'Bobinasdeextrusions.fecha >='=>$fechaDesde,
                            'Bobinasdeextrusions.fecha <='=>$fechaHasta,
                        ],
                    ],
                    'Bobinasdeimpresions'=>[
                        'Impresoras',
                        'conditions'=>[
                            'Bobinasdeimpresions.fecha >='=>$fechaDesde,
                            'Bobinasdeimpresions.fecha <='=>$fechaHasta,
                        ],
                    ]
                ],
            ]);
        }else{
            $empleado = $this->Empleados->get($id, [
                'contain' => [
                    'Bobinasdecortes'=>[
                        'Cortadoras'
                    ],
                    'Bobinasdeextrusions'=>[
                        'Extrusoras'
                    ],
                    'Bobinasdeimpresions'=>[
                        'Impresoras'
                    ]
                ],
            ]);
        }

        $this->set(compact('empleado','empleadoconsulta'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $empleado = $this->Empleados->newEntity();
        if ($this->request->is('post')) {
            $empleado = $this->Empleados->patchEntity($empleado, $this->request->getData());
            if ($this->Empleados->save($empleado)) {
                $this->Flash->success(__('The empleado has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The empleado could not be saved. Please, try again.'));
        }
        $this->set(compact('empleado'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Empleado id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $empleado = $this->Empleados->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $empleado = $this->Empleados->patchEntity($empleado, $this->request->getData());
            if ($this->Empleados->save($empleado)) {
                $this->Flash->success(__('The empleado has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The empleado could not be saved. Please, try again.'));
        }
        $this->set(compact('empleado'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Empleado id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $empleado = $this->Empleados->get($id);
        if ($this->Empleados->delete($empleado)) {
            $this->Flash->success(__('The empleado has been deleted.'));
        } else {
            $this->Flash->error(__('The empleado could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
