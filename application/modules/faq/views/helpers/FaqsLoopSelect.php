<?php

class Faq_View_Helper_FaqsLoopSelect extends Zend_View_Helper_Abstract
{
    public function faqsLoopSelect($model)
    {

        echo $this->view->partialLoop('index/faqs-loop-select.phtml', $model);
    }

}

