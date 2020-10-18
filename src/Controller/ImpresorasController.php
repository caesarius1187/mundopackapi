<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Impresoras Controller
 *
 * @property \App\Model\Table\ImpresorasTable $Impresoras
 *
 * @method \App\Model\Entity\Impresora[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ImpresorasController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $impresoras = $this->paginate($this->Impresoras);

        $this->set(compact('impresoras'));
    }

    /**
     * View method
     *
     * @param string|null $id Impresora id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $impresora = $this->Impresoras->get($id, [
            'contain' => [
                'Ordenots'=>[
                    'conditions'=>[
                        //'Ordenots.fechainicioimpresora <='=>date('Y-m-d')
                    ],
                    'Ordenesdetrabajos'=>[
                        'conditions'=>[
                            'Ordenesdetrabajos.estado'=>'En Proceso'
                        ],
                        'Ordenesdepedidos'=>[
                            'Clientes'
                        ]
                    ],
                    'sort'=>'Ordenots.prioridad ASC'
                ]
            ],
        ]);

        $this->set([
            'impresora' => $impresora,
            '_serialize' => ['impresora']
        ]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $impresora = $this->Impresoras->newEntity();
        if ($this->request->is('post')) {
            $impresora = $this->Impresoras->patchEntity($impresora, $this->request->getData());
            if ($this->Impresoras->save($impresora)) {
                $this->Flash->success(__('The impresora has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The impresora could not be saved. Please, try again.'));
        }
        $this->set(compact('impresora'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Impresora id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $impresora = $this->Impresoras->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $impresora = $this->Impresoras->patchEntity($impresora, $this->request->getData());
            if ($this->Impresoras->save($impresora)) {
                $this->Flash->success(__('The impresora has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The impresora could not be saved. Please, try again.'));
        }
        $this->set(compact('impresora'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Impresora id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $impresora = $this->Impresoras->get($id);
        if ($this->Impresoras->delete($impresora)) {
            $this->Flash->success(__('The impresora has been deleted.'));
        } else {
            $this->Flash->error(__('The impresora could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
