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

        $childrenNode = $worksPages->addChild('children');
        $childrenNode->addChild('label', $this->view->translate("#Children"));
        $childrenNode->addChild('uri', $this->view->translate('/works/children'));
        $childrenPages = $childrenNode->addChild('pages');

        $youngNode = $worksPages->addChild('young');
        $youngNode->addChild('label', $this->view->translate("#Young"));
        $youngNode->addChild('uri', $this->view->translate('/works/young'));
        $youngPages = $youngNode->addChild('pages');

        $fictionNode = $worksPages->addChild('fiction');
        $fictionNode->addChild('label', $this->view->translate("#Fiction"));
        $fictionNode->addChild('uri', $this->view->translate('/works/fiction'));
        $fictionPages = $fictionNode->addChild('pages');

        $essaysNode = $worksPages->addChild('essays');
        $essaysNode->addChild('label', $this->view->translate("#Essays"));
        $essaysNode->addChild('uri', $this->view->translate('/works/essays'));
        $essaysPages = $essaysNode->addChild('pages');


//        $works = $pages->works;
//        $worksPages = $works->pages;

        $editionsIds = $this->editionMapper->getAllIds();
        foreach ($editionsIds as $editionId) {
            $loopEditionObj = $this->editionMapper->findById($editionId);
            $loopWorkObj = $this->workMapper->findById($loopEditionObj->getWork());

            switch($loopWorkObj->getType()) {
                case Author_Collection_WorkTypeConstants::TYPE_CHILDREN:
                    $edition = $childrenPages->addChild('edition-' . $loopWorkObj->getUri());
                    break;

                case Author_Collection_WorkTypeConstants::TYPE_YOUNG:
                    $edition = $youngPages->addChild('edition-' . $loopWorkObj->getUri());
                    break;

                case Author_Collection_WorkTypeConstants::TYPE_FICTION:
                    $edition = $fictionPages->addChild('edition-' . $loopWorkObj->getUri());
                    break;

                case Author_Collection_WorkTypeConstants::TYPE_ESSAY:
                    $edition = $essaysPages->addChild('edition-' . $loopWorkObj->getUri());
                    break;

                default:
                    $edition = $worksPages->addChild('edition-' . $loopWorkObj->getUri());
                    break;

            }

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
        $newPage->addChild('uri', $this->view->translate('/biography'));

        $newPage = $pages->addChild('news');
        $newPage->addChild('label', $this->view->translate("#News"));
        $newPage->addChild('uri', $this->view->translate('/news'));

//
//        $config = new Zend_Config_Xml($sxe->asXML(), 'nav');
//        $navigation = new Zend_Navigation($config);
//        $this->view->navigation($navigation);
//        file_put_contents(APPLICATION_PATH . '/configs/dynamic.xml', $sxe->asXML());
        $this->saveXMLFile(APPLICATION_PATH . '/configs/dynamic.xml', $sxe);


    }

    private function saveXMLFile($filename, $xml)
    {
        $dom = new DOMDocument('1.0');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($xml->asXML());
//        echo $dom->saveXML();die();
        $dom->save($filename); // I used both (menu.xml) as well ($filename) but neither seems to work
    }

}