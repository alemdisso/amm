<?php
class IndexController extends Zend_Controller_Action
{
    public function postDispatch()
    {
        if (isset($this->view->pageTitle)) {
            $this->_helper->layout()->getView()->headTitle($this->view->pageTitle);
        }
    }

    public function init()
    {
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

        $blogData = array(
            'firstPostUri' => 'silenciosa-algazarra',
            'firstPostTitle' => '!#! Silenciosa Algazarra sera tema de conversa com professores na PUC/RJ',
            'firstPostDate' => '15.06.2014',
            'secondPostUri' => 'mais-um-post',
            'secondPostTitle' => 'Mais um título de um post',
            'secondPostDate' => '14.06.2014',
        );

        $bioData = array(
            'excerpt' => 'Considerada pela crítica como uma das mais versáteis e completas das escritoras brasileiras contemporâneas, Ana Maria Machado...',
        );
        $pageData = array(
            'worksData' => $worksData,
            'blogData' => $blogData,
            'bioData' => $bioData,
        );


        $this->view->pageData = $pageData;

        $this->view->pageTitle = "Ana Maria Machado";
  }


}

