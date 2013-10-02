<?php

class Works_View_Helper_PrizesLoopLegend extends Zend_View_Helper_Abstract
{
    public function prizesLoopLegend($model)
    {
        return $this->view->partialLoop('index/prizes-loop-legend.phtml', $model);
    }

}

