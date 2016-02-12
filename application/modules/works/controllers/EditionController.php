<?php
class Works_EditionController extends Zend_Controller_Action
{
    private $workMapper;
    private $editorMapper;
    private $editionMapper;
    private $keywords;
    private $db;

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
        
//
//        if ($workObj->getStatus() != Author_Collection_WorkStatusConstants::STATUS_RESIZED) 
//        {
//            $this->resizeCover($workObj, $editionObj);
//        }
//        
        $coverFilePath = $this->view->coverFilePath($editionObj, "no_img.png", "md");
        
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
            try {
                $serieObj = $serieMapper->findById($serie);
                $serieName = $serieObj->getName();
                $serieLabel = sprintf($this->view->translate("#Serie: %s"), $serieName);
                $serieUri = $serieObj->getUri();
            } catch (Exception $e) {
                $serieLabel = "";
                $serieUri = "#";
            }
        } else {
            $serieLabel = "";
            $serieUri = "#";
        }

        $prizeMapper = new Author_Collection_PrizeMapper($this->db);
        $prizesLabels = $this->view->workPrizesLabels($workObj->getId(), $prizeMapper);

        $illustratorLabel = "";
        if ($editionObj->getIllustrator()) {
            $illustratorLabel = $this->view->translate("#Illustrator:") . " " . $editionObj->getIllustrator();
        }

        $coverDesignerLabel = "";
        if ($editionObj->getCoverDesigner()) {
            $coverDesignerLabel = $this->view->translate("#Cover designer:") . " " . $editionObj->getCoverDesigner();
        }

        $editorLabel = "";
        if ($editionObj->getEditor()) {
            $editorLabel = $this->view->translate("#Editor:") . " " . $editorObj->getName();
        }
        
        $pageData = array(
            'title' => $workTitle,
            'mediumImageUri' => $coverFilePath,
            'editorName' => $editorLabel,
            'description' => nl2br($workObj->getDescription()),
            'serieName' => $serieLabel,
            'serieUri' => $serieUri,
            'illustrator' => $illustratorLabel,
            'coverDesigner' => $coverDesignerLabel,
            'isbn' => $isbnLabel,
            'pages' => $pagesLabel,

            'ecommerce' => false,
            'moreAbout' => false,
            'prizes' => $prizesLabels,
        );

        $this->view->pageData = $pageData;
        $this->view->pageTitle = sprintf($this->view->translate("#Exploring %s"), $workTitle);
        $taxonomyMapper = new Author_Collection_TaxonomyMapper($this->db);
        $keywordsLabels = $this->view->workKeywordsLabels($workObj->getId(), $taxonomyMapper);
        $stringKeywords="";
        foreach($keywordsLabels as $labelArray) {
            $stringKeywords .= ', ' . $labelArray['label'];
        }

        $keywords = $workObj->getTitle() . $stringKeywords . ", " . $this->view->keywords;

        $this->view->keywords = $keywords;

    }

    public function resizeAction()
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
        

        if ($workObj->getStatus() != Author_Collection_WorkStatusConstants::STATUS_RESIZED) 
        {
            $this->resizeCover($workObj, $editionObj);
        }
        
        $coverFilePath = $this->view->coverFilePath($editionObj, "no_img.png", "md");
        
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
            try {
                $serieObj = $serieMapper->findById($serie);
                $serieName = $serieObj->getName();
                $serieLabel = sprintf($this->view->translate("#Serie: %s"), $serieName);
                $serieUri = $serieObj->getUri();
            } catch (Exception $e) {
                $serieLabel = "";
                $serieUri = "#";
            }
        } else {
            $serieLabel = "";
            $serieUri = "#";
        }

        $prizeMapper = new Author_Collection_PrizeMapper($this->db);
        $prizesLabels = $this->view->workPrizesLabels($workObj->getId(), $prizeMapper);

        $illustratorLabel = "";
        if ($editionObj->getIllustrator()) {
            $illustratorLabel = $this->view->translate("#Illustrator:") . " " . $editionObj->getIllustrator();
        }

        $coverDesignerLabel = "";
        if ($editionObj->getCoverDesigner()) {
            $coverDesignerLabel = $this->view->translate("#Cover designer:") . " " . $editionObj->getCoverDesigner();
        }

        $editorLabel = "";
        if ($editionObj->getEditor()) {
            $editorLabel = $this->view->translate("#Editor:") . " " . $editorObj->getName();
        }
        
        $pageData = array(
            'title' => $workTitle,
            'mediumImageUri' => $coverFilePath,
            'editorName' => $editorLabel,
            'description' => nl2br($workObj->getDescription()),
            'serieName' => $serieLabel,
            'serieUri' => $serieUri,
            'illustrator' => $illustratorLabel,
            'coverDesigner' => $coverDesignerLabel,
            'isbn' => $isbnLabel,
            'pages' => $pagesLabel,

            'ecommerce' => false,
            'moreAbout' => false,
            'prizes' => $prizesLabels,
        );

        $this->view->pageData = $pageData;
        $this->view->pageTitle = sprintf($this->view->translate("#Exploring %s"), $workTitle);
        $taxonomyMapper = new Author_Collection_TaxonomyMapper($this->db);
        $keywordsLabels = $this->view->workKeywordsLabels($workObj->getId(), $taxonomyMapper);
        $stringKeywords="";
        foreach($keywordsLabels as $labelArray) {
            $stringKeywords .= ', ' . $labelArray['label'];
        }

        $keywords = $workObj->getTitle() . $stringKeywords . ", " . $this->view->keywords;

        $this->view->keywords = $keywords;

    }

    private function initDbAndMappers()
    {
        $this->db = Zend_Registry::get('db');
        $this->workMapper = new Author_Collection_WorkMapper($this->db);
        $this->editorMapper = new Author_Collection_EditorMapper($this->db);
        $this->editionMapper = new Author_Collection_EditionMapper($this->db);

    }    

    private function resizeCover(Author_Collection_Work $workObj, Author_Collection_Edition $editionObj)
    {
        
        $coverRawFilePath = $this->view->coverFilePath($editionObj);
        $extension = strtolower(strrchr($coverRawFilePath, '.'));
        
        
        list($width, $height) = getimagesize($_SERVER['DOCUMENT_ROOT'] . '/public' . $coverRawFilePath);
        
//        if ((!$width) && (!$height)) {
//            die("erro na imagem");
//        }
        
//        print_r($width); echo" W<br />";
//        print_r($height); echo" H <br />";
        
        

        if ($workObj->GetStatus() != Author_Collection_WorkStatusConstants::STATUS_RESIZED) {
            $rsz = new Moxca_Util_Resize($_SERVER['DOCUMENT_ROOT'] . '/public' . $coverRawFilePath);
            $rsz->resizeImage(198, 198);
            $rsz->saveImage($_SERVER['DOCUMENT_ROOT'] . '/public' . '/img/editions/tb/' . $workObj->getUri()  . '.png');
            unset($rsz);


            if (($width > 380) || ($height > 380)) {

                $rsz = new Moxca_Util_Resize($_SERVER['DOCUMENT_ROOT'] . '/public' . $this->view->coverFilePath($editionObj));
                $rsz->resizeImage(381, 381);
                $rsz->saveImage($_SERVER['DOCUMENT_ROOT'] . '/public' . '/img/editions/md/' . $workObj->getUri()  . '.png');
                unset($rsz);
            } else {
                $rsz = new Moxca_Util_Resize($_SERVER['DOCUMENT_ROOT'] . '/public' . $this->view->coverFilePath($editionObj));
                $rsz->resizeImage($width, $height);
                $rsz->saveImage($_SERVER['DOCUMENT_ROOT'] . '/public' . '/img/editions/md/' . $workObj->getUri()  . '.png');
                unset($rsz);
            }
            
            
            $rsz = new Moxca_Util_Resize($_SERVER['DOCUMENT_ROOT'] . '/public' . $coverRawFilePath);
            $rsz->resizeImage($width, $height);

            $rsz->saveImage($_SERVER['DOCUMENT_ROOT'] . '/public' . '/img/editions/new/' . $workObj->getUri()  . '.png');
            $editionObj->setCover($workObj->getUri()  . '.png');
            $this->editionMapper->update($editionObj);
            //unlink($_SERVER['DOCUMENT_ROOT'] . '/public' . $coverRawFilePath);
            //$coverRawFilePath = '/img/editions/raw/' . $workObj->getUri()  . '.png';

            unset($rsz);
            
            
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/public' . '/img/editions/new/' . $workObj->getUri()  . '.png')) {
                $workObj->SetStatus(Author_Collection_WorkStatusConstants::STATUS_RESIZED);
            } else {
                $workObj->SetStatus(Author_Collection_WorkStatusConstants::STATUS_RAW);

            } 
            $this->workMapper->update($workObj);
        }

        
    }

        
        
    
    
}

