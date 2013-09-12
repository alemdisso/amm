<?php
class Works_WorkController extends Zend_Controller_Action
{
    private $workMapper;
    private $db;

    public function postDispatch()
    {
        if (isset($this->view->pageTitle)) {
            $this->_helper->layout()->getView()->headTitle($this->view->pageTitle);
        }
    }

    public function init()
    {
        $this->db = Zend_Registry::get('db');
        $layoutHelper = $this->_helper->getHelper('Layout');
        $layout = $layoutHelper->getLayoutInstance();
        $layout->nestedLayout = 'inner_books';
    }

    public function exploreAction()
    {

        $this->workMapper = new Author_Collection_WorkMapper($this->db);

        $uri = $this->checkUriFromGet();

        $work = $this->workMapper->findByUri($uri);

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

       $workTitle = 'Menina Bonita do Laço de Fita';

        $pageData = array(
            'title' => $work->getTitle(),
            'bigImageUri' => '/img/marcacao_livro.png',
            'mediumImageUri' => '/img/marcacao_livro.png',
            'editorName' => 'Ática',
            'description' => $work->getDescription(),
            'collectionName' => 'Coleção: Barquinho de Papel',
            'ilustratorName' => 'Capa: Claudius',
            'isbn' => 'ISBN: 8508066392',
            'pages' => '24 p&aacute;ginas',

            'ecommerce' => '/submarino',
            'moreAbout' => true,
            'prizesLabels' => $prizesLabels,
        );


        $this->view->pageData = $pageData;
        $this->view->pageTitle = sprintf($this->view->translate("#Exploring %s"), $workTitle);

    }


    private function checkUriFromGet()
    {
        $data = $this->_request->getParams();
        $validator = new Moxca_Util_ValidTitle();

        if ($validator->isValid($data['uri'])) {
            $uri = $data['uri'];
            return $uri;
        }
        throw new C3op_Projects_ProjectException("Invalid Project Id from Get");

    }



}

