<?php
require_once APPLICATION_PATH . "/modules/autenticacao/models/MediadorAutenticacao.php";

class Autenticacao_LoginController extends Zend_Controller_Action
{

    public function init()
    {
         /* Initialize action controller here */

        // autenticacao: create and register translation object
        $translate = new Zend_Translate('array',  APPLICATION_PATH . '/../language/autenticacao.pt.php', 'pt_BR');
        //$translate->addTranslation(APPLICATION_PATH . '/../language/autenticacao.en.php', 'en_US');
        $translate->setLocale(Zend_Registry::get('Zend_Locale'));
        Zend_Registry::set('Zend_Translate', $translate);
    }


    public function acessaMockAction()
    {
        /* Initialize model and retrieve data here */
        $html = new Moxca_Html_Html();

        $this->view->html = $html;

        /* Initialize view and populate here */

        //dadosUsuario
        //  login: texto
        //  senha: texto
        //  dadosUsuarioEnviado: verdadeiro/falso
        //  dadosUsuarioEnviadoComErro: verdadeiro/falso
        //  mensagem_erro_dadosUsuario: texto
        $dadosPagina['dadosUsuario']['login'] = "";
        $dadosPagina['dadosUsuario']['senha'] = "";
        $dadosPagina['dadosUsuario']['dadosUsuarioEnviado'] = false;
        $dadosPagina['dadosUsuario']['dadosUsuarioEnviadoComErro'] = false;
        $dadosPagina['dadosUsuario']['mensagem_erro_dadosUsuario'] = "Senha inv&aacute;lida!";

        $this->view->dadosUsuario = $dadosPagina['dadosUsuario'];
        
        //link_solicita_senha
        $dadosPagina['link_solicita_senha'] = "/autenticacao/conta/solicita-senha-mock";
        
        $this->view->linkSolicitaSenha = $dadosPagina['link_solicita_senha'];

        //titulo_pagina
        $dadosPagina['titulo_pagina'] = "Login";

        $this->view->tituloPagina = $dadosPagina['titulo_pagina'];

        //breadcrumb: texto
        $dadosBreadcrumb['Principal'] = "/";
        $dadosBreadcrumb[$dadosPagina['titulo_pagina']] = "";
        $dadosPagina["breadcrumb"] = $html->breadcrumb($dadosBreadcrumb, "", "", " &gt; ");

        $this->view->breadcrumb = $dadosPagina['breadcrumb'];

        //title
        $dadosPagina['title'] = "Ao Cubo";

        $layoutHelper = $this->_helper->getHelper('Layout');
        $layout = $layoutHelper->getLayoutInstance();

        $layout->title = $dadosPagina['title'];
        
        $layout->nestedLayout = 'login';

        $this->render("acessa"); //use different view
    }


    public function acessaAction()
    {
        /* Initialize model and retrieve data here */

        $nivelPagina = "desconhecido";

        $html = new Moxca_Html_Html();

        $this->view->html = $html;

        $reqAutenticacao = new MediadorAutenticacao();

        $dadosPagina = Array();
        
        $translate = Zend_Registry::get('Zend_Translate');

        /* Initialize view and populate here */

        //dadosUsuario
        //  login: texto
        //  senha: texto
        //  dadosUsuarioEnviado: verdadeiro/falso
        //  dadosUsuarioEnviadoComErro: verdadeiro/falso
        //  mensagem_erro_dadosUsuario: texto
        if ($this->getRequest()->isPost()) {
             $postData = $this->getRequest()->getPost();

             if (isset($postData['etapaEnvio'])) {
                $etapaEnvio = $postData['etapaEnvio'];

                if ($etapaEnvio == 1) {
                    if ($html->validaEntradaSimples($postData["txtLogin"])) {
                         $dadosPagina['dadosUsuario']['dadosUsuarioEnviado'] = true;

                         //$senhaLimpa = str_replace("\'","&quot;",addslashes($html->limpaCampo($postData["txtSenha"])));
                        $senhaLimpa = str_replace(";", "&#059;", addslashes($html->limpaCampo($postData["txtSenha"])));
                        $senhaLimpa = str_replace("~","-",$senhaLimpa);
                        $senhaLimpa = str_replace("\"","&quot;",$senhaLimpa);
                        $senhaLimpa = str_replace("\'","&quot;",$senhaLimpa);
                        $senhaLimpa = stripslashes($senhaLimpa);

			//$loginLimpa = str_replace("\'","&quot;",addslashes($html->limpaCampo($postData["txtLogin"])));
			$loginLimpa = str_replace(";", "&#059;", addslashes($html->limpaCampo($postData["txtLogin"])));
			$loginLimpa = str_replace("~","-",$loginLimpa);
			$loginLimpa = str_replace("\"","&quot;",$loginLimpa);
			$loginLimpa = str_replace("\'","&quot;",$loginLimpa);
			$loginLimpa = stripslashes($loginLimpa);

                        $retEfetuaLogin = $reqAutenticacao->efetuaLogin($loginLimpa, $senhaLimpa);

			if ((!$retEfetuaLogin['cod_ret']) && (!is_null($retEfetuaLogin['val_ret']))) {
                            $codUsuario = $retEfetuaLogin['val_ret'];

                            $session = new Zend_Session_Namespace('meuPermalink');

                            if (isset($session->iaPara)) {
                                $url = $session->iaPara;
                                unset($session->iaPara);
                                $this->_redirect($url);

                            } else {
                                $this->_redirect('/');
                            }

                        } else if ($retEfetuaLogin['cod_ret'] == 2) {
                            $dadosPagina['dadosUsuario']['dadosUsuarioEnviadoComErro'] = true;
                            $etapaLogin = 1;
                            $saudacaoLogin = $translate->_('usuario_inativo');

			} else if ($retEfetuaLogin['cod_ret'] == 3) {
                            $dadosPagina['dadosUsuario']['dadosUsuarioEnviadoComErro'] = true;
                            $etapaLogin = 1;
                            $saudacaoLogin = $translate->_('usuario_bloqueado');

                        } else if ($retEfetuaLogin['cod_ret'] == 4) {
                            $dadosPagina['dadosUsuario']['dadosUsuarioEnviadoComErro'] = true;
                            $etapaLogin = 1;
                            $saudacaoLogin = "Login inexistente.";

			} else {
                            $dadosPagina['dadosUsuario']['dadosUsuarioEnviadoComErro'] = true;
                            $etapaLogin = 1;
                            $saudacaoLogin = $translate->_('erro_login_senha');

			}

                    } else {
                        $dadosPagina['dadosUsuario']['dadosUsuarioEnviadoComErro'] = true;
			$etapaLogin = 1;
			$saudacaoLogin = $translate->_('erro_login_senha');

                    }

                    $dadosPagina['dadosUsuario']['login'] = "";
                    $dadosPagina['dadosUsuario']['senha'] = "";
                    $dadosPagina['dadosUsuario']['mensagem_erro_dadosUsuario'] = $saudacaoLogin;

                }

             }

        } else {
            $dadosPagina['dadosUsuario']['login'] = "";
            $dadosPagina['dadosUsuario']['senha'] = "";
            $dadosPagina['dadosUsuario']['dadosUsuarioEnviado'] = false;
            $dadosPagina['dadosUsuario']['dadosUsuarioEnviadoComErro'] = false;
            $dadosPagina['dadosUsuario']['mensagem_erro_dadosUsuario'] = "";

        }

        $this->view->dadosUsuario = $dadosPagina['dadosUsuario'];

        //titulo_pagina: texto
        $dadosPagina['titulo_pagina'] = $translate->_('login');

        $this->view->tituloPagina = $dadosPagina['titulo_pagina'];

        //breadcrumb: texto
        $dadosBreadcrumb[$translate->_('title_home')] = "/";
        $dadosBreadcrumb[$dadosPagina['titulo_pagina']] = "";
        $dadosPagina["breadcrumb"] = $html->breadcrumb($dadosBreadcrumb, "", "", " &gt; ");

        $this->view->breadcrumb = $dadosPagina['breadcrumb'];

        //title
        $dadosPagina['title'] = $translate->_('title_site');

        $layoutHelper = $this->_helper->getHelper('Layout');
        $layout = $layoutHelper->getLayoutInstance();

        $layout->title = $dadosPagina['title'];
        
        $layout->nestedLayout = 'login';
    }


    public function retiraAction()
    {
        /* Initialize model and retrieve data here */

        $reqAutenticacao = new MediadorAutenticacao();

        /* Initialize view and populate here */

        $session = new Zend_Session_Namespace('meuPermalink');

        if (isset($session->iaPara)) {
            $url = $session->iaPara;
        } else {
            $url = '/autenticacao/login/acessa';
        }

        $reqAutenticacao->efetuaLogout();

        $this->_redirect($url);

    }


}