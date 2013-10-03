<?php

class Works_View_Helper_PaginationTest extends Zend_View_Helper_Abstract
{
    public function paginationTest($model)
    {
        echo $this->view->partial('index/pagination-test.phtml', $model);
    }

}

