<?php
class Livros_LivroController extends Zend_Controller_Action
{

    public function postDispatch()
    {
        if (isset($this->view->pageTitle)) {
            $this->_helper->layout()->getView()->headTitle($this->view->pageTitle);
        }
    }

    public function init()
    {
//        $this->db = Zend_Registry::get('db');
        $layoutHelper = $this->_helper->getHelper('Layout');
        $layout = $layoutHelper->getLayoutInstance();
        $layout->nestedLayout = 'inner_livros';
    }

    public function exploreAction()
    {
        $pageData = array(

            'title' => 'Menina Bonita do Laço de Fita',
            'bigImageUri' => '/img/marcacao_livro.png',
            'mediumImageUri' => '/img/marcacao_livro.png',
            'editorName' => 'Ática',
            'description' => 'Era uma menina linda. A pele era escura e lustrosa, que nem pêlo da pantera quando pula na chuva. Do lado da casa dela morava um coelho que achava a menina a pessoa mais linda que ele já vira na vida. Queria ter uma filha linda e pretinha como ela. Um dos maiores sucesso da autora.',

            'collectionName' => 'Coleção: Barquinho de Papel',
            'ilustratorName' => 'Capa: Claudius',
            'isbn' => 'ISBN: 8508066392',
            'pages' => '24 p&aacute;ginas',

        );


        $this->view->pageData = $pageData;
        $this->view->pageTitle = "Ana Maria Machado - Histórias";

    }
}

