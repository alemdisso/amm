<?php
class Works_IndexController extends Zend_Controller_Action
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
        $layout->nestedLayout = 'inner_books';
    }

    public function fictionAction()
    {

        $worksData = array(
                '1' => array(
                    'title' => 'Cabe na mala',
                    'thumbImageUri' => '/img/marcacao_livro.png',
                    'exploreUri' => '/explore/cabe-na-mala',
                    'summary' => 'Da s&eacute;rie Mico Maneco. Essa divertida hist&oacute;ria ajuda a treinar a leitura de palavras com d&iacute;grafos.',
                    'editorName' => 'Moderna',
                    'prizes' => array(),
                    'moreAbout' => false,
                    'otherLanguages' => false,
                ),
                '2' => array(
                    'title' => 'Banho sem chuva',
                    'thumbImageUri' => '/img/marcacao_livro.png',
                    'exploreUri' => '/explore/banho-sem-chuva',
                    'summary' => 'Da s&eacute;rie Mico Maneco. Essa divertida hist&oacute;ria ajuda a treinar a leitura de palavras com d&iacute;grafos.',
                    'editorName' => 'Moderna',
                    'prizes' => array(),
                    'moreAbout' => false,
                    'otherLanguages' => false,
                ),
                '3' => array(
                    'title' => 'Surpresa na sombra',
                    'thumbImageUri' => '/img/marcacao_livro.png',
                    'exploreUri' => '/explore/surpresa-na-sombra',
                    'summary' => 'Da s&eacute;rie Mico Maneco. Essa divertida hist&oacute;ria ajuda a treinar a leitura de palavras com d&iacute;grafos.',
                    'editorName' => 'Moderna',
                    'prizes' => array(),
                    'moreAbout' => false,
                    'otherLanguages' => false,
                ),
        );

        $pageData = array(
            'worksData' => $worksData,
        );

        $this->view->pageData = $pageData;
        $this->view->pageTitle = $this->view->translate("#Ana Maria Machado - Fiction");

    }


    public function indexAction()
    {
        $pageData = array(
            'leftSpecialUri' => '/explore/menina-bonita-do-laco-de-fita',
            'leftSpecialTitle' => 'Menina bonita do laço de fita',
            'leftSpecialSummary' => 'História de uma menina que, de tão bonita, deixa até um coelho apaixonado.',
            'leftSpecialImageUri' => '/img/marcacao_destaque_livro1.png',
            'rightSpecialUri' => '/explore/a-audacia-dessa-mulher',
            'rightSpecialTitle' => 'A audácia dessa mulher',
            'rightSpecialSummary' => 'Um romance que engloba varias vertentes e vem do século XIX aos nossos dias.',
            'rightSpecialImageUri' => '/img/marcacao_destaque_livro2.png',
        );

        $this->view->pageData = $pageData;
        $this->view->pageTitle = "Ana Maria Machado - Histórias";

    }
}

