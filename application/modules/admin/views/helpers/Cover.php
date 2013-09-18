<?php

class Admin_View_Helper_Cover extends Zend_View_Helper_Abstract
{
    public function cover($editionId, $pathToFile)
    {
        $model = array(
            'editionId' => $editionId,
            'src' => $pathToFile,
            );
        return $this->view->partial('edition/cover.phtml', $model);
    }

}

