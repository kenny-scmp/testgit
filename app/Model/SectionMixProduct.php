<?php
class SectionMixProduct extends AppModel {
    public $hasMany = array('SectionMixProductSection');
    public $belongsTo = array('Product');
}
?>