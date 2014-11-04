<?php
class Biografia_IndexController extends Zend_Controller_Action
{
    public function init()
    {
        $this->view->activateNavigation($this->_request, $this->view);
        $layoutHelper = $this->_helper->getHelper('Layout');
        $this->view->setNestedLayout($layoutHelper, 'inner_biografia');
    }

    public function postDispatch()
    {
        if (isset($this->view->pageTitle)) {
            $this->_helper->layout()->getView()->headTitle($this->view->pageTitle . " :: Ana Maria Machado");
        }
    }

    public function indexAction()
    {
        $this->view->pageTitle = $this->view->translate("#Biography");

    }

    public function primeirosPassosAction()
    {
        $this->view->pageTitle = $this->view->translate("#Virtual Exposition") . " - Primeiros Passos";

    }

    public function pintandoOCanecoAction()
    {
        $this->view->pageTitle = $this->view->translate("#Virtual Exposition") . " - Pintando o Caneco";

    }

    public function aqueleAbracoAction()
    {
        $this->view->pageTitle = $this->view->translate("#Virtual Exposition") . " - Aquele Abraço";

    }

    public function agoraParaFicarAction()
    {
        $this->view->pageTitle = $this->view->translate("#Virtual Exposition") . " - Agora Para Ficar";

    }

    public function milHistoriasAction()
    {
        $this->view->pageTitle = $this->view->translate("#Virtual Exposition") . " - Mil Histórias";

    }

    public function tempoDeColheitaAction()
    {
        $this->view->pageTitle = $this->view->translate("#Virtual Exposition") . " - Tempo de Colheita";

    }

}

