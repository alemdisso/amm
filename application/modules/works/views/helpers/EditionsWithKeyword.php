<?php

class Works_View_Helper_EditionsWithKeyword extends Zend_View_Helper_Abstract
{
    public function editionsWithKeyword($model)
    {
        echo $this->view->partial('index/editions-with-keyword.phtml', $model);
    }

}

