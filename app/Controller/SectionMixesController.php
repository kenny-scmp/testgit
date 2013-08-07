<?php
/**
 * @property SectionMix $SectionMix
 */
 
class SectionMixesController extends AppController {
    public $scaffold;

    public function index() {
        $sectionMixes = $this->SectionMix->find('all', $this->SectionMix->_Pagination());
        $this->set(compact('sectionMixes'));
    }

    public function add() {
        if ($this->request->is('post')) {
            if ($this->SectionMix->saveAll($this->request->data, array('deep'=>true))) {
                $this->Session->setFlash(__('Section Mix saved'));
            } else {
                $this->Session->setFlash(implode("",array_column($this->SectionMix->validationErrors, 0)));
            }
            $this->redirect(array('action'=>'index'));
        } else {
            if ($this->request->is('ajax')) {
                $packages = $this->SectionMix->Package->find('all', $this->SectionMix->Package->_Pagination());
                $products = $this->SectionMix->Package->PackageProduct->Product->find('all');
                $channels = $this->SectionMix->Channel->find('list',array(
                    'conditions' => array(
                        'OR' => array(
                            array('Channel.parent_id' => '0'),
                            array('Channel.parent_id' => null)
                        )
                    )
                ));
                $this->set(compact('packages','channels','products'));
                $this->autoLayout = false;
            }
        }
    }
}
?>