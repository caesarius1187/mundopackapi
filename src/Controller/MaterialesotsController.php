<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Materialesots Controller
 *
 * @property \App\Model\Table\MaterialesotsTable $Materialesots
 *
 * @method \App\Model\Entity\Materialesot[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MaterialesotsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Ordenesdetrabajos'],
        ];
        $materialesots = $this->paginate($this->Materialesots);

        $this->set(compact('materialesots'));
    }

    /**
     * View method
     *
     * @param string|null $id Materialesot id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $materialesot = $this->Materialesots->get($id, [
            'contain' => ['Ordenesdetrabajos'],
        ]);

        $this->set('materialesot', $materialesot);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $materialesot = $this->Materialesots->newEntity();
        if ($this->request->is('post')) {
            $materialesot = $this->Materialesots->patchEntity($materialesot, $this->request->getData());
            if ($this->Materialesots->save($materialesot)) {
                $this->Flash->success(__('The materialesot has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The materialesot could not be saved. Please, try again.'));
        }
        $ordenesdetrabajos = $this->Materialesots->Ordenesdetrabajos->find('list', ['limit' => 200]);
        $this->set(compact('materialesot', 'ordenesdetrabajos'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Materialesot id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $materialesot = $this->Materialesots->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $materialesot = $this->Materialesots->patchEntity($materialesot, $this->request->getData());
            if ($this->Materialesots->save($materialesot)) {
                $this->Flash->success(__('The materialesot has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The materialesot could not be saved. Please, try again.'));
        }
        $ordenesdetrabajos = $this->Materialesots->Ordenesdetrabajos->find('list', ['limit' => 200]);
        $this->set(compact('materialesot', 'ordenesdetrabajos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Materialesot id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $materialesot = $this->Materialesots->get($id);
        if ($this->Materialesots->delete($materialesot)) {
            $this->Flash->success(__('The materialesot has been deleted.'));
        } else {
            $this->Flash->error(__('The materialesot could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
