<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Cortadoras Controller
 *
 * @property \App\Model\Table\CortadorasTable $Cortadoras
 *
 * @method \App\Model\Entity\Cortadora[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CortadorasController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $cortadoras = $this->paginate($this->Cortadoras);

        $this->set(compact('cortadoras'));
    }

    /**
     * View method
     *
     * @param string|null $id Cortadora id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cortadora = $this->Cortadoras->get($id, [
            'contain' => [
                'Ordenots'=>[
                    'Ordenesdetrabajos'=>[
                        'Ordenesdepedidos'=>[
                            'Clientes'
                        ]
                    ],
                    'sort'=>'Ordenots.prioridad ASC'
                ]
            ],
        ]);

        $this->set([
            'cortadora' => $cortadora,
            '_serialize' => ['cortadora']
        ]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cortadora = $this->Cortadoras->newEntity();
        if ($this->request->is('post')) {
            $cortadora = $this->Cortadoras->patchEntity($cortadora, $this->request->getData());
            if ($this->Cortadoras->save($cortadora)) {
                $this->Flash->success(__('The cortadora has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cortadora could not be saved. Please, try again.'));
        }
        $this->set(compact('cortadora'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Cortadora id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cortadora = $this->Cortadoras->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cortadora = $this->Cortadoras->patchEntity($cortadora, $this->request->getData());
            if ($this->Cortadoras->save($cortadora)) {
                $this->Flash->success(__('The cortadora has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cortadora could not be saved. Please, try again.'));
        }
        $this->set(compact('cortadora'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Cortadora id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cortadora = $this->Cortadoras->get($id);
        if ($this->Cortadoras->delete($cortadora)) {
            $this->Flash->success(__('The cortadora has been deleted.'));
        } else {
            $this->Flash->error(__('The cortadora could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
