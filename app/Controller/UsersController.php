<?php
/**
 * @property User $User
 */
class UsersController extends AppController {
    public $components = array('Paginator');

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->saveUser($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
    }

    public function index() {
        $this->Paginator->settings = $this->User->_Pagination();
        $users = $this->Paginator->paginate();
        $this->set(compact('users'));
    }

    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->User->deleteUser($id)) {
            $this->Session->setFlash('The User with id: ' . $id . ' has been deleted.');
            $this->redirect(array('action' => 'index'));
        }
    }

    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid User'));
        }
        $user = $this->User->findById($id);
        if (!$user) {
            throw new NotFoundException(__('Invalid User'));
        }
        $this->set(compact('user'));
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid User'));
        }

        $user= $this->User->findById($id);
        if (!$user) {
            throw new NotFoundException(__('Invalid User'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->User->id = $id;
            if ($this->User->saveUser($this->request->data)) {
                $this->Session->setFlash('Your post has been updated.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update your post.');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $user;
        }
    }
}
?>