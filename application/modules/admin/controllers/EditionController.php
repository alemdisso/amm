<?php

class Admin_EditionController extends Zend_Controller_Action
{
    private $db;
    private $editorMapper;
    private $editionMapper;
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
        $layout = $layoutHelper->getLayoutInstance();
        $layout->nestedLayout = 'inner_admin';

        $this->workMapper = new Author_Collection_WorkMapper($this->db);
        $this->editorMapper = new Author_Collection_EditorMapper($this->db);
        $this->editionMapper = new Author_Collection_EditionMapper($this->db);
    }

   public function createAction()
    {
        // cria form
        $form = new Author_Form_EditionCreate;
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $postData = $this->getRequest()->getPost();
            if ($form->isValid($postData)) {
                $id = $form->process($postData);
                $this->_helper->getHelper('FlashMessenger')
                    ->addMessage($this->view->translate('#The record was successfully updated.'));
                $this->_redirect('/admin/work/detail/?id=' . $id);
            } else {
                //form error: populate and go back
                $form->populate($postData);
                $this->view->form = $form;
            }
        } else {
            $element = $form->getElement('editor');
            $this->populateEditorsSelect($element, 1);

            $this->view->pageTitle = $this->view->translate("#Create edition");
        }
    }


   public function changeCoverAction()
    {
        // cria form
        $form = new Author_Form_CoverChange;
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $postData = $this->getRequest()->getPost();
            if ($form->isValid($postData)) {
                $id = $form->process($postData);
                $this->_helper->getHelper('FlashMessenger')
                    ->addMessage($this->view->translate('#The record was successfully updated.'));
                $this->_redirect('/admin/work/detail/?id=' . $id);
            } else {
                //form error: populate and go back
                $form->populate($postData);
                $this->view->form = $form;
            }
        } else {

            $data = $this->_request->getParams();
            $filters = array(
                'id' => new Zend_Filter_Alnum(),
            );
            $validators = array(
                'id' => new Moxca_Util_ValidId(),
            );
            $input = new Zend_Filter_Input($filters, $validators, $data);
            if ($input->isValid()) {
                $field = $form->getElement('edition');
                $field->setValue($input->id);
            } else {
                throw new Author_Collection_EditionException("Invalid edition to change cover");
            }
            $this->view->pageTitle = $this->view->translate("#Change cover");
        }
    }

    public function populateEditorsSelect(Zend_Form_Element_Select $elementSelect, $current)
    {
        $editorMapper = new Author_Collection_EditorMapper($this->db);
        $list = $editorMapper->getAllEditorsAlphabeticallyOrdered();

        foreach($list as $editorId => $editorName) {
            $elementSelect->addMultiOption($editorId, $editorName);
        }
        $elementSelect->setValue($current);


    }

}