<?php
/**
 * @property Product $Product
 */

class ProductsController extends AppController {
    public $components = array('RequestHandler');

    public function index() {
        $products = $this->Product->find('all', $this->Product->_Pagination());
        $this->set(compact('products'));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Product->create();
            if ($this->Product->save($this->request->data)) {
                $this->Session->setFlash(__('Product saved'));
            } else {
                $this->Session->setFlash(implode("",array_column($this->Product->validationErrors, 0)));
            }
            $this->redirect(array('action'=>'index'));
        } else {
            if ($this->request->is('ajax')) {
                $this->autoLayout = false;
            }
        }
    }

    public function findAllBy() {
        if ($this->request->is('ajax')) {
            $product = $this->Product->findAllBy($this->request->data['by'], $this->request->data['val']);
            $this->set(compact('product'));
            $this->set('_serialize', 'product');
        }
    }
}
?>