<?php
class Section extends AppModel {
    public $hasMany = 'ProductSection';
    public $belongsTo = array(
        'Product' => array(
            'foreignKey' => false,
            'conditions' => array('Section.product_code'=>'Product.code')
        )
    );

    public function afterFind($results, $primary = false) {
        foreach($results as $i=>$result) {
            if (!empty($result[$this->alias]['weekday'])) {
                $results[$i][$this->alias]['weekday'] = explode(',',$result[$this->alias]['weekday']);
            }
        }
        return $results;
    }
}
?>