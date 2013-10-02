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
        $layout = $layoutHelper->getLayoutInstance();
        $layout->nestedLayout = 'inner_home';
    }


    public function indexAction()
    {

        $pageData = array(
            'worksSpecialUri' => '/explore/canteiros-de-saturno',
            'worksSpecialTitle' => 'Canteiros de Saturno',
            'worksSpecialSummary' => 'Um livro sobre o tempo e seu efeito sobre as pessoas',
            'worksSpecialImageUri' => '/img/special/canteiros_home.png',
        );


        $this->view->pageData = $pageData;

        $this->view->pageTitle = "Ana Maria Machado";
  }


}

