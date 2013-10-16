<?php

class Admin_NavigationController extends Zend_Controller_Action
{
    private $db;
    private $editorMapper;
    private $editionMapper;
    private $serieMapper;
    private $workMapper;
    private $postMapper;

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
        $this->postMapper = new Moxca_Blog_PostMapper($this->db);
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

        $childrenNode = $this->addPage($worksPages, 'children', '#Children', '/works/children');
        $childrenPages = $childrenNode->addChild('pages');

        $youngNode = $this->addPage($worksPages, 'young', '#Young', '/works/young');
        $youngPages = $youngNode->addChild('pages');

        $fictionNode = $this->addPage($worksPages, 'fiction', '#Fiction', '/works/fiction');
        $fictionPages = $fictionNode->addChild('pages');

        $essaysNode = $this->addPage($worksPages, 'essays', '#Essays', '/works/essays');
        $essaysPages = $essaysNode->addChild('pages');

        $editionsIds = $this->editionMapper->getAllIds();
        foreach ($editionsIds as $editionId) {
            $loopEditionObj = $this->editionMapper->findById($editionId);
            $loopWorkObj = $this->workMapper->findById($loopEditionObj->getWork());

            switch($loopWorkObj->getType()) {
                case Author_Collection_WorkTypeConstants::TYPE_CHILDREN:
                    $nodePages = $childrenPages;
                    break;

                case Author_Collection_WorkTypeConstants::TYPE_YOUNG:
                    $nodePages = $youngPages;
                    break;

                case Author_Collection_WorkTypeConstants::TYPE_FICTION:
                    $nodePages = $fictionPages;
                    break;

                case Author_Collection_WorkTypeConstants::TYPE_ESSAY:
                    $nodePages = $essaysPages;
                    break;

                default:
                    $nodePages = $worksPages;
                    break;

            }

            $edition = $this->addPage($nodePages, 'edition-' . $loopWorkObj->getUri(), $loopWorkObj->getTitle(), '/explore/' . $loopWorkObj->getUri());
        }

        $series = $this->addPage($worksPages, 'series', $this->view->translate("#Series"), '/series');

        $seriesPages = $series->addChild('pages');
        $seriesIds = $this->serieMapper->getAllIds();
        foreach ($seriesIds as $serieId) {
            $loopSerieObj = $this->serieMapper->findById($serieId);
            $serie = $this->addPage($seriesPages, 'serie-' . $loopSerieObj->getUri(), $loopSerieObj->getName(), '/colecao/' . $loopSerieObj->getUri());
        }

        $this->addPage($pages, 'biography', '#Biography', '/biography');
        $newsNode = $this->addPage($pages, 'news', '#News', '/news');
        $newsPages = $newsNode->addChild('pages');

        $postsIds = $this->postMapper->getAllPublishedIds();
        foreach ($postsIds as $postId) {
            $loopPostObj = $this->postMapper->findById($postId);
            $serie = $this->addPage($newsPages, 'post-' . $loopPostObj->getUri(), $loopPostObj->getTitle(), '/novidades/' . $loopPostObj->getUri());
        }



        $this->saveXMLFile(APPLICATION_PATH . '/configs/dynamic.xml', $sxe);


    }

    private function addPage($node, $id, $label, $uri)
    {
        $newPage = $node->addChild($id);
        $newPage->addChild('label', $this->view->translate($label));
        $newPage->addChild('uri', $this->view->translate($uri));
        return ($newPage);
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