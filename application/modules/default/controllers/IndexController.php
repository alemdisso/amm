<?php
class IndexController extends Zend_Controller_Action
{
    private $db;
    private $postMapper;
    private $questionMapper;

    public function postDispatch()
    {
        if (isset($this->view->pageTitle)) {
            $this->_helper->layout()->getView()->headTitle($this->view->pageTitle);
        }
    }

    public function init()
    {
        $this->initDbAndMappers();

        $layoutHelper = $this->_helper->getHelper('Layout');
        $this->view->setNestedLayout($layoutHelper, 'inner_home');
    }


    public function indexAction()
    {
        $worksData = array(
            'worksSpecialUri' => '/livro/canteiros-de-saturno',
            'worksSpecialTitle' => 'Canteiros de Saturno',
            'worksSpecialSummary' => 'Um livro sobre o tempo e seu efeito sobre as pessoas',
            'worksSpecialImageUri' => '/img/special/canteiros_home.png',
        );

        $postsIds = $this->postMapper->getLastPublishedPosts(2);

        $blogData = array();
        $blogData['firstPostUri'] = null;
        $blogData['firstPostTitle'] = null;
        $blogData['firstPostDate'] = null;
        $blogData['secondPostUri'] = null;
        $blogData['secondPostTitle'] = null;
        $blogData['secondPostDate'] = null;

        if (count($postsIds) > 0) {
            $postObj = $this->postMapper->findById($postsIds[0]);
            $publicationDate = $this->view->splitDateFromDateTime($postObj->getPublicationDate());

            $blogData['firstPostUri'] = $postObj->getUri();
            $blogData['firstPostTitle'] = $postObj->getTitle();
            $blogData['firstPostDate'] = $this->view->formatDateToShow($publicationDate, ".");
            if (count($postsIds) > 1) {
                $postObj = $this->postMapper->findById($postsIds[1]);
                $publicationDate = $this->view->splitDateFromDateTime($postObj->getPublicationDate());

                $blogData['secondPostUri'] = $postObj->getUri();
                $blogData['secondPostTitle'] = $postObj->getTitle();
                $blogData['secondPostDate'] = $this->view->formatDateToShow($publicationDate, ".");
            }
        }


        $bioData = array(
            'excerpt' => 'Considerada pela crítica como uma das mais versáteis e completas das escritoras brasileiras contemporâneas, Ana Maria Machado...',
        );

        $faqData = $this->questionMapper->getAllActiveQuestionsIdsAndTitles();

        foreach ($faqData as $key => $eachFaq) {
            $questionObj = $this->questionMapper->findById($eachFaq['id']);

            $faqModel[$key] = array('id' => $questionObj->getId(), 'question' => $questionObj->getQuestion());

        }

        $pageData = array(
            'worksData' => $worksData,
            'blogData' => $blogData,
            'bioData' => $bioData,
            'faqData' => $faqModel,
        );


        $this->view->pageData = $pageData;

        $this->view->pageTitle = "Ana Maria Machado";
  }

    private function initDbAndMappers()
    {
        $this->db = Zend_Registry::get('db');
        $this->postMapper = new Moxca_Blog_PostMapper($this->db);
        $this->questionMapper = new Moxca_Faq_QuestionMapper($this->db);

    }


}

