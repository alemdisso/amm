<?php

class Admin_PostController extends Zend_Controller_Action
{
    private $db;
    private $postMapper;

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

        $this->postMapper = new Moxca_Blog_PostMapper($this->db);
    }

   public function createAction()
    {
        // cria form
        $form = new Moxca_Form_PostCreate;
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $postData = $this->getRequest()->getPost();
            if ($form->isValid($postData)) {
                $newPost = $form->process($postData);
                $this->_helper->getHelper('FlashMessenger')
                    ->addMessage($this->view->translate('#The record was successfully updated.'));
                $this->_redirect('/admin/index/list-posts');
            } else {
                //form error: populate and go back
                $form->populate($postData);
                $this->view->form = $form;
            }
        } else {

            $this->view->pageTitle = $this->view->translate("#Create post");
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

        $postObj = $this->postMapper->findById($id);

        $data = array(
            'id' => $id,
            'uri' => $postObj->getUri(),
            'title' => $postObj->getTitle(),
            'content' => $postObj->getContent(),
        );

        $this->view->pageData = $data;

    }

   public function editAction()
    {
        // cria form
        $form = new Moxca_Form_PostEdit;
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $postData = $this->getRequest()->getPost();
            if ($form->isValid($postData)) {
                $newPost = $form->process($postData);
                $this->_helper->getHelper('FlashMessenger')
                    ->addMessage($this->view->translate('#The record was successfully updated.'));
                $this->_redirect('/admin/index/list-posts');
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

            $postObj = $this->postMapper->findById($id);

            $element = $form->getElement('title');
            $element->setValue($postObj->getTitle());

            $element = $form->getElement('status');
            $element->setValue($postObj->getStatus());

            $element = $form->getElement('category');
            $element->setValue($postObj->getCategory());

            $element = $form->getElement('content');
            $element->setValue($postObj->getContent());

            $this->view->pageTitle = $this->view->translate("#Edit post");
        }
    }

    public function removeAction()
    {
        $form = new Moxca_Form_PostRemove();
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $postData = $this->getRequest()->getPost();
            if ($form->isValid($postData)) {
                $submitButton = $form->getUnfilteredValue('Submit');

                if ($submitButton) {
                    $id = $form->process($postData);
                    $this->_helper->getHelper('FlashMessenger')
                        ->addMessage($this->view->translate('#The record was successfully removed.'));
                    $this->_redirect('/admin/index/list-posts');
                } else {
                    $id = $postData['id'];
                    $this->_redirect('/admin/post/detail/?id=' . $id);
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

            $postData = array();
            $postObj = $this->postMapper->findById($id);
            $idField = $form->getElement('id');
            $idField->setValue($id);
            $postData = array(
                'id'   => $id,
                'title' => $postObj->getTitle(),
            );
            $this->view->pageData = $postData;

            $this->view->pageTitle = $this->view->translate("#Remove post");

        }
    }

}