<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Bobinascorteorigens Controller
 *
 * @property \App\Model\Table\BobinascorteorigensTable $Bobinascorteorigens
 *
 * @method \App\Model\Entity\Bobinascorteorigen[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BobinascorteorigensController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Bobinasdeimpresions', 'Bobinasdecortes', 'Bobinasdeextrusions'],
        ];
        $bobinascorteorigens = $this->paginate($this->Bobinascorteorigens);

        $this->set(compact('bobinascorteorigens'));
    }

    /**
     * View method
     *
     * @param string|null $id Bobinascorteorigen id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bobinascorteorigen = $this->Bobinascorteorigens->get($id, [
            'contain' => ['Bobinasdeimpresions', 'Bobinasdecortes', 'Bobinasdeextrusions'],
        ]);

        $this->set('bobinascorteorigen', $bobinascorteorigen);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $bobinascorteorigen = $this->Bobinascorteorigens->newEntity();
        if ($this->request->is('post')) {
            $bobinascorteorigen = $this->Bobinascorteorigens->patchEntity($bobinascorteorigen, $this->request->getData());
            if ($this->Bobinascorteorigens->save($bobinascorteorigen)) {
                $this->Flash->success(__('The bobinascorteorigen has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bobinascorteorigen could not be saved. Please, try again.'));
        }
        $bobinasdeimpresions = $this->Bobinascorteorigens->Bobinasdeimpresions->find('list', ['limit' => 200]);
        $bobinasdecortes = $this->Bobinascorteorigens->Bobinasdecortes->find('list', ['limit' => 200]);
        $bobinasdeextrusions = $this->Bobinascorteorigens->Bobinasdeextrusions->find('list', ['limit' => 200]);
        $this->set(compact('bobinascorteorigen', 'bobinasdeimpresions', 'bobinasdecortes', 'bobinasdeextrusions'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Bobinascorteorigen id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bobinascorteorigen = $this->Bobinascorteorigens->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bobinascorteorigen = $this->Bobinascorteorigens->patchEntity($bobinascorteorigen, $this->request->getData());
            if ($this->Bobinascorteorigens->save($bobinascorteorigen)) {
                $this->Flash->success(__('The bobinascorteorigen has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bobinascorteorigen could not be saved. Please, try again.'));
        }
        $bobinasdeimpresions = $this->Bobinascorteorigens->Bobinasdeimpresions->find('list', ['limit' => 200]);
        $bobinasdecortes = $this->Bobinascorteorigens->Bobinasdecortes->find('list', ['limit' => 200]);
        $bobinasdeextrusions = $this->Bobinascorteorigens->Bobinasdeextrusions->find('list', ['limit' => 200]);
        $this->set(compact('bobinascorteorigen', 'bobinasdeimpresions', 'bobinasdecortes', 'bobinasdeextrusions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Bobinascorteorigen id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bobinascorteorigen = $this->Bobinascorteorigens->get($id);
        if ($this->Bobinascorteorigens->delete($bobinascorteorigen)) {
            $this->Flash->success(__('The bobinascorteorigen has been deleted.'));
        } else {
            $this->Flash->error(__('The bobinascorteorigen could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
