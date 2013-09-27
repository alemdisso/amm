<?php

class Admin_PrizeController extends Zend_Controller_Action
{
    private $db;
    private $prizeMapper;
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
        $this->prizeMapper = new Author_Collection_PrizeMapper($this->db);
    }

   public function createAction()
    {
        // cria form
        $form = new Author_Form_PrizeCreate;
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $postData = $this->getRequest()->getPost();
            if ($form->isValid($postData)) {
                $newPrize = $form->process($postData);
                $this->_helper->getHelper('FlashMessenger')
                    ->addMessage($this->view->translate('#The record was successfully updated.'));
                $this->_redirect('/admin/work/detail/?id=' . $newPrize->getWork());
            } else {
                //form error: populate and go back
                $form->populate($postData);
                $this->view->form = $form;
            }
        } else {

            $data = $this->_request->getParams();
            try {
                $workId = $this->view->checkIdFromGet($data, 'work');
            } catch (Exception $e) {
                throw $e;
            }
            $element = $form->getElement('work');
            $element->setValue($workId);

            $this->view->pageTitle = $this->view->translate("#Create prize");
        }
    }
   public function editAction()
    {
        // cria form
        $form = new Author_Form_PrizeEdit;
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $postData = $this->getRequest()->getPost();
            if ($form->isValid($postData)) {
                $newPrize = $form->process($postData);
                $this->_helper->getHelper('FlashMessenger')
                    ->addMessage($this->view->translate('#The record was successfully updated.'));
                $this->_redirect('/admin/work/detail/?id=' . $newPrize->getWork());
            } else {
                //form error: populate and go back
                $form->populate($postData);
                $this->view->form = $form;
            }
        } else {

            $data = $this->_request->getParams();
            try {
                $id = $this->view->checkIdFromGet($data);
            } catch (Exception $e) {
                throw $e;
            }

            $prize = $this->prizeMapper->findById($id);

            $element = $form->getElement('id');
            $element->setValue($id);

            $element = $form->getElement('work');
            $element->setValue($prize->getWork());

            $element = $form->getElement('prize');
            $element->setValue($prize->getPrizeName());

            $element = $form->getElement('institution');
            $element->setValue($prize->getInstitutionName());

            $element = $form->getElement('category');
            $element->setValue($prize->getCategoryName());

            $element = $form->getElement('year');
            $element->setValue($prize->getYear());

            $this->view->pageTitle = $this->view->translate("#Create prize");
        }
    }

}