<?php

class Includes_IncludeController extends Zend_Controller_Action
{

    public function init()
    {
        $this->initDbAndMappers();
    }

    public function categoriesAction()
    {
        $ids = $this->taxonomyMapper->getAllCategoriesAlphabeticallyOrdered();
        $idsCount = count($ids);

        foreach ($ids as $id => $term) {
            $idsCount--;
            $termAndUri = $this->taxonomyMapper->getTermAndUri($id);
            $categoriesModel[$id] = array(
                'label' => $termAndUri['term'],
                'uri' => $termAndUri['uri'],
                'last' => ($idsCount > 0 ? false : true),
            );

        }



        $pageData = array(
            'categories' => $categoriesModel,
        );

        $this->view->pageData = $pageData;


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

    private function initDbAndMappers()
    {
        $this->db = Zend_Registry::get('db');
        $this->taxonomyMapper = new Author_Collection_TaxonomyMapper($this->db);
    }

}
