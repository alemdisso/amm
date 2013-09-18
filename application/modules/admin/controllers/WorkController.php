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
        $this->db = Zend_Registry::get('db');

        $layoutHelper = $this->_helper->getHelper('Layout');
        $layout = $layoutHelper->getLayoutInstance();
        $layout->nestedLayout = 'inner_admin';

        $this->workMapper = new Author_Collection_WorkMapper($this->db);
        $this->editorMapper = new Author_Collection_EditorMapper($this->db);
        $this->editionMapper = new Author_Collection_EditionMapper($this->db);
    }

    public function detailAction()
    {

        $checker = new Moxca_Util_CheckIdFromGet();
        $id = $checker->check($this->_request);

        $workObj = $this->workMapper->findById($id);

        $typeLabel = $this->view->typeLabel($workObj, new Author_Collection_WorkTypes, $this->view);

        $editionsIds = $this->editionMapper->getAllEditionsOfWork($id);

        $editionsModel = array();

        foreach($editionsIds as $editionId) {
            $loopEditionObj = $this->editionMapper->findById($editionId);
            $loopEditorObj = $this->editorMapper->findById($loopEditionObj->getEditor());
            $editorName = $loopEditorObj->getName();

            $editionsModel[$editionId] = array(
                    'editionId' => $editionId,
                    'editorName' => $editorName,
                    'src' => '/img/editions/raw/' . $loopEditionObj->getCoverImageFilename(),
            );
        }




        $data = array(
            'id' => $id,
            'title' => $workObj->getTitle(),
            'typeLabel' => $typeLabel,
            'description' => $workObj->getDescription(),
            'summary' => $workObj->getSummary(),
            'editions' => $editionsModel,
        );

        $this->view->pageData = $data;

    }

    public function listAction()
    {
        $works = $this->workMapper->getAllIds();

        $worksData = array();
        foreach ($works as $workId) {
            $loopWorkObj = $this->workMapper->findById($workId);

            $loopEditionObj = $this->editionMapper->findByWork($workId);
            if (!is_null($loopEditionObj)) {
                $loopEditorObj = $this->editorMapper->findById($loopEditionObj->getEditor());
                $editorName = $loopEditorObj->getName();
            } else {
                $loopEditorObj = null;
                $editorName = $this->view->translate("#no editions");
                $editorName = "(<em>$editorName</em>)";
            }

            $typeLabel = $this->view->typeLabel($loopWorkObj, new Author_Collection_WorkTypes, $this->view);

            $worksData[$workId] = array('title' => $loopWorkObj->getTitle(),
                    'typeLabel' => $typeLabel,
                    'editorName' => $editorName,
            );
        }


        $data = array(
            'worksList' => $worksData,
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

}