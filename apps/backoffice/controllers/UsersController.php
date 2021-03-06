<?php
namespace Candidates\Backoffice\Controllers;

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Candidates\Common\Models\Users;


class UsersController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->tag->prependTitle('Users');
        $numberPage = 1;

        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Candidates\Common\Models\Users', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
            $this->persistent->parameters = null;
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "id";

        $users = Users::find($parameters);
        if (count($users) == 0) {
            $this->flash->notice("The search did not find any users");
        }

        $paginator = new Paginator(array(
            'data' => $users,
            'limit'=> 10,
            'page' => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a user
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $user = Users::findFirstByid($id);
            if (!$user) {
                $this->flash->error("user was not found");

                $this->dispatcher->forward(array(
                    'controller' => "users",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $user->id;

            $this->tag->setDefault("id", $user->id);
            $this->tag->setDefault("username", $user->username);
            $this->tag->setDefault("email", $user->email);
            $this->tag->setDefault("password", $user->password);
            $this->tag->setDefault("profileId", $user->profileId);
            $this->tag->setDefault("banned", $user->banned);
            $this->tag->setDefault("suspended", $user->suspended);
            $this->tag->setDefault("deleted", $user->deleted);
            
        }
    }

    /**
     * Creates a new user
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "users",
                'action' => 'index'
            ));

            return;
        }

        $user = new Users();
        $user->username = $this->request->getPost("username");
        $user->email = $this->request->getPost("email", "email");
        $user->password = $this->request->getPost("password");
        $user->profileId = 1;
        

        if (!$user->save()) {
            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "users",
                'action' => 'new'
            ));

            return;
        }

//        $this->dispatcher->forward(array(
//            'controller' => "users",
//            'action' => 'index'
//        ));
        $this->response->redirect('users/index');
        $this->flash->success("user was created successfully");
        $this->view->disable();
    }

    /**
     * Saves a user edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "users",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $user = Users::findFirstByid($id);

        if (!$user) {
            $this->flash->error("user does not exist " . $id);

            $this->dispatcher->forward(array(
                'controller' => "users",
                'action' => 'index'
            ));

            return;
        }

        $user->username = $this->request->getPost("username");
        $user->email = $this->request->getPost("email", "email");
        $user->password = $this->request->getPost("password");
        $user->profileId = $this->request->getPost("profileId");
        $user->banned = $this->request->getPost("banned");
        $user->suspended = $this->request->getPost("suspended");
        $user->deleted = $this->request->getPost("deleted");
        

        if (!$user->save()) {

            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "users",
                'action' => 'edit',
                'params' => array($user->id)
            ));

            return;
        }

        $this->flash->success("user was updated successfully");

        $this->dispatcher->forward(array(
            'controller' => "users",
            'action' => 'index'
        ));
    }

    /**
     * Deletes a user
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $user = Users::findFirstByid($id);
        if (!$user) {
            $this->flash->error("user was not found");

            $this->dispatcher->forward(array(
                'controller' => "users",
                'action' => 'index'
            ));

            return;
        }

        if (!$user->delete()) {

            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "users",
                'action' => 'index'
            ));

            return;
        }

        $this->flash->success("user was deleted successfully");

        $this->dispatcher->forward(array(
            'controller' => "users",
            'action' => "index"
        ));
    }

}
