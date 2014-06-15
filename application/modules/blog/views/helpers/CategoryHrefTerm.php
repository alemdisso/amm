<?php

class Blog_View_Helper_CategoryHrefTerm extends Zend_View_Helper_Abstract
{
    public function categoryHrefTerm($model)
    {
        try {
            $term = $model['term'];
            $uri = $model['uri'];
            $hrefRoot = $this->view->translate("/blog/index/category");
            return "<a href='$hrefRoot/$uri' title='$term'><strong>$term</strong></a>";
        } catch (Exception $e) {
            throw $e;
        }
    }

}

