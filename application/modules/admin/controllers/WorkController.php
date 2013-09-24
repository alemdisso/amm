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

        $typeLabel = $this->view->typeLabel($workObj, new Author_Collection_WorkTypes, $this->view);

        $editionsIds = $this->editionMapper->getAllEditionsOfWork($id);

        $editionsModel = array();

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


            $coverFilePath = $this->view->coverFilePath($loopEditionObj);

            $editionsModel[$editionId] = array(
                    'editionId' => $editionId,
                    'editorName' => $editorName,
                    'src' => $coverFilePath,
                    'isbn' => $isbn,
                    'pages' => $pages,
                    'serie' => $serieName,
            );
        }

        $prizesLabels = $this->prizes($id);



        $data = array(
            'id' => $id,
            'title' => $workObj->getTitle(),
            'typeLabel' => $typeLabel,
            'description' => $workObj->getDescription(),
            'summary' => $workObj->getSummary(),
            'editions' => $editionsModel,
            'prizes' => $prizesLabels,
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

    private function initDbAndMappers()
    {
        $this->db = Zend_Registry::get('db');
        $this->workMapper = new Author_Collection_WorkMapper($this->db);
        $this->editorMapper = new Author_Collection_EditorMapper($this->db);
        $this->editionMapper = new Author_Collection_EditionMapper($this->db);
    }

    private function prizes($id)
    {
        $prizeMapper = new Author_Collection_PrizeMapper($this->db);
        $prizesIds = $prizeMapper->getAllPrizesOfWork($id);

        $prizesLabels = array();
        foreach($prizesIds as $prizeId) {
            $loopPrizeObj = $prizeMapper->findById($prizeId);
            $label = "";
            if ($loopPrizeObj->getYear()) {
                $label = $loopPrizeObj->getYear() . " - ";
            }
            $label .= $loopPrizeObj->getPrizeName();
            if ($loopPrizeObj->getInstitutionName()) {
                $label .= ", " . $loopPrizeObj->getInstitutionName();
            }
            if ($loopPrizeObj->getCategoryName()) {
                $label .= " (" . $loopPrizeObj->getCategoryName() . ")";
            }
            $prizesLabels[$prizeId] = array('label' => $label);
        }

        return $prizesLabels;
    }

}