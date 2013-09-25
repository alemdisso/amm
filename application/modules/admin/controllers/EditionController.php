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
        $this->view->setNestedLayout($layoutHelper, 'inner_admin');

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
            $this->populateEditorsSelect($element, 0);

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
                $editionObj = $form->process($postData);
                $workId = $editionObj->getWork();
                $this->_helper->getHelper('FlashMessenger')
                    ->addMessage($this->view->translate('#The record was successfully updated.'));
                $this->_redirect('/admin/work/detail/?id=' . $workId);
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
                $field = $form->getElement('id');
                $field->setValue($input->id);
            } else {
                throw new Author_Collection_EditionException("Invalid edition to change cover");
            }
            $this->view->pageTitle = $this->view->translate("#Change cover");
        }
    }

   public function changeIsbnAction()
    {
        // cria form
        $form = new Author_Form_IsbnChange;
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $this->processAndRedirect($form);
            return;
        } else {
            $data = $this->_request->getParams();
            try {
                $id = $this->view->checkIdFromGet($data);
            } catch (Exception $e) {
                throw $e;
            }

            $element = $form->getElement('id');
            $element->setValue($id);

            $editionObj = $this->editionMapper->findById($id);
            $element = $form->getElement('isbn');
            $element->setValue($editionObj->getIsbn());

            $workObj = $this->workMapper->findById($editionObj->getWork());
            $this->view->title = $workObj->getTitle();
            $this->view->pageTitle = $this->view->translate("#Change isbn");
        }
    }

   public function changePagesAction()
    {
        // cria form
        $form = new Author_Form_PagesChange;
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $this->processAndRedirect($form);
            return;
        } else {
            $data = $this->_request->getParams();
            try {
                $id = $this->view->checkIdFromGet($data);
            } catch (Exception $e) {
                throw $e;
            }

            $element = $form->getElement('id');
            $element->setValue($id);

            $editionObj = $this->editionMapper->findById($id);
            $element = $form->getElement('pages');
            $element->setValue($editionObj->getPages());

            $workObj = $this->workMapper->findById($editionObj->getWork());
            $this->view->title = $workObj->getTitle();
            $this->view->pageTitle = $this->view->translate("#Change isbn");
        }
    }

   public function changeSerieAction()
    {
        // cria form
        $form = new Author_Form_SerieChange;
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $this->processAndRedirect($form);
            return;
        } else {
            $data = $this->_request->getParams();
            try {
                $id = $this->view->checkIdFromGet($data);
            } catch (Exception $e) {
                throw $e;
            }

            $element = $form->getElement('id');
            $element->setValue($id);

            $editionObj = $this->editionMapper->findById($id);
            $element = $form->getElement('serie');
            $this->populateSeriesSelect($element, $editionObj->getSerie(), $editionObj->getEditor());
            $element->setValue($editionObj->getSerie());

            $workObj = $this->workMapper->findById($editionObj->getWork());
            $this->view->title = $workObj->getTitle();
            $this->view->pageTitle = $this->view->translate("#Change serie");
        }
    }

    public function populateEditorsSelect(Zend_Form_Element_Select $elementSelect, $current)
    {
        $editorMapper = new Author_Collection_EditorMapper($this->db);
        $list = $editorMapper->getAllEditorsAlphabeticallyOrdered();

        $elementSelect->addMultiOption(null, $this->view->translate("#(choose an option)"));
        foreach($list as $editorId => $editorName) {
            $elementSelect->addMultiOption($editorId, $editorName);
        }
        $elementSelect->setValue($current);
    }


    public function populateSeriesSelect(Zend_Form_Element_Select $elementSelect, $current, $editorId)
    {
        $serieMapper = new Author_Collection_SerieMapper($this->db);
        $list = $serieMapper->getAllSeriesAlphabeticallyOrdered($editorId);

        $elementSelect->addMultiOption(null, $this->view->translate("#(choose an option)"));
        foreach($list as $serieId => $serieName) {
            $elementSelect->addMultiOption($serieId, $serieName);
        }
        $elementSelect->setValue($current);
    }


    private function processAndRedirect($form)
    {
        $postData = $this->getRequest()->getPost();
        if ($form->isValid($postData)) {
            $editionObj = $form->process($postData);
            $workId = $editionObj->getWork();
            $this->_helper->getHelper('FlashMessenger')
                ->addMessage($this->view->translate('#The record was successfully updated.'));
            $this->_redirect('/admin/work/detail/?id=' . $workId);
        } else {
            //form error: populate and go back
            $form->populate($postData);
            try {
                $id = $this->view->checkIdFromGet($postData);
            } catch (Exception $e) {
                throw $e;
            }

            $editionObj = $this->editionMapper->findById($id);
            $workObj = $this->workMapper->findById($editionObj->getWork());

            $this->view->title = $workObj->getTitle();
            $this->view->form = $form;
        }

    }

}