<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Bobinasdeimpresions Controller
 *
 * @property \App\Model\Table\BobinasdeimpresionsTable $Bobinasdeimpresions
 *
 * @method \App\Model\Entity\Bobinasdeimpresion[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BobinasdeimpresionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Empleados', 'Cortadoras', 'Bobinasdeextrusions'],
        ];
        $bobinasdeimpresions = $this->paginate($this->Bobinasdeimpresions);

        $this->set(compact('bobinasdeimpresions'));
    }

    /**
     * View method
     *
     * @param string|null $id Bobinasdeimpresion id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bobinasdeimpresion = $this->Bobinasdeimpresions->get($id, [
            'contain' => ['Empleados', 'Cortadoras', 'Bobinasdeextrusions', 'Bobinascorteorigens'],
        ]);

        $this->set('bobinasdeimpresion', $bobinasdeimpresion);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $bobinasdeimpresion = $this->Bobinasdeimpresions->newEntity();
        if ($this->request->is('post')) {
            $bobinasdeimpresion = $this->Bobinasdeimpresions->patchEntity($bobinasdeimpresion, $this->request->getData());
            if ($this->Bobinasdeimpresions->save($bobinasdeimpresion)) {
                $this->Flash->success(__('The bobinasdeimpresion has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bobinasdeimpresion could not be saved. Please, try again.'));
        }
        $empleados = $this->Bobinasdeimpresions->Empleados->find('list', ['limit' => 200]);
        $cortadoras = $this->Bobinasdeimpresions->Cortadoras->find('list', ['limit' => 200]);
        $bobinasdeextrusions = $this->Bobinasdeimpresions->Bobinasdeextrusions->find('list', ['limit' => 200]);
        $this->set(compact('bobinasdeimpresion', 'empleados', 'cortadoras', 'bobinasdeextrusions'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Bobinasdeimpresion id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bobinasdeimpresion = $this->Bobinasdeimpresions->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bobinasdeimpresion = $this->Bobinasdeimpresions->patchEntity($bobinasdeimpresion, $this->request->getData());
            if ($this->Bobinasdeimpresions->save($bobinasdeimpresion)) {
                $this->Flash->success(__('The bobinasdeimpresion has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bobinasdeimpresion could not be saved. Please, try again.'));
        }
        $empleados = $this->Bobinasdeimpresions->Empleados->find('list', ['limit' => 200]);
        $cortadoras = $this->Bobinasdeimpresions->Cortadoras->find('list', ['limit' => 200]);
        $bobinasdeextrusions = $this->Bobinasdeimpresions->Bobinasdeextrusions->find('list', ['limit' => 200]);
        $this->set(compact('bobinasdeimpresion', 'empleados', 'cortadoras', 'bobinasdeextrusions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Bobinasdeimpresion id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bobinasdeimpresion = $this->Bobinasdeimpresions->get($id);
        if ($this->Bobinasdeimpresions->delete($bobinasdeimpresion)) {
            $this->Flash->success(__('The bobinasdeimpresion has been deleted.'));
        } else {
            $this->Flash->error(__('The bobinasdeimpresion could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
