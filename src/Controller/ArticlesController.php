<?php
namespace App\Controller;

use Cake\Utility\Text;

class ArticlesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->loadComponent('Flash');
    }
    public function index()
    {
        $this->loadComponent('Paginator');
        $articles = $this->Paginator->paginate(
            $this->Articles->find()
        );
        $this->set(compact('articles'));

    }

    public function view($slug = null)
    {
        $article = $this->Articles->findBySlug($slug)->firstOrFail();
        $this->set(compact('article'));
    }

    public function create()
    {
        $article = $this->Articles->newEntity();
        if($this->request->is('post')){
            $article = $this->Articles->patchEntity(
                $article,
                $this->request->getData()
            );

            //$article->user_id = 1;

            $article->slug = Text::slug(
                strtolower(
                    substr($article->title, 0, 191)
                )
            );

            if($this->Articles->save($article)) {
                $this->Flash->success('Your article has been saved');
                return $this->redirect(['action'=>'index']);
            }
            $this->Flash->error('Unable to add your article');

        }
        $this->set(compact('article'));
    }

    public function edit($id = null)
    {
        $article = $this->Articles->findById($id)->firstOrFail();
        if($this->request->is(['post', 'put'])){
            $article = $this->Articles->patchEntity(
                $article, $this->request->getData()
        );

        if($this->Articles->save($article)){
            $this->Flash->success('Your article has been updated'
            );

            return $this->redirect(['action'=>'index']);
        }
        $this->Flash->error('An error has occured');
        }
        $this->set('article', $article);
    }

    public function delete($id=null){
        $this->request->allowMethod(['post', 'delete']);

        $article = $this->Articles->findById($id)->firstOrFail();
        if($this->Articles->delete($article)){
            $this->Flash->success("The article {$article->title} has been deleted.");

            return $this->redirect(['action'=>'index']);
        }
        $this->Flash->error(
            "Something bad happened."
        );

    }

}
