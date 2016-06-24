<?php
namespace Candidates\Backoffice\Controllers;

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Candidates\Common\Models\Questions;


class QuestionsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for questions
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Candidates\Common\Models\Questions', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "id";

        $questions = Questions::find($parameters);
        if (count($questions) == 0) {
            $this->flash->notice("The search did not find any questions");

            $this->dispatcher->forward(array(
                "controller" => "questions",
                "action" => "index"
            ));

            return;
        }

        $paginator = new Paginator(array(
            'data' => $questions,
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
     * Edits a question
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $question = Questions::findFirstByid($id);
            if (!$question) {
                $this->flash->error("question was not found");

                $this->dispatcher->forward(array(
                    'controller' => "questions",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $question->id;

            $this->tag->setDefault("id", $question->id);
            $this->tag->setDefault("question", $question->question);
            $this->tag->setDefault("typeId", $question->typeId);
            $this->tag->setDefault("deleted", $question->deleted);
            
        }
    }

    /**
     * Creates a new question
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "questions",
                'action' => 'index'
            ));

            return;
        }

        $question = new Questions();
        $question->question = $this->request->getPost("question");
        $question->typeId = $this->request->getPost("typeId");
        $question->deleted = $this->request->getPost("deleted");
        

        if (!$question->save()) {
            foreach ($question->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "questions",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("question was created successfully");

        $this->dispatcher->forward(array(
            'controller' => "questions",
            'action' => 'index'
        ));
    }

    /**
     * Saves a question edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "questions",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $question = Questions::findFirstByid($id);

        if (!$question) {
            $this->flash->error("question does not exist " . $id);

            $this->dispatcher->forward(array(
                'controller' => "questions",
                'action' => 'index'
            ));

            return;
        }

        $question->question = $this->request->getPost("question");
        $question->typeId = $this->request->getPost("typeId");
        $question->deleted = $this->request->getPost("deleted");
        

        if (!$question->save()) {

            foreach ($question->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "questions",
                'action' => 'edit',
                'params' => array($question->id)
            ));

            return;
        }

        $this->flash->success("question was updated successfully");

        $this->dispatcher->forward(array(
            'controller' => "questions",
            'action' => 'index'
        ));
    }

    /**
     * Deletes a question
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $question = Questions::findFirstByid($id);
        if (!$question) {
            $this->flash->error("question was not found");

            $this->dispatcher->forward(array(
                'controller' => "questions",
                'action' => 'index'
            ));

            return;
        }

        if (!$question->delete()) {

            foreach ($question->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "questions",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("question was deleted successfully");

        $this->dispatcher->forward(array(
            'controller' => "questions",
            'action' => "index"
        ));
    }

}
