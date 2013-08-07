<?php
/**
 * @property SpecialExec $SpecialExec
 */
 
class SpecialExecsController extends AppController {
    public $components = array('Paginator');
    public $scaffold;

    public function index() {
        $this->Paginator->settings = array('limit'=>10);
        $specialExecs = $this->Paginator->paginate();
        $this->set(compact(('specialExecs')));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->SpecialExec->save($this->request->data);
            $this->Session->setFlash('Data Saved..');
            $this->redirect(array('action'=>'index'));
        } else {
            $this->autoLayout = false;
        }
    }
}
?>