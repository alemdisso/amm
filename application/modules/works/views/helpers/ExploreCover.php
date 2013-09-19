<?php

class Works_View_Helper_ExploreCover extends Zend_View_Helper_Abstract
{
    public function exploreCover($pathToFile, $biggerImgUri="")
    {
        $model = array(
            'src' => $pathToFile,
            'biggerImgUri' =>$biggerImgUri
            );
        
        echo  $this->view->partial('edition/explore-cover.phtml', $model);
    }

}

