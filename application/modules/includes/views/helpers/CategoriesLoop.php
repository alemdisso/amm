<?php

class Includes_View_Helper_CategoriesLoop extends Zend_View_Helper_Abstract
{
    public function categoriesLoop($model)
    {
        echo $this->view->partialLoop('include/categories-loop.phtml', 'includes', $model);
    }

}

