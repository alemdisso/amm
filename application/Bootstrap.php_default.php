<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    public function _initDbAdapter() {
        $config = new Zend_Config_Ini(APPLICATION_PATH . "/configs/application.ini", "staging");

        try {
            $db = Zend_Db::factory($config->conecta);
            $db->getConnection($db);

        } catch (Zend_Db_Adapter_Exception $e) {
            echo $e->getMessage();

        } catch (Zend_Exception $e) {
            echo $e->getMessage();
        }

        Zend_Registry::set('db', $db);
    }


    protected function _initTimezone() {
        date_default_timezone_set('America/Sao_Paulo');
    }

    protected function _initRoutes()
    {
        $config = new Zend_Config_Ini(APPLICATION_PATH . "/configs/routes.ini", "production");
        $frontController  = Zend_Controller_Front::getInstance();
	$router = $frontController->getRouter();
	$router->addConfig($config,'routes');
    }

    protected function _initLocale()
    {
        $session = new Zend_Session_Namespace('lang');

        if ($session->locale) {
            $locale = new Zend_Locale($session->locale);
        } else {
            try {
                $locale = new Zend_Locale('browser');
            } catch (Zend_Locale_Exception $e) {
                $locale = new Zend_Locale('pt_BR');
            }
        }
        $locale = new Zend_Locale('pt_BR');
        Zend_Registry::set('Zend_Locale', $locale);
    }

    protected function _initTranslate()
    {
    $translate = new Zend_Translate('gettext',
            APPLICATION_PATH . '/../languages/'
                , null
                ,array(
                  'scan' => Zend_Translate::LOCALE_DIRECTORY
                  ,'disableNotices' => 1
                    )
        );

        Zend_Registry::set('Zend_Translate', $translate);
    }

    protected function _initUser()
    {
        $user = null;
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $user = $auth->getIdentity();
            if ($user instanceof Moxca_Auth_User) {
                $userLastAccess = strtotime($user->GetLastLogin());
                if ((time() - $userLastAccess) > 60*5) {
                    $date = new Zend_Date();
    //                $userMapper = new Moxca_Auth_UserMapper();
    //                $userMapper->RegisterLogin($user, $date->toString('YYYY-MM-dd HH:mm:ss'));
                }
            }
        }
        Zend_Registry::set('user', $user);
        return $user;
    }

    protected function _initAcl()
    {
        $acl = new Moxca_Access_Acl();
        Zend_Registry::set('acl', $acl);
        return $acl;
    }

    protected function _initKeywords() {
        $view = $this->bootstrap('view')->getResource('view');
        $view->keywords = 'Ana Maria Machado, histórias, livros, literatura, romances, ensaios, literatura infantil, literatura juvenil, stories, books, literature, fiction, essays, youth, children, hans christian andersen, casa de las americas, academia brasileira de letras';
    }

}