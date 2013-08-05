<?php
class Product extends AppModel {
    public $hasMany = array(
        'ProductSection',
        'PackageProduct',
        'ProductSpecialExec',
        'Section' => array(
            'foreignKey' => false,
            'conditions' => array('Section.product_code'=>'Product.code')
        )
    );

    public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Product name is required'
            )
        ),
        'code' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Product name is required'
            )
        ),
        'type' => array(
            'valid' => array(
                'rule' => array('inList', array('1','2','3')),
                'message' => 'Please enter a valid type',
                'allowEmpty' => false
            )
        )
    );

    public function findAllBy($by = null, $val = null) {
        if ($by == 'type') {
            $product = $this->findAllByType($val);
        } else if ($by == 'id') {
            $product = $this->find('all', array(
                'order'=> array('name'=>'asc'),
                'recursive' => 2,
                'conditions' => array('Product.id'=>$val)
            ));
        }

        return $product;
    }

    public function beforeSave($options = array()) {
        if (!empty($this->data['Product']['weekday'])) {
            $this->data['Product']['weekday'] = implode(",", $this->data['Product']['weekday']);
        }
        return true;
    }

    public function afterFind($results, $primary = false) {
        if (!empty($results['weekday'])) {
            $results['weekday'] = explode(',',$results['weekday']);
        }
        foreach($results as $i=>$result) {
            if (!empty($result[$this->alias]['weekday']) && gettype($result[$this->alias]['weekday'])=='string') {
                $results[$i][$this->alias]['weekday'] = explode(',',$result[$this->alias]['weekday']);
            }
        }
        return $results;
    }

    public function _Pagination($customParams = array()) {
        $conditions = array('status'=>'1');
        $params = array(
            'order'=> array('name'=>'asc'),
            'recursive' => 2
        );
        $params = array_merge($params, $customParams);
        $params = Hash::insert($params, 'conditions', $conditions);

        return $params;
    }
}
?>