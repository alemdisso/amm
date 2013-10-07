<?php

class Blog_View_Helper_PostsLoop extends Zend_View_Helper_Abstract
{
    public function postsLoop($model)
    {
        echo $this->view->partialLoop('index/posts-loop.phtml', $model);
    }

}

