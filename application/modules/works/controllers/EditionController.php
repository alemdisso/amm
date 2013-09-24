<?php
class Works_EditionController extends Zend_Controller_Action
{
    private $workMapper;
    private $editorMapper;
    private $editionMapper;
    private $db;

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

    public function exploreAction()
    {
        $data = $this->_request->getParams();
        try {
            $uri = $this->view->checkUriFromGet($data);
        } catch (Exception $e) {
            throw $e;
        }
        $editionObj = $this->editionMapper->findByUri($uri);
        $workObj = $this->workMapper->findById($editionObj->getWork());
        $editorObj = $this->editorMapper->findById($editionObj->getEditor());
        $coverFilePath = $this->view->coverFilePath($editionObj);

        $workTitle = $workObj->getTitle();

        $isbn = $editionObj->getIsbn();
        if ($isbn != "") {
            $isbnLabel = sprintf($this->view->translate("#ISBN: %s"), $isbn);
        } else {
            $isbnLabel = "";
        }

        $pages = $editionObj->getPages();
        if ($pages != "") {
            $pagesLabel = sprintf($this->view->translate("#%s pages"), $pages);
        } else {
            $pagesLabel = "";
        }

        $serie = $editionObj->getSerie();
        if ($serie > 0) {
            $serieMapper = new Author_Collection_SerieMapper($this->db);
            $serieObj = $serieMapper->findById($serie);
            $serieName = $serieObj->getName();
            $serieLabel = sprintf($this->view->translate("#Serie: %s"), $serieName);
            $serieUri = $serieObj->getUri();
        } else {
            $serieLabel = "";
            $serieUri = "#";
        }

        $prizeMapper = new Author_Collection_PrizeMapper($this->db);
        $prizesLabels = $this->view->workPrizesLabels($workObj->getId(), $prizeMapper);


        $pageData = array(
            'title' => $workTitle,
            'mediumImageUri' => $coverFilePath,
            'editorName' => $editorObj->getName(),
            'description' => $workObj->getDescription(),
            'serieName' => $serieLabel,
            'serieUri' => $serieUri,
            'ilustratorName' => 'Capa: Claudius',
            'isbn' => $isbnLabel,
            'pages' => $pagesLabel,

            'ecommerce' => false,
            'moreAbout' => false,
            'prizes' => $prizesLabels,
        );

        $this->view->pageData = $pageData;
        $this->view->pageTitle = sprintf($this->view->translate("#Exploring %s"), $workTitle);
        $keywords = $workObj->getTitle() . ", " . $this->view->keywords;

        $this->view->keywords = $keywords;


    }



    private function prizes()
    {
        $prizes = array(
                '1' => array(
                    'year' => '1997',
                    'name' => 'Prêmio Américas',
                    'category' =>  '',
                    'institution' => 'Fundalectura, Bogotá, Colômbia'
                ),
                '2' => array(
                    'year' => '1995',
                    'name' => 'Prêmio Melhores do Ano',
                    'category' =>  '',
                    'institution' => 'Biblioteca Nacional da Venezuela'
                ),
                '3' => array(
                    'year' => '1988',
                    'name' => 'Prêmio Bienal de São Paulo',
                    'category' =>  'Menção Honrosa - Uma das Cinco Melhores Obras do Biênio',
                    'institution' => 'Bienal de São Paulo'
                ),
        );

        $prizesLabels = array();
        foreach ($prizes as $prizeId => $prize) {
            $label = "";
            $label = $prize['year'] . " - " . $prize['name'];
            if ($prize['institution']) {
                $label .= ", " . $prize['institution'];
            }
            if ($prize['category']) {
                $label .= " (" . $prize['category'] . ")";
            }
            $prizesLabels[$prizeId] = $label;
        }

        return $prizesLabels;


    }

    private function initDbAndMappers()
    {
        $this->db = Zend_Registry::get('db');
        $this->workMapper = new Author_Collection_WorkMapper($this->db);
        $this->editorMapper = new Author_Collection_EditorMapper($this->db);
        $this->editionMapper = new Author_Collection_EditionMapper($this->db);

    }
}

