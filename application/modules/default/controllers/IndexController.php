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
//        $this->db = Zend_Registry::get('db');
        $layoutHelper = $this->_helper->getHelper('Layout');
        $layout = $layoutHelper->getLayoutInstance();
        $layout->nestedLayout = 'inner_home';
    }


  public function indexAction()
  {

        $this->view->pageTitle = "Ana Maria Machado";
  }


}

