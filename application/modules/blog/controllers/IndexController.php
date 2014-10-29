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
        $data = $this->_request->getParams();

//        $page = $data['page'];
//        $limit = 3;
//        $offset = ($page - 1) * $limit;
        $limit = 100;
        $offset = 0;
        $postsIds = $this->postMapper->getLastPublishedPosts($limit, $offset);

        $postsData = array();
        foreach ($postsIds as $postId) {
            $loopPostObj = $this->postMapper->findById($postId);
            $publicationDate = $this->view->splitDateFromDateTime($loopPostObj->getPublicationDate());
            $categoryData = $this->view->CategoryTermAndUri($loopPostObj->getCategory(), $this->taxonomyMapper);

            $parag = preg_match_all("{<p>(.*)</p>}",$loopPostObj->getContent(),$pTags);
//            echo "<br>";echo "TITULO<br>";echo "<br>";
//            echo $loopPostObj->getTitle();echo "<br>";
//            echo $pTags[0][0];
//            echo "<br>";echo "========<br>";echo "<br>";
//            print_r($pTags);

            if (isset($pTags[0][0])) {
                $firstP = $pTags[0][0];
                $imgLen = strpos($loopPostObj->getContent(), $firstP);
                $content = substr($loopPostObj->getContent(), 0, strlen($firstP) + $imgLen);
            } else {
                $content = $loopPostObj->getContent();
            }

            $continueLink = true;
            if ($content == $loopPostObj->getContent()) {
                $continueLink = false;
            }
            $postsData[$postId] = array(
                'title' => $loopPostObj->getTitle(),
                'uri' => $loopPostObj->getUri(),
                'content' => $content,
                'publicationDate' => $this->view->formatDateToShow($publicationDate, "."),
                'categoryModel' => $categoryData,
                'commentsCount' => 0,
                'continueLink' => $continueLink,
            );

        }
//exit;
        if ($offset) {
            $previous = $this->view->translate("#previous");
        } else {
            $previous = null;
        }

        $allPostsIds = $this->postMapper->getAllPublishedIds();
        $allPostsCount = count($allPostsIds);
//        if (($limit * $page) < $allPostsCount) {
//            $next = $this->view->translate("#next");
//        } else {
//            $next = null;
//        }
        $next = null;
        $page = 1;

        $pageData = array('postsData' => $postsData, 'previous' => $previous, 'next' => $next, 'page' => $page);
        $this->view->pageData = $pageData;

    }

    public function categoryAction()
    {
        $data = $this->_request->getParams();
        try {
            $postsIds = array();
            $validator = new Moxca_Util_ValidUri();
            if ($validator->isValid($data['category'])) {
                $postsIds = $this->taxonomyMapper->getPublishedPostsByCategory($data['category']);
            }
        } catch (Exception $e) {
            throw $e;
        }

        $postsData = array();
        foreach ($postsIds as $postId) {
            $loopPostObj = $this->postMapper->findById($postId);
            $publicationDate = $this->view->splitDateFromDateTime($loopPostObj->getPublicationDate());
            $categoryData = $this->view->CategoryTermAndUri($loopPostObj->getCategory(), $this->taxonomyMapper);

            $parag = preg_match_all("{<p>(.*)</p>}",$loopPostObj->getContent(),$pTags);
            if (isset($pTags[0][0])) {
                $firstP = $pTags[0][0];
                $imgLen = strpos($loopPostObj->getContent(), $firstP);
                $content = substr($loopPostObj->getContent(), 0, strlen($firstP) + $imgLen);
            } else {
                $content = $loopPostObj->getContent();
            }
            $continueLink = true;
            if ($content == $loopPostObj->getContent()) {
                $continueLink = false;
            }

            $postsData[$postId] = array(
                'title' => $loopPostObj->getTitle(),
                'uri' => $loopPostObj->getUri(),
                'content' => $content,
                'publicationDate' => $this->view->formatDateToShow($publicationDate, "."),
                'categoryModel' => $categoryData,
                'commentsCount' => 0,
                'continueLink' => $continueLink,
            );

        }

        $pageData = array('postsData' => $postsData);
        $this->view->pageData = $pageData;

    }

    private function initDbAndMappers()
    {
        $this->db = Zend_Registry::get('db');
        $this->postMapper = new Moxca_Blog_PostMapper($this->db);
        $this->taxonomyMapper = new Moxca_Blog_TaxonomyMapper($this->db);

    }

    private function buildPostsModel($postsIds)
    {
        $postsData = array();
        if (is_array($postsIds)) {
            foreach ($postsIds as $postId) {
                $loopPostObj = $this->postMapper->findById($postId);

                $postsData[$postId] = array(
                        'title' => $loopPostObj->getTitle(),
                        'exploreUri' => '/curiosidades/' . $loopPostObj->getUri(),
                );
            }
        }

        return $postsData;
    }




}

