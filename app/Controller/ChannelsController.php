<?php

class ChannelsController extends AppController {
    public $components = array('RequestHandler');
    var $name = 'Channels';

    function index() {
        //$this->set('channels', $this->Channel->find('all'));
        $this->set('channels', $this->Channel->find('all', array(
                    'conditions' => array('Channel.parent_id' => 0))));
        //debug( $this->Channel->find('all'));
    }

    function add() {

        $this->Channel->create();
        if ($this->Channel->saveAll($this->request->data)) {

            $this->Session->setFlash('New Channel Saved');
        } else {
            $this->Session->setFlash('An Error Occured');
        }
        $this->redirect(array('action' => 'index'));
    }

    function addSubChannel() {

        $this->Channel->create();
        if ($this->Channel->saveAll($this->request->data)) {

            $this->Session->setFlash('New Channel Saved');
        } else {
            $this->Session->setFlash('An Error Occured');
        }
        $this->redirect(array('action' => 'index'));
    }

    function view($id = null) {
        $this->Channel->id = $id;
        $this->set('channel', $this->Channel->read());
    }

    function edit($id = null) {
        $this->Channel->id = $id;
        if (empty($this->data)) {
            $this->data = $this->Channel->read();
        } else {
            if ($this->Channel->save($this->data)) {
                $this->Session->setFlash('Your post has been updated.');
                $this->redirect(array('action' => 'index'));
            }
        }
    }

    function delete($id) {
        $this->Channel->delete($id);
        $this->Session->setFlash('The channel has been deleted.');
        $this->redirect(array('action' => 'index'));
    }

    function viewSubChannels($id = null) {
        $id = $this->request->is('ajax') ? $this->request->data['id'] : $id;

        $this->set('channels', $this->Channel->find('all', array(
                    'conditions' => array('Channel.parent_id' => $id))));

        $this->set('parentChannels', $this->Channel->find('all', array(
                    'conditions' => array('Channel.id' => $id))));


        $this->set('_serialize', 'channels');
    }


}

?>
