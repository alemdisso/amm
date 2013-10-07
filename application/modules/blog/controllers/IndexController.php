<?php
class Blog_IndexController extends Zend_Controller_Action
{
    private $db;
    private $postMapper;

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
        $this->view->setNestedLayout($layoutHelper, 'inner_blog');
    }

    public function indexAction()
    {
        $postsIds = $this->postMapper->getLastPublishedPosts(Author_Collection_WorkTypeConstants::TYPE_FICTION);

        $postsData = array();
        foreach ($postsIds as $postId) {
            $loopPostObj = $this->postMapper->findById($postId);
            $publicationDate = $this->view->splitDateFromDateTime($loopPostObj->getPublicationDate());

            $postsData[$postId] = array(
                'title' => $loopPostObj->getTitle(),
                'uri' => $loopPostObj->getUri(),
                'content' => nl2br($loopPostObj->getContent()),
                'publicationDate' => $this->view->formatDateToShow($publicationDate, "."),
                'categoryTerm' => 'Leitura',
                'categoryUri' => 'leitura',
                'commentsCount' => 0,
            );

        }


        $pageData = array('postsData' => $postsData);
        $this->view->pageData = $pageData;


    }

    private function initDbAndMappers()
    {
        $this->db = Zend_Registry::get('db');
        $this->postMapper = new Moxca_Blog_PostMapper($this->db);

    }
}

