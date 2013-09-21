<?php

class Admin_NavigationController extends Zend_Controller_Action
{
    private $db;
    private $editorMapper;
    private $editionMapper;
    private $serieMapper;
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
        $this->serieMapper = new Author_Collection_SerieMapper($this->db);
    }

    public function updateAction()
    {

        $xml = simplexml_load_file(APPLICATION_PATH . '/configs/basic-navigation.xml');
        $sxe = new SimpleXMLElement($xml->asXML());
        $nav = $sxe->nav;
        $home = $nav->home;
        $pages = $home->pages;

        $works = $pages->addChild('works');
        $works->addChild('label', $this->view->translate("#Works"));
        $works->addChild('uri', $this->view->translate('/works'));

        $worksPages = $works->addChild('pages');
        $newPage = $worksPages->addChild('children');
        $newPage->addChild('label', $this->view->translate("#Children"));
        $newPage->addChild('uri', $this->view->translate('/works/children'));

        $newPage = $worksPages->addChild('young');
        $newPage->addChild('label', $this->view->translate("#Young"));
        $newPage->addChild('uri', $this->view->translate('/works/young'));

        $newPage = $worksPages->addChild('fiction');
        $newPage->addChild('label', $this->view->translate("#Fiction"));
        $newPage->addChild('uri', $this->view->translate('/works/fiction'));

        $newPage = $worksPages->addChild('essays');
        $newPage->addChild('label', $this->view->translate("#Essays"));
        $newPage->addChild('uri', $this->view->translate('/works/essays'));



//        $works = $pages->works;
//        $worksPages = $works->pages;

        $editionsIds = $this->editionMapper->getAllIds();
        foreach ($editionsIds as $editionId) {
            $loopEditionObj = $this->editionMapper->findById($editionId);
            $loopWorkObj = $this->workMapper->findById($loopEditionObj->getWork());
            $edition = $worksPages->addChild('edition-' . $loopWorkObj->getUri());
            $edition->addChild('label', $loopWorkObj->getTitle());
            $edition->addChild('uri', '/explore/' . $loopWorkObj->getUri());
        }

        $series = $worksPages->addChild('series');
        $series->addChild('label', $this->view->translate("#Series"));
        $series->addChild('uri', $this->view->translate('/series'));
        $seriesPages = $series->addChild('pages');
        $seriesIds = $this->serieMapper->getAllIds();
        foreach ($seriesIds as $serieId) {
            $loopSerieObj = $this->serieMapper->findById($serieId);
            $serie = $seriesPages->addChild('serie-' . $loopSerieObj->getUri());
            $serie->addChild('label', $loopSerieObj->getName());
            $serie->addChild('uri', '/colecao/' . $loopSerieObj->getUri());
        }

        $newPage = $pages->addChild('biography');
        $newPage->addChild('label', $this->view->translate("#Biography"));
        $newPage->addChild('uri', $this->view->translate('/works/biography'));

        $newPage = $pages->addChild('news');
        $newPage->addChild('label', $this->view->translate("#News"));
        $newPage->addChild('uri', $this->view->translate('/works/news'));

//
//        $config = new Zend_Config_Xml($sxe->asXML(), 'nav');
//        $navigation = new Zend_Navigation($config);
//        $this->view->navigation($navigation);
        file_put_contents(APPLICATION_PATH . '/configs/dynamic.xml', $sxe->asXML());


    }
}