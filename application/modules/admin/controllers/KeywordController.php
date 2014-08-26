<?php

class Admin_KeywordController extends Zend_Controller_Action
{
    private $db;
    private $taxonomyMapper;
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
        $this->taxonomyMapper = new Author_Collection_TaxonomyMapper($this->db);
    }

   public function addAction()
    {
        // cria form
        $form = new Author_Form_KeywordAdd;
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $postData = $this->getRequest()->getPost();
            if ($form->isValid($postData)) {
                $workObj = $form->process($postData);
                $this->_helper->getHelper('FlashMessenger')
                    ->addMessage($this->view->translate('#The record was successfully updated.'));
                $this->_redirect('/admin/work/detail/?id=' . $workObj->getId());
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

            $this->view->pageTitle = $this->view->translate("#Create keyword");
        }
    }

    public function editAction()
    {
        // cria form
        $form = new Author_Form_KeywordEdit;
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $postData = $this->getRequest()->getPost();
            if ($form->isValid($postData)) {
                $newKeyword = $form->process($postData);
                $this->_helper->getHelper('FlashMessenger')
                    ->addMessage($this->view->translate('#The record was successfully updated.'));
                $this->_redirect('/admin/work/detail/?id=' . $newKeyword->getWork());
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

            $keyword = $this->taxonomyMapper->findById($id);

            $element = $form->getElement('id');
            $element->setValue($id);

            $element = $form->getElement('work');
            $element->setValue($keyword->getWork());

            $element = $form->getElement('keyword');
            $element->setValue($keyword->getKeywordName());

            $element = $form->getElement('institution');
            $element->setValue($keyword->getInstitutionName());

            $element = $form->getElement('category');
            $element->setValue($keyword->getCategoryName());

            $element = $form->getElement('year');
            $element->setValue($keyword->getYear());

            $this->view->pageTitle = $this->view->translate("#Create keyword");
        }
    }

}