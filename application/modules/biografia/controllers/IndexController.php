<?php
class Biografia_IndexController extends Zend_Controller_Action
{
    public function init()
    {
        $this->view->activateNavigation($this->_request, $this->view);
        $layoutHelper = $this->_helper->getHelper('Layout');
        $this->view->setNestedLayout($layoutHelper, 'inner_biografia');
    }

    public function postDispatch()
    {
        if (isset($this->view->pageTitle)) {
            $this->_helper->layout()->getView()->headTitle($this->view->pageTitle . " :: Ana Maria Machado");
        }
    }

    public function indexAction()
    {
        $this->view->pageTitle = $this->view->translate("#Biography");

    }

}

