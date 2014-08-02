<?php

class Default_View_Helper_FaqsLoop extends Zend_View_Helper_Abstract
{
    public function faqsLoop($model)
    {

        echo $this->view->partialLoop('index/faqs-loop.phtml', $model);
    }

}

