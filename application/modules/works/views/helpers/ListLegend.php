<?php

class Works_View_Helper_ListLegend extends Zend_View_Helper_Abstract
{
    public function listLegend()
    {
        echo $this->view->partial('edition/list-legend.phtml');
    }

}

