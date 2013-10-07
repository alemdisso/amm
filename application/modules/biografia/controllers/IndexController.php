<?php
class Biografia_IndexController extends Zend_Controller_Action
{
    public function init()
    {
        $layoutHelper = $this->_helper->getHelper('Layout');
        $this->view->setNestedLayout($layoutHelper, 'inner_biografia');
    }

    public function indexAction()
    {

    }

}

