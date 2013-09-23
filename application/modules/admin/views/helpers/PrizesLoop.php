<?php

class Admin_View_Helper_PrizesLoop extends Zend_View_Helper_Abstract
{
    public function prizesLoop($model)
    {
        return $this->view->partialLoop('work/prizes-loop.phtml', $model);
    }

}

