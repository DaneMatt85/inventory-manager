<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Skus Controller
 *
 * @property \App\Model\Table\SkusTable $Skus
 *
 * @method \App\Model\Entity\Skus[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SkusController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Products']
        ];
        $skus = $this->paginate($this->Skus);

        $this->set(compact('skus'));
    }

    /**
     * View method
     *
     * @param string|null $id Skus id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $skus = $this->Skus->get($id, [
            'contain' => ['Products']
        ]);

        $this->set('skus', $skus);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $skus = $this->Skus->newEntity();
        if ($this->request->is('post')) {
            $skus = $this->Skus->patchEntity($skus, $this->request->getData());
            if ($this->Skus->save($skus)) {
                $this->Flash->success(__('The skus has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The skus could not be saved. Please, try again.'));
        }
        $products = $this->Skus->Products->find('list', ['limit' => 200]);
        $this->set(compact('skus', 'products'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Skus id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $skus = $this->Skus->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $skus = $this->Skus->patchEntity($skus, $this->request->getData());
            if ($this->Skus->save($skus)) {
                $this->Flash->success(__('The skus has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The skus could not be saved. Please, try again.'));
        }
        $products = $this->Skus->Products->find('list', ['limit' => 200]);
        $this->set(compact('skus', 'products'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Skus id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $skus = $this->Skus->get($id);
        if ($this->Skus->delete($skus)) {
            $this->Flash->success(__('The skus has been deleted.'));
        } else {
            $this->Flash->error(__('The skus could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
