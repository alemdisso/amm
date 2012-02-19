<?php
require_once APPLICATION_PATH . "/modules/acervo/models/MediadorAcervo.php";

class Acervo_LivroController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
     
        

        $reqAcervo = new MediadorAcervo();
        $reqItem = $reqAcervo->find("1");
        $thisItem = $reqItem['val_ret'];
        
        
        $this->view->livro = "LIVRO! " . $thisItem->getTitulo() . "-" . $thisItem->getEditora();
        
        
                        
        $layoutHelper = $this->_helper->getHelper('Layout');
        $layout = $layoutHelper->getLayoutInstance();
        //$layout->setLayout('livro');
        $layout->title = "Um conto";
        $layout->nestedLayout = 'livro';
   
        $this->render("index"); //use different view

        
    }
            
    
    
}