<?php
class ProductSection extends AppModel {
    public $belongsTo = array('Product','Section');

    public function afterFind($results, $primary = false) {
        foreach($results as $i=>$result) {
            if (!empty($result[$this->alias]['weekday'])) {
                $results[$i][$this->alias]['weekday'] = explode(',',$result[$this->alias]['weekday']);
            }
            if (!empty($result[$this->alias]['section_product_id'])) {
                $product = $this->Product->find('first', array('conditions'=>array('id'=>$result[$this->alias]['section_product_id'])));
                $results[$i][$this->alias]['SectionProduct'] = $product;
            }
        }

        return $results;
    }

    public function beforeSave($options = array()) {
        if (!empty($this->data[$this->alias]['weekday'])) {
            $this->data[$this->alias]['weekday'] = implode(",", $this->data[$this->alias]['weekday']);
        }
        return true;
    }
}
?>