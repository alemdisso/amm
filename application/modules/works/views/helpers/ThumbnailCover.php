<?php

class Works_View_Helper_ThumbnailCover extends Zend_View_Helper_Abstract
{
    public function thumbnailCover($pathToFile, $exploreUri, $title="")
    {
        $model = array(
            'src' => $pathToFile,
            'exploreUri' =>$exploreUri,
            'title' => $title,
            );
        echo  $this->view->partial('edition/thumbnail-cover.phtml', $model);
    }

}

