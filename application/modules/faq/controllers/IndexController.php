<?php
class Faq_IndexController extends Zend_Controller_Action
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

    public function indexAction()
    {
        $data = $this->_request->getParams();
        try {
            $id = $this->view->checkIdFromGet($data);
        } catch (Exception $e) {
            $id = null;
        }
        $q = $this->questionMapper->getAllActiveQuestionsIdsAndTitles();

        $loopData = array();
        foreach($q as $key => $row) {
            if ($row['id'] == $id) {
                $selected = true;
            } else {
                $selected = false;
            }
            $questionObj = $this->questionMapper->findById($row['id']);
            $loopData[$key] = array (
                'id' => $row['id'],
                'question' => $questionObj->getQuestion(),
                'answer' => $questionObj->getAnswer(),
                'selected' => $selected,
            );

        }

        $pageData = array(
            'faqData' => $loopData,
            'selectedQuestion' => $id,
        );



        $this->view->pageData = $pageData;
        $this->view->pageTitle = "Respostas";
    }

    private function initDbAndMappers()
    {
        $this->db = Zend_Registry::get('db');
        $this->questionMapper = new Moxca_Faq_QuestionMapper($this->db);

    }
}

