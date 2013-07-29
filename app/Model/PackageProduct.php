<?php
class PackageProduct extends AppModel {
    public $belongsTo = array('Product','Package');

    public function beforeSave($options = array()) {
        if (!empty($this->data[$this->alias]['weekday'])) {
            $this->data[$this->alias]['weekday'] = implode(",", $this->data[$this->alias]['weekday']);
        }
        return true;
    }

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