<?php
class Livros_IndexController extends Zend_Controller_Action
{
    public function init()
    {
        $layoutHelper = $this->_helper->getHelper('Layout');
        $layout = $layoutHelper->getLayoutInstance();
        $layout->nestedLayout = 'inner_livros';
    }

    public function indexAction()
    {

        $pageData = array(
            'leftSpecialUri' => 'menina-bonita-do-laco-de-fita',
            'leftSpecialTitle' => 'Menina bonita do laço de fita',
            'leftSpecialSummary' => 'História de uma menina que, de tão bonita, deixa até um coelho apaixonado.',
            'rightSpecialUri' => 'a-audacia-dessa-mulher',
            'rightSpecialTitle' => 'A audácia dessa mulher',
            'rightSpecialSummary' => 'Um romance que engloba varias vertentes e vem do século XIX aos nossos dias.',

        );

        $this->view->pageData = $pageData;

    }
}

