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
    public function add()
    {
        $bobinasdeextrusion = $this->Bobinasdeextrusions->newEntity();
        if ($this->request->is('post')) {
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
