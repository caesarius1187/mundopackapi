<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Bobinasdecortes Controller
 *
 * @property \App\Model\Table\BobinasdecortesTable $Bobinasdecortes
 *
 * @method \App\Model\Entity\Bobinasdecorte[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BobinasdecortesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Empleados', 'Impresoras'],
        ];
        $bobinasdecortes = $this->paginate($this->Bobinasdecortes);

        $this->set(compact('bobinasdecortes'));
    }

    /**
     * View method
     *
     * @param string|null $id Bobinasdecorte id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bobinasdecorte = $this->Bobinasdecortes->get($id, [
            'contain' => ['Empleados', 'Impresoras', 'Bobinascorteorigens'],
        ]);

        $this->set('bobinasdecorte', $bobinasdecorte);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $bobinasdecorte = $this->Bobinasdecortes->newEntity();
        if ($this->request->is('post')) {
            $bobinasdecorte = $this->Bobinasdecortes->patchEntity($bobinasdecorte, $this->request->getData());
            if ($this->Bobinasdecortes->save($bobinasdecorte)) {
                $this->Flash->success(__('The bobinasdecorte has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bobinasdecorte could not be saved. Please, try again.'));
        }
        $empleados = $this->Bobinasdecortes->Empleados->find('list', ['limit' => 200]);
        $impresoras = $this->Bobinasdecortes->Impresoras->find('list', ['limit' => 200]);
        $this->set(compact('bobinasdecorte', 'empleados', 'impresoras'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Bobinasdecorte id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bobinasdecorte = $this->Bobinasdecortes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bobinasdecorte = $this->Bobinasdecortes->patchEntity($bobinasdecorte, $this->request->getData());
            if ($this->Bobinasdecortes->save($bobinasdecorte)) {
                $this->Flash->success(__('The bobinasdecorte has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bobinasdecorte could not be saved. Please, try again.'));
        }
        $empleados = $this->Bobinasdecortes->Empleados->find('list', ['limit' => 200]);
        $impresoras = $this->Bobinasdecortes->Impresoras->find('list', ['limit' => 200]);
        $this->set(compact('bobinasdecorte', 'empleados', 'impresoras'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Bobinasdecorte id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bobinasdecorte = $this->Bobinasdecortes->get($id);
        if ($this->Bobinasdecortes->delete($bobinasdecorte)) {
            $this->Flash->success(__('The bobinasdecorte has been deleted.'));
        } else {
            $this->Flash->error(__('The bobinasdecorte could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
