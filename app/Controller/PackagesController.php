<?php
/**
 * @property Package $Package
 */
 
class PackagesController extends AppController {
    public $components = array('RequestHandler');

    public function index() {
        $packages = $this->Package->find('all', $this->Package->_Pagination());
        $this->set(compact('packages'));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Package->create();
            if ($this->Package->saveAssociated($this->request->data)) {
                $this->Session->setFlash(__('The package has been saved'));
            } else {
                $this->Session->setFlash(implode("",array_column($this->ProductSection->validationErrors, 0)));
            }
            $this->redirect(array('action' => 'index'));
        } else {
            $products = $this->Package->PackageProduct->Product->find('all', $this->Package->PackageProduct->Product->_Pagination(array('recursive'=>'-1')));
            $this->set(compact('products'));
            if ($this->request->is('ajax')) {
                $this->autoLayout = false;
            }
        }
    }

    public function findAllBy() {
        if ($this->request->is('ajax')) {
            $package = $this->Package->findAllBy($this->request->data['by'], $this->request->data['val']);
            $this->set(compact('package'));
            $this->set('_serialize', 'package');
        }
    }
}
?>