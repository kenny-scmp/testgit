<?php
class Attachment extends AppModel {
    public $belongsTo = array(
        'User' => array(
            'className'    => 'User',
            'foreignKey'   => 'user_id'
        )
    );

    public function getFolderName($create=true) {
        $folder = date('Ymd').DS;
        $dir = WWW_ROOT.'files'.DS.$folder;
        if (!file_exists($dir) && $create) {
            mkdir($dir);
        }
        return $folder;
    }

    public function getPath($folder = null) {
        return isset($folder) ? WWW_ROOT.'files'.DS.$folder : WWW_ROOT.'files'.DS.$this->getFolderName(false);
    }

    public function getFile($id) {
        $attachment = $this->findById($id);
        if (!$attachment) {
            throw new NotFoundException(__('Invalid Attachment'));
        }
        $file = new File($this->getPath($attachment['Attachment']['foldername']).$attachment['Attachment']['filename']);
        return compact('file','attachment');
    }

   public function deleteByUser($user_id) {
       $attachments = $this->find('all',array('conditions'=>array('Attachment.user_id'=>$user_id)));
       foreach ($attachments as $i => $attachment) {
           $attachments[$i]['Attachment']['status'] = 2;
       }
       $this->saveAll($attachments);

       return true;
   }

    public function deleteById($id) {
        $attachment = $this->findById($id);
        $attachment['Attachment']['status'] = 2;
        $this->save($attachment);

        return true;
    }
}
?>