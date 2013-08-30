<?php
class Stories_IndexController extends Zend_Controller_Action
{

    public function postDispatch()
    {
        if (isset($this->view->pageTitle)) {
            $this->_helper->layout()->getView()->headTitle($this->view->pageTitle);
        }
    }

    public function init()
    {
        $layoutHelper = $this->_helper->getHelper('Layout');
        $layout = $layoutHelper->getLayoutInstance();
        $layout->nestedLayout = 'inner_stories';
    }

    public function indexAction()
    {
        $pageData = array(
            'leftSpecialUri' => '/explore/historia/menina-bonita-do-laco-de-fita',
            'leftSpecialTitle' => 'Menina bonita do laço de fita',
            'leftSpecialSummary' => 'História de uma menina que, de tão bonita, deixa até um coelho apaixonado.',
            'leftSpecialImageUri' => '/img/marcacao_destaque_livro1.png',
            'rightSpecialUri' => '/explore/historia/a-audacia-dessa-mulher',
            'rightSpecialTitle' => 'A audácia dessa mulher',
            'rightSpecialSummary' => 'Um romance que engloba varias vertentes e vem do século XIX aos nossos dias.',
            'rightSpecialImageUri' => '/img/marcacao_destaque_livro2.png',
        );

        $this->view->pageData = $pageData;
        $this->view->pageTitle = "Ana Maria Machado - Histórias";

    }
}

