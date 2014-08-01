<?php

class Admin_QuestionController extends Zend_Controller_Action
{
    private $db;
    private $questionMapper;

    public function preDispatch()
    {
        try {
            $checker = new Moxca_Access_PrivilegeChecker();
        } catch (Exception $e) {
            throw $e;
        }
        $this->view->pageTitle = "";
    }

    public function init()
    {
        $this->db = Zend_Registry::get('db');

        $layoutHelper = $this->_helper->getHelper('Layout');
        $this->view->setNestedLayout($layoutHelper, 'inner_admin');

        $this->questionMapper = new Moxca_Faq_QuestionMapper($this->db);
    }

   public function createAction()
    {
        // cria form
        $form = new Moxca_Form_QuestionCreate;
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $postData = $this->getRequest()->getPost();
            if ($form->isValid($postData)) {
                $newQuestion = $form->process($postData);
                $this->_helper->getHelper('FlashMessenger')
                    ->addMessage($this->view->translate('#The record was successfully updated.'));
                $this->_redirect('/admin/index/list-questions');
            } else {
                //form error: populate and go back
                $form->populate($postData);
                $this->view->form = $form;
            }
        } else {

            $this->view->pageTitle = $this->view->translate("#Create question");
        }
    }

    public function detailAction()
    {

        $data = $this->_request->getParams();
        try {
            $id = $this->view->checkIdFromGet($data);
        } catch (Exception $e) {
            throw $e;
        }

        $questionObj = $this->questionMapper->findById($id);

        $data = array(
            'id' => $id,
            'uri' => $questionObj->getUri(),
            'title' => $questionObj->getTitle(),
            'question' => $questionObj->getQuestion(),
            'answer' => $questionObj->getAnswer(),
            'status' => $questionObj->getStatus(),
            'rank' => $questionObj->getRank(),
        );

        $this->view->pageData = $data;

    }

   public function editAction()
    {
        // cria form
        $form = new Moxca_Form_QuestionEdit;
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $postData = $this->getRequest()->getPost();
            if ($form->isValid($postData)) {
                $newQuestion = $form->process($postData);
                $this->_helper->getHelper('FlashMessenger')
                    ->addMessage($this->view->translate('#The record was successfully updated.'));
                $this->_redirect('/admin/index/list-questions');
            } else {
                //form error: populate and go back
                $form->populate($postData);
                $this->view->form = $form;
            }
        } else {

            $data = $this->_request->getParams();
            try {
                $id = $this->view->checkIdFromGet($data, 'id');
            } catch (Exception $e) {
                throw $e;
            }

            $element = $form->getElement('id');
            $element->setValue($id);

            $questionObj = $this->questionMapper->findById($id);

            $element = $form->getElement('title');
            $element->setValue($questionObj->getTitle());

            $element = $form->getElement('question');
            $element->setValue($questionObj->getQuestion());

            $element = $form->getElement('answer');
            $element->setValue($questionObj->getAnswer());

            $element = $form->getElement('rank');
            $element->setValue($questionObj->getRank());

            $this->view->pageTitle = $this->view->translate("#Edit question");
        }
    }

    public function removeAction()
    {
        $form = new Moxca_Form_QuestionRemove();
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $pageData = $this->getRequest()->getPost();
            if ($form->isValid($pageData)) {
                $submitButton = $form->getUnfilteredValue('Submit');

                if ($submitButton) {
                    $id = $form->process($pageData);
                    $this->_helper->getHelper('FlashMessenger')
                        ->addMessage($this->view->translate('#The record was successfully removed.'));
                    $this->_redirect('/admin/index/list-questions');
                } else {
                    $id = $pageData['id'];
                    $this->_redirect('/admin/question/detail/?id=' . $id);
                }
            } else {
                //form error: populate and go back
                $this->view->form = $form;
            }
        } else {
            // GET

            $data = $this->_request->getParams();
            try {
                $id = $this->view->checkIdFromGet($data);
            } catch (Exception $e) {
                throw $e;
            }

            $pageData = array();
            $questionObj = $this->questionMapper->findById($id);
            $idField = $form->getElement('id');
            $idField->setValue($id);
            $pageData = array(
                'id'   => $id,
                'title' => $questionObj->getTitle(),
            );
            $this->view->pageData = $pageData;

            $this->view->pageTitle = $this->view->translate("#Remove question");

        }
    }

}