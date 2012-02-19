<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    /* conecta */
    
    public function _initDbAdapter() {
        $config = new Zend_Config_Ini(APPLICATION_PATH . "/configs/application.ini", "development");
        //$config = new Zend_Config_Ini(APPLICATION_PATH . "/configs/application.ini", "production");

        try {
            $db = Zend_Db::factory($config->conecta);
            $db->getConnection($db);
        
        } catch (Zend_Db_Adapter_Exception $e) {
            //echo $e->getMessage();
            die('Could not connect to database.');

        } catch (Zend_Exception $e) {
            //echo $e->getMessage();
            die('Could not connect to database.');

        }

        Zend_Registry::set('db', $db);

    }


    protected function _initTimezone() {
        date_default_timezone_set('America/Sao_Paulo');
    }


    protected function _initLocale() {
        $session = new Zend_Session_Namespace('lang');

        if ($session->locale) {
            $locale = new Zend_Locale($session->locale);

        } else {
            $locale = new Zend_Locale('pt_BR');
        }

        Zend_Registry::set('Zend_Locale', $locale);

    }
    


}