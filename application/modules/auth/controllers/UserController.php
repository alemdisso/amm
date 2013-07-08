<?php

class Auth_UserController extends Zend_Controller_Action
{
    private $userMapper;
    private $db;

    public function preDispatch()
    {
        try {
            $checker = new Moxca_Access_PrivilegeChecker();
        } catch (Exception $e) {
            $this->_helper->getHelper('FlashMessenger')
                ->addMessage(_('#Access denied'));
            $this->_redirect('/' . $id);
        }
    }

    public function init()
    {
        $this->db = Zend_Registry::get('db');
        $this->userMapper = new Moxca_Auth_UserMapper($this->db);
    }

    public function createAction()
    {
        // cria form
        $form = new Moxca_Form_UserCreate;
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $postData = $this->getRequest()->getPost();
            if ($form->isValid($postData)) {
                $form->process($postData);
                $this->_helper->getHelper('FlashMessenger')
                    ->addMessage($this->view->translate('#The record was successfully updated.'));
                $this->_redirect('/auth/user/success');
            } else {
                //form error: populate and go back
                $form->populate($postData);
                $this->view->form = $form;
            }
        } else {

        }
    }

    public function editAction()
    {
        $form = new Moxca_Form_UserEdit;
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $postData = $this->getRequest()->getPost();
            try {
                if ($form->isValid($postData)) {
                    $form->process($postData);
                    $this->_helper->getHelper('FlashMessenger')
                        ->addMessage($this->view->translate('#The record was successfully updated.'));
                    $this->_redirect('/auth/user/success');
                }
            } catch (Exception $e) {
                $this->_helper->getHelper('FlashMessenger')
                    ->addMessage($e->getMessage());
                $this->view->form = $form;
                return $this->render('create');

            }
        } else {
            // GET
            $thisUser = $this->InitUserWithCheckedId($this->userMapper);
            $id = $this->checkIdFromGet();
            Moxca_Util_FormFieldValueSetter::SetValueToFormField($form, 'id', $id);
            Moxca_Util_FormFieldValueSetter::SetValueToFormField($form, 'name', $thisUser->GetName());
            Moxca_Util_FormFieldValueSetter::SetValueToFormField($form, 'login', $thisUser->GetLogin());
            Moxca_Util_FormFieldValueSetter::SetValueToFormField($form, 'email', $thisUser->GetEmail());
            Moxca_Util_FormFieldValueSetter::SetValueToFormField($form, 'role', $thisUser->GetRole());
          }
    }

    public function successAction()
    {
        if ($this->_helper->getHelper('FlashMessenger')->getMessages()) {
            $this->view->messages = $this->_helper->getHelper('FlashMessenger')->getMessages();
            $this->getResponse()->setHeader('Refresh', '1; URL=/');
        } else {
            $this->_redirect('/');
        }
    }

    private function initUserMapper()
    {
         $this->userMapper = new Moxca_Auth_UserMapper($this->db);
    }

    private function InitUserWithCheckedId(Moxca_Auth_UserMapper $mapper)
    {
        return $mapper->findById($this->checkIdFromGet());
    }

    private function checkIdFromGet()
    {
        $data = $this->_request->getParams();
        $filters = array(
            'id' => new Zend_Filter_Alnum(),
        );
        $validators = array(
            'id' => array('Digits', new Zend_Validate_GreaterThan(0)),
        );
        $input = new Zend_Filter_Input($filters, $validators, $data);
        if ($input->isValid()) {
            $id = $input->id;
            return $id;
        }
        throw new Moxca_Auth_UserException(_("#Invalid User Id from Get"));
    }
}