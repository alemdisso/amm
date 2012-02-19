<?php
require_once APPLICATION_PATH . "/modules/autenticacao/models/MediadorAutenticacao.php";

class Autenticacao_ContaController extends Zend_Controller_Action
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


    public function criaMockAction()
    {
        /* Initialize model and retrieve data here */
        $html = new Moxca_Html_Html();

        $this->view->html = $html;

        /* Initialize view and populate here */

        //novo_usuario
        //  id: numero
        //  apelido: texto
        //  nome: texto
        //  sobrenome: texto
        //  senha: texto
        //  senha_repetida: texto
        //  email: texto
        //  status: texto
        //  papel: texto
        //  usuarioEnviado: verdadeiro/falso
        //  usuarioEnviadoComErro: verdadeiro/falso
        //  mensagem_erro_usuario: texto
        $dadosPagina['novo_usuario']['id'] = 1;
        $dadosPagina['novo_usuario']['apelido'] = "";
        $dadosPagina['novo_usuario']['nome'] = "";
        $dadosPagina['novo_usuario']['sobrenome'] = "";
        $dadosPagina['novo_usuario']['senha'] = "";
        $dadosPagina['novo_usuario']['senha_repetida'] = "";
        $dadosPagina['novo_usuario']['email'] = "";
        $dadosPagina['novo_usuario']['status'] = "";
        $dadosPagina['novo_usuario']['papel'] = "";
        $dadosPagina['novo_usuario']['usuarioEnviado'] = false;
        $dadosPagina['novo_usuario']['usuarioEnviadoComErro'] = false;
        $dadosPagina['novo_usuario']['mensagem_erro_usuario'] = "J&aacute; existe usu&aacute;rio cadastrado com o email informado.";

        $this->view->novoUsuario = $dadosPagina['novo_usuario'];

        //titulo_pagina: texto
        if ($dadosPagina['novo_usuario']['id']) {
            $dadosPagina['titulo_pagina'] = "Editar usu&aacute;rio";
        } else {
            $dadosPagina['titulo_pagina'] = "Criar usu&aacute;rio";
        }

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


        $this->render("cria"); //use different view
    }


    public function criaAction()
    {
        /* Initialize model and retrieve data here */

        $nivelPagina = "administrador";

        $html = new Moxca_Html_Html();

        $this->view->html = $html;

        $reqAutenticacao = new MediadorAutenticacao();

        $dadosPagina = Array();

        $reqAutenticacao->checaLogin($nivelPagina);

        $translate = Zend_Registry::get('Zend_Translate');

        /* Initialize view and populate here */

        //novo_usuario
        //  id: numero
        //  apelido: texto
        //  nome: texto
        //  sobrenome: texto
        //  senha: texto
        //  senha_repetida: texto
        //  email: texto
        //  status: texto
        //  papel: texto
        //  usuarioEnviado: verdadeiro/falso
        //  usuarioEnviadoComErro: verdadeiro/falso
        //  mensagem_erro_usuario: texto
         if ($this->getRequest()->isPost()) {
             $postData = $this->getRequest()->getPost();

             //print_r($postData);

             if (isset($postData['etapaEnvio'])) {
                $etapaEnvio = $postData['etapaEnvio'];

                if ($etapaEnvio == 1) {
                    $dadosPagina['novo_usuario']['usuarioEnviado'] = true;

                    $codUsuario = 0;
                    $retUsuario = $reqAutenticacao->retornaUsuarioVazio();

                    if ((!$retUsuario['cod_ret']) && (!is_null($retUsuario['val_ret']))) {
                        $novoUsuario = $retUsuario['val_ret'];
                    }

                    //controle acesso
                    if (!isset($novoUsuario)) {
                        header("location: /home");
                        exit;
                    }

                    //nome*
                    if ($campoLimpo = $html->validaEntradaSimples($postData["txtNome"])) {
                        $novoUsuario->setaNome(substr($campoLimpo, 0, 120));
                        if (strlen($campoLimpo) > 120) {
                            $msgCampos .= " " . $translate->_('erro_nome_caracteres');
                            $erroMedio = 1;
                        }

                    } else {
                        $msgCampos .= " " . $translate->_('erro_nome_invalido');
                        $erroGrave = 1;
                    }

                    //sobrenome*
                    if ($campoLimpo = $html->validaEntradaSimples($postData["txtSobrenome"])) {
                        $novoUsuario->setaSobrenome(substr($campoLimpo, 0, 120));
                        if (strlen($campoLimpo) > 120) {
                            $msgCampos .= " " . $translate->_('erro_sobrenome_caracteres');
                            $erroMedio = 1;
                        }

                    } else {
                        $msgCampos .= " " . $translate->_('erro_sobrenome_invalido');
                        $erroGrave = 1;
                    }

                    //apelido*
                    if ($campo = $html->validaEntradaSimples($postData["txtApelido"])) {
                        $campoLimpo = $html->sanitiza($campo);

                        $apelidoOK = $novoUsuario->setaApelido(substr($campoLimpo, 0, 80));

                        if (!$apelidoOK) {
                            $msgCampos .= " " . $translate->_('erro_apelido_repetido');
                            $erroGrave = 1;

                        } else if (strlen($campoLimpo) > 80) {
                            $msgCampos .= " " . $translate->_('erro_apelido_caracteres');
                            $erroMedio = 1;
                        }

                    } else {
                        $msgCampos .= " " . $translate->_('erro_apelido_invalido');
                        $erroGrave = 1;
                    }

                    //email*
                    if ($html->validaFormacaoEmail($postData["txtEmail"])) {
                        if ($campoLimpo = $html->validaEntradaSimples($postData["txtEmail"])) {
                            $emailOK = $novoUsuario->setaEmail(substr($campoLimpo, 0, 80));

                            if (!$emailOK) {
                                $msgCampos .= " " . $translate->_('erro_email_repetido');
                                $erroGrave = 1;

                            } else if (strlen($campoLimpo) > 80) {
                                $msgCampos .= " " . $translate->_('erro_email_caracteres');
                                $erroGrave = 1;
                            }

                        } else {
                            $msgCampos .= " " . $translate->_('erro_email_invalido');
                            $erroGrave = 1;
                        }

                    } else {
                        $msgCampos .= " " . $translate->_('erro_email_invalido');
                        $erroGrave = 1;
                    }

                    //senha*
                    if ($campoLimpo1 = $html->validaEntradaSimples($postData["txtCriaSenhaUsuario"])) {
                        if ($campoLimpo2 = $html->validaEntradaSimples($postData["txtCriaRepeteSenha"])) {
                            if ($campoLimpo1 == $campoLimpo2) {
                                $novoUsuario->setaSenha(substr($campoLimpo1, 0, 10));

                                if (strlen($campoLimpo1) > 10) {
                                    $msgCampos .= " " . $translate->_('erro_senha_caracteres');
                                    $erroGrave = 1;
                                }

                            } else {
                                $msgCampos .= " " . $translate->_('erro_senha_diferente');
                                $erroGrave = 1;
                            }

                        } else {
                            $msgCampos .= " " . $translate->_('erro_senha_repeticao_invalida');
                            $erroGrave = 1;
                        }

                    } else if (!$novoUsuario->pegaSenha()) {
                        $msgCampos .= " " . $translate->_('erro_senha_invalida');
                        $erroGrave = 1;
                    }

                    //status
                    $novoUsuario->SetaStatus("inativo");

                    //completar nivel


                    if (!$erroGrave) {
                        if (!$codUsuario) {
                            $retCriaUsuario = $reqAutenticacao->criaUsuario($novoUsuario);

                            if (!$retCriaUsuario['cod_ret']) {
                                $codUsuario = $retCriaUsuario['val_ret'];

                                //envia confirmação
                                $retEnvio = $reqAutenticacao->retornaEnvioVazio();

                                if ((!$retEnvio['cod_ret']) && (!is_null($retEnvio['val_ret']))) {
                                    $thisEnvio = $retEnvio['val_ret'];

                                    //nomeRemetente
                                    $thisEnvio->setaNomeRemetente($translate->_('Ao Cubo'));

                                    //emailRemetente
                                    $thisEnvio->setaEmailRemetente("noreply@programarepertorios.com.br");

                                    //nomeDestinatario
                                    $thisEnvio->setaNomeDestinatario($novoUsuario->pegaNome());

                                    //emailDestinatario
                                    $thisEnvio->setaEmailDestinatario($novoUsuario->pegaEmail());

                                    //mensagem

                                    //idioma
                                    $thisEnvio->setaIdioma("pt");

                                    //arquivo
                                    $thisEnvio->setaArquivo("envia_ativacao_conta_pt.txt");

                                    //classe
                                    $thisEnvio->setaClasse("Usuario");

                                    //codColaboracao
                                    $thisEnvio->setaCodColaboracao($novoUsuario->pegaCodUsuario());

                                    //linkColaboracao
                                    $linkRegistro = "http://" . $_SERVER['SERVER_NAME'] . "/autenticacao/conta/ativa?c=" . $novoUsuario->pegaCodUsuario() . "&h=" . md5($html->chaveLembra . $novoUsuario->pegaCodUsuario());
                                    $thisEnvio->setaLinkColaboracao($linkRegistro);

                                    $reqAutenticacao->enviaAtivacaoConta($thisEnvio);

                                }

                            }

                        }

                        $etapaEnvio = 0;

                        $dadosPagina['novo_usuario']['usuarioEnviadoComErro'] = false;
                        $dadosPagina['novo_usuario']['mensagem_erro_usuario'] = "";

                    } else {
                        $etapaEnvio = 1;

                        $dadosPagina['novo_usuario']['usuarioEnviadoComErro'] = true;
                        $dadosPagina['novo_usuario']['mensagem_erro_usuario'] = $msgCampos;

                    }

                    $dadosPagina['novo_usuario']['id'] = $novoUsuario->pegaCodUsuario();
                    $dadosPagina['novo_usuario']['apelido'] = $novoUsuario->pegaApelido();
                    $dadosPagina['novo_usuario']['nome'] = $novoUsuario->pegaNome();
                    $dadosPagina['novo_usuario']['sobrenome'] = $novoUsuario->pegaSobrenome();
                    $dadosPagina['novo_usuario']['senha'] = "";
                    $dadosPagina['novo_usuario']['senha_repetida'] = "";
                    $dadosPagina['novo_usuario']['email'] = $novoUsuario->pegaEmail();
                    $dadosPagina['novo_usuario']['status'] = $novoUsuario->pegaStatus();

                    $dadosPagina['novo_usuario']['papel'] = ""; //completar

                }

             }

         } else {
             $retUsuario = $reqAutenticacao->retornaUsuarioVazio();

             if ((!$retUsuario['cod_ret']) && (!is_null($retUsuario['val_ret']))) {
		$novoUsuario = $retUsuario['val_ret'];
            }

            //controle acesso
            if (!isset($novoUsuario)) {
                header("location: /home");
                exit;
            }

            $dadosPagina['novo_usuario']['id'] = $novoUsuario->pegaCodUsuario();
            $dadosPagina['novo_usuario']['apelido'] = $novoUsuario->pegaApelido();
            $dadosPagina['novo_usuario']['nome'] = $novoUsuario->pegaNome();
            $dadosPagina['novo_usuario']['sobrenome'] = $novoUsuario->pegaSobrenome();
            $dadosPagina['novo_usuario']['senha'] = "";
            $dadosPagina['novo_usuario']['senha_repetida'] = "";
            $dadosPagina['novo_usuario']['email'] = $novoUsuario->pegaEmail();
            $dadosPagina['novo_usuario']['status'] = $novoUsuario->pegaStatus();
            
            $dadosPagina['novo_usuario']['papel'] = ""; //completar

            $dadosPagina['novo_usuario']['usuarioEnviado'] = false;
            $dadosPagina['novo_usuario']['usuarioEnviadoComErro'] = false;
            $dadosPagina['novo_usuario']['mensagem_erro_usuario'] = "";

         }

        $this->view->novoUsuario = $dadosPagina['novo_usuario'];


        //titulo_pagina: texto
        $dadosPagina['titulo_pagina'] = $translate->_('title_cria_usuario');

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

    }


    public function editaMockAction()
    {
        /* Initialize model and retrieve data here */
        $html = new Moxca_Html_Html();

        $this->view->html = $html;

        /* Initialize view and populate here */

        //usuario_pagina
        //  apelido: texto (read-only)
        //  nome: texto
        //  sobrenome: texto
        //  email: texto (read-only)
        //  usuarioEnviado: verdadeiro/falso
        //  usuarioEnviadoComErro: verdadeiro/falso
        //  mensagem_erro_usuario: texto
        $dadosPagina['usuario_pagina']['apelido'] = "claudiop";
        $dadosPagina['usuario_pagina']['nome'] = "";
        $dadosPagina['usuario_pagina']['sobrenome'] = "";
        $dadosPagina['usuario_pagina']['email'] = "";
        $dadosPagina['usuario_pagina']['usuarioEnviado'] = false;
        $dadosPagina['usuario_pagina']['usuarioEnviadoComErro'] = false;
        $dadosPagina['usuario_pagina']['mensagem_erro_usuario'] = "";

        $this->view->usuarioPagina = $dadosPagina['usuario_pagina'];

        //titulo_pagina: texto
        $dadosPagina['titulo_pagina'] = "Editar usu&aacute;rio";

        $this->view->tituloPagina = $dadosPagina['titulo_pagina'];

        //breadcrumb: texto
        $dadosBreadcrumb['Principal'] = "/";
        $dadosBreadcrumb[$dadosPagina['titulo_pagina']] = "";
        $dadosBreadcrumb[$dadosPagina['usuario_pagina']['apelido']] = "";
        $dadosPagina["breadcrumb"] = $html->breadcrumb($dadosBreadcrumb, "", "", " &gt; ");

        $this->view->breadcrumb = $dadosPagina['breadcrumb'];

        //title
        $dadosPagina['title'] = "Ao Cubo";

        $layoutHelper = $this->_helper->getHelper('Layout');
        $layout = $layoutHelper->getLayoutInstance();

        $layout->title = $dadosPagina['title'];


        $this->render("edita"); //use different view
    }


    public function editaAction()
    {
        /* Initialize model and retrieve data here */

        $nivelPagina = "visitante";

        $html = new Moxca_Html_Html();

        $this->view->html = $html;

        $reqAutenticacao = new MediadorAutenticacao();

        $dadosPagina = Array();

        $retLogin = $reqAutenticacao->checaLogin($nivelPagina);

        if ((!$retLogin['cod_ret']) && (!is_null($retLogin['val_ret']))) {
            $identityLogin = $retLogin['val_ret'];
        }
        
        $translate = Zend_Registry::get('Zend_Translate');

        /* Initialize view and populate here */

        //usuario_pagina
        //  apelido: texto (read-only)
        //  nome: texto
        //  sobrenome: texto
        //  email: texto (read-only)
        //  usuarioEnviado: verdadeiro/falso
        //  usuarioEnviadoComErro: verdadeiro/falso
        //  mensagem_erro_usuario: texto
        $titulo = $html->limpaCampo($this->getRequest()->getParam('titulo'));

        $retUsuario = $reqAutenticacao->recuperaUsuarioPorApelido($titulo);

        if ((!$retUsuario['cod_ret']) && (!is_null($retUsuario['val_ret']))) {
            $usuarioPagina = $retUsuario['val_ret'];

            $codUsuario = $usuarioPagina->pegaCodUsuario();

            $dadosPagina['usuario_pagina']['apelido'] = $usuarioPagina->pegaApelido();
            $dadosPagina['usuario_pagina']['nome_completo'] = $usuarioPagina->pegaNome() . " " .  $usuarioPagina->pegaSobrenome();

        } else {
            $this->_redirect("/");
        }

        if ($this->getRequest()->isPost()) {
             $postData = $this->getRequest()->getPost();

             if (isset($postData['etapaEnvio'])) {
                $etapaEnvio = $postData['etapaEnvio'];

                if ($etapaEnvio == 1) {
                    $dadosPagina['usuario_pagina']['usuarioEnviado'] = true;

                    //nome*
                    if ($campoLimpo = $html->validaEntradaSimples($postData["txtNome"])) {
                        $usuarioPagina->setaNome(substr($campoLimpo, 0, 120));
                        if (strlen($campoLimpo) > 120) {
                            $msgCampos .= " " . $translate->_('erro_nome_caracteres');
                            $erroMedio = 1;
                        }

                    } else {
                        $msgCampos .= " " . $translate->_('erro_nome_invalido');
                        $erroGrave = 1;
                    }

                    //sobrenome*
                    if ($campoLimpo = $html->validaEntradaSimples($postData["txtSobrenome"])) {
                        $usuarioPagina->setaSobrenome(substr($campoLimpo, 0, 120));
                        if (strlen($campoLimpo) > 120) {
                            $msgCampos .= " " . $translate->_('erro_sobrenome_caracteres');
                            $erroMedio = 1;
                        }

                    } else {
                        $msgCampos .= " " . $translate->_('erro_sobrenome_invalido');
                        $erroGrave = 1;
                    }


                    if (!$erroGrave) {
                        $reqAutenticacao->atualizaUsuario($usuarioPagina);

                        $identityLogin->nomeUsuario = $usuarioPagina->pegaNome();

                        $etapaEnvio = 0;

                        $dadosPagina['usuario_pagina']['usuarioEnviadoComErro'] = false;
                        $dadosPagina['usuario_pagina']['mensagem_erro_usuario'] = "";

                    } else {
                        $etapaEnvio = 1;

                        $dadosPagina['usuario_pagina']['usuarioEnviadoComErro'] = true;
                        $dadosPagina['usuario_pagina']['mensagem_erro_usuario'] = $msgCampos;

                    }

                    $dadosPagina['usuario_pagina']['nome'] = $usuarioPagina->pegaNome();
                    $dadosPagina['usuario_pagina']['sobrenome'] = $usuarioPagina->pegaSobrenome();
                    $dadosPagina['usuario_pagina']['email'] = $usuarioPagina->pegaEmail();

                }

             }

         } else {
            //controle acesso
            if (isset($identityLogin)) {
                if ($usuarioPagina->pegaCodUsuario() != $identityLogin->codUsuario) {
                    $retPapel = $reqAutenticacao->recuperaPapelPorCodigoUsuario($identityLogin->codUsuario);

                    if ((!$retPapel['cod_ret']) && (!is_null($retPapel['val_ret']))) {
                        $thisPapel = $retPapel['val_ret'];

                        if ($thisPapel->pegaTituloUnico() != "administrador") {
                            $this->_redirect("/");
                        }

                    } else {
                        $this->_redirect("/");
                    }

                }

            } else {
                $this->_redirect("/");
            }

            $dadosPagina['usuario_pagina']['nome'] = $usuarioPagina->pegaNome();
            $dadosPagina['usuario_pagina']['sobrenome'] = $usuarioPagina->pegaSobrenome();
            $dadosPagina['usuario_pagina']['email'] = $usuarioPagina->pegaEmail();
            $dadosPagina['usuario_pagina']['usuarioEnviado'] = false;
            $dadosPagina['usuario_pagina']['usuarioEnviadoComErro'] = false;
            $dadosPagina['usuario_pagina']['mensagem_erro_usuario'] = "";

         }

        $this->view->usuarioPagina = $dadosPagina['usuario_pagina'];


        //titulo_pagina: texto
        $dadosPagina['titulo_pagina'] = $translate->_('title_edita_usuario');

        $this->view->tituloPagina = $dadosPagina['titulo_pagina'];


        //breadcrumb: texto
        $dadosBreadcrumb[$translate->_('title_home')] = "/";
        $dadosBreadcrumb[$dadosPagina['titulo_pagina']] = "";
        $dadosBreadcrumb[$dadosPagina['usuario_pagina']['apelido']] = "";
        $dadosPagina["breadcrumb"] = $html->breadcrumb($dadosBreadcrumb, "", "", " &gt; ");

        $this->view->breadcrumb = $dadosPagina['breadcrumb'];


        //title
        $dadosPagina['title'] = $translate->_('title_site');

        $layoutHelper = $this->_helper->getHelper('Layout');
        $layout = $layoutHelper->getLayoutInstance();

        $layout->title = $dadosPagina['title'];
        
    }


    public function ativaMockAction()
    {
        /* Initialize model and retrieve data here */
        $html = new Moxca_Html_Html();

        $this->view->html = $html;

        /* Initialize view and populate here */
		
        //nome_usuario: texto
        $dadosPagina['nome_usuario'] = "Silvia";
		
        $this->view->nomeUsuario = $dadosPagina['nome_usuario'];
		

        //ativa_usuario
        //  id: numero
        //  senha: texto
        //  senha_repetida: texto
        //  usuarioEnviado: verdadeiro/falso
        //  usuarioComErro: verdadeiro/falso
        //  mensagem_erro_usuario: texto
        $dadosPagina['ativa_usuario']['id'] = 1;
        $dadosPagina['ativa_usuario']['senha'] = "";
        $dadosPagina['ativa_usuario']['senha_repetida'] = "";
        $dadosPagina['ativa_usuario']['usuarioEnviado'] = false;
        $dadosPagina['ativa_usuario']['usuarioComErro'] = false;
        $dadosPagina['ativa_usuario']['mensagem_erro_usuario'] = " Aten&ccedil;&atilde;o, senhas n&atilde;o s&atilde;o id&ecirc;nticas!";

        $this->view->ativaUsuario = $dadosPagina['ativa_usuario'];

        //titulo_pagina: texto
        $dadosPagina['titulo_pagina'] = "Ativar conta de usu&aacute;rio";

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


        $this->render("ativa"); //use different view
    }


    public function ativaAction()
    {
        /* Initialize model and retrieve data here */
        $nivelPagina = "desconhecido";

        $html = new Moxca_Html_Html();

        $this->view->html = $html;

        $reqAutenticacao = new MediadorAutenticacao();

        $dadosPagina = Array();
        
        $translate = Zend_Registry::get('Zend_Translate');

        /* Initialize view and populate here */

        //nome_usuario: texto
        $codUsuario = $html->limpaCampo($this->getRequest()->getParam('c'));

        $retUsuario = $reqAutenticacao->recuperaUsuarioPorCodigo($codUsuario);

        if ((!$retUsuario['cod_ret']) && (!is_null($retUsuario['val_ret']))) {
            $usuarioPagina = $retUsuario['val_ret'];

        } else {
            $this->_redirect("/");
        }

        $dadosPagina['nome_usuario'] = $usuarioPagina->pegaNome();

        $this->view->nomeUsuario = $dadosPagina['nome_usuario'];


        //ativa_usuario
        //  id: numero
        //  senha: texto
        //  senha_repetida: texto
        //  usuarioEnviado: verdadeiro/falso
        //  usuarioEnviadoComErro: verdadeiro/falso
        //  mensagem_erro_usuario: texto
        if ($this->getRequest()->isPost()) {
             $postData = $this->getRequest()->getPost();

             if (isset($postData['etapaEnvio'])) {
                $etapaEnvio = $postData['etapaEnvio'];

                if ($etapaEnvio == 1) {
                    $dadosPagina['ativa_usuario']['usuarioEnviado'] = true;

                    //senha*
                    if ($campoLimpo1 = $html->validaEntradaSimples($postData["txtAtivaSenhaUsuario"])) {
                        if ($campoLimpo2 = $html->validaEntradaSimples($postData["txtAtivaRepeteSenha"])) {
                            if ($campoLimpo1 == $campoLimpo2) {
                                $usuarioPagina->setaSenha(substr($campoLimpo1, 0, 10));

                                if (strlen($campoLimpo1) > 10) {
                                    $msgCampos .= " " . $translate->_('erro_senha_caracteres');
                                    $erroGrave = 1;
                                }

                            } else {
                                $msgCampos .= " " . $translate->_('erro_senha_diferente');
                                $erroGrave = 1;
                            }

                        } else {
                            $msgCampos .= " " . $translate->_('erro_senha_repeticao_invalida');
                            $erroGrave = 1;
                        }

                    } else {
                        $msgCampos .= " " . $translate->_('erro_senha_invalida');
                        $erroGrave = 1;
                    }

                    //status
                    $usuarioPagina->setaStatus("ativo");


                    if (!$erroGrave) {
                        $retAtualiza = $reqAutenticacao->atualizaUsuario($usuarioPagina);

                        if (!$retAtualiza['cod_ret']) {
                            $reqAutenticacao->incluiVisitante($usuarioPagina->pegaCodUsuario());
                        }

                        $etapaEnvio = 0;

                        $dadosPagina['ativa_usuario']['usuarioComErro'] = false;
                        $dadosPagina['ativa_usuario']['mensagem_erro_usuario'] = "";

                        $this->_redirect("/autenticacao/login/acessa");

                    } else {
                        $etapaEnvio = 1;

                        $dadosPagina['ativa_usuario']['usuarioComErro'] = true;
                        $dadosPagina['ativa_usuario']['mensagem_erro_usuario'] = $msgCampos;

                    }

                    $dadosPagina['ativa_usuario']['id'] = $usuarioPagina->pegaCodUsuario();
                    $dadosPagina['ativa_usuario']['senha'] = "";
                    $dadosPagina['ativa_usuario']['senha_repetida'] = "";

                }

             }

         } else {
            //controle acesso
            $hashEnviado = $html->limpaCampo($this->getRequest()->getParam('h'));

            $hashEsperado = md5($html->chaveLembra . $usuarioPagina->pegaCodUsuario());

            if ($hashEnviado != $hashEsperado) {
                $msgCampos .= " " . $translate->_('credenciais_invalidas');
                $erroGrave = 1;
            }

            if ($usuarioPagina->pegaStatus() != "inativo") {
                $msgCampos .= " " . $translate->_('ativacao_realizada');
                $erroGrave = 1;
            }

            if (!$erroGrave) {
                $dadosPagina['ativa_usuario']['usuarioComErro'] = false;
                $dadosPagina['ativa_usuario']['mensagem_erro_usuario'] = "";

            } else {
                $this->view->escondeForm = true;
                $dadosPagina['ativa_usuario']['usuarioComErro'] = true;
                $dadosPagina['ativa_usuario']['mensagem_erro_usuario'] = $msgCampos;
            }

            $dadosPagina['ativa_usuario']['id'] = $usuarioPagina->pegaCodUsuario();
            $dadosPagina['ativa_usuario']['senha'] = "";
            $dadosPagina['ativa_usuario']['senha_repetida'] = "";
            $dadosPagina['ativa_usuario']['usuarioEnviado'] = false;

        }

        $this->view->ativaUsuario = $dadosPagina['ativa_usuario'];


        //titulo_pagina: texto
        $dadosPagina['titulo_pagina'] = $translate->_('title_ativa_conta');

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

    }


    public function listaMockAction()
    {
        /* Initialize model and retrieve data here */
        $html = new Moxca_Html_Html();

        $this->view->html = $html;

        /* Initialize view and populate here */

        //n usuarios
        //  nome: texto
        //  sobrenome: texto
        //  apelido: texto
        //  email: texto
        //  status: texto
        //  link_edita: texto

        #usuario-01
        $conjuntoUsuarios['usuario-01']['nome'] = "Fulano";
        $conjuntoUsuarios['usuario-01']['sobrenome'] = "de Tal";
        $conjuntoUsuarios['usuario-01']['apelido'] = "fulano";
        $conjuntoUsuarios['usuario-01']['email'] = "fulano@fulano.com";
        $conjuntoUsuarios['usuario-01']['status'] = "ativo";
        $conjuntoUsuarios['usuario-01']['link_edita'] = "/autenticacao/conta/edita?titulo=fulano";
        #/usuario-01
		
        #usuario-02
        $conjuntoUsuarios['usuario-02']['nome'] = "Beltrano";
        $conjuntoUsuarios['usuario-02']['sobrenome'] = "de Tal";
        $conjuntoUsuarios['usuario-02']['apelido'] = "beltrano";
        $conjuntoUsuarios['usuario-02']['email'] = "beltrano@beltrano.com";
        $conjuntoUsuarios['usuario-02']['status'] = "ativo";
        $conjuntoUsuarios['usuario-02']['link_edita'] = "/autenticacao/conta/edita?titulo=beltrano";
        #/usuario-02
		
        $this->view->conjuntoUsuarios = $conjuntoUsuarios;

        //titulo_pagina: texto
        $dadosPagina['titulo_pagina'] = "Todos os usu&aacute;rios";

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


        $this->render("lista"); //use different view
    }


    public function listaAction()
    {
        /* Initialize model and retrieve data here */
        $nivelPagina = "administrador";

        $html = new Moxca_Html_Html();

        $this->view->html = $html;

        $reqAutenticacao = new MediadorAutenticacao();

        $dadosPagina = Array();

        $reqAutenticacao->checaLogin($nivelPagina);
        
        $translate = Zend_Registry::get('Zend_Translate');

        /* Initialize view and populate here */

        //n usuarios
        //  nome: texto
        //  sobrenome: texto
        //  apelido: texto
        //  email: texto
        //  status: texto
        //  link_edita: texto
        $retUsuarios = $reqAutenticacao->listaUsuarios("", "nomeUsuario");

        $thisColecaoUsuarios = $retUsuarios['val_ret'];

        if ($thisColecaoUsuarios->count() > 0) {
            $conjuntoUsuarios = Array();

            foreach ($thisColecaoUsuarios as $thisUsuario) {
                $conjuntoUsuarios[$thisUsuario->pegaCodUsuario()]['nome'] = $thisUsuario->pegaNome();
                $conjuntoUsuarios[$thisUsuario->pegaCodUsuario()]['sobrenome'] = $thisUsuario->pegaSobrenome();
                $conjuntoUsuarios[$thisUsuario->pegaCodUsuario()]['apelido'] = $thisUsuario->pegaApelido();
                $conjuntoUsuarios[$thisUsuario->pegaCodUsuario()]['email'] = $thisUsuario->pegaEmail();
                $conjuntoUsuarios[$thisUsuario->pegaCodUsuario()]['status'] = $thisUsuario->pegaStatus();
                $conjuntoUsuarios[$thisUsuario->pegaCodUsuario()]['link_edita'] = "/autenticacao/conta/edita?titulo=" . $thisUsuario->pegaApelido();
            }

            $this->view->conjuntoUsuarios = $conjuntoUsuarios;

        }

        //titulo_pagina: texto
        $dadosPagina['titulo_pagina'] = $translate->_('lista_usuarios');

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
        
        $layout->nestedLayout = 'home';

    }
    
    public function alteraSenhaMockAction()
    {
        /* Initialize model and retrieve data here */
        $html = new Moxca_Html_Html();

        $this->view->html = $html;

        /* Initialize view and populate here */

        //usuario_pagina
        //  senha: texto
        //  senha_repetida: texto
        //  senhaEnviada: verdadeiro/falso
        //  senhaEnviadaComErro: verdadeiro/falso
        //  mensagem_erro_senha: texto
        $dadosPagina['usuario_pagina']['senha'] = "";
        $dadosPagina['usuario_pagina']['senhaEnviada'] = "";
        $dadosPagina['usuario_pagina']['senhaEnviada'] = false;
        $dadosPagina['usuario_pagina']['senhaEnviadaComErro'] = false;
        $dadosPagina['usuario_pagina']['mensagem_erro_senha'] = "";

        $this->view->usuarioPagina = $dadosPagina['usuario_pagina'];

        //titulo_pagina: texto
        $dadosPagina['titulo_pagina'] = "Editar senha";

        $this->view->tituloPagina = $dadosPagina['titulo_pagina'];

        //breadcrumb: texto
        $dadosBreadcrumb['Principal'] = "/";
        $dadosBreadcrumb[$dadosPagina['titulo_pagina']] = "";
        $dadosBreadcrumb[$dadosPagina['usuario_pagina']['apelido']] = "";
        $dadosPagina["breadcrumb"] = $html->breadcrumb($dadosBreadcrumb, "", "", " &gt; ");

        $this->view->breadcrumb = $dadosPagina['breadcrumb'];

        //title
        $dadosPagina['title'] = "Ao Cubo";

        $layoutHelper = $this->_helper->getHelper('Layout');
        $layout = $layoutHelper->getLayoutInstance();

        $layout->title = $dadosPagina['title'];


        $this->render("altera-senha"); //use different view
    }
    
    
    public function alteraSenhaAction()
    {
        /* Initialize model and retrieve data here */
        $nivelPagina = "visitante";

        $html = new Moxca_Html_Html();

        $this->view->html = $html;

        $reqAutenticacao = new MediadorAutenticacao();

        $dadosPagina = Array();

        $retLogin = $reqAutenticacao->checaLogin($nivelPagina);

        if ((!$retLogin['cod_ret']) && (!is_null($retLogin['val_ret']))) {
            $identityLogin = $retLogin['val_ret'];
        }
        
        $translate = Zend_Registry::get('Zend_Translate');

        
        /* Initialize view and populate here */

        //usuario_pagina
        //  apelido: texto
        //  senha: texto
        //  senha_repetida: texto
        //  senhaEnviada: verdadeiro/falso
        //  senhaEnviadaComErro: verdadeiro/falso
        //  mensagem_erro_senha: texto
        
        $titulo = $html->limpaCampo($this->getRequest()->getParam('titulo'));

        $retUsuario = $reqAutenticacao->recuperaUsuarioPorApelido($titulo);

        if ((!$retUsuario['cod_ret']) && (!is_null($retUsuario['val_ret']))) {
            $usuarioPagina = $retUsuario['val_ret'];

            $codUsuario = $usuarioPagina->pegaCodUsuario();

            $dadosPagina['usuario_pagina']['apelido'] = $usuarioPagina->pegaApelido();

            } else {
            $this->_redirect("/");
        }
        
        if ($this->getRequest()->isPost()) {
             $postData = $this->getRequest()->getPost();

             if (isset($postData['etapaEnvio'])) {
                $etapaEnvio = $postData['etapaEnvio'];

                if ($etapaEnvio == 1) {
                    $dadosPagina['usuario_pagina']['senhaEnviada'] = true;

                    //senha*
                    if ($campoLimpo1 = $html->validaEntradaSimples($postData["txtAlteraSenhaUsuario"])) {
                        if ($campoLimpo2 = $html->validaEntradaSimples($postData["txtAlteraRepeteSenha"])) {
                            if ($campoLimpo1 == $campoLimpo2) {
                                $usuarioPagina->setaSenha(substr($campoLimpo1, 0, 10));

                                if (strlen($campoLimpo1) > 10) {
                                    $msgCampos .= " " . $translate->_('A senha deve ter no máximo 10 caracteres');
                                    $erroGrave = 1;
                                }

                            } else {
                                $msgCampos .= " " . $translate->_('As senhas informadas não são iguais');
                                $erroGrave = 1;
                            }

                        } else {
                            $msgCampos .= " " . $translate->_('Você deve informar a senha duas vezes.');
                            $erroGrave = 1;
                        }

                    } else if (!$usuarioPagina->pegaSenha()) {
                        $msgCampos .= " " . $translate->_('Senha inválida');
                        $erroGrave = 1;
                    }


                    if (!$erroGrave) {
                        $reqAutenticacao->atualizaUsuario($usuarioPagina);

                        $identityLogin->nomeUsuario = $usuarioPagina->pegaNome();

                        $etapaEnvio = 0;

                        $dadosPagina['usuario_pagina']['senhaEnviadaComErro'] = false;
                        $dadosPagina['usuario_pagina']['mensagem_erro_senha'] = "";

                    } else {
                        $etapaEnvio = 1;

                        $dadosPagina['usuario_pagina']['senhaEnviadaComErro'] = true;
                        $dadosPagina['usuario_pagina']['mensagem_erro_senha'] = $msgCampos;

                    }

                    $dadosPagina['usuario_pagina']['senha'] = "";
                    $dadosPagina['usuario_pagina']['senha_repetida'] = "";

                }

             }

         } else {
            //controle acesso
            if (isset($identityLogin)) {
                if ($usuarioPagina->pegaCodUsuario() != $identityLogin->codUsuario) {
                    $retPapel = $reqAutenticacao->recuperaPapelPorCodigoUsuario($identityLogin->codUsuario);

                    if ((!$retPapel['cod_ret']) && (!is_null($retPapel['val_ret']))) {
                        $thisPapel = $retPapel['val_ret'];

                        if ($thisPapel->pegaTituloUnico() != "administrador") {
                            $this->_redirect("/");
                        }

                    } else {
                        $this->_redirect("/");
                    }

                }

            } else {
                $this->_redirect("/");
            }

            $dadosPagina['usuario_pagina']['senha'] = "";
            $dadosPagina['usuario_pagina']['senha_repetida'] = "";
            $dadosPagina['usuario_pagina']['senhaEnviada'] = false;
            $dadosPagina['usuario_pagina']['senhaEnviadaComErro'] = false;
            $dadosPagina['usuario_pagina']['mensagem_erro_senha'] = "";

         }
         
         $this->view->usuarioPagina = $dadosPagina['usuario_pagina'];


        //titulo_pagina: texto
        $dadosPagina['titulo_pagina'] = $translate->_('Informe sua nova senha');

        $this->view->tituloPagina = $dadosPagina['titulo_pagina'];


        //breadcrumb: texto
        $dadosBreadcrumb[$translate->_('title_home')] = "/";
        $dadosBreadcrumb[$dadosPagina['titulo_pagina']] = "";
        $dadosBreadcrumb[$dadosPagina['usuario_pagina']['apelido']] = "";
        $dadosPagina["breadcrumb"] = $html->breadcrumb($dadosBreadcrumb, "", "", " &gt; ");

        $this->view->breadcrumb = $dadosPagina['breadcrumb'];


        //title
        $dadosPagina['title'] = $translate->_('title_site');

        $layoutHelper = $this->_helper->getHelper('Layout');
        $layout = $layoutHelper->getLayoutInstance();

        $layout->title = $dadosPagina['title'];

    }
    
    
    public function solicitaSenhaMockAction()
    {
        /* Initialize model and retrieve data here */
        $html = new Moxca_Html_Html();

        $this->view->html = $html;

        /* Initialize view and populate here */

        //envio_mensagem
        //  senha: texto (read-only)
        //  senha_repetida: texto
        //  mensagemEnviada: verdadeiro/falso
        //  erroNaSolicitacaoDeSenha: verdadeiro/falso
        //  mensagem_erro_senha: texto
        $dadosPagina['envio_mensagem']['senha'] = "";
        $dadosPagina['envio_mensagem']['mensagemEnviada'] = "";
        $dadosPagina['envio_mensagem']['mensagemEnviada'] = false;
        $dadosPagina['envio_mensagem']['erroNaSolicitacaoDeSenha'] = false;
        $dadosPagina['envio_mensagem']['mensagem_erro_senha'] = "";

        $this->view->solicitaSenha = $dadosPagina['envio_mensagem'];

        //titulo_pagina: texto
        $dadosPagina['titulo_pagina'] = "Solicitar nova senha";

        $this->view->tituloPagina = $dadosPagina['titulo_pagina'];

        //breadcrumb: texto
        $dadosBreadcrumb['Principal'] = "/";
        $dadosBreadcrumb[$dadosPagina['titulo_pagina']] = "";
        $dadosBreadcrumb[$dadosPagina['usuario_pagina']['apelido']] = "";
        $dadosPagina["breadcrumb"] = $html->breadcrumb($dadosBreadcrumb, "", "", " &gt; ");

        $this->view->breadcrumb = $dadosPagina['breadcrumb'];

        //title
        $dadosPagina['title'] = "Ao Cubo";

        $layoutHelper = $this->_helper->getHelper('Layout');
        $layout = $layoutHelper->getLayoutInstance();

        $layout->title = $dadosPagina['title'];


        $this->render("solicita-senha"); //use different view
    }


    public function solicitaSenhaAction()
    {
        /* Initialize model and retrieve data here */
        $nivelPagina = "desconhecido";

        $html = new Moxca_Html_Html();

        $this->view->html = $html;

        $reqAutenticacao = new MediadorAutenticacao();

        $dadosPagina = Array();

        
        $translate = Zend_Registry::get('Zend_Translate');

        
        /* Initialize view and populate here */
        
        // se estiver na postagem
        if ($this->getRequest()->isPost()) {
             $postData = $this->getRequest()->getPost();

             if (isset($postData['etapaEnvio'])) {
                $etapaEnvio = $postData['etapaEnvio'];

                if ($etapaEnvio == 1) {
                    $dadosPagina['usuario_pagina']['mensagemEnviada'] = true;

                     //email*
                    if ($html->validaFormacaoEmail($postData["txtEmail"])) {
                        if ($campoLimpo = $html->validaEntradaSimples($postData["txtEmail"])) {
                            
                            // checa se email existe no BD
                            $retAutenticacao = $reqAutenticacao->existeEmail(substr($campoLimpo, 0, 80));

                            if ((!$retAutenticacao['cod_ret']) && (!is_null($retAutenticacao['val_ret']))) {
                                $emailOK = true;
                                $retEmailExiste = $retAutenticacao['val_ret'];
                                $usuarioEmailInformado = $retEmailExiste->current();

                            }

                            if (!$emailOK) {
                                $msgCampos .= " " . $translate->_('esse email não está cadastrado');
                                $erroGrave = 1;

                            } 

                        } else {
                            $msgCampos .= " " . $translate->_('caracter inválido no email');
                            $erroGrave = 1;
                        }

                    } else {
                        $msgCampos .= " " . $translate->_('formato inválido de email');
                        $erroGrave = 1;
                    }

        /* se email ok */
                     if ((!$erroGrave) && (!is_null($usuarioEmailInformado))) {
                        $codUsuario = $usuarioEmailInformado->PegaCodUsuario();
                        
                         //    envia link para altera senha
                        $retEnvio = $reqAutenticacao->retornaEnvioVazio();

                        if ((!$retEnvio['cod_ret']) && (!is_null($retEnvio['val_ret']))) {

                            $thisEnvio = $retEnvio['val_ret'];

                            //nomeRemetente
                            $thisEnvio->setaNomeRemetente($translate->_('Ao Cubo'));

                            //emailRemetente
                            $thisEnvio->setaEmailRemetente("noreply@programarepertorios.com.br");

                            //nomeDestinatario
                            $thisEnvio->setaNomeDestinatario($usuarioEmailInformado->pegaNome());

                            //emailDestinatario
                            $thisEnvio->setaEmailDestinatario($usuarioEmailInformado->pegaEmail());

                            //mensagem

                            //idioma
                            $thisEnvio->setaIdioma("pt");
                            
                            //arquivo
                            $thisEnvio->setaArquivo("envia_resposta_solicitacao_senha_pt.txt");

                            //classe
                            $thisEnvio->setaClasse("Usuario");

                            //codColaboracao
                            $thisEnvio->setaCodColaboracao($usuarioEmailInformado->pegaCodUsuario());

                            //linkColaboracao
                            $dataPrazo  = mktime(date("s"), date("i"), date("H"), date("m")  , date("d")+2, date("Y"));
                            $dataPrazo = date( 'Y-m-d H:i:s', $dataPrazo );

                            $hashRenovacaoSenha = md5($dataPrazo . $html->chaveLembra . $usuarioEmailInformado->pegaCodUsuario());
                            $linkRegistro = "http://" . $_SERVER['SERVER_NAME'] . "/autenticacao/conta/renova-senha?c=" . $usuarioEmailInformado->pegaCodUsuario() . "&h=" . $hashRenovacaoSenha;
                            $thisEnvio->setaLinkColaboracao($linkRegistro);

                            $retEnvioRenovacao = $reqAutenticacao->enviaRenovacaoSenha($thisEnvio);
                            if (!$retEnvio['cod_ret']) {
                                $usuarioEmailInformado->setaPrazoRenovaSenha($dataPrazo);
                                $usuarioEmailInformado->setaRenovaSenha($hashRenovacaoSenha);
                                $reqAutenticacao->atualizaUsuario($usuarioEmailInformado);
                                
                                //envio_mensagem
                                //  mensagemEnviada: verdadeiro/falso
                                //  erroNaSolicitacaoDeSenha: verdadeiro/falso
                                //  mensagem_erro_senha: texto
                                //  sucesso_envio_mensagem: texto
                                $dadosPagina['envio_mensagem']['mensagemEnviada'] = true;
                                $dadosPagina['envio_mensagem']['erroNaSolicitacaoDeSenha'] = false;
                                $dadosPagina['envio_mensagem']['mensagem_erro_senha'] = "";
                                $dadosPagina['envio_mensagem']['sucesso_envio_mensagem'] = "Uma mensagem com instruções foi enviada para o endereço informado.";
                            }

                        }

                    } else {
                        $dadosPagina['envio_mensagem']['mensagemEnviada'] = false;
                        $dadosPagina['envio_mensagem']['erroNaSolicitacaoDeSenha'] = true;
                        $dadosPagina['envio_mensagem']['mensagem_erro_senha'] = "$msgCampos";
                        $dadosPagina['envio_mensagem']['sucesso_envio_mensagem'] = "";

                    }

                }

                $etapaEnvio = 0;

                
             }
         } else {
             
        // se não for postagem
        //   exibe form
            //envio_mensagem
            $dadosPagina['envio_mensagem']['mensagemEnviada'] = false;
            $dadosPagina['envio_mensagem']['erroNaSolicitacaoDeSenha'] = false;
            $dadosPagina['envio_mensagem']['mensagem_erro_senha'] = "";
            $dadosPagina['envio_mensagem']['sucesso_envio_mensagem'] = "";

             
         }

        $this->view->solicitaSenha = $dadosPagina['envio_mensagem'];

        //titulo_pagina: texto
        $dadosPagina['titulo_pagina'] = "Solicitar nova senha";

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


        $this->render("solicita-senha"); //use different view
    }

    
    
    public function renovaSenhaAction()
    {
        /* Initialize model and retrieve data here */
        $nivelPagina = "visitante";

        $html = new Moxca_Html_Html();

        $this->view->html = $html;
        
        $reqAutenticacao = new MediadorAutenticacao();

        $dadosPagina = Array();


        if ((!$retLogin['cod_ret']) && (!is_null($retLogin['val_ret']))) {
            $identityLogin = $retLogin['val_ret'];
        }
        
        $translate = Zend_Registry::get('Zend_Translate');

        
        /* Initialize view and populate here */

        //usuario_pagina
        //  codigo: texto
        //  hash: texto
        //  senha: texto
        //  senha_repetida: texto
        //  senhaCadastrada: verdadeiro/falso
        //  erroNaSolicitacaoDeSenha: verdadeiro/falso
        //  mensagem_erro_senha: texto
        
        
        
        $hash = $html->limpaCampo($this->getRequest()->getParam('h'));
        $codigo = $html->limpaCampo($this->getRequest()->getParam('c'));

        $retUsuario = $reqAutenticacao->recuperaUsuarioPorCodigo($codigo);

        if ((!$retUsuario['cod_ret']) && (!is_null($retUsuario['val_ret']))) {
            $usuarioPagina = $retUsuario['val_ret'];

            $codUsuario = $usuarioPagina->pegaCodUsuario();
            $renovaSenha = $usuarioPagina->pegaRenovaSenha();            
            $prazoRenovaSenha = $usuarioPagina->pegaPrazoRenovaSenha();
            
            $dataHoje  = mktime(date("s"), date("i"), date("H"), date("m")  , date("d"), date("Y"));
            $dataPrazo = strtotime($prazoRenovaSenha);
            
            if ($dataPrazo < $dataHoje) {
                $msgCampos .= " " . $translate->_('Essas credenciais expiraram. Solicite outra senha.');
                $erroGrave = 1;
            }
            
            if ($renovaSenha != $hash) {
                $msgCampos = " " . $translate->_('Houve um erro na autenticação das suas credenciais. Procure o administrador do sistema.');
                $erroGrave = 1;
            } else {

                $dadosPagina['usuario_pagina']['apelido'] = $usuarioPagina->pegaApelido();
            }

        } else {
            $msgCampos .= " " . $translate->_('Houve um erro com o código informado. Procure o administrador do sistema.');
            $erroGrave = 1;
        }
        
        
        if ($this->getRequest()->isPost()) {
             $postData = $this->getRequest()->getPost();

             if (isset($postData['etapaEnvio'])) {
                $etapaEnvio = $postData['etapaEnvio'];

                if ($etapaEnvio == 1) {
                    $dadosPagina['usuario_pagina']['senhaCadastrada'] = true;

                    //senha*
                    if ($campoLimpo1 = $html->validaEntradaSimples($postData["txtRenovaSenhaUsuario"])) {
                        if ($campoLimpo2 = $html->validaEntradaSimples($postData["txtRenovaRepeteSenha"])) {
                            if ($campoLimpo1 == $campoLimpo2) {

                                $usuarioPagina->setaSenha(substr($campoLimpo1, 0, 10));

                                if (strlen($campoLimpo1) > 10) {
                                    $msgCampos .= " " . $translate->_('A senha deve ter no máximo 10 caracteres');
                                    $erroGrave = 1;
                                }

                            } else {
                                $msgCampos .= " " . $translate->_('As senhas informadas não são iguais');
                                $erroGrave = 1;
                            }

                        } else {
                            $msgCampos .= " " . $translate->_('Você deve informar a senha duas vezes.');
                            $erroGrave = 1;
                        }

                    } else if (!$usuarioPagina->pegaSenha()) {
                        $msgCampos .= " " . $translate->_('Senha inválida');
                        $erroGrave = 1;
                    }


                    if (!$erroGrave) {
                        $dataExpirada  = mktime(date("s"), date("i"), date("H"), date("m")  , date("d")-30, date("Y"));
                        $dataExpirada = date( 'Y-m-d H:i:s', $dataExpirada );
                        
                        $usuarioPagina->setaPrazoRenovaSenha($dataExpirada);
                        $usuarioPagina->setaRenovaSenha(md5(date("r")));
                        
                        
                        $reqAutenticacao->atualizaUsuario($usuarioPagina);

                        $identityLogin->nomeUsuario = $usuarioPagina->pegaNome();

                        $etapaEnvio = 0;

                        $dadosPagina['usuario_pagina']['erroNoCadastroDaSenha'] = false;
                        $dadosPagina['usuario_pagina']['mensagem_erro_senha'] = "";
                        $dadosPagina['usuario_pagina']['senhaCadastrada'] = true;
                        $dadosPagina['usuario_pagina']['erroComAsCredenciais'] = false;
                        

                    } else {
                        $etapaEnvio = 1;

                        $dadosPagina['usuario_pagina']['erroNoCadastroDaSenha'] = true;
                        $dadosPagina['usuario_pagina']['mensagem_erro_senha'] = $msgCampos;

                    }

                    $dadosPagina['usuario_pagina']['senha'] = "";
                    $dadosPagina['usuario_pagina']['senha_repetida'] = "";

                }

             }

         } else {
             
             if (!$erroGrave)  {
                $dadosPagina['usuario_pagina']['senha'] = "";
                $dadosPagina['usuario_pagina']['senha_repetida'] = "";
                $dadosPagina['usuario_pagina']['senhaCadastrada'] = false;
                $dadosPagina['usuario_pagina']['erroNoCadastroDaSenha'] = false;
                $dadosPagina['usuario_pagina']['erroComAsCredenciais'] = false;
                $dadosPagina['usuario_pagina']['mensagem_erro_senha'] = "";
             } else {
                $dadosPagina['usuario_pagina']['senha'] = "";
                $dadosPagina['usuario_pagina']['senha_repetida'] = "";
                $dadosPagina['usuario_pagina']['senhaCadastrada'] = false;
                $dadosPagina['usuario_pagina']['erroComAsCredenciais'] = true;
                $dadosPagina['usuario_pagina']['erroNoCadastroDaSenha'] = true;
                $dadosPagina['usuario_pagina']['mensagem_erro_senha'] = "$msgCampos";
                 
             }

         }
         
         $this->view->usuarioPagina = $dadosPagina['usuario_pagina'];


        //titulo_pagina: texto
        $dadosPagina['titulo_pagina'] = $translate->_('Informe sua nova senha');

        $this->view->tituloPagina = $dadosPagina['titulo_pagina'];


        //breadcrumb: texto
        $dadosBreadcrumb[$translate->_('title_home')] = "/";
        $dadosBreadcrumb[$dadosPagina['titulo_pagina']] = "";
        $dadosBreadcrumb[$dadosPagina['usuario_pagina']['apelido']] = "";
        $dadosPagina["breadcrumb"] = $html->breadcrumb($dadosBreadcrumb, "", "", " &gt; ");

        $this->view->breadcrumb = $dadosPagina['breadcrumb'];


        //title
        $dadosPagina['title'] = $translate->_('title_site');

        $layoutHelper = $this->_helper->getHelper('Layout');
        $layout = $layoutHelper->getLayoutInstance();

        $layout->title = $dadosPagina['title'];

        $this->render("renova-senha"); //use different view
    }
    
    
    
}