<?php

class Works_View_Helper_EditionsLoop extends Zend_View_Helper_Abstract
{
    public function editionsLoop($model)
    {
        echo $this->view->partialLoop('work/editions-loop.phtml', $model);
    }

}

