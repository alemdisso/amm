<?php

class Includes_IncludeController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function categoriesAction()
    {

    }

    public function searchAction()
    {

    }

    public function breadcrumbAction()
    {

    }

    public function headerAction()
    {
        $pageData = Array();


        $controller = $this->getFrontController();
        $moduleName = $controller->getParam('outerModule');

        $user = Zend_Registry::get('user');

    }

    public function headerLoginAction()
    {



    }

    public function footerAction()
    {

    }

    public function footerHomeAction()
    {

    }


}