<?php

class Works_View_Helper_SeriesLoop extends Zend_View_Helper_Abstract
{
    public function seriesLoop($model)
    {
        echo $this->view->partialLoop('index/series-loop.phtml', $model);
    }

}

