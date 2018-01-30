<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Graphics Controller
 *
 * @property \App\Model\Table\GraphicsTable $Graphics
 *
 * @method \App\Model\Entity\Graphic[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GraphicsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Releases']
        ];
        $graphics = $this->paginate($this->Graphics);

        $this->set(compact('graphics'));
    }

    /**
     * View method
     *
     * @param string|null $id Graphic id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $graphic = $this->Graphics->get($id, [
            'contain' => ['Releases']
        ]);

        $this->set('graphic', $graphic);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $graphic = $this->Graphics->newEntity();
        if ($this->request->is('post')) {
            $graphic = $this->Graphics->patchEntity($graphic, $this->request->getData());
            if ($this->Graphics->save($graphic)) {
                $this->Flash->success(__('The graphic has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The graphic could not be saved. Please, try again.'));
        }
        $releases = $this->Graphics->Releases->find('list', ['limit' => 200]);
        $this->set(compact('graphic', 'releases'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Graphic id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $graphic = $this->Graphics->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $graphic = $this->Graphics->patchEntity($graphic, $this->request->getData());
            if ($this->Graphics->save($graphic)) {
                $this->Flash->success(__('The graphic has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The graphic could not be saved. Please, try again.'));
        }
        $releases = $this->Graphics->Releases->find('list', ['limit' => 200]);
        $this->set(compact('graphic', 'releases'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Graphic id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $graphic = $this->Graphics->get($id);
        if ($this->Graphics->delete($graphic)) {
            $this->Flash->success(__('The graphic has been deleted.'));
        } else {
            $this->Flash->error(__('The graphic could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
