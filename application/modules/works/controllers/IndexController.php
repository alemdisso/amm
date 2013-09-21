<?php
class Works_IndexController extends Zend_Controller_Action
{
    private $db;
    private $editorMapper;
    private $editionMapper;
    private $workMapper;

    public function postDispatch()
    {
        if (isset($this->view->pageTitle)) {
            $this->_helper->layout()->getView()->headTitle($this->view->pageTitle);
        }
    }

    public function init()
    {
        $this->initDbAndMappers();

        $this->view->activateNavigation($this->_request, $this->view);

        $layoutHelper = $this->_helper->getHelper('Layout');
        $this->view->setNestedLayout($layoutHelper, 'inner_works');
    }

    public function fictionAction()
    {
        $editionsIds = $this->editionMapper->getAllIdsOfType(Author_Collection_WorkTypeConstants::TYPE_FICTION);
        $editionsData = array();
        foreach ($editionsIds as $editionId) {
            $loopEditionObj = $this->editionMapper->findById($editionId);
            $loopWorkObj = $this->workMapper->findById($loopEditionObj->getWork());
            $loopEditorObj = $this->editorMapper->findById($loopEditionObj->getEditor());

            $coverFilePath = $this->view->coverFilePath($loopEditionObj);

            $editionsData[$editionId] = array(
                    'title' => $loopWorkObj->getTitle(),
                    'coverSrc' => $coverFilePath,
                    'exploreUri' => '/explore/' . $loopWorkObj->getUri(),
                    'summary' => $loopWorkObj->getSummary(),
                    'editorName' => $loopEditorObj->getName(),
                    'prizes' => array(),
                    'moreAbout' => false,
                    'otherLanguages' => false,
            );
        }


        $pageData = array(
            'editionsData' => $editionsData,
        );

        $this->view->pageData = $pageData;
        $this->view->pageTitle = $this->view->translate("#Ana Maria Machado - Fiction");

    }


    public function childrenAction()
    {
        $editionsIds = $this->editionMapper->getAllIdsOfType(Author_Collection_WorkTypeConstants::TYPE_CHILDREN);
        $editionsData = array();
        $editionsModel = array();
        foreach ($editionsIds as $editionId) {
            $loopEditionObj = $this->editionMapper->findById($editionId);
            $loopWorkObj = $this->workMapper->findById($loopEditionObj->getWork());
            $loopEditorObj = $this->editorMapper->findById($loopEditionObj->getEditor());

            $coverFilePath = $this->view->coverFilePath($loopEditionObj);

            $editionsData[$editionId] = array(
                    'title' => $loopWorkObj->getTitle(),
                    'coverSrc' => $coverFilePath,
                    'exploreUri' => '/explore/' . $loopWorkObj->getUri(),
                    'summary' => $loopWorkObj->getSummary(),
                    'editorName' => $loopEditorObj->getName(),
                    'prizes' => array(),
                    'moreAbout' => false,
                    'otherLanguages' => false,
            );
        }


        $pageData = array(
            'editionsData' => $editionsData,
            'editionsModel' => $editionsModel,
        );

        $this->view->pageData = $pageData;
        $this->view->pageTitle = $this->view->translate("#Ana Maria Machado - Children");

    }

    public function essaysAction()
    {
        $editionsIds = $this->editionMapper->getAllIdsOfType(Author_Collection_WorkTypeConstants::TYPE_ESSAY);
        $editionsData = array();
        foreach ($editionsIds as $editionId) {
            $loopEditionObj = $this->editionMapper->findById($editionId);
            $loopWorkObj = $this->workMapper->findById($loopEditionObj->getWork());
            $loopEditorObj = $this->editorMapper->findById($loopEditionObj->getEditor());

            $coverFilePath = $this->view->coverFilePath($loopEditionObj);

            $editionsData[$editionId] = array(
                    'title' => $loopWorkObj->getTitle(),
                    'coverSrc' => $coverFilePath,
                    'exploreUri' => '/explore/' . $loopWorkObj->getUri(),
                    'summary' => $loopWorkObj->getSummary(),
                    'editorName' => $loopEditorObj->getName(),
                    'prizes' => array(),
                    'moreAbout' => false,
                    'otherLanguages' => false,
            );
        }


        $pageData = array(
            'editionsData' => $editionsData,
        );

        $this->view->pageData = $pageData;
        $this->view->pageTitle = $this->view->translate("#Ana Maria Machado - Essays");

    }

    public function serieAction()
    {
        $data = $this->_request->getParams();
        try {
            $uri = $this->view->checkUriFromGet($data);
        } catch (Exception $e) {
            throw $e;
        }
        $serieMapper = new Author_Collection_SerieMapper($this->db);
        $serieObj = $serieMapper->findByUri($uri);



        $editionsIds = $this->editionMapper->getAllEditionsOfSerie($uri);
        $editionsData = array();
        foreach ($editionsIds as $editionId) {
            $loopEditionObj = $this->editionMapper->findById($editionId);
            $loopWorkObj = $this->workMapper->findById($loopEditionObj->getWork());
            $loopEditorObj = $this->editorMapper->findById($loopEditionObj->getEditor());

            $coverFilePath = $this->view->coverFilePath($loopEditionObj);

            $editionsData[$editionId] = array(
                    'title' => $loopWorkObj->getTitle(),
                    'coverSrc' => $coverFilePath,
                    'exploreUri' => '/explore/' . $loopWorkObj->getUri(),
                    'summary' => $loopWorkObj->getSummary(),
                    'editorName' => $loopEditorObj->getName(),
                    'prizes' => array(),
                    'moreAbout' => false,
                    'otherLanguages' => false,
            );
        }

        if (count($editionsData) > 0) {
            $serieLabel = sprintf($this->view->translate("#Serie: %s"), $serieObj->getName());
        } else {
            $serieLabel = "";
        }


        $pageData = array(
            'serieLabel' => $serieLabel,
            'editionsData' => $editionsData,
        );

        $this->view->pageData = $pageData;
        $this->view->pageTitle = $this->view->translate("#Ana Maria Machado - Essays");

    }

    public function youngAction()
    {
        $editionsIds = $this->editionMapper->getAllIdsOfType(Author_Collection_WorkTypeConstants::TYPE_YOUNG);
        $editionsData = array();
        foreach ($editionsIds as $editionId) {
            $loopEditionObj = $this->editionMapper->findById($editionId);
            $loopWorkObj = $this->workMapper->findById($loopEditionObj->getWork());
            $loopEditorObj = $this->editorMapper->findById($loopEditionObj->getEditor());

            $coverFilePath = $this->view->coverFilePath($loopEditionObj);

            $editionsData[$editionId] = array(
                    'title' => $loopWorkObj->getTitle(),
                    'coverSrc' => $coverFilePath,
                    'exploreUri' => '/explore/' . $loopWorkObj->getUri(),
                    'summary' => $loopWorkObj->getSummary(),
                    'editorName' => $loopEditorObj->getName(),
                    'prizes' => array(),
                    'moreAbout' => false,
                    'otherLanguages' => false,
            );
        }


        $pageData = array(
            'editionsData' => $editionsData,
        );

        $this->view->pageData = $pageData;
        $this->view->pageTitle = $this->view->translate("#Ana Maria Machado - Young");

    }


    public function indexAction()
    {
        $pageData = array(
            'leftSpecialUri' => '/explore/menina-bonita-do-laco-de-fita',
            'leftSpecialTitle' => 'Menina bonita do laço de fita',
            'leftSpecialSummary' => 'História de uma menina que, de tão bonita, deixa até um coelho apaixonado.',
            'leftSpecialImageUri' => '/img/marcacao_destaque_livro1.png',
            'rightSpecialUri' => '/explore/a-audacia-dessa-mulher',
            'rightSpecialTitle' => 'A audácia dessa mulher',
            'rightSpecialSummary' => 'Um romance que engloba varias vertentes e vem do século XIX aos nossos dias.',
            'rightSpecialImageUri' => '/img/marcacao_destaque_livro2.png',
        );

        $this->view->pageData = $pageData;
        $this->view->pageTitle = "Ana Maria Machado - Histórias";

    }

    private function initDbAndMappers()
    {
        $this->db = Zend_Registry::get('db');
        $this->workMapper = new Author_Collection_WorkMapper($this->db);
        $this->editorMapper = new Author_Collection_EditorMapper($this->db);
        $this->editionMapper = new Author_Collection_EditionMapper($this->db);

    }
}

