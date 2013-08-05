<?php
class SectionMixProductSection extends AppModel {
    public $belongsTo = array(
        'SectionMixProduct',
        'Section',
        'SectionProduct' => array(
            'className' => 'Product',
            'foreignKey' => 'section_product_id'
        )
    );
}
?>