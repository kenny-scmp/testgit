<?php
/**
 * @property ProductSection $ProductSection
 */
 
class ProductSectionsController extends AppController {
    public function index($product_id) {
        $product = $this->ProductSection->Product->findById($product_id);
        $sections = $this->ProductSection->Product->Section->findAllByProductCode($product['Product']['code']);
        $this->set(compact('product','sections'));
        if ($this->request->is('ajax')) {
            $this->autoLayout = false;
        }
    }

    /**
     * delete existing and add new records
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->ProductSection->deleteAll(array('product_id'=>$this->request->query['product_id']));
            $this->ProductSection->create();
            if ($this->ProductSection->saveAll($this->request->data)) {
                $this->Session->setFlash(__('Section saved'));
            } else {
                $this->Session->setFlash(implode("",array_column($this->ProductSection->validationErrors, 0)));
            }
            $this->redirect(array('controller'=>'products','action'=>'index'));
        }
    }

}
?>