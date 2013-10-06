<?php
class Blog_IndexController extends Zend_Controller_Action
{
    public function init()
    {
        $layoutHelper = $this->_helper->getHelper('Layout');
        $layout = $layoutHelper->getLayoutInstance();
        $layout->nestedLayout = 'inner_blog';
    }

    public function indexAction()
    {

    }
}

