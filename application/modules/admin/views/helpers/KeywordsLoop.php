<?php

class Admin_View_Helper_KeywordsLoop extends Zend_View_Helper_Abstract
{
    public function keywordsLoop($model)
    {
        return $this->view->partialLoop('work/keywords-loop.phtml', $model);
    }

}

