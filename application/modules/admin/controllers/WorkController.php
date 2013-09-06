<?php

class Admin_WorkController extends Zend_Controller_Action
{
    private $db;
    private $editorMapper;
    private $editionMapper;
    private $workMapper;

    public function preDispatch()
    {
        try {
            $checker = new Moxca_Access_PrivilegeChecker();
        } catch (Exception $e) {
            throw $e;
        }
        $this->view->pageTitle = "";
    }

    public function init()
    {
        $this->db = Zend_Registry::get('db');

        $layoutHelper = $this->_helper->getHelper('Layout');
        $layout = $layoutHelper->getLayoutInstance();
        $layout->nestedLayout = 'inner_admin';

        $this->workMapper = new Amm_Collection_WorkMapper($this->db);
        $this->editorMapper = new Amm_Collection_EditorMapper($this->db);
        $this->editionMapper = new Amm_Collection_EditionMapper($this->db);
    }

    public function detailAction()
    {
        $data = array(
            'id' => '1',
            'title' => 'um título',
            'labelType' => 'Infantil',
            'description' => 'O rato estava com fome, mas não tinha nem um resto de rosca para roer. Então ele roeu o reboco, o rádio, o remo e a rolha. Nada matava sua fome. Aí ele roeu a roupa nova do Rei de Roma.',
            'summary' => 'Parte da terceira fase da série Mico Maneco. Enquanto se diverte a criança aprende a leitura dos sons com "r".',
            'editions' => array(
                '1' => array(
                    'editorId' => 1,
                    'editorName' => 'uma editora',
                ),
            ),
        );

        $this->view->pageData = $data;

    }


    public function populateEditorsSelect(Zend_Form_Element_Select $elementSelect, $current)
    {
        $editorMapper = new Amm_Collection_EditorMapper($this->db);
        $list = $editorMapper->getAllEditorsAlphabeticallyOrdered();

        foreach($list as $editorId => $editorName) {
            $elementSelect->addMultiOption($editorId, $editorName);
        }
        $elementSelect->setValue($current);


    }

}