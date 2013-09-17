<?php

class Admin_View_Helper_EditionsLoop extends Zend_View_Helper_Abstract
{
    public function editionsLoop($model)
    {
        return $this->view->partialLoop('work/editions-loop.phtml', $model);
    }

}

