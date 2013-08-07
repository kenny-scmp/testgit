<?php
/**
 * @property Section $Section
 */
class SectionsController extends AppController {
    public $components = array('Paginator');
	public $scaffold;
    public function add() {
        if ($this->request->is('post')){
            $this->Section->save($this->request->data);
            $this->Session->setFlash('Data Saved..');
            $this->redirect(array('action'=>'index'));
        } else {
            $this->autoLayout = false;
        }
    }

    public function index() {
        $this->Paginator->settings = array('limit'=>10);
        $sections = $this->Paginator->paginate();
        $this->set(compact(('sections')));
    }
}
