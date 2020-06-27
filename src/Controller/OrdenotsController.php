<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Ordenots Controller
 *
 * @property \App\Model\Table\OrdenotsTable $Ordenots
 *
 * @method \App\Model\Entity\Ordenot[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrdenotsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Extrusoras', 'Impresoras', 'Cortadoras', 'Ordenesdetrabajos'],
        ];
        $ordenots = $this->paginate($this->Ordenots);

        $this->set(compact('ordenots'));
    }

    /**
     * View method
     *
     * @param string|null $id Ordenot id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ordenot = $this->Ordenots->get($id, [
            'contain' => ['Extrusoras', 'Impresoras', 'Cortadoras', 'Ordenesdetrabajos'],
        ]);

        $this->set('ordenot', $ordenot);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ordenot = $this->Ordenots->newEntity();
        if ($this->request->is('post')) {
            $ordenot = $this->Ordenots->patchEntity($ordenot, $this->request->getData());
            if ($this->Ordenots->save($ordenot)) {
                $this->Flash->success(__('The ordenot has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ordenot could not be saved. Please, try again.'));
        }
        $extrusoras = $this->Ordenots->Extrusoras->find('list', ['limit' => 200]);
        $impresoras = $this->Ordenots->Impresoras->find('list', ['limit' => 200]);
        $cortadoras = $this->Ordenots->Cortadoras->find('list', ['limit' => 200]);
        $ordenesdetrabajos = $this->Ordenots->Ordenesdetrabajos->find('list', ['limit' => 200]);
        $this->set(compact('ordenot', 'extrusoras', 'impresoras', 'cortadoras', 'ordenesdetrabajos'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Ordenot id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ordenot = $this->Ordenots->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ordenot = $this->Ordenots->patchEntity($ordenot, $this->request->getData());
            if ($this->Ordenots->save($ordenot)) {
                $this->Flash->success(__('The ordenot has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ordenot could not be saved. Please, try again.'));
        }
        $extrusoras = $this->Ordenots->Extrusoras->find('list', ['limit' => 200]);
        $impresoras = $this->Ordenots->Impresoras->find('list', ['limit' => 200]);
        $cortadoras = $this->Ordenots->Cortadoras->find('list', ['limit' => 200]);
        $ordenesdetrabajos = $this->Ordenots->Ordenesdetrabajos->find('list', ['limit' => 200]);
        $this->set(compact('ordenot', 'extrusoras', 'impresoras', 'cortadoras', 'ordenesdetrabajos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Ordenot id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ordenot = $this->Ordenots->get($id);
        if ($this->Ordenots->delete($ordenot)) {
            $this->Flash->success(__('The ordenot has been deleted.'));
        } else {
            $this->Flash->error(__('The ordenot could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
