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
