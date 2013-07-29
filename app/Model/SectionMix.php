<?php
class SectionMix extends AppModel {
    public $belongsTo = array('Package','Channel');

    public $validate = array(
        'package_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Package is required'
            )
        ),
        'channel_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Channel is required'
            )
        )
    );

    public function _Pagination() {
        $conditions = array('SectionMix.status'=>'1');
        $params = array(
            'order'=> array('SectionMix.created'=>'desc')
        );
        $params = Hash::insert($params, 'conditions', $conditions);

        return $params;
    }
}
?>