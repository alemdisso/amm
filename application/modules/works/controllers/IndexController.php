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
            $this->_helper->layout()->getView()->headTitle($this->view->pageTitle . " :: Ana Maria Machado");
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
        $editionsIds = $this->editionMapper->getAllEditionsOfTypeAlphabeticallyOrdered(Author_Collection_WorkTypeConstants::TYPE_FICTION);
        $this->buildEditionsListPage($editionsIds, "#Fiction");
    }

    public function childrenAction()
    {
        $editionsIds = $this->editionMapper->getAllEditionsOfTypeAlphabeticallyOrdered(Author_Collection_WorkTypeConstants::TYPE_CHILDREN);
        $this->buildEditionsListPage($editionsIds, "#Children");
    }

    public function essaysAction()
    {
        $editionsIds = $this->editionMapper->getAllEditionsOfTypeAlphabeticallyOrdered(Author_Collection_WorkTypeConstants::TYPE_ESSAY);
        $this->buildEditionsListPage($editionsIds, "#Essays");
    }

    public function serieAction()
    {
        $data = $this->_request->getParams();
        try {
            $uri = $this->view->checkUriFromGet($data);
        } catch (Exception $e) {
            throw $e;
        }

        $editionsIds = $this->editionMapper->getAllEditionsOfSerie($uri);

        $serieMapper = new Author_Collection_SerieMapper($this->db);
        $serieObj = $serieMapper->findByUri($uri);
        if (count($editionsIds) > 0) {
            $serieLabel = sprintf($this->view->translate("#Serie: %s"), $serieObj->getName());
        } else {
            $serieLabel = "";
        }
        $this->buildEditionsListPage($editionsIds, $serieLabel);

        $this->view->pageTitle = $serieLabel;

    }

    public function seriesAction()
    {
        $serieMapper = new Author_Collection_SerieMapper($this->db);


        $serieIds = $serieMapper->getAllIds();
        $seriesData = array();
        foreach ($serieIds as $serieId) {
            $loopSerieObj = $serieMapper->findById($serieId);

            $data = $this->editionMapper->getSomeEditionFrom($serieId);
            $editionId = $data[0];

            if ($editionId) {
                $loopEditionObj = $this->editionMapper->findById($editionId);
                $loopWorkObj = $this->workMapper->findById($loopEditionObj->getWork());
                $loopEditorObj = $this->editorMapper->findById($loopEditionObj->getEditor());

                $coverFilePath = $this->view->coverFilePath($loopEditionObj);
                $serieLabel = $loopSerieObj->getName();

                $seriesData[$serieId] = array(
                        'title' => $serieLabel,
                        'coverSrc' => $coverFilePath,
                        'exploreUri' => $this->view->translate('/serie/') . $loopSerieObj->getUri(),
                        'editorName' => $loopEditorObj->getName(),
                );
            }
        }

        $pageData = array(
            'seriesData' => $seriesData,
        );

        $this->view->pageData = $pageData;
        $this->view->pageTitle = $this->view->translate("#Series");

    }

//

    public function youngAction()
    {
        $editionsIds = $this->editionMapper->getAllIdsOfType(Author_Collection_WorkTypeConstants::TYPE_YOUNG);
        $this->buildEditionsListPage($editionsIds, "#Young");
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
            'rightSpecialImageUri' => '/img/special/audacia_crop.png',
        );

        $this->view->pageData = $pageData;
        $this->view->pageTitle = "Ana Maria Machado - Histórias";
    }

    private function buildEditionsListPage($editionsIds, $title)
    {
        $editionsData = array();
        $editionsModel = array();
        foreach ($editionsIds as $editionId) {
            $loopEditionObj = $this->editionMapper->findById($editionId);
            $loopWorkObj = $this->workMapper->findById($loopEditionObj->getWork());
            $loopEditorObj = $this->editorMapper->findById($loopEditionObj->getEditor());

            $coverFilePath = $this->view->coverFilePath($loopEditionObj);

            $prizeMapper = new Author_Collection_PrizeMapper($this->db);
            $prizesLabels = $this->view->workPrizesLabels($loopWorkObj->getId(), $prizeMapper);

            $editionsData[$editionId] = array(
                    'title' => $loopWorkObj->getTitle(),
                    'coverSrc' => $coverFilePath,
                    'exploreUri' => '/explore/' . $loopWorkObj->getUri(),
                    'summary' => $loopWorkObj->getSummary(),
                    'editorName' => $loopEditorObj->getName(),
                    'prizes' => $prizesLabels,
                    'moreAbout' => false,
                    'otherLanguages' => false,
            );
        }

        $pageData = array(
            'editionsData' => $editionsData,
            'editionsModel' => $editionsModel,
            'pageTitle' => $this->view->translate($title),
        );

        $this->view->pageData = $pageData;
        $this->view->pageTitle = $pageData['pageTitle'];
    }



    private function initDbAndMappers()
    {
        $this->db = Zend_Registry::get('db');
        $this->workMapper = new Author_Collection_WorkMapper($this->db);
        $this->editorMapper = new Author_Collection_EditorMapper($this->db);
        $this->editionMapper = new Author_Collection_EditionMapper($this->db);

    }
}

