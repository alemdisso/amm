<?php

class Auth_LoginController extends Zend_Controller_Action
{

    public function init()
    {
    }

    public function indexAction()
    {

        $layoutHelper = $this->_helper->getHelper('Layout');
        $layout = $layoutHelper->getLayoutInstance();


        $layout->nestedLayout = 'login';

        $form = new Moxca_Form_UserLogin;
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $postData = $this->getRequest()->getPost();
            if ($form->isValid($postData)) {
                $user = $form->process($postData);
                if ($user instanceOf Moxca_Auth_User ) {
                    $session = new Zend_Session_Namespace('moxca.auth');
                    $session->user = $user;
                    $this->_redirect("/home");
//                    if (isset($session->requestURL)) {
//                        $url = $session->requestURL;
//                        unset($session->requestURL);
//                        $this->_redirect($url);
//                    } else {
//                        $this->_helper->getHelper('FlashMessenger')
//                            ->addMessage('You were successfully logged in.');
//                        $this->_redirect('/projects');
//                    }

                }

            } else {
                $this->view->form = $form;
                $this->view->message = _('#You could not be logged in. Please try again.');
                return $this->render('login');

            }

        }

    }

//    public function logoutAction()
//    {
//        Zend_Auth::getInstance()->clearIdentity();
//        Zend_Session::destroy();
//        $this->_redirect('/auth/login');
//    }


}
