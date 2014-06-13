<?php
class Blog_IndexController extends Zend_Controller_Action
{
    private $db;
    private $postMapper;
    private $taxonomyMapper;

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
            $categoryData = $this->view->CategoryTermAndUri($loopPostObj->getCategory(), $this->taxonomyMapper);

            $postsData[$postId] = array(
                'title' => $loopPostObj->getTitle(),
                'uri' => $loopPostObj->getUri(),
                'content' => $loopPostObj->getContent(),
                'publicationDate' => $this->view->formatDateToShow($publicationDate, "."),
                'categoryModel' => $categoryData,
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
        $this->taxonomyMapper = new Moxca_Taxonomy_TaxonomyMapper($this->db);

    }

    private function buildPostsModel($postsIds)
    {
        $postsData = array();
        if (is_array($postsIds)) {
            foreach ($postsIds as $postId) {
                $loopPostObj = $this->postMapper->findById($postId);

                $postsData[$postId] = array(
                        'title' => $loopPostObj->getTitle(),
                        'exploreUri' => '/novidades/' . $loopPostObj->getUri(),
                );
            }
        }

        return $postsData;
    }




}

