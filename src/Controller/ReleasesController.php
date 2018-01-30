<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Releases Controller
 *
 * @property \App\Model\Table\ReleasesTable $Releases
 *
 * @method \App\Model\Entity\Release[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReleasesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Partners']
        ];
        $releases = $this->paginate($this->Releases);

        $this->set(compact('releases'));
    }

    /**
     * View method
     *
     * @param string|null $id Release id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $release = $this->Releases->get($id, [
            'contain' => ['Partners', 'Authors', 'Tags', 'Graphics']
        ]);

        $this->set('release', $release);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $release = $this->Releases->newEntity();
        if ($this->request->is('post')) {
            $release = $this->Releases->patchEntity($release, $this->request->getData());
            if ($this->Releases->save($release)) {
                $this->Flash->success(__('The release has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The release could not be saved. Please, try again.'));
        }
        $partners = $this->Releases->Partners->find('list', ['limit' => 200]);
        $authors = $this->Releases->Authors->find('list', ['limit' => 200]);
        $tags = $this->Releases->Tags->find('list', ['limit' => 200]);
        $this->set(compact('release', 'partners', 'authors', 'tags'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Release id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $release = $this->Releases->get($id, [
            'contain' => ['Authors', 'Tags']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $release = $this->Releases->patchEntity($release, $this->request->getData());
            if ($this->Releases->save($release)) {
                $this->Flash->success(__('The release has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The release could not be saved. Please, try again.'));
        }
        $partners = $this->Releases->Partners->find('list', ['limit' => 200]);
        $authors = $this->Releases->Authors->find('list', ['limit' => 200]);
        $tags = $this->Releases->Tags->find('list', ['limit' => 200]);
        $this->set(compact('release', 'partners', 'authors', 'tags'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Release id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $release = $this->Releases->get($id);
        if ($this->Releases->delete($release)) {
            $this->Flash->success(__('The release has been deleted.'));
        } else {
            $this->Flash->error(__('The release could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
