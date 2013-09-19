<?php

class Works_View_Helper_Cover extends Zend_View_Helper_Abstract
{
    public function cover($pathToFile, $exploreUri)
    {
        $model = array(
            'src' => $pathToFile,
            'exploreUri' =>$exploreUri
            );
        echo  $this->view->partial('edition/cover.phtml', $model);
    }

}

