<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Extrusoras Controller
 *
 * @property \App\Model\Table\ExtrusorasTable $Extrusoras
 *
 * @method \App\Model\Entity\Extrusora[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ExtrusorasController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $extrusoras = $this->paginate($this->Extrusoras);

        $this->set(compact('extrusoras'));
    }

    /**
     * View method
     *
     * @param string|null $id Extrusora id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $extrusora = $this->Extrusoras->get($id, [
            'contain' => [
                'Ordenots'=>[
                    'Ordenesdetrabajos'=>['Ordenesdepedidos'],
                    'sort'=>'Ordenots.prioridad ASC'
                ]
            ],
        ]);

        $this->set([
            'extrusora' => $extrusora,
            '_serialize' => ['extrusora']
        ]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $extrusora = $this->Extrusoras->newEntity();
        if ($this->request->is('post')) {
            $extrusora = $this->Extrusoras->patchEntity($extrusora, $this->request->getData());
            if ($this->Extrusoras->save($extrusora)) {
                $this->Flash->success(__('The extrusora has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The extrusora could not be saved. Please, try again.'));
        }
        $this->set(compact('extrusora'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Extrusora id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $extrusora = $this->Extrusoras->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $extrusora = $this->Extrusoras->patchEntity($extrusora, $this->request->getData());
            if ($this->Extrusoras->save($extrusora)) {
                $this->Flash->success(__('The extrusora has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The extrusora could not be saved. Please, try again.'));
        }
        $this->set(compact('extrusora'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Extrusora id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $extrusora = $this->Extrusoras->get($id);
        if ($this->Extrusoras->delete($extrusora)) {
            $this->Flash->success(__('The extrusora has been deleted.'));
        } else {
            $this->Flash->error(__('The extrusora could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
