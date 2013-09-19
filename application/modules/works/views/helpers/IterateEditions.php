<?php

class Works_View_Helper_IterateEditions extends Zend_View_Helper_Abstract
{
    public function iterateEditions($a)
    {
            echo $this->view->partialLoop('work/editions-loop.phtml', $a);
    }
}

