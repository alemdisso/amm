<?php

class Includes_IncludeController extends Zend_Controller_Action
{
    private $blogTaxonomyMapper;
    private $collectionTaxonomyMapper;

    public function init()
    {
        $this->initDbAndMappers();
    }

    public function categoriesAction()
    {

        $categoriesModel = $this->fetchCategories($this->blogTaxonomyMapper);
        //print_r($categoriesModel);exit;

        $pageData = array(
            'categories' => $categoriesModel,
        );

        $this->view->pageData = $pageData;

    }

    public function worksCategoriesAction()
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
        $categoriesModel = $this->fetchCategories($this->blogTaxonomyMapper);
        $tagsModel = $this->fetchTagsCloud();

        $pageData = array(
            'categories' => $categoriesModel,
            'tags' => $tagsModel,
        );

        $this->view->pageData = $pageData;
    }

    public function footerHomeAction()
    {

        $categoriesModel = $this->fetchCategories($this->blogTaxonomyMapper);
        $tagsModel = $this->fetchTagsCloud();

        $pageData = array(
            'categories' => $categoriesModel,
            'tags' => $tagsModel,
        );

        $this->view->pageData = $pageData;

    }

    private function initDbAndMappers()
    {
        $this->db = Zend_Registry::get('db');
        $this->blogTaxonomyMapper = new Moxca_Blog_TaxonomyMapper($this->db);
        $this->collectionTaxonomyMapper = new Author_Collection_TaxonomyMapper($this->db);
    }

    private function fetchCategories($taxonomyMapper)
    {
        $ids = $taxonomyMapper->getAllCategoriesAlphabeticallyOrdered();
        $idsCount = count($ids);
        $categoriesModel = array();
        $lastInsertedId = null;

        foreach ($ids as $id => $term) {
            $termAndUri = $taxonomyMapper->getTermAndUri($id);
            $publishedIds = $taxonomyMapper->getPublishedPostsByCategory($termAndUri['uri']);
            //echo "publ " . count($publishedIds) . " for $term ($id) <br />";
            if (count($publishedIds)) {
                //$termAndUri = $taxonomyMapper->getTermAndUri($id);
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


    private function fetchTagsCloud()
    {
        $tagsCloud = $this->collectionTaxonomyMapper->getAllWorksKeywordsAlphabeticallyOrdered();

        $weight = array();

        foreach($tagsCloud as $id => $tagData) {
            if ($tagData['count'] > 0) {
                $weight[] = array('id' => $id, 'count' => $tagData['count']);
            }
        }
        $i = count($weight);
        if ($i) {
            $medianIndex = ceil($i/2);
            if(isset($weight[$medianIndex]['count'])) {
                $median = $weight[$medianIndex]['count'];
            } else {
                $median = 0;
            }
        }
        reset($tagsCloud);
        $tagsModel = array();

        foreach($tagsCloud as $id => $tagData) {
            if ($tagData['count'] < $median) {
                $class = 'tag_1';
            } elseif ($tagData['count'] == $median) {
                $class = 'tag_2';
            } else {
                $class = 'tag_3';
            }
            $tagsModel[] = array('class' => $class, 'term' => $tagData['term'], 'uri' => $tagData['uri']);
        }

        return $tagsModel;

    }

}
