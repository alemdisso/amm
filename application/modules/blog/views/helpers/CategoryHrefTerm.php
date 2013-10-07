<?php

class Blog_View_Helper_CategoryHrefTerm extends Zend_View_Helper_Abstract
{
    public function categoryHrefTerm($model)
    {
        try {
            $term = $model['term'];
            $uri = $model['uri'];
            return "<a href='/blog/index/category/$uri' title='$term'><strong>$term</strong></a>";
        } catch (Exception $e) {
            throw $e;
        }

        //$model->view->partialLoop('index/category.phtml', $model);
    }

}

