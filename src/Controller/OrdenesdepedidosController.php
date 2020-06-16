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
        $ordenesdepedidos = $this->paginate($this->Ordenesdepedidos);

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
    public function add()
    {
        $ordenesdepedido = $this->Ordenesdepedidos->newEntity();
        if ($this->request->is('post')) {
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
