<?php
class Package extends AppModel {
    //public $hasAndBelongsToMany = 'Product';
    public $hasMany = 'PackageProduct';

    public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Product name is required'
            )
        )
    );

    public function findAllBy($by = null, $val = null) {
        if ($by == 'id') {
            $package = $this->find('all', array(
                'order'=> array('name'=>'asc'),
                'recursive' => 4,
                'conditions' => array('Package.id'=>$val)
            ));
        }

        return $package;
    }

    public function _Pagination() {
        $conditions = array('status'=>'1');
        $params = array(
            'order'=> array('created'=>'desc'),
            'recursive' => 2
        );
        $params = Hash::insert($params, 'conditions', $conditions);

        return $params;
    }

}
?>