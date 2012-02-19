<?php

require_once APPLICATION_PATH . "/modules/includes/models/MediadorIncludes.php";

class Includes_FooterController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }


    public function incluiMockAction()
    {
        /* Initialize model and retrieve data here */

        /* Initialize view and populate here */
        
        //links_footer
		//	secretaria: verdadeiro/falso
		//	administracao: verdadeiro/falso
        $dadosPagina['links_footer']['secretaria'] = true;
		$dadosPagina['links_footer']['administracao'] = false;

        $this->view->linksFooter = $dadosPagina['links_footer'];

        $this->render("inclui"); //use different view
    }


    public function incluiAction()
    {
        /* Initialize model and retrieve data here */
        
        $reqIncludes = new MediadorIncludes();

        $dadosPagina = Array();

        /* Initialize view and populate here */
        
        //links_footer: verdadeiro/falso
        $auth = Zend_Auth::getInstance();

        if ($auth->hasIdentity()) {
            $identity = $auth->getIdentity();

            $this->view->identity = $identity;
            
            $retPapel = $reqIncludes->recuperaPapelPorCodigoUsuario($identity->codUsuario);

            if ((!$retPapel['cod_ret']) && (!is_null($retPapel['val_ret']))) {
                $thisPapel = $retPapel['val_ret'];

                if (($thisPapel->pegaTituloUnico() == "secretario") || ($thisPapel->pegaTituloUnico() == "coordenador") || ($thisPapel->pegaTituloUnico() == "administrador")){
                    $dadosPagina['links_footer']['secretaria'] = true;
                }
		if ($thisPapel->pegaTituloUnico() == "administrador"){
                    $dadosPagina['links_footer']['administracao'] = true;
                }

            }

        } 

        $this->view->linksFooter = $dadosPagina['links_footer'];        

    }


}