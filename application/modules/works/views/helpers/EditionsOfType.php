<?php

class Works_View_Helper_EditionsOfType extends Zend_View_Helper_Abstract
{
    public function editionsOfType($model)
    {
        echo $this->view->partial('index/editions-of-type.phtml', $model);
    }

}

