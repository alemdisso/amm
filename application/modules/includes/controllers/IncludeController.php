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

        $min = 4;
        $max = null;
        foreach($tagsCloud as $id => $tagData) {
//                if ((is_null($min)) || ($tagData['count'] < $min)) {
//                    $min = $tagData['count'];
//                }
                if ((is_null($max)) || ($tagData['count'] > $max)) {
                    $max = $tagData['count'];
                }
        }

        $fontSizes = 5;
        $classes = array(
            '0' => 'tag_2',
            '1' => 'tag_3',
            '2' => 'tag_4',
            '3' => 'tag_5',
            '4' => 'tag_6',
        );
        $range = $max - $min;
        $step = floor($range / $fontSizes);

        reset($tagsCloud);
        $tagsModel = array();
        foreach($tagsCloud as $id => $tagData) {
            $count = $tagData['count'];
            $whichRange = floor(($count-$min) / $step);
            if ($whichRange) {
                $whichRange--;
            }
            if ($whichRange >= count($classes)) {
                $whichRange = count($classes) - 1;
            }

            if ($count >= $min) {
                $tagsModel[] = array('class' => $classes[$whichRange], 'term' => $tagData['term'], 'uri' => $tagData['uri']);
            }

        }



        return $tagsModel;

    }

}
