<?php
class Stories_StoryController extends Zend_Controller_Action
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
        $layout->nestedLayout = 'inner_stories';
    }

    public function exploreAction()
    {



        $prizes = array(
                '1' => array(
                    'year' => '1997',
                    'name' => 'Prêmio Américas',
                    'category' =>  '',
                    'institution' => 'Fundalectura, Bogotá, Colômbia'
                ),
                '2' => array(
                    'year' => '1995',
                    'name' => 'Prêmio Melhores do Ano',
                    'category' =>  '',
                    'institution' => 'Biblioteca Nacional da Venezuela'
                ),
                '3' => array(
                    'year' => '1988',
                    'name' => 'Prêmio Bienal de São Paulo',
                    'category' =>  'Menção Honrosa - Uma das Cinco Melhores Obras do Biênio',
                    'institution' => 'Bienal de São Paulo'
                ),
        );

        $prizesLabels = array();
        foreach ($prizes as $prizeId => $prize) {
            $label = "";
            $label = $prize['year'] . " - " . $prize['name'];
            if ($prize['institution']) {
                $label .= ", " . $prize['institution'];
            }
            if ($prize['category']) {
                $label .= " (" . $prize['category'] . ")";
            }
            $prizesLabels[$prizeId] = $label;
        }

       $storyTitle = 'Menina Bonita do Laço de Fita';

        $pageData = array(
            'title' => $storyTitle,
            'bigImageUri' => '/img/marcacao_livro.png',
            'mediumImageUri' => '/img/marcacao_livro.png',
            'editorName' => 'Ática',
            'description' => 'Era uma menina linda. A pele era escura e lustrosa, que nem pêlo da pantera quando pula na chuva. Do lado da casa dela morava um coelho que achava a menina a pessoa mais linda que ele já vira na vida. Queria ter uma filha linda e pretinha como ela. Um dos maiores sucesso da autora.',
            'collectionName' => 'Coleção: Barquinho de Papel',
            'ilustratorName' => 'Capa: Claudius',
            'isbn' => 'ISBN: 8508066392',
            'pages' => '24 p&aacute;ginas',

            'ecommerce' => '/submarino',
            'moreAbout' => true,
            'prizesLabels' => $prizesLabels,
        );


        $this->view->pageData = $pageData;
        $this->view->pageTitle = sprintf($this->view->translate("#Exploring %s"), $storyTitle);

    }
}

