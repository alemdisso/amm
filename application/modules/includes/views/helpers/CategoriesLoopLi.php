<?php

class Includes_View_Helper_CategoriesLoopLi extends Zend_View_Helper_Abstract
{
    public function categoriesLoopLi($model)
    {
        echo $this->view->partialLoop('include/categories-loop-li.phtml', 'includes', $model);
    }

}

