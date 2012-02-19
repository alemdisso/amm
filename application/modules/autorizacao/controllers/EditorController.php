<?php
require_once APPLICATION_PATH . "/modules/autorizacao/models/MediadorAutorizacao.php";

class Autorizacao_EditorController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    
    public function apagaMockAction()
    {
        /* Initialize model and retrieve data here */
        $html = new Moxca_Html_Html();

        $this->view->html = $html;

        /* Initialize view and populate here */

        //titulo_pagina: texto
        $dadosPagina['titulo_pagina'] = "Retirar privilégio de editor";

        $this->view->tituloPagina = $dadosPagina['titulo_pagina'];
        

        //editor_pagina
        //  nome: texto
        //  sobrenome: texto
        //  comandoApagarEnviado: verdadeiro/falso
        //  mensagem_retorno: texto
        $dadosPagina['editor_pagina']['nome'] = "Rafael";
        $dadosPagina['editor_pagina']['sobrenome'] = "Fonseca";
        $dadosPagina['editor_pagina']['comandoApagarEnviado'] = false;
        $dadosPagina['editor_pagina']['mensagem_retorno'] = "Privilégio de editor retirado com sucesso. Conta de usuário inativada.";

        $this->view->editorPagina = $dadosPagina['editor_pagina'];
        

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


        $this->render("apaga"); //use different view

    }


    public function apagaAction()
    {
        /* Initialize model and retrieve data here */
        $nivelPagina = "secretario";

        $html = new Moxca_Html_Html();

        $this->view->html = $html;

        $reqAutorizacao = new MediadorAutorizacao();

        $dadosPagina = Array();

        $reqAutorizacao->checaLogin($nivelPagina);

        /* Initialize view and populate here */

        //titulo_pagina: texto
        $dadosPagina['titulo_pagina'] = "Retirar privilégio de editor";

        $this->view->tituloPagina = $dadosPagina['titulo_pagina'];


        //editor_pagina
        //  nome: texto
        //  sobrenome: texto
        //  comandoApagarEnviado: verdadeiro/falso
        //  mensagem_retorno: texto
        $codUsuario = $html->limpaCampo($this->getRequest()->getParam('codigo'));

        $retUsuario = $reqAutorizacao->recuperaUsuarioPorCodigo($codUsuario);

        if ((!$retUsuario['cod_ret']) && (!is_null($retUsuario['val_ret']))) {
            $editorPagina = $retUsuario['val_ret'];
        } else {
            $this->_redirect("/");
        }

        //controle acesso
        $apelido = $html->limpaCampo($this->getRequest()->getParam('editor'));
        
        if ($editorPagina->pegaApelido() != $apelido) {
            $this->_redirect("/");
        }

        //controle acesso
        $retPapel = $reqAutorizacao->recuperaPapelPorCodigoUsuario($codUsuario);

        if ((!$retPapel['cod_ret']) && (!is_null($retPapel['val_ret']))) {
            $thisPapel = $retPapel['val_ret'];

            if ($thisPapel->pegaTituloUnico() != "editor") {
                $this->_redirect("/");

            } else {
                $codPapel = $thisPapel->pegaCodPapel();

            }

        }


        if ($this->getRequest()->isPost()) {
            $postData = $this->getRequest()->getPost();

            if (isset($postData['etapaEnvio'])) {
                $etapaEnvio = $postData['etapaEnvio'];

                if ($etapaEnvio == 1) {
                    $dadosPagina['editor_pagina']['comandoApagarEnviado'] = true;

                    $dadosPagina['editor_pagina']['nome'] = $editorPagina->pegaNome();

                    $dadosPagina['editor_pagina']['sobrenome'] = $editorPagina->pegaSobrenome();

                    $retHorarios = $reqAutorizacao->listaHorarios("codEditor = " . $editorPagina->pegaCodUsuario(), "");

                    $thisColecaoHorarios = $retHorarios['val_ret'];

                    if ($thisColecaoHorarios->count() > 0) { //editor tem horários
                        $dadosPagina['editor_pagina']['mensagem_retorno'] = "O editor n&atilde;o pode ser alterado por conter horários associados.";

                    } else {
                        $retApaga = $reqAutorizacao->apagaEditor($codPapel, $codUsuario);

                        if (!$retApaga['cod_ret']) {
                            $dadosPagina['editor_pagina']['mensagem_retorno'] = "Privilégio de editor retirado com sucesso. Conta de usuário inativada.";
                        } else {
                            $dadosPagina['editor_pagina']['mensagem_retorno'] = "O privilégio de editor n&atilde;o pode ser apagado por erro no sistema.";
                        }

                    }

                }

            }

        } else {
            $dadosPagina['editor_pagina']['nome'] = $editorPagina->pegaNome();
            $dadosPagina['editor_pagina']['sobrenome'] = $editorPagina->pegaSobrenome();
            $dadosPagina['editor_pagina']['comandoApagarEnviado'] = false;
            $dadosPagina['editor_pagina']['mensagem_retorno'] = "";

        }

        $this->view->editorPagina = $dadosPagina['editor_pagina'];


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

    }

    
    public function listaMockAction()
    {
        /* Initialize model and retrieve data here */
        $html = new Moxca_Html_Html();

        $this->view->html = $html;

        /* Initialize view and populate here */

        //n editores
        //  nome: texto
        //  link_horarios: texto
        //  link_aulas: texto

        #editor-01
        $conjuntoEditores['editor-01']['nome'] = "Editor 01";
        $conjuntoEditores['editor-01']['link_horarios'] = "";
        $conjuntoEditores['editor-01']['link_aulas'] = "";
        #/editor-01
            
        #editor-02
        $conjuntoEditores['editor-02']['nome'] = "Editor 02";
        $conjuntoEditores['editor-02']['link_horarios'] = "";
        $conjuntoEditores['editor-02']['link_aulas'] = "";
        #/editor-02
		
        $this->view->conjuntoEditores = $conjuntoEditores;
        
        
        //titulo_pagina: texto
        $dadosPagina['titulo_pagina'] = "Todos os editores";

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
        $nivelPagina = "editor";

        $html = new Moxca_Html_Html();

        $this->view->html = $html;

        $reqAutorizacao = new MediadorAutorizacao();

        $dadosPagina = Array();

        $retLogin = $reqAutorizacao->checaLogin($nivelPagina);
        
        if ((!$retLogin['cod_ret']) && (!is_null($retLogin['val_ret']))) {
            $identityLogin = $retLogin['val_ret'];
        }

        /* Initialize view and populate here */
        
        if (isset($identityLogin)) {
            
            $retPapel = $reqAutorizacao->recuperaPapelPorCodigoUsuario($identityLogin->codUsuario);

            if ((!$retPapel['cod_ret']) && (!is_null($retPapel['val_ret']))) {
                $thisPapel = $retPapel['val_ret'];

            } else {
                $this->_redirect("/");
            }

        }

        //n editores
        //  nome: texto
        //  link_horarios: texto
        //  link_aulas: texto
        $retEditores = $reqAutorizacao->listaTodosEditores();

        $thisColecaoEditores = $retEditores['val_ret'];

        if ($thisColecaoEditores->count() > 0) {
            foreach ($thisColecaoEditores as $thisEditor) {
                if (isset($identityLogin)) {
                    if($thisEditor->pegaCodUsuario() !== $identityLogin->codUsuario){
                
                        $conjuntoEditores[$thisEditor->pegaCodUsuario()]['nome'] = $thisEditor->pegaNome() . " " . $thisEditor->pegaSobrenome();
                        
                        $conjuntoEditores[$thisEditor->pegaCodUsuario()]['link_horarios'] = "/planejamento/horario/lista-editor?titulo=" . $thisEditor->pegaApelido();
                        
                        $conjuntoEditores[$thisEditor->pegaCodUsuario()]['link_aulas'] = "/planejamento/aula/lista?titulo=" . $thisEditor->pegaApelido();
            
                    }
                }
            }
        }

        $this->view->conjuntoEditores = $conjuntoEditores;


        //titulo_pagina: texto
        $dadosPagina['titulo_pagina'] = "Todos os editores";

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

    }
    
}