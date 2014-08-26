<?php

class Admin_WorkController extends Zend_Controller_Action
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
        $this->initDbAndMappers();

        $this->view->activateNavigation($this->_request, $this->view);

        $layoutHelper = $this->_helper->getHelper('Layout');
        $this->view->setNestedLayout($layoutHelper, 'inner_admin');
    }


    public function changeDescriptionAction()
    {
        // cria form
        $form = new Author_Form_DescriptionChange;
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

            $workObj = $this->workMapper->findById($id);
            $element = $form->getElement('description');
            $element->setValue($workObj->getDescription());

            $workObj = $this->workMapper->findById($workObj->getId());
            $this->view->title = $workObj->getTitle();
            $this->view->pageTitle = $this->view->translate("#Change description");
        }
    }

    public function changeSummaryAction()
    {
        // cria form
        $form = new Author_Form_SummaryChange;
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

            $workObj = $this->workMapper->findById($id);
            $element = $form->getElement('summary');
            $element->setValue($workObj->getSummary());

            $workObj = $this->workMapper->findById($workObj->getId());
            $this->view->title = $workObj->getTitle();
            $this->view->pageTitle = $this->view->translate("#Change summary");
        }
    }

    public function changeTitleAction()
    {
        // cria form
        $form = new Author_Form_TitleChange;
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

            $workObj = $this->workMapper->findById($id);
            $element = $form->getElement('title');
            $element->setValue($workObj->getTitle());

            $workObj = $this->workMapper->findById($workObj->getId());
            $this->view->title = $workObj->getTitle();
            $this->view->pageTitle = $this->view->translate("#Change title");
        }
    }

    public function changeTypeAction()
    {
        // cria form
        $form = new Author_Form_WorkTypeChange;
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

            $workObj = $this->workMapper->findById($id);
            $element = $form->getElement('type');
            $element->setValue($workObj->getType());

            $this->view->title = $workObj->getTitle();
            $this->view->pageTitle = $this->view->translate("#Change type");
        }
    }

    public function createKeywordAction()
    {
        // cria form
        $form = new Author_Form_KeywordAdd;
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

            $workObj = $this->workMapper->findById($id);

            $this->view->title = $workObj->getTitle();
            $this->view->pageTitle = $this->view->translate("#Add keyword");
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

//        $checker = new Moxca_Util_CheckIdFromGet();
//        $id = $checker->check($this->_request);

        $workObj = $this->workMapper->findById($id);

        $typeLabel = $this->view->typeLabel($workObj->getType(), new Author_Collection_WorkTypes, $this->view);
        $typeListLink = $this->view->typeListLink($workObj, $this->view);

        $editionsIds = $this->editionMapper->getAllEditionsOfWork($id);
        foreach($editionsIds as $editionId) {
            $loopEditionObj = $this->editionMapper->findById($editionId);
            $loopEditorObj = $this->editorMapper->findById($loopEditionObj->getEditor());
            $editorName = $loopEditorObj->getName();
            $isbn = $loopEditionObj->getIsbn();
            if ($isbn == "") {
                $isbn = $this->view->translate("#NI");
            }

            $pages = $loopEditionObj->getPages();
            if ($pages == "") {
                $pages = $this->view->translate("#NI");
            }

            if ($loopEditionObj->getSerie() > 0) {
                $serieMapper = new Author_Collection_SerieMapper($this->db);
                $serieObj = $serieMapper->findById($loopEditionObj->getSerie());
                $serieName = $serieObj->getName();
            } else {
                $serieName = "";
            }

            $illustrator = $loopEditionObj->getIllustrator();
            if ($illustrator == "") {
                $illustrator = $this->view->translate("#NI");
            }

            $coverDesigner = $loopEditionObj->getCoverDesigner();
            if ($coverDesigner == "") {
                $coverDesigner = $this->view->translate("#NI");
            }


            $coverFilePath = $this->view->coverFilePath($loopEditionObj);

            $editionsModel[$editionId] = array(
                    'uri' => $workObj->getUri(),
                    'editionId' => $editionId,
                    'editorName' => $editorName,
                    'src' => $coverFilePath,
                    'isbn' => $isbn,
                    'pages' => $pages,
                    'serie' => $serieName,
                    'illustrator' => $illustrator,
                    'coverDesigner' => $coverDesigner,
            );
        }

        $prizeMapper = new Author_Collection_PrizeMapper($this->db);
        $prizesLabels = $this->view->workPrizesLabels($id, $prizeMapper);

        $taxonomyMapper = new Author_Collection_TaxonomyMapper($this->db);
        $keywordsLabels = $this->view->workKeywordsLabels($id, $taxonomyMapper);

        $data = array(
            'id' => $id,
            'title' => $workObj->getTitle(),
            'typeLabel' => $typeLabel,
            'typeListLink' => $typeListLink,
            'description' => nl2br($workObj->getDescription()),
            'summary' => nl2br($workObj->getSummary()),
            'editions' => $editionsModel,
            'prizes' => $prizesLabels,
            'keywords' => $keywordsLabels,
        );

        $this->view->pageData = $data;

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

    public function removeAction()
    {
        $form = new Author_Form_WorkRemove();
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $postData = $this->getRequest()->getPost();
            if ($form->isValid($postData)) {
                $submitButton = $form->getUnfilteredValue('Submit');

                if ($submitButton) {
                    $id = $form->process($postData);
                    $this->_helper->getHelper('FlashMessenger')
                        ->addMessage($this->view->translate('#The record was successfully removed.'));
                    $this->_redirect('/admin/index/list-works');
                } else {
                    $id = $postData['id'];
                    $this->_redirect('/admin/work/detail/?id=' . $id);
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

            $workData = array();
            $workObj = $this->workMapper->findById($id);
            $idField = $form->getElement('id');
            $idField->setValue($id);
            $workData = array(
                'id'   => $id,
                'title' => $workObj->getTitle(),
            );
            $this->view->pageData = $workData;

            $this->view->pageTitle = $this->view->translate("#Remove work");

        }
    }

    private function initDbAndMappers()
    {
        $this->db = Zend_Registry::get('db');
        $this->workMapper = new Author_Collection_WorkMapper($this->db);
        $this->editorMapper = new Author_Collection_EditorMapper($this->db);
        $this->editionMapper = new Author_Collection_EditionMapper($this->db);
    }

    private function processAndRedirect($form)
    {
        $postData = $this->getRequest()->getPost();
        if ($form->isValid($postData)) {
            $workObj = $form->process($postData);
            $workId = $workObj->getId();
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

            $workObj = $this->workMapper->findById($id);

            $this->view->title = $workObj->getTitle();
            $this->view->form = $form;
        }

    }


}