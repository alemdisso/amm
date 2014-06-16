<?php

class Includes_IncludeController extends Zend_Controller_Action
{

    public function init()
    {
        $this->initDbAndMappers();
    }

    public function categoriesAction()
    {

        $categoriesModel = $this->fetchCategories($this->taxonomyMapper);

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
        $categoriesModel = $this->fetchCategories($this->taxonomyMapper);

        $pageData = array(
            'categories' => $categoriesModel,
        );

        $this->view->pageData = $pageData;



    }

    public function footerHomeAction()
    {

        $categoriesModel = $this->fetchCategories($this->taxonomyMapper);

        $pageData = array(
            'categories' => $categoriesModel,
        );

        $this->view->pageData = $pageData;

    }

    private function initDbAndMappers()
    {
        $this->db = Zend_Registry::get('db');
        $this->taxonomyMapper = new Author_Collection_TaxonomyMapper($this->db);
    }

    private function fetchCategories($taxonomyMapper)
    {
        $ids = $taxonomyMapper->getAllCategoriesAlphabeticallyOrdered();
        $idsCount = count($ids);
        $categoriesModel = array();
        $lastInsertedId = null;

        foreach ($ids as $id => $term) {
            $publishedIds = $this->taxonomyMapper->getPublishedPostsByCategory($term);
            if (count($publishedIds)) {
                $termAndUri = $taxonomyMapper->getTermAndUri($id);
                $categoriesModel[$id] = array(
                    'label' => $termAndUri['term'],
                    'uri' => $termAndUri['uri'],
                    'last' => false,
                );
                $lastInsertedId = $id;
            }

        }
        if ($lastInsertedId) {
            $categoriesModel[$lastInsertedId]['last'] = true;
        }


        return ($categoriesModel);


    }

}
