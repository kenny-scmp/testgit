<?php
/**
 * @property Attachment $Attachment
 */
 class AttachmentsController extends AppController {
    public function download($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid Attachment'));
        }
        $fileObj = $this->Attachment->getFile($id);
        $this->response->type($fileObj['attachment']['Attachment']['type']);
        $this->response->file($fileObj['file']->path, array('download' => true, 'name' => $fileObj['attachment']['Attachment']['name']));
        return $this->response;
    }
}
?>