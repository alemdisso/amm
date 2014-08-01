<?php
class Faq_QuestionController extends Zend_Controller_Action
{
    private $db;
    private $questionMapper;

    public function init()
    {
        $this->initDbAndMappers();

        $this->view->activateNavigation($this->_request, $this->view);

        $layoutHelper = $this->_helper->getHelper('Layout');
        $this->view->setNestedLayout($layoutHelper, 'inner_faq');
    }

    public function postDispatch()
    {
        if (isset($this->view->pageTitle)) {
            $this->_helper->layout()->getView()->headTitle($this->view->pageTitle . " :: Ana Maria Machado");
        }
    }

    public function showAction()
    {
        $this->_helper->layout->disableLayout();
        $data = $this->_request->getParams();
        try {
            $id = $this->view->checkIdFromGet($data);
        } catch (Exception $e) {
            throw $e;
        }

        $questionObj = $this->questionMapper->findById($id);

        $data = array(
            'question' => $questionObj->getQuestion(),
            'answer' => $questionObj->getAnswer()
        );

        $this->view->pageData = $data;

    }

    private function initDbAndMappers()
    {
        $this->db = Zend_Registry::get('db');
        $this->questionMapper = new Moxca_Faq_QuestionMapper($this->db);

    }
}

