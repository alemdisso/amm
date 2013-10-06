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

            $data = $this->_request->getParams();
            try {
                $postId = $this->view->checkIdFromGet($data, 'post');
            } catch (Exception $e) {
                throw $e;
            }

            $this->view->pageTitle = $this->view->translate("#Create post");
        }
    }

}