<?php
class User extends AppModel {
    public $hasMany = array(
        'Attachment' => array(
            'className' => 'Attachment',
            'foreignKey' => 'user_id',
            'conditions' => array('Attachment.status' => '1'),
            'order' => 'Attachment.created DESC'
        )
    );
    public $belongsTo = array(
        'Attachment' => array(
            'className' => 'Attachment',
            'foreignKey' => 'attachment_id'
        )
    );

    public $validate = array(
        'username' => array(
            'email' => array(
                'rule' => 'email',
                'required' => true,
                'message' => 'user name error message',
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('minLength','6'),
                'message' => 'A password is require a min-length: 6'
            )
        )
    );

    function deleteUser($id) {
        $user = $this->findById($id);
        $user['User']['status'] = 2;
        if ($this->save($user)) {
            $this->Attachment->deleteByUser($id);
        } else {
            return false;
        }
        return true;
    }
    
    function saveUser($data) {
        if (!empty($data['User']['attachment']) && is_uploaded_file($data['User']['attachment']['tmp_name'])) {
            $file = new File($data['User']['attachment']['tmp_name']);
            $data['Attachment'][0]['name'] = $data['User']['attachment']['name'];
            $data['Attachment'][0]['filename'] = String::uuid();
            $data['Attachment'][0]['foldername'] = $this->Attachment->getFolderName();
            $data['Attachment'][0]['type'] = $data['User']['attachment']['type'];
            $data['Attachment'][0]['size'] = $data['User']['attachment']['size'];
            if (!move_uploaded_file($data['User']['attachment']['tmp_name'], $this->Attachment->getPath($data['Attachment'][0]['foldername']) . $data['Attachment'][0]['filename'])) {
                return false;
            }

            if (isset($data['User']['attachment_id'])) {
                $this->Attachment->deleteById($data['User']['attachment_id']);
            }
        }
        if (!$this->saveAssociated($data)) {
            return false;
        }
        $data['User']['attachment_id'] = $this->Attachment->id;
        return $this->save($data);
    }

    public function _Pagination() {
        $conditions = array('User.status'=>1);
        $params = array(
            'limit'=> 10,
            'order'=> array('User.created'=>'desc')
        );
        $params = Hash::insert($params, 'conditions', $conditions);

        return $params;
    }
}
?>