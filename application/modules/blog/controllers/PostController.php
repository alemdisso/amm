<?php
class Blog_PostController extends Zend_Controller_Action
{

    private $postMapper;
    private $taxonomyMapper;
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
        $this->view->setNestedLayout($layoutHelper, 'inner_blog');
    }

    public function exploreAction()
    {

        $data = $this->_request->getParams();
        try {
            $uri = $this->view->checkUriFromGet($data);
        } catch (Exception $e) {
            throw $e;
        }

        $postObj = $this->postMapper->findByUri($uri);

        if (!$this->view->canSeePost($postObj)) {
            $this->_redirect('/');
        }

        if (!is_null($postObj->getPublicationDate())) {
            $publicationDate = $this->view->splitDateFromDateTime($postObj->getPublicationDate());
            $publicationLabel = $this->view->formatDateToShow($publicationDate, ".");
        } else {
            $publicationLabel = $this->view->translate("#Not published");
        }

        $postTitle = $postObj->getTitle();
        $categoryData = $this->view->CategoryTermAndUri($postObj->getCategory(), $this->taxonomyMapper);

        $pageData = array(
            'title' => $postTitle,
            'publicationDate' => $publicationLabel,
            'content' => $postObj->getContent(),
            'categoryModel' => $categoryData,
        );

        $this->view->pageData = $pageData;
        $this->view->pageTitle = $postTitle;
    }

    private function initDbAndMappers()
    {
        $this->db = Zend_Registry::get('db');
        $this->postMapper = new Moxca_Blog_PostMapper($this->db);
        $this->taxonomyMapper = new Moxca_Taxonomy_TaxonomyMapper($this->db);
    }
}

