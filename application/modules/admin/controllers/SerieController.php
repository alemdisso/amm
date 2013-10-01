<?php

class Admin_SerieController extends Zend_Controller_Action
{
    private $db;
    private $serieMapper;
    private $workMapper;

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

        $this->workMapper = new Author_Collection_WorkMapper($this->db);
        $this->serieMapper = new Author_Collection_SerieMapper($this->db);
    }

   public function createAction()
    {
        $this->_helper->layout->disableLayout();
        // cria form
        $form = new Author_Form_SerieCreate;
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $postData = $this->getRequest()->getPost();
            if ($form->isValid($postData)) {
                $newSerie = $form->process($postData);
                $this->_helper->getHelper('FlashMessenger')
                    ->addMessage($this->view->translate('#The record was successfully updated.'));
                $this->_redirect('/admin/serie/sucess/?id=' . $newSerie->getId());
                //$this->_helper->viewRenderer->setNoRender(TRUE);

            } else {
                //form error: populate and go back
                $form->populate($postData);
                $this->view->form = $form;
            }
        } else {
            $element = $form->getElement('serie');
            $this->view->pageTitle = $this->view->translate("#Create serie");
        }
    }



    public function sucessAction()
    {

        $this->_helper->layout->disableLayout();
        $data = $this->_request->getParams();
        try {
            $id = $this->view->checkIdFromGet($data);
        } catch (Exception $e) {
            throw $e;
        }

        $this->view->id = $id;



    }
}