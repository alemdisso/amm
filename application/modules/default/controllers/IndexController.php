<?php
require_once APPLICATION_PATH . "/modules/default/models/MediadorDefault.php";

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }



    public function indexAction()
    {
        /* Initialize model and retrieve data here */

        $nivelPagina = "visitante";

        $reqDefault = new MediadorDefault();

        $auth = Zend_Auth::getInstance();

        if ($auth->hasIdentity()) {
            $identity = $auth->getIdentity();

            $retPapel = $reqDefault->recuperaPapelPorCodigoUsuario($identity->codUsuario);

            if ((!$retPapel['cod_ret']) && (!is_null($retPapel['val_ret']))) {
                $thisPapel = $retPapel['val_ret'];

                switch ($thisPapel->pegaTituloUnico()) {
                    case "monitor":
                        $this->_forward('monitor', 'index');
                    break;

                    case "secretario":
                        $this->_forward('secretaria', 'index');
                    break;

                    case "coordenador":
                        $this->_forward('coordenador', 'index');
                    break;

                    case "administrador":
                        $this->_forward('administrador', 'index');
                    break;

                    default:
                        $this->_forward('monitor', 'index');
                    break;

                }

            } else {
                $this->_redirect("/autenticacao/login/acessa");
            }

        } else {
            $this->_redirect("/autenticacao/login/acessa");
        }

    }
    
    
    public function administradorMockAction()
    {
        /* Initialize model and retrieve data here */
        $html = new Moxca_Html_Html();

        $this->view->html = $html;

        /* Initialize view and populate here */
          
        //links_home
        //  link_usuarios: texto
        //  link_monitores: texto
        //  link_planos_nao_verificados: texto
        //  link_cria_usuario: texto
        //  link_cadastra_escola: texto
        //  link_cadastra_turma: texto
        //  link_cadastra_horario: texto
        //  link_gerencia_categorias: texto
        $dadosPagina['links_home']['link_usuarios'] = "";
        $dadosPagina['links_home']['link_monitores'] = "";
        $dadosPagina['links_home']['link_planos_nao_verificados'] = "";
        $dadosPagina['links_home']['link_cria_usuario'] = "/autenticacao/conta/cria";
        $dadosPagina['links_home']['link_cadastra_escola'] = "/planejamento/escola/cadastra";
        $dadosPagina['links_home']['link_cadastra_turma'] = "/planejamento/turma/cadastra";
        $dadosPagina['links_home']['link_cadastra_horario'] = "/planejamento/horario/cadastra";
        $dadosPagina['links_home']['link_gerencia_categorias'] = "/panopramanga/categoria/gerencia";
        
        $this->view->linksHome = $dadosPagina['links_home'];
        
        
        //banco_pagina
        //  link_edita: texto
        $dadosPagina['banco_pagina']['link_edita'] = "";
        
        $this->view->bancoPagina = $dadosPagina['banco_pagina'];
        
        
        //titulo_pagina: texto
        $dadosPagina['titulo_pagina'] = "Principal";

        $this->view->tituloPagina = $dadosPagina['titulo_pagina'];

        //title
        $dadosPagina['title'] = "Ao Cubo";

        $layoutHelper = $this->_helper->getHelper('Layout');
        $layout = $layoutHelper->getLayoutInstance();

        $layout->title = $dadosPagina['title'];

        $layout->nestedLayout = 'home';


        $this->render("administrador"); //use different view
    }
    
    
    public function administradorAction()
    {
        /* Initialize model and retrieve data here */
        $nivelPagina = "administrador";
        

        $html = new Moxca_Html_Html();

        $this->view->html = $html;

        $reqDefault = new MediadorDefault();

        $dadosPagina = Array();

        /* Initialize view and populate here */

        //links_home
        //  link_usuarios: texto
        //  link_monitores: texto
        //  link_planos_nao_verificados: texto
        //  link_cria_usuario: texto
        //  link_cadastra_escola: texto
        //  link_cadastra_turma: texto
        //  link_cadastra_horario: texto
        //  link_gerencia_categorias: texto
        $dadosPagina['links_home']['link_usuarios'] = "/autenticacao/conta/lista";
        $dadosPagina['links_home']['link_cria_usuario'] = "/autenticacao/conta/cria";
        $dadosPagina['links_home']['link_cadastra_escola'] = "/planejamento/escola/cadastra";
        $dadosPagina['links_home']['link_cadastra_turma'] = "/planejamento/turma/cadastra";
        $dadosPagina['links_home']['link_cadastra_horario'] = "/planejamento/horario/cadastra";
        $dadosPagina['links_home']['link_monitores'] = "/autorizacao/monitor/lista";
        $dadosPagina['links_home']['link_planos_nao_verificados'] = "/planejamento/aula/verifica";
        $dadosPagina['links_home']['link_gerencia_categorias'] = "/panopramanga/categoria/gerencia";

        $this->view->linksHome = $dadosPagina['links_home'];
        
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $this->view->identity = $auth->getIdentity();
            
        } else {
            $this->_redirect("/autenticacao/login/acessa");
        }

        
        //banco_pagina
        //  link_edita: texto
        $dadosPagina['banco_pagina']['link_edita'] = "/panopramanga/banco/edita";
        
        $this->view->bancoPagina = $dadosPagina['banco_pagina'];
        

        //titulo_pagina: texto
        $dadosPagina['titulo_pagina'] = "Principal";

        $this->view->tituloPagina = $dadosPagina['titulo_pagina'];

        
        //title
        $dadosPagina['title'] = "Ao Cubo";

        $layoutHelper = $this->_helper->getHelper('Layout');
        $layout = $layoutHelper->getLayoutInstance();

        $layout->title = $dadosPagina['title'];

        $layout->nestedLayout = 'home';

    }
    
    
    public function coordenadorMockAction()
    {
        /* Initialize model and retrieve data here */
        $html = new Moxca_Html_Html();

        $this->view->html = $html;

        /* Initialize view and populate here */
          
        //alerta_aulas
        // planos_a_verificar: texto
        // aulas_a_planejar: texto
        // aulas_a_relatar: texto
        // ultimos_relatos: texto
        // link_planos_a_verificar: texto
        // link_aulas_a_planejar: texto
        // link_aulas_a_relatar: texto
        // link_ultimos_relatos: texto
        $dadosPagina['alerta_aulas']['planos_a_verificar'] = "3";
        $dadosPagina['alerta_aulas']['aulas_a_planejar'] = "1";
        $dadosPagina['alerta_aulas']['aulas_a_relatar'] = "1";
        $dadosPagina['alerta_aulas']['ultimos_relatos'] = "1";
        $dadosPagina['alerta_aulas']['link_planos_a_verificar'] = "";
        $dadosPagina['alerta_aulas']['link_aulas_a_planejar'] = "";
        $dadosPagina['alerta_aulas']['link_aulas_a_relatar'] = "";
        $dadosPagina['alerta_aulas']['link_ultimos_relatos'] = "";
        
        $this->view->alertaAulas = $dadosPagina['alerta_aulas'];
        
        
        //alerta_atividades
        // atividades_a_verificar
        // link_atividades_a_verificar
        // atividades_a_ajustar
        // link_atividades_a_ajustar
        $dadosPagina['alerta_atividades']['atividades_a_verificar'] = "1";
        $dadosPagina['alerta_atividades']['link_atividades_a_verificar'] = "";
        $dadosPagina['alerta_atividades']['atividades_a_ajustar'] = "3";
        $dadosPagina['alerta_atividades']['link_atividades_a_ajustar'] = "";
        
        $this->view->alertaAtividades = $dadosPagina['alerta_atividades'];
        
        
        //titulo_pagina: texto
        $dadosPagina['titulo_pagina'] = "Principal";

        $this->view->tituloPagina = $dadosPagina['titulo_pagina'];
        
        
        //title        
        $dadosPagina['title'] = "Ao Cubo";

        $layoutHelper = $this->_helper->getHelper('Layout');
        $layout = $layoutHelper->getLayoutInstance();

        $layout->title = $dadosPagina['title'];

        $layout->nestedLayout = 'home';


        $this->render("coordenador"); //use different view
    }
    
    
    public function coordenadorAction()
    {
        /* Initialize model and retrieve data here */
        $nivelPagina = "coordenador";

        $html = new Moxca_Html_Html();

        $this->view->html = $html;

        $reqDefault = new MediadorDefault();

        $dadosPagina = Array();

        $auth = Zend_Auth::getInstance();

        if ($auth->hasIdentity()) {
            $identity = $auth->getIdentity();
        } else {
            $this->_redirect("/autenticacao/login/acessa");
        }

        /* Initialize view and populate here */

        $retMonitores = $reqDefault->listaTodosMonitores();

        $thisColecaoMonitores = $retMonitores['val_ret'];

        if ($thisColecaoMonitores->count() > 0) {
            $arrProximasAulas = Array();
            $conjuntoHorarios = Array();

            foreach ($thisColecaoMonitores as $thisMonitor) {
                $retHorarios = $reqDefault->listaTodosHorariosPorMonitor($thisMonitor->pegaCodUsuario());

                $thisColecaoHorarios = $retHorarios['val_ret'];

                $ccColecaoHorarios = $thisColecaoHorarios->count();

                if ($ccColecaoHorarios > 0) {
                    $conjuntoHorarios = Array();

                    foreach ($thisColecaoHorarios as $thisHorario) {
                        $retTurma = $reqDefault->recuperaTurmaPorCodigo($thisHorario->pegaCodTurma());

                        if ((!$retTurma['cod_ret']) && (!is_null($retTurma['val_ret']))) {
                            $thisTurma = $retTurma['val_ret'];

                            $conjuntoHorarios[$thisHorario->pegaCodHorario()]['horario'] = $thisHorario;
                            $conjuntoHorarios[$thisHorario->pegaCodHorario()]['turma'] = $thisTurma;
                        }

                        $arrProximasAulas[$thisHorario->pegaCodHorario()] = $html->recuperaProximaDataDiaSemana($thisHorario->pegaDiaSemana());

                    }

                }

            }

            asort($arrProximasAulas);

        }


        $arrDatas = $html->retornaDatasAnteriores(5);
        

        //alerta_aulas
        // planos_a_verificar: texto
        // link_planos_a_verificar: texto
        $retVerificar = $reqDefault->listaPlanosNaoVerificadosProximasAulas();

        $thisColecaoVerificar = $retVerificar['val_ret'];

        $ccVerificar = $thisColecaoVerificar->count();

        if ($ccVerificar) {
            $dadosPagina['alerta_aulas']['planos_a_verificar'] = $ccVerificar;
            $dadosPagina['alerta_aulas']['link_planos_a_verificar'] = "/planejamento/aula/verifica";
        }


        //alerta_aulas
        // aulas_a_planejar: texto
        // link_aulas_a_planejar: texto
        $ccAPlanejar = 0;

        foreach ($arrProximasAulas as $codHorario => $dataAula) {
            $retProximaAula = $reqDefault->recuperaAulaPorDataPorHorario($codHorario, $dataAula);

            if ((!$retProximaAula['cod_ret']) && (!is_null($retProximaAula['val_ret']))) {
                $thisProximaAula = $retProximaAula['val_ret'];

                $retPlanoExistente = $reqDefault->recuperaPlanoPorCodigoAula($thisProximaAula->pegaCodAula());

                if (($retPlanoExistente['cod_ret']) || (is_null($retPlanoExistente['val_ret']))) {
                    $ccAPlanejar++;
                }

            } else {
                $ccAPlanejar++;
            }

        }

        if ($ccAPlanejar) {
            $dadosPagina['alerta_aulas']['aulas_a_planejar'] = $ccAPlanejar;
            $dadosPagina['alerta_aulas']['link_aulas_a_planejar'] = "/planejamento/aula/lista?planejamento=planejar";
        }


        //alerta_aulas
        // aulas_a_relatar: texto
        // link_aulas_a_relatar: texto
        reset($conjuntoHorarios);
        foreach ($conjuntoHorarios as $codHorario => $dadosHorario) {
            $thisHorario = $dadosHorario['horario'];
            $thisTurma = $dadosHorario['turma'];

            $arrDatasRelato = $html->retornaDatas($thisHorario->pegaDiaSemana(), $thisHorario->pegaInicio(), $thisTurma->pegaPostagem(), date("Y-m-d H:i:s"));

            foreach ($arrDatasRelato as $chave => $valor) {
                $retAula = $reqDefault->recuperaAulaPorDataPorHorario($thisHorario->pegaCodHorario(), substr($valor, 0, 10));

                if ((!$retAula['cod_ret']) && (!is_null($retAula['val_ret']))) {
                    $thisAula = $retAula['val_ret'];

                    if ($thisAula->pegaStatus() != "relatado") {
                        $ccSemRelato++;
                    }

                } else {
                    $ccSemRelato++;
                }

            }

        }

        if ($ccSemRelato) {
            $dadosPagina['alerta_aulas']['aulas_a_relatar'] = $ccSemRelato;
            $dadosPagina['alerta_aulas']['link_aulas_a_relatar'] = "/planejamento/aula/lista?planejamento=arelatar";
        }


        //alerta_aulas
        // ultimos_relatos: texto
        // link_ultimos_relatos: texto
        $data1 = $arrDatas[4] . " 00:00:00";
        $data2 = $arrDatas[0] . " " . date("H:i:s");

        $retRelatos = $reqDefault->listaRelatos("(c.postagemRelato BETWEEN '" . $data1 . "' AND '" . $data2 . "') AND ci.idiomaRelato = 'pt'", "c.postagemRelato DESC LIMIT 5");

        $thisColecaoRelatos = $retRelatos['val_ret'];

        $ccUltimosRelatos = $thisColecaoRelatos->count();

        if ($ccUltimosRelatos) {
            $dadosPagina['alerta_aulas']['ultimos_relatos'] = $ccUltimosRelatos;
            $dadosPagina['alerta_aulas']['link_ultimos_relatos'] = "/planejamento/aula/lista?planejamento=relatadas";
        }


        $this->view->alertaAulas = $dadosPagina['alerta_aulas'];
        
        
        
        //n ultimos relatos
        //  link: texto
        //  data: data
        //  dia_semana: texto
        //  hora_inicio: texto
        //  hora_termino: texto
        //  turma: texto
        //  escola: texto
        //  autor: texto
        //  link_autor: texto
        $retRelatos = $reqDefault->listaRelatos("ci.idiomaRelato = 'pt'", "c.codRelato DESC LIMIT 3");

        $thisColecaoRelatos = $retRelatos['val_ret'];

        if ($thisColecaoRelatos->count() > 0) {
            $conjuntoRelatos = Array();

            foreach ($thisColecaoRelatos as $thisRelato) {
                $retAula = $reqDefault->recuperaAulaPorCodigo($thisRelato->pegaCodAula());

                if ((!$retAula['cod_ret']) && (!is_null($retAula['val_ret']))) {
                    $thisAulaRelato = $retAula['val_ret'];
                }

                if (isset($thisAulaRelato)) {
                    $retHorario = $reqDefault->recuperaHorarioPorCodigo($thisAulaRelato->pegaCodHorario());

                    if ((!$retHorario['cod_ret']) && (!is_null($retHorario['val_ret']))) {
                        $thisHorarioRelato = $retHorario['val_ret'];
                    }

                    if (isset($thisHorarioRelato)) {
                        $retMonitor = $reqDefault->recuperaUsuarioPorCodigo($thisHorarioRelato->pegaCodMonitor());

                        if ((!$retMonitor['cod_ret']) && (!is_null($retMonitor['val_ret']))) {
                            $thisMonitorRelato = $retMonitor['val_ret'];
                        }

                        $retEscola = $reqDefault->recuperaEscolaPorCodigo($thisHorarioRelato->pegaCodEscola());

                        if ((!$retEscola['cod_ret']) && (!is_null($retEscola['val_ret']))) {
                            $thisEscolaRelato = $retEscola['val_ret'];
                        }

                        $retTurma = $reqDefault->recuperaTurmaPorCodigo($thisHorarioRelato->pegaCodTurma());

                        if ((!$retTurma['cod_ret']) && (!is_null($retTurma['val_ret']))) {
                            $thisTurmaRelato = $retTurma['val_ret'];
                        }

                    }

                }

                if (isset($thisMonitorRelato) && isset($thisEscolaRelato) && isset($thisTurmaRelato)) {
                    $conjuntoRelatos[$thisRelato->pegaCodRelato()]['link'] = "/registro/aula/consulta?aula=" . $thisAulaRelato->pegaCodAula();
                    $conjuntoRelatos[$thisRelato->pegaCodRelato()]['data'] = date("d/m/Y", strtotime($thisAulaRelato->pegaData()));
                    $conjuntoRelatos[$thisRelato->pegaCodRelato()]['dia_semana'] = strtoupper(substr($html->nomesDiasSemana[$thisHorarioRelato->pegaDiaSemana()], 0, 3));
                    $conjuntoRelatos[$thisRelato->pegaCodRelato()]['hora_inicio'] = substr($thisHorarioRelato->pegaInicio(), 0, 5);
                    $conjuntoRelatos[$thisRelato->pegaCodRelato()]['hora_termino'] = substr($thisHorarioRelato->pegaTermino(), 0, 5);
                    $conjuntoRelatos[$thisRelato->pegaCodRelato()]['turma'] = $thisTurmaRelato->pegaTitulo();
                    $conjuntoRelatos[$thisRelato->pegaCodRelato()]['escola'] = $thisEscolaRelato->pegaTitulo();
                    $conjuntoRelatos[$thisRelato->pegaCodRelato()]['autor'] = $thisMonitorRelato->pegaNome() . " " . $thisMonitorRelato->pegaSobrenome();
                    $conjuntoRelatos[$thisRelato->pegaCodRelato()]['link_autor'] = "/planejamento/aula/lista?titulo=" . $thisMonitorRelato->pegaApelido() . "&planejamento=relatadas";

                }

            }

            $this->view->conjuntoRelatos = $conjuntoRelatos;

        }


        //todos_relatos: texto
        $dadosPagina['todos_relatos'] = "/planejamento/aula/lista?planejamento=relatadas";

        $this->view->todosRelatos = $dadosPagina['todos_relatos'];


        //n ultimos planos
        //  link: texto
        //  data: data
        //  dia_semana: texto
        //  hora_inicio: texto
        //  hora_termino: texto
        //  turma: texto
        //  escola: texto
        //  autor: texto
        //  link_autor: texto
        $retPlanos = $reqDefault->listaPlanos("c.statusPlano = 'adequada' AND ci.idiomaPlano = 'pt'", "c.codPlano DESC LIMIT 3");

        $thisColecaoPlanos = $retPlanos['val_ret'];

        if ($thisColecaoPlanos->count() > 0) {
            $conjuntoPlanos = Array();

            foreach ($thisColecaoPlanos as $thisPlano) {
                $retAula = $reqDefault->recuperaAulaPorCodigo($thisPlano->pegaCodAula());

                if ((!$retAula['cod_ret']) && (!is_null($retAula['val_ret']))) {
                    $thisAulaPlano = $retAula['val_ret'];
                }

                if (isset($thisAulaPlano)) {
                    $retHorario = $reqDefault->recuperaHorarioPorCodigo($thisAulaPlano->pegaCodHorario());

                    if ((!$retHorario['cod_ret']) && (!is_null($retHorario['val_ret']))) {
                        $thisHorarioPlano = $retHorario['val_ret'];
                    }

                    if (isset($thisHorarioPlano)) {
                        $retMonitor = $reqDefault->recuperaUsuarioPorCodigo($thisHorarioPlano->pegaCodMonitor());

                        if ((!$retMonitor['cod_ret']) && (!is_null($retMonitor['val_ret']))) {
                            $thisMonitorPlano = $retMonitor['val_ret'];
                        }

                        $retEscola = $reqDefault->recuperaEscolaPorCodigo($thisHorarioPlano->pegaCodEscola());

                        if ((!$retEscola['cod_ret']) && (!is_null($retEscola['val_ret']))) {
                            $thisEscolaPlano = $retEscola['val_ret'];
                        }

                        $retTurma = $reqDefault->recuperaTurmaPorCodigo($thisHorarioPlano->pegaCodTurma());

                        if ((!$retTurma['cod_ret']) && (!is_null($retTurma['val_ret']))) {
                            $thisTurmaPlano = $retTurma['val_ret'];
                        }

                    }

                }

                if (isset($thisMonitorPlano) && isset($thisEscolaPlano) && isset($thisTurmaPlano)) {
                    $conjuntoPlanos[$thisPlano->pegaCodPlano()]['link'] = "/registro/aula/consulta?aula=" . $thisAulaPlano->pegaCodAula();
                    $conjuntoPlanos[$thisPlano->pegaCodPlano()]['data'] = date("d/m/Y", strtotime($thisAulaPlano->pegaData()));
                    $conjuntoPlanos[$thisPlano->pegaCodPlano()]['dia_semana'] = strtoupper(substr($html->nomesDiasSemana[$thisHorarioPlano->pegaDiaSemana()], 0, 3));
                    $conjuntoPlanos[$thisPlano->pegaCodPlano()]['hora_inicio'] = substr($thisHorarioPlano->pegaInicio(), 0, 5);
                    $conjuntoPlanos[$thisPlano->pegaCodPlano()]['hora_termino'] = substr($thisHorarioPlano->pegaTermino(), 0, 5);
                    $conjuntoPlanos[$thisPlano->pegaCodPlano()]['turma'] = $thisTurmaPlano->pegaTitulo();
                    $conjuntoPlanos[$thisPlano->pegaCodPlano()]['escola'] = $thisEscolaPlano->pegaTitulo();
                    $conjuntoPlanos[$thisPlano->pegaCodPlano()]['autor'] = $thisMonitorPlano->pegaNome() . " " . $thisMonitorPlano->pegaSobrenome();
                    $conjuntoPlanos[$thisPlano->pegaCodPlano()]['link_autor'] = "/planejamento/aula/lista?titulo=" . $thisMonitorPlano->pegaApelido() . "&planejamento=planejadas&plano=adequada";

                }

            }

            $this->view->conjuntoPlanos = $conjuntoPlanos;

        }


        //todos_planos: texto
        $dadosPagina['todos_planos'] = "/planejamento/aula/lista?planejamento=planejadas&plano=adequada";

        $this->view->todosPlanos = $dadosPagina['todos_planos'];


        //n aulas mais comentadas
        //  link: texto
        //  data: data
        //  dia_semana: texto
        //  hora_inicio: texto
        //  hora_termino: texto
        //  turma: texto
        //  escola: texto
        //  comentarios: texto
        //  autor: texto
        //  link_autor: texto
        $retAulasMaisComentadas = $reqDefault->listaAulasMaisComentadas();

        if ((!$retAulasMaisComentadas['cod_ret']) && (!is_null($retAulasMaisComentadas['val_ret']))) {
            $arrAulas = $retAulasMaisComentadas['val_ret'];

        } else {
            $arrAulas = Array();
        }

        if (count($arrAulas) > 0) {
            $conjuntoAulasComentadas = Array();
            $ccAulas = 0;

            foreach ($arrAulas as $codAula => $ccAula) {
                if ($ccAulas >= 3) {
                    break;
                }

                $retAula = $reqDefault->recuperaAulaPorCodigo($codAula);

                if ((!$retAula['cod_ret']) && (!is_null($retAula['val_ret']))) {
                    $thisAulaComentada = $retAula['val_ret'];
                }
                
                if (isset($thisAulaComentada)) {
                    $retHorario = $reqDefault->recuperaHorarioPorCodigo($thisAulaComentada->pegaCodHorario());

                    if ((!$retHorario['cod_ret']) && (!is_null($retHorario['val_ret']))) {
                        $thisHorarioComentado = $retHorario['val_ret'];
                    }
                    
                    if (isset($thisHorarioComentado)) {
                        $retMonitor = $reqDefault->recuperaUsuarioPorCodigo($thisHorarioComentado->pegaCodMonitor());

                        if ((!$retMonitor['cod_ret']) && (!is_null($retMonitor['val_ret']))) {
                            $thisMonitorComentado = $retMonitor['val_ret'];
                        }

                        $retEscola = $reqDefault->recuperaEscolaPorCodigo($thisHorarioComentado->pegaCodEscola());

                        if ((!$retEscola['cod_ret']) && (!is_null($retEscola['val_ret']))) {
                            $thisEscolaComentada = $retEscola['val_ret'];
                        }

                        $retTurma = $reqDefault->recuperaTurmaPorCodigo($thisHorarioComentado->pegaCodTurma());

                        if ((!$retTurma['cod_ret']) && (!is_null($retTurma['val_ret']))) {
                            $thisTurmaComentada = $retTurma['val_ret'];
                        }
                        
                    }
                    
                }

                if (isset($thisMonitorComentado) && isset($thisEscolaComentada) && isset($thisTurmaComentada)) {
                    $ccAulas++;

                    $conjuntoAulasComentadas[$codAula]['link'] = "/registro/aula/consulta?aula=" . $thisAulaComentada->pegaCodAula();
                    $conjuntoAulasComentadas[$codAula]['data'] = date("d/m/Y", strtotime($thisAulaComentada->pegaData()));
                    $conjuntoAulasComentadas[$codAula]['dia_semana'] = strtoupper(substr($html->nomesDiasSemana[$thisHorarioComentado->pegaDiaSemana()], 0, 3));
                    $conjuntoAulasComentadas[$codAula]['hora_inicio'] = substr($thisHorarioComentado->pegaInicio(), 0, 5);
                    $conjuntoAulasComentadas[$codAula]['hora_termino'] = substr($thisHorarioComentado->pegaTermino(), 0, 5);
                    $conjuntoAulasComentadas[$codAula]['turma'] = $thisTurmaComentada->pegaTitulo();
                    $conjuntoAulasComentadas[$codAula]['escola'] = $thisEscolaComentada->pegaTitulo();
                    $conjuntoAulasComentadas[$codAula]['comentarios'] = $ccAula;
                    $conjuntoAulasComentadas[$codAula]['autor'] = $thisMonitorComentado->pegaNome() . " " . $thisMonitorComentado->pegaSobrenome();
                    $conjuntoAulasComentadas[$codAula]['link_autor'] = "/planejamento/aula/lista?titulo=" . $thisMonitorComentado->pegaApelido();

                }

            }

            $this->view->conjuntoAulasComentadas = $conjuntoAulasComentadas;

        }

        
        //todas_aulas: texto
        $dadosPagina['todas_aulas'] = "/planejamento/aula/lista";

        $this->view->todasAulas = $dadosPagina['todas_aulas'];

        
        
        //alerta_atividades
        // atividades_a_verificar
        // link_atividades_a_ajustar
        $retAjustesAtividade = $reqDefault->listaAtividades("c.statusAtividade = 'verificar' AND c.autorAtividade= " . $identity->codUsuario . " AND ci.idiomaAtividade = 'pt'");

        $thisColecaoAjustesAtividade = $retAjustesAtividade['val_ret'];

        $ccAjustesAtividade = $thisColecaoAjustesAtividade->count();

        if ($ccAjustesAtividade) {
            $dadosPagina['alerta_atividades']['atividades_a_verificar'] = $ccAjustesAtividade;
            $dadosPagina['alerta_atividades']['link_atividades_a_verificar'] = "/panopramanga/atividade/lista?status=verificar";
        }

        $this->view->alertaAtividades = $dadosPagina['alerta_atividades'];


        //minhas_atividades: texto
        $dadosPagina['minhas_atividades'] = "/panopramanga/atividade/lista?monitor=" . $identity->apelidoUsuario;

        $this->view->minhasAtividades = $dadosPagina['minhas_atividades'];


        //n ultimos comentarios de atividades
        //  link_atividade: texto
        //  titulo_atividade: texto
        //  data_atividade: data
        //  autor_comentario: texto
        $retMinhasAtividades = $reqDefault->listaAtividades("c.statusAtividade = 'adequada' AND c.autorAtividade= " . $identity->codUsuario . " AND ci.idiomaAtividade = 'pt'");

        $thisColecaoMinhasAtividades = $retMinhasAtividades['val_ret'];

        $arrMinhasAtividades = Array();

        if ($thisColecaoMinhasAtividades->count() > 0) {
            foreach ($thisColecaoMinhasAtividades as $thisMinhaAtividade) {
                $arrMinhasAtividades[] = $thisMinhaAtividade->pegaCodAtividade();
            }
        }

        if (count($arrMinhasAtividades) > 0) {
            $strMinhasAtividades = implode(", ", $arrMinhasAtividades);

            $retComentariosAtividades = $reqDefault->listaComentarios("codAtividade IN (" . $strMinhasAtividades . ") AND idiomaComentario = 'pt'", "postagemComentario DESC LIMIT 3");

            $thisColecaoComentariosAtividades = $retComentariosAtividades['val_ret'];

            if ($thisColecaoComentariosAtividades->count() > 0) {
                $conjuntoComentariosAtividades = Array();

                foreach ($thisColecaoComentariosAtividades as $thisComentarioAtividade) {
                    $retAtividade = $reqDefault->recuperaAtividadePorCodigo($thisComentarioAtividade->pegaCodAtividade());

                    if ((!$retAtividade['cod_ret']) && (!is_null($retAtividade['val_ret']))) {
                        $thisAtividade = $retAtividade['val_ret'];
                    }

                    $retAutorComentario = $reqDefault->recuperaUsuarioPorCodigo($thisComentarioAtividade->pegaAutor());

                    if ((!$retAutorComentario['cod_ret']) && (!is_null($retAutorComentario['val_ret']))) {
                        $thisAutorComentario = $retAutorComentario['val_ret'];
                    }

                    if (isset($thisAtividade) && isset($thisAutorComentario)) {
                        $conjuntoComentariosAtividades[$thisComentarioAtividade->pegaCodComentario()]['link_atividade'] = "/panopramanga/atividade/consulta?titulo=" . $thisAtividade->pegaTituloUnico();
                        $conjuntoComentariosAtividades[$thisComentarioAtividade->pegaCodComentario()]['titulo_atividade'] = $thisAtividade->pegaTitulo();

                        $dataComentario = date("d/m/Y", strtotime($thisComentarioAtividade->pegaPostagem()));
                        $horarioComentario = date("H:i", strtotime($thisComentarioAtividade->pegaPostagem()));

                        $conjuntoComentariosAtividades[$thisComentarioAtividade->pegaCodComentario()]['data_atividade'] = $dataComentario . " às " . $horarioComentario;

                        $conjuntoComentariosAtividades[$thisComentarioAtividade->pegaCodComentario()]['autor_comentario'] = $thisAutorComentario->pegaNome() . " " . $thisAutorComentario->pegaSobrenome();

                    }

                }

                $this->view->conjuntoComentariosAtividades = $conjuntoComentariosAtividades;

            }

        }


        //n atividades mais comentadas
        //  link: texto
        //  titulo: texto
        //  data: data
        //  autor: texto
        //  comentarios: texto
        $retAtividadesMaisComentadas = $reqDefault->listaAtividadesMaisComentadas();

        if ((!$retAtividadesMaisComentadas['cod_ret']) && (!is_null($retAtividadesMaisComentadas['val_ret']))) {
            $arrAtividades = $retAtividadesMaisComentadas['val_ret'];

        } else {
            $arrAtividades = Array();
        }
        
        if (count($arrAtividades) > 0) {
            $conjuntoAtividadesComentadas = Array();
            $ccAtividades = 0;

            foreach ($arrAtividades as $codAtividade => $ccAtividade) {
                if ($ccAtividades >= 3) {
                    break;
                }

                $retAtividade = $reqDefault->recuperaAtividadePorCodigo($codAtividade);

                if ((!$retAtividade['cod_ret']) && (!is_null($retAtividade['val_ret']))) {
                    $thisAtividadeComentada = $retAtividade['val_ret'];

                    $retUltimoComentario = $reqDefault->listaComentarios("codAtividade = " . $thisAtividadeComentada->pegaCodAtividade() . " AND idiomaComentario = 'pt'", "postagemComentario DESC LIMIT 1");

                    $thisColecaoUltimoComentario = $retUltimoComentario['val_ret'];

                    if ($thisColecaoUltimoComentario->count() > 0) {
                        $thisUltimoComentario = $thisColecaoUltimoComentario->current();

                        $retAutorUltimoComentario = $reqDefault->recuperaUsuarioPorCodigo($thisUltimoComentario->pegaAutor());

                        if ((!$retAutorUltimoComentario['cod_ret']) && (!is_null($retAutorUltimoComentario['val_ret']))) {
                            $thisAutorUltimoComentario = $retAutorUltimoComentario['val_ret'];

                            $ccAtividades++;

                            $conjuntoAtividadesComentadas[$thisAtividadeComentada->pegaTituloUnico()]['link'] = "/panopramanga/atividade/consulta?titulo=" . $thisAtividadeComentada->pegaTituloUnico();
                            $conjuntoAtividadesComentadas[$thisAtividadeComentada->pegaTituloUnico()]['titulo'] = $thisAtividadeComentada->pegaTitulo();

                            $dataUltimoComentario = date("d/m/Y", strtotime($thisUltimoComentario->pegaPostagem()));
                            $horarioUltimoComentario = date("H:i", strtotime($thisUltimoComentario->pegaPostagem()));

                            $conjuntoAtividadesComentadas[$thisAtividadeComentada->pegaTituloUnico()]['data'] = $dataUltimoComentario . " às " . $horarioUltimoComentario;
                            $conjuntoAtividadesComentadas[$thisAtividadeComentada->pegaTituloUnico()]['autor'] = $thisAutorUltimoComentario->pegaNome() . " " . $thisAutorUltimoComentario->pegaSobrenome();
                            $conjuntoAtividadesComentadas[$thisAtividadeComentada->pegaTituloUnico()]['comentarios'] = $ccAtividade;

                        }

                    }
                    
                }
                
            }

            $this->view->conjuntoAtividadesComentadas = $conjuntoAtividadesComentadas;
            
        }
        

        //n atividades mais utilizadas
        //  link: texto
        //  titulo: texto
        $retAtividadesMaisUtilizadas = $reqDefault->listaAtividadesMaisUtilizadas();

        if ((!$retAtividadesMaisUtilizadas['cod_ret']) && (!is_null($retAtividadesMaisUtilizadas['val_ret']))) {
            $arrAtividadesUtilizadas = $retAtividadesMaisUtilizadas['val_ret'];

        } else {
            $arrAtividadesUtilizadas = Array();
        }

        if (count($arrAtividadesUtilizadas) > 0) {
            $conjuntoAtividadesUtilizadas = Array();
            $ccAtividadesUtilizadas = 0;

            foreach ($arrAtividadesUtilizadas as $codAtividadeUtilizada => $ccAtividadeUtilizada) {
                if ($ccAtividadesUtilizadas >= 5) {
                    break;
                }

                $retAtividadeUtilizada = $reqDefault->recuperaAtividadePorCodigo($codAtividadeUtilizada);

                if ((!$retAtividadeUtilizada['cod_ret']) && (!is_null($retAtividadeUtilizada['val_ret']))) {
                    $ccAtividadesUtilizadas++;

                    $thisAtividadeUtilizada = $retAtividadeUtilizada['val_ret'];

                    $conjuntoAtividadesUtilizadas[$thisAtividadeUtilizada->pegaTituloUnico()]['link'] = "/panopramanga/atividade/consulta?titulo=" . $thisAtividadeUtilizada->pegaTituloUnico();
                    $conjuntoAtividadesUtilizadas[$thisAtividadeUtilizada->pegaTituloUnico()]['titulo'] = $thisAtividadeUtilizada->pegaTitulo();

                }

            }

            $this->view->conjuntoAtividadesUtilizadas = $conjuntoAtividadesUtilizadas;

        }


        //n atividades mais recentes
        //  link: texto
        //  titulo: texto
        $retAtividadesRecentes = $reqDefault->listaAtividades("c.statusAtividade = 'adequada'", "c.postagemAtividade DESC LIMIT 5");

        $thisColecaoAtividadesRecentes = $retAtividadesRecentes['val_ret'];

        if ($thisColecaoAtividadesRecentes->count() > 0) {
            $conjuntoAtividadesRecentes = Array();

            foreach ($thisColecaoAtividadesRecentes as $thisAtividadeRecente) {
                $conjuntoAtividadesRecentes[$thisAtividadeRecente->pegaTituloUnico()]['link'] = "/panopramanga/atividade/consulta?titulo=" . $thisAtividadeRecente->pegaTituloUnico();
                $conjuntoAtividadesRecentes[$thisAtividadeRecente->pegaTituloUnico()]['titulo'] = $thisAtividadeRecente->pegaTitulo();

            }

            $this->view->conjuntoAtividadesRecentes = $conjuntoAtividadesRecentes;

        }



        
        //titulo_pagina: texto
        $dadosPagina['titulo_pagina'] = "Principal";

        $this->view->tituloPagina = $dadosPagina['titulo_pagina'];

        
        //title
        $dadosPagina['title'] = "Ao Cubo";

        $layoutHelper = $this->_helper->getHelper('Layout');
        $layout = $layoutHelper->getLayoutInstance();

        $layout->title = $dadosPagina['title'];

        $layout->nestedLayout = 'home';

    }


    public function secretariaMockAction()
    {
        /* Initialize model and retrieve data here */
        $html = new Moxca_Html_Html();

        $this->view->html = $html;

        /* Initialize view and populate here */
		
        //links_home
        //  link_cadastra_escola: texto
        //  link_cadastra_turma: texto
        //  link_cadastra_horario: texto
        $dadosPagina['links_home']['link_cadastra_escola'] = "/planejamento/escola/cadastra";
        $dadosPagina['links_home']['link_cadastra_turma'] = "/planejamento/turma/cadastra";
        $dadosPagina['links_home']['link_cadastra_horario'] = "/planejamento/horario/cadastra";

        //titulo_pagina: texto
        $dadosPagina['titulo_pagina'] = "Principal";

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

        $layout->nestedLayout = 'home';


        $this->render("secretaria"); //use different view
    }


    public function secretariaAction()
    {
        /* Initialize model and retrieve data here */
        $nivelPagina = "secretario";

        $html = new Moxca_Html_Html();

        $this->view->html = $html;

        $reqDefault = new MediadorDefault();

        $dadosPagina = Array();

        /* Initialize view and populate here */

        //links_home
        //  link_cadastra_escola: texto
        //  link_cadastra_turma: texto
        //  link_cadastra_horario: texto
        $dadosPagina['links_home']['link_cadastra_escola'] = "/planejamento/escola/cadastra";
        $dadosPagina['links_home']['link_cadastra_turma'] = "/planejamento/turma/cadastra";
        $dadosPagina['links_home']['link_cadastra_horario'] = "/planejamento/horario/cadastra";

        $this->view->linksHome = $dadosPagina['links_home'];
        

        //titulo_pagina: texto
        $dadosPagina['titulo_pagina'] = "Principal";

        $this->view->tituloPagina = $dadosPagina['titulo_pagina'];

        
        //title
        $dadosPagina['title'] = "Ao Cubo";

        $layoutHelper = $this->_helper->getHelper('Layout');
        $layout = $layoutHelper->getLayoutInstance();

        $layout->title = $dadosPagina['title'];

        $layout->nestedLayout = 'home';

    }


    public function monitorMockAction()
    {
        /* Initialize model and retrieve data here */
        $html = new Moxca_Html_Html();

        $this->view->html = $html;

        /* Initialize view and populate here */
          
        //alerta_aulas
        // aulas_a_ajustar
        // aulas_a_relatar
        // link_aulas_a_ajustar
        // link_aulas_a_relatar
        $dadosPagina['alerta_aulas']['aulas_a_ajustar'] = "1";
        $dadosPagina['alerta_aulas']['aulas_a_relatar'] = "5";
        $dadosPagina['alerta_aulas']['link_aulas_a_ajustar'] = "";
        $dadosPagina['alerta_aulas']['link_aulas_a_relatar'] = "";
        
        $this->view->alertaAulas = $dadosPagina['alerta_aulas'];
        
        //minhas_aulas: texto
        $dadosPagina['minhas_aulas'] = "/planejamento/aula/lista-mock";
        
        $this->view->minhasAulas = $dadosPagina['minhas_aulas'];
        
        
        //n aulas
        //  link: texto
        //  data: data
        //  dia_semana: texto
        //  hora_inicio: texto
        //  hora_termino: texto
        //  turma: texto
        //  escola: texto
        //  proxima_aula: verdadeiro/falso
        //  aula_planejada: verdadeiro/falso
        //  link_planejar: texto
        //  plano_aprovado: verdadeiro/falso
        //  plano_a_ajustar: verdadeiro/falso
        //  plano_a_verificar: verdadeiro/falso
        //  aula_relatada: verdadeiro/falso
        //  link_relatar: texto
        
        $conjuntoAulas['2011-07-01']['horario-01']['link'] = "";
        $conjuntoAulas['2011-07-01']['horario-01']['dia_semana'] = "SEX";
        $conjuntoAulas['2011-07-01']['horario-01']['hora_inicio'] = "14:00";
        $conjuntoAulas['2011-07-01']['horario-01']['hora_termino'] = "16:00";
	$conjuntoAulas['2011-07-01']['horario-01']['turma'] = "Turma 02";
	$conjuntoAulas['2011-07-01']['horario-01']['escola'] = "Escola 03";
        $conjuntoAulas['2011-07-01']['horario-01']['proxima_aula'] = false;
        $conjuntoAulas['2011-07-01']['horario-01']['aula_planejada'] = false;
        $conjuntoAulas['2011-07-01']['horario-01']['link_planejar'] = "";
        $conjuntoAulas['2011-07-01']['horario-01']['plano_aprovado'] = false;
        $conjuntoAulas['2011-07-01']['horario-01']['plano_a_ajustar'] = false;     
        $conjuntoAulas['2011-07-01']['horario-01']['plano_a_verificar'] = false;
        $conjuntoAulas['2011-07-01']['horario-01']['aula_relatada'] = false;
        $conjuntoAulas['2011-07-01']['horario-01']['link_relatar'] = "/registro/aula/relata-mock";
        
        $conjuntoAulas['2011-07-05']['horario-02']['link'] = "";
        $conjuntoAulas['2011-07-05']['horario-02']['dia_semana'] = "TER";
        $conjuntoAulas['2011-07-05']['horario-02']['hora_inicio'] = "10:00";
        $conjuntoAulas['2011-07-05']['horario-02']['hora_termino'] = "11:00";
	$conjuntoAulas['2011-07-05']['horario-02']['turma'] = "Turma 01";
	$conjuntoAulas['2011-07-05']['horario-02']['escola'] = "Escola 02";
        $conjuntoAulas['2011-07-05']['horario-02']['proxima_aula'] = false;
        $conjuntoAulas['2011-07-05']['horario-02']['aula_planejada'] = true;
        $conjuntoAulas['2011-07-05']['horario-02']['link_planejar'] = "";
        $conjuntoAulas['2011-07-05']['horario-02']['plano_aprovado'] = true;
        $conjuntoAulas['2011-07-05']['horario-02']['plano_a_ajustar'] = false;     
        $conjuntoAulas['2011-07-05']['horario-02']['plano_a_verificar'] = false;
        $conjuntoAulas['2011-07-05']['horario-02']['aula_relatada'] = false;
        $conjuntoAulas['2011-07-05']['horario-02']['link_relatar'] = "/registro/aula/relata-mock";
        
        $conjuntoAulas['2011-07-06']['horario-03']['link'] = "";
        $conjuntoAulas['2011-07-06']['horario-03']['dia_semana'] = "QUA";
        $conjuntoAulas['2011-07-06']['horario-03']['hora_inicio'] = "15:00";
        $conjuntoAulas['2011-07-06']['horario-03']['hora_termino'] = "16:00";
	$conjuntoAulas['2011-07-06']['horario-03']['turma'] = "Turma 02";
	$conjuntoAulas['2011-07-06']['horario-03']['escola'] = "Escola 01";
        $conjuntoAulas['2011-07-06']['horario-03']['proxima_aula'] = false;
        $conjuntoAulas['2011-07-06']['horario-03']['aula_planejada'] = true;
        $conjuntoAulas['2011-07-06']['horario-03']['link_planejar'] = "";
        $conjuntoAulas['2011-07-06']['horario-03']['plano_aprovado'] = true;
        $conjuntoAulas['2011-07-06']['horario-03']['plano_a_ajustar'] = false;     
        $conjuntoAulas['2011-07-06']['horario-03']['plano_a_verificar'] = false;
        $conjuntoAulas['2011-07-06']['horario-03']['aula_relatada'] = true;
        $conjuntoAulas['2011-07-06']['horario-03']['link_relatar'] = "";
        
        $conjuntoAulas['2011-07-08']['horario-04']['link'] = "";
        $conjuntoAulas['2011-07-08']['horario-04']['dia_semana'] = "SEX";
        $conjuntoAulas['2011-07-08']['horario-04']['hora_inicio'] = "13:00";
        $conjuntoAulas['2011-07-08']['horario-04']['hora_termino'] = "15:00";
	$conjuntoAulas['2011-07-08']['horario-04']['turma'] = "Turma 03";
	$conjuntoAulas['2011-07-08']['horario-04']['escola'] = "Escola 02";
        $conjuntoAulas['2011-07-08']['horario-04']['proxima_aula'] = true;
        $conjuntoAulas['2011-07-08']['horario-04']['aula_planejada'] = true;
        $conjuntoAulas['2011-07-08']['horario-04']['link_planejar'] = "";
        $conjuntoAulas['2011-07-08']['horario-04']['plano_aprovado'] = false;
        $conjuntoAulas['2011-07-08']['horario-04']['plano_a_ajustar'] = true;     
        $conjuntoAulas['2011-07-08']['horario-04']['plano_a_verificar'] = false;
        $conjuntoAulas['2011-07-08']['horario-04']['aula_relatada'] = false;
        $conjuntoAulas['2011-07-08']['horario-04']['link_relatar'] = "";
         
        $conjuntoAulas['2011-07-14']['horario-05']['link'] = "";
        $conjuntoAulas['2011-07-14']['horario-05']['dia_semana'] = "QUI";
        $conjuntoAulas['2011-07-14']['horario-05']['hora_inicio'] = "13:00";
        $conjuntoAulas['2011-07-14']['horario-05']['hora_termino'] = "15:00";
	$conjuntoAulas['2011-07-14']['horario-05']['turma'] = "Turma 03";
	$conjuntoAulas['2011-07-14']['horario-05']['escola'] = "Escola 02";
        $conjuntoAulas['2011-07-14']['horario-05']['proxima_aula'] = false;
        $conjuntoAulas['2011-07-14']['horario-05']['aula_planejada'] = true;
        $conjuntoAulas['2011-07-14']['horario-05']['link_planejar'] = "";
        $conjuntoAulas['2011-07-14']['horario-05']['plano_aprovado'] = false;
        $conjuntoAulas['2011-07-14']['horario-05']['plano_a_ajustar'] = false;     
        $conjuntoAulas['2011-07-14']['horario-05']['plano_a_verificar'] = true;
        $conjuntoAulas['2011-07-14']['horario-05']['aula_relatada'] = false;
        $conjuntoAulas['2011-07-14']['horario-05']['link_relatar'] = "";
        
        $conjuntoAulas['2011-07-15']['horario-06']['link'] = "";
        $conjuntoAulas['2011-07-15']['horario-06']['dia_semana'] = "QUI";
        $conjuntoAulas['2011-07-15']['horario-06']['hora_inicio'] = "13:00";
        $conjuntoAulas['2011-07-15']['horario-06']['hora_termino'] = "15:00";
	$conjuntoAulas['2011-07-15']['horario-06']['turma'] = "Turma 03";
	$conjuntoAulas['2011-07-15']['horario-06']['escola'] = "Escola 02";
        $conjuntoAulas['2011-07-15']['horario-06']['proxima_aula'] = false;
        $conjuntoAulas['2011-07-15']['horario-06']['aula_planejada'] = false;
        $conjuntoAulas['2011-07-15']['horario-06']['link_planejar'] = "planejamento/aula/planeja-mock";
        $conjuntoAulas['2011-07-15']['horario-06']['plano_aprovado'] = false;
        $conjuntoAulas['2011-07-15']['horario-06']['plano_a_ajustar'] = false;     
        $conjuntoAulas['2011-07-15']['horario-06']['plano_a_verificar'] = false;
        $conjuntoAulas['2011-07-15']['horario-06']['aula_relatada'] = false;
        $conjuntoAulas['2011-07-15']['horario-06']['link_relatar'] = "";
	
        $this->view->conjuntoAulas = $conjuntoAulas;
        
        
        //n ultimos relatos
        //  link: texto
        //  data: data
        //  dia_semana: texto
        //  hora_inicio: texto
        //  hora_termino: texto
        //  turma: texto
        //  escola: texto
        //  autor: texto
        //  link_autor: texto
        
        $conjuntoRelatos['relato-01']['link'] = "";
        $conjuntoRelatos['relato-01']['data'] = "03/07/2011";
        $conjuntoRelatos['relato-01']['dia_semana'] = "TER";
        $conjuntoRelatos['relato-01']['hora_inicio'] = "16:00";
        $conjuntoRelatos['relato-01']['hora_termino'] = "18:00";
	$conjuntoRelatos['relato-01']['turma'] = "Turma 02";
	$conjuntoRelatos['relato-01']['escola'] = "Escola 02";
        $conjuntoRelatos['relato-01']['autor'] = "Fulano de Tal";
        $conjuntoRelatos['relato-01']['link_autor'] = "/registro/aula/lista-mock";
        
        $this->view->conjuntoRelatos = $conjuntoRelatos;
        
        
        //todos_relatos: texto
        $dadosPagina['todos_relatos'] = "/registro/aula/lista-mock";

        $this->view->todosRelatos = $dadosPagina['todos_relatos'];
        
        
        //n ultimos planos
        //  link: texto
        //  data: data
        //  dia_semana: texto
        //  hora_inicio: texto
        //  hora_termino: texto
        //  turma: texto
        //  escola: texto
        //  autor: texto
        //  link_autor: texto
        
        $conjuntoPlanos['plano-01']['link'] = "";
        $conjuntoPlanos['plano-01']['data'] = "04/07/2011";
        $conjuntoPlanos['plano-01']['dia_semana'] = "QUA";
        $conjuntoPlanos['plano-01']['hora_inicio'] = "10:00";
        $conjuntoPlanos['plano-01']['hora_termino'] = "12:00";
	$conjuntoPlanos['plano-01']['turma'] = "Turma 02";
	$conjuntoPlanos['plano-01']['escola'] = "Escola 01";
        $conjuntoPlanos['plano-01']['autor'] = "Beltrano de Tal";
        $conjuntoPlanos['plano-01']['link_autor'] = "/registro/aula/lista-mock";
        
        $this->view->conjuntoPlanos = $conjuntoPlanos;
        
        
        //todos_planos: texto
        $dadosPagina['todos_planos'] = "/registro/aula/lista-mock";

        $this->view->todosPlanos = $dadosPagina['todos_planos'];
        
        
        //n aulas mais comentadas
        //  link: texto
        //  data: data
        //  dia_semana: texto
        //  hora_inicio: texto
        //  hora_termino: texto
        //  turma: texto
        //  escola: texto
        //  comentarios: texto
        //  autor: texto
        //  link_autor: texto
        
        $conjuntoAulasComentadas['aula-01']['link'] = "";
        $conjuntoAulasComentadas['aula-01']['data'] = "03/07/2011";
        $conjuntoAulasComentadas['aula-01']['dia_semana'] = "SEG";
        $conjuntoAulasComentadas['aula-01']['hora_inicio'] = "13:00";
        $conjuntoAulasComentadas['aula-01']['hora_termino'] = "15:00";
	$conjuntoAulasComentadas['aula-01']['turma'] = "Turma 01";
	$conjuntoAulasComentadas['aula-01']['escola'] = "Escola 01";
        $conjuntoAulasComentadas['aula-01']['comentarios'] = "3";
        $conjuntoAulasComentadas['aula-01']['autor'] = "Fulano de Tal";
        $conjuntoAulasComentadas['aula-01']['link_autor'] = "/registro/aula/lista-mock";
        
        $this->view->conjuntoAulasComentadas = $conjuntoAulasComentadas;
        
        
        //todas_aulas: texto
        $dadosPagina['todas_aulas'] = "/registro/aula/lista-mock";

        $this->view->todasAulas = $dadosPagina['todas_aulas'];
        
        
        //alerta_atividades
        // atividades_a_ajustar
        // link_atividades_a_ajustar
        $dadosPagina['alerta_atividades']['atividades_a_ajustar'] = "1";
        $dadosPagina['alerta_atividades']['link_atividades_a_ajustar'] = "";
        
        $this->view->alertaAtividades = $dadosPagina['alerta_atividades'];
        
        
        //minhas_atividades: texto
        $dadosPagina['minhas_atividades'] = "/panopramanga/atividade/lista?monitor=leonardo";
        
        $this->view->minhasAtividades = $dadosPagina['minhas_atividades'];
        
        
        //n ultimos comentarios de atividades
        //  link_atividade: texto
        //  titulo_atividade: texto
        //  data_atividade: data
        //  autor_comentario: texto
        
        $conjuntoComentariosAtividades['comentario-01']['link_atividade'] = "/panopramanga/atividade/consulta-mock";
        $conjuntoComentariosAtividades['comentario-01']['titulo_atividade'] = "Atividade 01";
        $conjuntoComentariosAtividades['comentario-01']['data_atividade'] = "07/07/2011 às 13:00";
        $conjuntoComentariosAtividades['comentario-01']['autor_comentario'] = "Fulano de Tal";

        $this->view->conjuntoComentariosAtividades = $conjuntoComentariosAtividades;
        
        
        //n atividades mais comentadas
        //  link: texto
        //  titulo: texto
        //  data: data
        //  autor: texto
        
        $conjuntoAtividadesComentadas['atividade-01']['link'] = "/panopramanga/atividade/consulta-mock";
        $conjuntoAtividadesComentadas['atividade-01']['titulo'] = "Atividade 01";
        $conjuntoAtividadesComentadas['atividade-01']['data'] = "07/07/2011 às 13:00";
        $conjuntoAtividadesComentadas['atividade-01']['autor'] = "Fulano de Tal";

        $this->view->conjuntoAtividadesComentadas = $conjuntoAtividadesComentadas;
        
        
        //n atividades mais utilizadas
        //  link: texto
        //  titulo: texto
        
        $conjuntoAtividadesUtilizadas['atividade-01']['link'] = "/panopramanga/atividade/consulta-mock";
        $conjuntoAtividadesUtilizadas['atividade-01']['titulo'] = "Atividade 01";
        
        $this->view->conjuntoAtividadesUtilizadas = $conjuntoAtividadesUtilizadas;
        
        
        //n atividades mais recentes
        //  link: texto
        //  titulo: texto
        
        $conjuntoAtividadesRecentes['atividade-01']['link'] = "/panopramanga/atividade/consulta-mock";
        $conjuntoAtividadesRecentes['atividade-01']['titulo'] = "Atividade 01";
        
        $this->view->conjuntoAtividadesRecentes = $conjuntoAtividadesRecentes;

        
        //titulo_pagina: texto
        $dadosPagina['titulo_pagina'] = "Principal";

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

        $layout->nestedLayout = 'home';


        $this->render("monitor"); //use different view
    }

    
    public function monitorAction()
    {
        /* Initialize model and retrieve data here */
        $nivelPagina = "monitor";

        $html = new Moxca_Html_Html();

        $this->view->html = $html;

        $reqDefault = new MediadorDefault();

        $dadosPagina = Array();

        $auth = Zend_Auth::getInstance();

        if ($auth->hasIdentity()) {
            $identity = $auth->getIdentity();
        } else {
            $this->_redirect("/autenticacao/login/acessa");
        }

        /* Initialize view and populate here */

        $retHorarios = $reqDefault->listaTodosHorariosPorMonitor($identity->codUsuario);

        $thisColecaoHorarios = $retHorarios['val_ret'];

        $ccColecaoHorarios = $thisColecaoHorarios->count();

        if ($ccColecaoHorarios > 0) {
            $conjuntoHorarios = Array();
            $arrHorarios = Array();

            foreach ($thisColecaoHorarios as $thisHorario) {
                $retEscola = $reqDefault->recuperaEscolaPorCodigo($thisHorario->pegaCodEscola());

                if ((!$retEscola['cod_ret']) && (!is_null($retEscola['val_ret']))) {
                    $thisEscola = $retEscola['val_ret'];

                } else {
                    break;
                }

                $retTurma = $reqDefault->recuperaTurmaPorCodigo($thisHorario->pegaCodTurma());

                if ((!$retTurma['cod_ret']) && (!is_null($retTurma['val_ret']))) {
                    $thisTurma = $retTurma['val_ret'];

                } else {
                    break;
                }

                $conjuntoHorarios[$thisHorario->pegaCodHorario()]['horario'] = $thisHorario;
                $conjuntoHorarios[$thisHorario->pegaCodHorario()]['escola'] = $thisEscola;
                $conjuntoHorarios[$thisHorario->pegaCodHorario()]['turma'] = $thisTurma;

                $arrHorarios[] = $thisHorario->pegaCodHorario();

            }

        }


        //minhas_aulas: texto
        $dadosPagina['minhas_aulas'] = "/planejamento/aula/lista" ;

        $this->view->minhasAulas = $dadosPagina['minhas_aulas'];

        //minhas_proximas_aulas: texto
        $dadosPagina['minhas_proximas_aulas'] = "/planejamento/aula/lista?busca=proxima" ;

        $this->view->minhasProximasAulas = $dadosPagina['minhas_proximas_aulas'];


        //alerta_aulas
        // aulas_a_ajustar
        // link_aulas_a_ajustar
        $retAjustes = $reqDefault->listaTodosPlanosPorStatusPorMonitor($arrHorarios, "ajustar");

        $thisColecaoAjustes = $retAjustes['val_ret'];

        $ccAjustes = $thisColecaoAjustes->count();

        if ($ccAjustes) {
            $dadosPagina['alerta_aulas']['aulas_a_ajustar'] = $ccAjustes;
            $dadosPagina['alerta_aulas']['link_aulas_a_ajustar'] = "/planejamento/aula/lista?titulo=" . $identity->apelidoUsuario . "&planejamento=planejadas&plano=ajustar";
        }
        

        //alerta_aulas
        // aulas_a_relatar
        // link_aulas_a_relatar
        reset($conjuntoHorarios);
        foreach ($conjuntoHorarios as $codHorario => $dadosHorario) {
            $thisHorario = $dadosHorario['horario'];
            $thisEscola = $dadosHorario['escola'];
            $thisTurma = $dadosHorario['turma'];

            $arrDatasRelato = $html->retornaDatas($thisHorario->pegaDiaSemana(), $thisHorario->pegaInicio(), $thisTurma->pegaPostagem(), date("Y-m-d H:i:s"));

            foreach ($arrDatasRelato as $chave => $valor) {
                $retAula = $reqDefault->recuperaAulaPorDataPorHorario($thisHorario->pegaCodHorario(), substr($valor, 0, 10));

                if ((!$retAula['cod_ret']) && (!is_null($retAula['val_ret']))) {
                    $thisAula = $retAula['val_ret'];

                    if ($thisAula->pegaStatus() != "relatado") {
                        $ccSemRelato++;
                    }

                } else {
                    $ccSemRelato++;
                }

            }

        }

        if ($ccSemRelato) {
            $dadosPagina['alerta_aulas']['aulas_a_relatar'] = $ccSemRelato;
            $dadosPagina['alerta_aulas']['link_aulas_a_relatar'] = "/planejamento/aula/lista?titulo=" . $identity->apelidoUsuario . "&planejamento=arelatar";
        }


        $this->view->alertaAulas = $dadosPagina['alerta_aulas'];


        //n aulas
        //  link: texto
        //  data: data
        //  dia_semana: texto
        //  hora_inicio: texto
        //  hora_termino: texto
        //  turma: texto
        //  escola: texto
        //  proxima_aula: verdadeiro/falso
        //  aula_planejada: verdadeiro/falso
        //  link_planejar: texto
        //  plano_aprovado: verdadeiro/falso
        //  plano_a_ajustar: verdadeiro/falso
        //  plano_a_verificar: verdadeiro/falso
        //  aula_relatada: verdadeiro/falso
        //  link_relatar: texto
        reset($conjuntoHorarios);
        foreach ($conjuntoHorarios as $codHorario => $dadosHorario) {
            $thisHorario = $dadosHorario['horario'];
            $thisEscola = $dadosHorario['escola'];
            $thisTurma = $dadosHorario['turma'];

            $diaSemana = $thisHorario->pegaDiaSemana();
            $inicioTurma = $thisTurma->pegaPostagem();

            if ($ccColecaoHorarios > 2) {
                $dias = 7;
            } else if ($ccColecaoHorarios > 1) {
                $dias = 14;
            } else {
                $dias = 21;
            }

            $dataCorte = date("Y-m-d H:i:s");

            // (anteriores)
            $arrMinhasAulasAnteriores = $html->recuperaDatasAnteriores($diaSemana, $inicioTurma, $dias);

            while (list($chave, $valor) = each($arrMinhasAulasAnteriores)) {
                $retMinhaAulaAnterior = $reqDefault->recuperaAulaPorDataPorHorario($thisHorario->pegaCodHorario(), $chave);

                if ((!$retMinhaAulaAnterior['cod_ret']) && (!is_null($retMinhaAulaAnterior['val_ret']))) {
                    $thisAulaAnterior = $retMinhaAulaAnterior['val_ret'];

                    $retPlanoAulaAnterior = $reqDefault->recuperaPlanoPorCodigoAula($thisAulaAnterior->pegaCodAula());

                    if ((!$retPlanoAulaAnterior['cod_ret']) && (!is_null($retPlanoAulaAnterior['val_ret']))) {
                        $thisPlanoAulaAnterior = $retPlanoAulaAnterior['val_ret'];
                    }

                    $retRelatoAulaAnterior = $reqDefault->recuperaRelatoPorCodigoAula($thisAulaAnterior->pegaCodAula());

                    if ((!$retRelatoAulaAnterior['cod_ret']) && (!is_null($retRelatoAulaAnterior['val_ret']))) {
                        $thisRelatoAulaAnterior = $retRelatoAulaAnterior['val_ret'];
                    }

                }

                if (isset($thisAulaAnterior)) {
                    $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['link'] = "/registro/aula/consulta?aula=" . $thisAulaAnterior->pegaCodAula();
                }

                $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['dia_semana'] = strtoupper(substr($html->nomesDiasSemana[$thisHorario->pegaDiaSemana()], 0, 3));
                $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['hora_inicio'] = substr($thisHorario->pegaInicio(), 0, 5);
                $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['hora_termino'] = substr($thisHorario->pegaTermino(), 0, 5);
                $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['turma'] = $thisTurma->pegaTitulo();
                $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['escola'] = $thisEscola->pegaTitulo();

                $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['proxima_aula'] = false;
                $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['aula_planejada'] = false;
                $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['link_planejar'] = "";
                $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['plano_aprovado'] = false;
                $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['plano_a_ajustar'] = false;
                $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['plano_a_verificar'] = false;
                $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['aula_relatada'] = false;
                $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['link_relatar'] = "";

                //com plano
                if (isset($thisPlanoAulaAnterior)) {
                    $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['aula_planejada'] = true;

                    switch ($thisPlanoAulaAnterior->pegaStatus()) {
                        case "verificar":
                            $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['plano_a_verificar'] = true;
                        break;

                        case "ajustar":
                            $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['plano_a_ajustar'] = true;
                        break;

                        case "adequada":
                            $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['plano_aprovado'] = true;
                        break;

                        default:
                            $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['plano_a_verificar'] = true;
                        break;

                    }

                    //com relato
                    if (isset($thisRelatoAulaAnterior)) {
                        $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['aula_relatada'] = true;

                    } else if (strtotime($chave . " " . $thisHorario->pegaInicio()) < strtotime($dataCorte)) { //sem relato e data passada
                        $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['link_relatar'] = "/registro/aula/relata?h=" . $thisHorario->pegaCodHorario() . "&d=" . $chave;

                    }

                } else { //sem plano
                    //sem relato
                    if (!isset($thisRelatoAulaAnterior)) {
                        //data passada
                        if (strtotime($chave . " " . $thisHorario->pegaInicio()) < strtotime($dataCorte)) {
                            $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['link_relatar'] = "/registro/aula/relata?h=" . $thisHorario->pegaCodHorario() . "&d=" . $chave;

                        } else { //data futura
                            $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['link_planejar'] = "/planejamento/aula/planeja?h=" . $thisHorario->pegaCodHorario() . "&d=" . $chave;

                        }

                    } else {
                        $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['aula_relatada'] = true;
                    }

                }

                unset($thisAulaAnterior);
                unset($thisPlanoAulaAnterior);
                unset($thisRelatoAulaAnterior);

            }

            // (proximas)
            $arrMinhasProximasAulas = $html->recuperaProximasDatas($diaSemana, $inicioTurma, $dias);

            while (list($chave, $valor) = each($arrMinhasProximasAulas)) {
                $retMinhaProximaAula = $reqDefault->recuperaAulaPorDataPorHorario($thisHorario->pegaCodHorario(), $chave);

                if ((!$retMinhaProximaAula['cod_ret']) && (!is_null($retMinhaProximaAula['val_ret']))) {
                    $thisProximaAula = $retMinhaProximaAula['val_ret'];

                    $retPlanoProximaAula = $reqDefault->recuperaPlanoPorCodigoAula($thisProximaAula->pegaCodAula());

                    if ((!$retPlanoProximaAula['cod_ret']) && (!is_null($retPlanoProximaAula['val_ret']))) {
                        $thisPlanoProximaAula = $retPlanoProximaAula['val_ret'];
                    }

                    $retRelatoProximaAula = $reqDefault->recuperaRelatoPorCodigoAula($thisProximaAula->pegaCodAula());

                    if ((!$retRelatoProximaAula['cod_ret']) && (!is_null($retRelatoProximaAula['val_ret']))) {
                        $thisRelatoProximaAula = $retRelatoProximaAula['val_ret'];
                    }

                }

                if (isset($thisProximaAula)) {
                    $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['link'] = "/registro/aula/consulta?aula=" . $thisProximaAula->pegaCodAula();
                }

                $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['dia_semana'] = strtoupper(substr($html->nomesDiasSemana[$thisHorario->pegaDiaSemana()], 0, 3));
                $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['hora_inicio'] = substr($thisHorario->pegaInicio(), 0, 5);
                $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['hora_termino'] = substr($thisHorario->pegaTermino(), 0, 5);
                $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['turma'] = $thisTurma->pegaTitulo();
                $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['escola'] = $thisEscola->pegaTitulo();

                $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['proxima_aula'] = false;
                $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['aula_planejada'] = false;
                $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['link_planejar'] = "";
                $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['plano_aprovado'] = false;
                $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['plano_a_ajustar'] = false;
                $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['plano_a_verificar'] = false;
                $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['aula_relatada'] = false;
                $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['link_relatar'] = "";

                //com plano
                if (isset($thisPlanoProximaAula)) {
                    $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['aula_planejada'] = true;

                    switch ($thisPlanoProximaAula->pegaStatus()) {
                        case "verificar":
                            $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['plano_a_verificar'] = true;
                        break;

                        case "ajustar":
                            $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['plano_a_ajustar'] = true;
                        break;

                        case "adequada":
                            $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['plano_aprovado'] = true;
                        break;

                        default:
                            $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['plano_a_verificar'] = true;
                        break;

                    }

                    //com relato
                    if (isset($thisRelatoProximaAula)) {
                        $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['aula_relatada'] = true;

                    } else if (strtotime($chave . " " . $thisHorario->pegaInicio()) < strtotime($dataCorte)) { //sem relato e data passada
                        $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['link_relatar'] = "/registro/aula/relata?h=" . $thisHorario->pegaCodHorario() . "&d=" . $chave;

                    }

                } else { //sem plano
                    //sem relato
                    if (!isset($thisRelatoProximaAula)) {
                        //data passada
                        if (strtotime($chave . " " . $thisHorario->pegaInicio()) < strtotime($dataCorte)) {
                            $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['link_relatar'] = "/registro/aula/relata?h=" . $thisHorario->pegaCodHorario() . "&d=" . $chave;

                        } else { //data futura
                            $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['link_planejar'] = "/planejamento/aula/planeja?h=" . $thisHorario->pegaCodHorario() . "&d=" . $chave;

                        }

                    } else {
                        $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['aula_relatada'] = true;
                    }

                }

                unset($thisProximaAula);
                unset($thisPlanoProximaAula);
                unset($thisRelatoProximaAula);

            }

        }

        //anteriores
        ksort($conjuntoAulasAnteriores); //ordena

        $conjuntoAulasAnteriores = array_slice($conjuntoAulasAnteriores, -3, 3, true);

        //conta restantes
        $ccAnteriores = 0;
        foreach ($conjuntoAulasAnteriores as $dataAulaAnterior => $dadosAulaAnterior) {
            foreach ($dadosAulaAnterior as $idStr => $dadosHorarioAnterior) {
                $ccAnteriores++;
            }
        }

        //elimina restantes
        reset($conjuntoAulasAnteriores);
        $conjuntoFinalAulasAnteriores = Array();
        $ccAtual = 0;
        if ($ccAnteriores > 3) {
            foreach ($conjuntoAulasAnteriores as $dataAulaAnterior => $dadosAulaAnterior) {
                foreach ($dadosAulaAnterior as $idStr => $dadosHorarioAnterior) {
                    if ($ccAtual >= ($ccAnteriores-3)) {
                        $conjuntoFinalAulasAnteriores[$dataAulaAnterior][$idStr] = $conjuntoAulasAnteriores[$dataAulaAnterior][$idStr];
                    }

                    $ccAtual++;
                }
            }

        } else {
            $conjuntoFinalAulasAnteriores = $conjuntoAulasAnteriores;
        }


        //proximas
        ksort($conjuntoProximasAulas); //ordena

        $conjuntoProximasAulas = array_slice($conjuntoProximasAulas, 0, 3, true);

        //conta restantes
        $ccProximas = 0;

        foreach ($conjuntoProximasAulas as $dataProximaAula => $dadosProximaAula) {
            foreach ($dadosProximaAula as $idStr => $dadosProximoHorario) {
                $ccProximas++;
            }
        }

        //elimina restantes
        reset($conjuntoProximasAulas);

        $conjuntoFinalProximasAulas = Array();
        $ccAtual = 0;
        if ($ccProximas > 3) {
            foreach ($conjuntoProximasAulas as $dataProximaAula => $dadosProximaAula) {
                foreach ($dadosProximaAula as $idStr => $dadosProximoHorario) {
                    $ccAtual++;

                    if ($ccAtual <= 3) {
                        $conjuntoFinalProximasAulas[$dataProximaAula][$idStr] = $conjuntoProximasAulas[$dataProximaAula][$idStr];
                    }
                }
            }

        } else {
            $conjuntoFinalProximasAulas = $conjuntoProximasAulas;
        }

        //destaque
        $ccDestaque = 0;
        foreach($conjuntoFinalProximasAulas as $essaChave => $dadosAula) {
            foreach($dadosAula as $esseHorario => $campoAula) {
                if ($essaChave == substr($dataCorte, 0, 10)) { //hoje
                    if (strtotime($essaChave . " " . $campoAula['hora_inicio']) >= strtotime($dataCorte)) {
                        $chaveDestaque = $essaChave;
                        $horarioDestaque = $esseHorario;
                        break;
                    }

                } else {
                    $ccDestaque++;
                }

                if ($ccDestaque == 1) {
                    $chaveDestaque = $essaChave;
                    $horarioDestaque = $esseHorario;
                    break;
                }
            }
        }

        if (isset($chaveDestaque) && (isset($horarioDestaque))) {
            $conjuntoFinalProximasAulas[$chaveDestaque][$horarioDestaque]['proxima_aula'] = true;
        }


        $conjuntoAulas = array_merge($conjuntoFinalAulasAnteriores, $conjuntoFinalProximasAulas);

        $this->view->conjuntoAulas = $conjuntoAulas;


        //n ultimos relatos
        //  link: texto
        //  data: data
        //  dia_semana: texto
        //  hora_inicio: texto
        //  hora_termino: texto
        //  turma: texto
        //  escola: texto
        //  autor: texto
        //  link_autor: texto
        $retRelatos = $reqDefault->listaRelatos("ci.idiomaRelato = 'pt'", "c.codRelato DESC LIMIT 3");

        $thisColecaoRelatos = $retRelatos['val_ret'];

        if ($thisColecaoRelatos->count() > 0) {
            $conjuntoRelatos = Array();

            foreach ($thisColecaoRelatos as $thisRelato) {
                $retAula = $reqDefault->recuperaAulaPorCodigo($thisRelato->pegaCodAula());

                if ((!$retAula['cod_ret']) && (!is_null($retAula['val_ret']))) {
                    $thisAulaRelato = $retAula['val_ret'];
                }

                if (isset($thisAulaRelato)) {
                    $retHorario = $reqDefault->recuperaHorarioPorCodigo($thisAulaRelato->pegaCodHorario());

                    if ((!$retHorario['cod_ret']) && (!is_null($retHorario['val_ret']))) {
                        $thisHorarioRelato = $retHorario['val_ret'];
                    }

                    if (isset($thisHorarioRelato)) {
                        $retMonitor = $reqDefault->recuperaUsuarioPorCodigo($thisHorarioRelato->pegaCodMonitor());

                        if ((!$retMonitor['cod_ret']) && (!is_null($retMonitor['val_ret']))) {
                            $thisMonitorRelato = $retMonitor['val_ret'];
                        }

                        $retEscola = $reqDefault->recuperaEscolaPorCodigo($thisHorarioRelato->pegaCodEscola());

                        if ((!$retEscola['cod_ret']) && (!is_null($retEscola['val_ret']))) {
                            $thisEscolaRelato = $retEscola['val_ret'];
                        }

                        $retTurma = $reqDefault->recuperaTurmaPorCodigo($thisHorarioRelato->pegaCodTurma());

                        if ((!$retTurma['cod_ret']) && (!is_null($retTurma['val_ret']))) {
                            $thisTurmaRelato = $retTurma['val_ret'];
                        }

                    }

                }

                if (isset($thisMonitorRelato) && isset($thisEscolaRelato) && isset($thisTurmaRelato)) {
                    $conjuntoRelatos[$thisRelato->pegaCodRelato()]['link'] = "/registro/aula/consulta?aula=" . $thisAulaRelato->pegaCodAula();
                    $conjuntoRelatos[$thisRelato->pegaCodRelato()]['data'] = date("d/m/Y", strtotime($thisAulaRelato->pegaData()));
                    $conjuntoRelatos[$thisRelato->pegaCodRelato()]['dia_semana'] = strtoupper(substr($html->nomesDiasSemana[$thisHorarioRelato->pegaDiaSemana()], 0, 3));
                    $conjuntoRelatos[$thisRelato->pegaCodRelato()]['hora_inicio'] = substr($thisHorarioRelato->pegaInicio(), 0, 5);
                    $conjuntoRelatos[$thisRelato->pegaCodRelato()]['hora_termino'] = substr($thisHorarioRelato->pegaTermino(), 0, 5);
                    $conjuntoRelatos[$thisRelato->pegaCodRelato()]['turma'] = $thisTurmaRelato->pegaTitulo();
                    $conjuntoRelatos[$thisRelato->pegaCodRelato()]['escola'] = $thisEscolaRelato->pegaTitulo();
                    $conjuntoRelatos[$thisRelato->pegaCodRelato()]['autor'] = $thisMonitorRelato->pegaNome() . " " . $thisMonitorRelato->pegaSobrenome();
                    $conjuntoRelatos[$thisRelato->pegaCodRelato()]['link_autor'] = "/planejamento/aula/lista?titulo=" . $thisMonitorRelato->pegaApelido() . "&planejamento=relatadas";

                }

            }

            $this->view->conjuntoRelatos = $conjuntoRelatos;

        }


        //todos_relatos: texto
        $dadosPagina['todos_relatos'] = "/planejamento/aula/lista?planejamento=relatadas";

        $this->view->todosRelatos = $dadosPagina['todos_relatos'];


        //n ultimos planos
        //  link: texto
        //  data: data
        //  dia_semana: texto
        //  hora_inicio: texto
        //  hora_termino: texto
        //  turma: texto
        //  escola: texto
        //  autor: texto
        //  link_autor: texto
        $retPlanos = $reqDefault->listaPlanos("c.statusPlano = 'adequada' AND ci.idiomaPlano = 'pt'", "c.codPlano DESC LIMIT 3");

        $thisColecaoPlanos = $retPlanos['val_ret'];

        if ($thisColecaoPlanos->count() > 0) {
            $conjuntoPlanos = Array();

            foreach ($thisColecaoPlanos as $thisPlano) {
                $retAula = $reqDefault->recuperaAulaPorCodigo($thisPlano->pegaCodAula());

                if ((!$retAula['cod_ret']) && (!is_null($retAula['val_ret']))) {
                    $thisAulaPlano = $retAula['val_ret'];
                }

                if (isset($thisAulaPlano)) {
                    $retHorario = $reqDefault->recuperaHorarioPorCodigo($thisAulaPlano->pegaCodHorario());

                    if ((!$retHorario['cod_ret']) && (!is_null($retHorario['val_ret']))) {
                        $thisHorarioPlano = $retHorario['val_ret'];
                    }

                    if (isset($thisHorarioPlano)) {
                        $retMonitor = $reqDefault->recuperaUsuarioPorCodigo($thisHorarioPlano->pegaCodMonitor());

                        if ((!$retMonitor['cod_ret']) && (!is_null($retMonitor['val_ret']))) {
                            $thisMonitorPlano = $retMonitor['val_ret'];
                        }

                        $retEscola = $reqDefault->recuperaEscolaPorCodigo($thisHorarioPlano->pegaCodEscola());

                        if ((!$retEscola['cod_ret']) && (!is_null($retEscola['val_ret']))) {
                            $thisEscolaPlano = $retEscola['val_ret'];
                        }

                        $retTurma = $reqDefault->recuperaTurmaPorCodigo($thisHorarioPlano->pegaCodTurma());

                        if ((!$retTurma['cod_ret']) && (!is_null($retTurma['val_ret']))) {
                            $thisTurmaPlano = $retTurma['val_ret'];
                        }

                    }

                }

                if (isset($thisMonitorPlano) && isset($thisEscolaPlano) && isset($thisTurmaPlano)) {
                    $conjuntoPlanos[$thisPlano->pegaCodPlano()]['link'] = "/registro/aula/consulta?aula=" . $thisAulaPlano->pegaCodAula();
                    $conjuntoPlanos[$thisPlano->pegaCodPlano()]['data'] = date("d/m/Y", strtotime($thisAulaPlano->pegaData()));
                    $conjuntoPlanos[$thisPlano->pegaCodPlano()]['dia_semana'] = strtoupper(substr($html->nomesDiasSemana[$thisHorarioPlano->pegaDiaSemana()], 0, 3));
                    $conjuntoPlanos[$thisPlano->pegaCodPlano()]['hora_inicio'] = substr($thisHorarioPlano->pegaInicio(), 0, 5);
                    $conjuntoPlanos[$thisPlano->pegaCodPlano()]['hora_termino'] = substr($thisHorarioPlano->pegaTermino(), 0, 5);
                    $conjuntoPlanos[$thisPlano->pegaCodPlano()]['turma'] = $thisTurmaPlano->pegaTitulo();
                    $conjuntoPlanos[$thisPlano->pegaCodPlano()]['escola'] = $thisEscolaPlano->pegaTitulo();
                    $conjuntoPlanos[$thisPlano->pegaCodPlano()]['autor'] = $thisMonitorPlano->pegaNome() . " " . $thisMonitorPlano->pegaSobrenome();
                    $conjuntoPlanos[$thisPlano->pegaCodPlano()]['link_autor'] = "/planejamento/aula/lista?titulo=" . $thisMonitorPlano->pegaApelido() . "&planejamento=planejadas&plano=adequada";

                }

            }

            $this->view->conjuntoPlanos = $conjuntoPlanos;

        }


        //todos_planos: texto
        $dadosPagina['todos_planos'] = "/planejamento/aula/lista?planejamento=planejadas&plano=adequada";

        $this->view->todosPlanos = $dadosPagina['todos_planos'];


        //n aulas mais comentadas
        //  link: texto
        //  data: data
        //  dia_semana: texto
        //  hora_inicio: texto
        //  hora_termino: texto
        //  turma: texto
        //  escola: texto
        //  comentarios: texto
        //  autor: texto
        //  link_autor: texto
        $retAulasMaisComentadas = $reqDefault->listaAulasMaisComentadas();

        if ((!$retAulasMaisComentadas['cod_ret']) && (!is_null($retAulasMaisComentadas['val_ret']))) {
            $arrAulas = $retAulasMaisComentadas['val_ret'];

        } else {
            $arrAulas = Array();
        }

        if (count($arrAulas) > 0) {
            $conjuntoAulasComentadas = Array();
            $ccAulas = 0;

            foreach ($arrAulas as $codAula => $ccAula) {
                if ($ccAulas >= 3) {
                    break;
                }

                $retAula = $reqDefault->recuperaAulaPorCodigo($codAula);

                if ((!$retAula['cod_ret']) && (!is_null($retAula['val_ret']))) {
                    $thisAulaComentada = $retAula['val_ret'];
                }
                
                if (isset($thisAulaComentada)) {
                    $retHorario = $reqDefault->recuperaHorarioPorCodigo($thisAulaComentada->pegaCodHorario());

                    if ((!$retHorario['cod_ret']) && (!is_null($retHorario['val_ret']))) {
                        $thisHorarioComentado = $retHorario['val_ret'];
                    }
                    
                    if (isset($thisHorarioComentado)) {
                        $retMonitor = $reqDefault->recuperaUsuarioPorCodigo($thisHorarioComentado->pegaCodMonitor());

                        if ((!$retMonitor['cod_ret']) && (!is_null($retMonitor['val_ret']))) {
                            $thisMonitorComentado = $retMonitor['val_ret'];
                        }

                        $retEscola = $reqDefault->recuperaEscolaPorCodigo($thisHorarioComentado->pegaCodEscola());

                        if ((!$retEscola['cod_ret']) && (!is_null($retEscola['val_ret']))) {
                            $thisEscolaComentada = $retEscola['val_ret'];
                        }

                        $retTurma = $reqDefault->recuperaTurmaPorCodigo($thisHorarioComentado->pegaCodTurma());

                        if ((!$retTurma['cod_ret']) && (!is_null($retTurma['val_ret']))) {
                            $thisTurmaComentada = $retTurma['val_ret'];
                        }
                        
                    }
                    
                }

                if (isset($thisMonitorComentado) && isset($thisEscolaComentada) && isset($thisTurmaComentada)) {
                    $ccAulas++;

                    $conjuntoAulasComentadas[$codAula]['link'] = "/registro/aula/consulta?aula=" . $thisAulaComentada->pegaCodAula();
                    $conjuntoAulasComentadas[$codAula]['data'] = date("d/m/Y", strtotime($thisAulaComentada->pegaData()));
                    $conjuntoAulasComentadas[$codAula]['dia_semana'] = strtoupper(substr($html->nomesDiasSemana[$thisHorarioComentado->pegaDiaSemana()], 0, 3));
                    $conjuntoAulasComentadas[$codAula]['hora_inicio'] = substr($thisHorarioComentado->pegaInicio(), 0, 5);
                    $conjuntoAulasComentadas[$codAula]['hora_termino'] = substr($thisHorarioComentado->pegaTermino(), 0, 5);
                    $conjuntoAulasComentadas[$codAula]['turma'] = $thisTurmaComentada->pegaTitulo();
                    $conjuntoAulasComentadas[$codAula]['escola'] = $thisEscolaComentada->pegaTitulo();
                    $conjuntoAulasComentadas[$codAula]['comentarios'] = $ccAula;
                    $conjuntoAulasComentadas[$codAula]['autor'] = $thisMonitorComentado->pegaNome() . " " . $thisMonitorComentado->pegaSobrenome();
                    $conjuntoAulasComentadas[$codAula]['link_autor'] = "/planejamento/aula/lista?titulo=" . $thisMonitorComentado->pegaApelido();

                }

            }

            $this->view->conjuntoAulasComentadas = $conjuntoAulasComentadas;

        }

        
        //todas_aulas: texto
        $dadosPagina['todas_aulas'] = "/planejamento/aula/lista";

        $this->view->todasAulas = $dadosPagina['todas_aulas'];


        //alerta_atividades
        // atividades_a_ajustar
        // link_atividades_a_ajustar
        $retAjustesAtividade = $reqDefault->listaAtividades("c.statusAtividade = 'ajustar' AND c.autorAtividade= " . $identity->codUsuario . " AND ci.idiomaAtividade = 'pt'");

        $thisColecaoAjustesAtividade = $retAjustesAtividade['val_ret'];

        $ccAjustesAtividade = $thisColecaoAjustesAtividade->count();

        if ($ccAjustesAtividade) {
            $dadosPagina['alerta_atividades']['atividades_a_ajustar'] = $ccAjustesAtividade;
            $dadosPagina['alerta_atividades']['link_atividades_a_ajustar'] = "/panopramanga/atividade/lista?monitor=" . $identity->apelidoUsuario . "&status=ajustar";
        }

        $this->view->alertaAtividades = $dadosPagina['alerta_atividades'];


        //minhas_atividades: texto
        $dadosPagina['minhas_atividades'] = "/panopramanga/atividade/lista?monitor=" . $identity->apelidoUsuario;

        $this->view->minhasAtividades = $dadosPagina['minhas_atividades'];


        //n ultimos comentarios de atividades
        //  link_atividade: texto
        //  titulo_atividade: texto
        //  data_atividade: data
        //  autor_comentario: texto
        $retMinhasAtividades = $reqDefault->listaAtividades("c.statusAtividade = 'adequada' AND c.autorAtividade= " . $identity->codUsuario . " AND ci.idiomaAtividade = 'pt'");

        $thisColecaoMinhasAtividades = $retMinhasAtividades['val_ret'];

        $arrMinhasAtividades = Array();

        if ($thisColecaoMinhasAtividades->count() > 0) {
            foreach ($thisColecaoMinhasAtividades as $thisMinhaAtividade) {
                $arrMinhasAtividades[] = $thisMinhaAtividade->pegaCodAtividade();
            }
        }

        if (count($arrMinhasAtividades) > 0) {
            $strMinhasAtividades = implode(", ", $arrMinhasAtividades);

            $retComentariosAtividades = $reqDefault->listaComentarios("codAtividade IN (" . $strMinhasAtividades . ") AND idiomaComentario = 'pt'", "postagemComentario DESC LIMIT 3");

            $thisColecaoComentariosAtividades = $retComentariosAtividades['val_ret'];

            if ($thisColecaoComentariosAtividades->count() > 0) {
                $conjuntoComentariosAtividades = Array();

                foreach ($thisColecaoComentariosAtividades as $thisComentarioAtividade) {
                    $retAtividade = $reqDefault->recuperaAtividadePorCodigo($thisComentarioAtividade->pegaCodAtividade());

                    if ((!$retAtividade['cod_ret']) && (!is_null($retAtividade['val_ret']))) {
                        $thisAtividade = $retAtividade['val_ret'];
                    }

                    $retAutorComentario = $reqDefault->recuperaUsuarioPorCodigo($thisComentarioAtividade->pegaAutor());

                    if ((!$retAutorComentario['cod_ret']) && (!is_null($retAutorComentario['val_ret']))) {
                        $thisAutorComentario = $retAutorComentario['val_ret'];
                    }

                    if (isset($thisAtividade) && isset($thisAutorComentario)) {
                        $conjuntoComentariosAtividades[$thisComentarioAtividade->pegaCodComentario()]['link_atividade'] = "/panopramanga/atividade/consulta?titulo=" . $thisAtividade->pegaTituloUnico();
                        $conjuntoComentariosAtividades[$thisComentarioAtividade->pegaCodComentario()]['titulo_atividade'] = $thisAtividade->pegaTitulo();

                        $dataComentario = date("d/m/Y", strtotime($thisComentarioAtividade->pegaPostagem()));
                        $horarioComentario = date("H:i", strtotime($thisComentarioAtividade->pegaPostagem()));

                        $conjuntoComentariosAtividades[$thisComentarioAtividade->pegaCodComentario()]['data_atividade'] = $dataComentario . " às " . $horarioComentario;

                        $conjuntoComentariosAtividades[$thisComentarioAtividade->pegaCodComentario()]['autor_comentario'] = $thisAutorComentario->pegaNome() . " " . $thisAutorComentario->pegaSobrenome();

                    }

                }

                $this->view->conjuntoComentariosAtividades = $conjuntoComentariosAtividades;

            }

        }


        //n atividades mais comentadas
        //  link: texto
        //  titulo: texto
        //  data: data
        //  autor: texto
        //  comentarios: texto
        $retAtividadesMaisComentadas = $reqDefault->listaAtividadesMaisComentadas();

        if ((!$retAtividadesMaisComentadas['cod_ret']) && (!is_null($retAtividadesMaisComentadas['val_ret']))) {
            $arrAtividades = $retAtividadesMaisComentadas['val_ret'];

        } else {
            $arrAtividades = Array();
        }
        
        if (count($arrAtividades) > 0) {
            $conjuntoAtividadesComentadas = Array();
            $ccAtividades = 0;

            foreach ($arrAtividades as $codAtividade => $ccAtividade) {
                if ($ccAtividades >= 3) {
                    break;
                }

                $retAtividade = $reqDefault->recuperaAtividadePorCodigo($codAtividade);

                if ((!$retAtividade['cod_ret']) && (!is_null($retAtividade['val_ret']))) {
                    $thisAtividadeComentada = $retAtividade['val_ret'];

                    $retUltimoComentario = $reqDefault->listaComentarios("codAtividade = " . $thisAtividadeComentada->pegaCodAtividade() . " AND idiomaComentario = 'pt'", "postagemComentario DESC LIMIT 1");

                    $thisColecaoUltimoComentario = $retUltimoComentario['val_ret'];

                    if ($thisColecaoUltimoComentario->count() > 0) {
                        $thisUltimoComentario = $thisColecaoUltimoComentario->current();

                        $retAutorUltimoComentario = $reqDefault->recuperaUsuarioPorCodigo($thisUltimoComentario->pegaAutor());

                        if ((!$retAutorUltimoComentario['cod_ret']) && (!is_null($retAutorUltimoComentario['val_ret']))) {
                            $thisAutorUltimoComentario = $retAutorUltimoComentario['val_ret'];

                            $ccAtividades++;

                            $conjuntoAtividadesComentadas[$thisAtividadeComentada->pegaTituloUnico()]['link'] = "/panopramanga/atividade/consulta?titulo=" . $thisAtividadeComentada->pegaTituloUnico();
                            $conjuntoAtividadesComentadas[$thisAtividadeComentada->pegaTituloUnico()]['titulo'] = $thisAtividadeComentada->pegaTitulo();

                            $dataUltimoComentario = date("d/m/Y", strtotime($thisUltimoComentario->pegaPostagem()));
                            $horarioUltimoComentario = date("H:i", strtotime($thisUltimoComentario->pegaPostagem()));

                            $conjuntoAtividadesComentadas[$thisAtividadeComentada->pegaTituloUnico()]['data'] = $dataUltimoComentario . " às " . $horarioUltimoComentario;
                            $conjuntoAtividadesComentadas[$thisAtividadeComentada->pegaTituloUnico()]['autor'] = $thisAutorUltimoComentario->pegaNome() . " " . $thisAutorUltimoComentario->pegaSobrenome();
                            $conjuntoAtividadesComentadas[$thisAtividadeComentada->pegaTituloUnico()]['comentarios'] = $ccAtividade;

                        }

                    }
                    
                }
                
            }

            $this->view->conjuntoAtividadesComentadas = $conjuntoAtividadesComentadas;
            
        }
        

        //n atividades mais utilizadas
        //  link: texto
        //  titulo: texto
        $retAtividadesMaisUtilizadas = $reqDefault->listaAtividadesMaisUtilizadas();

        if ((!$retAtividadesMaisUtilizadas['cod_ret']) && (!is_null($retAtividadesMaisUtilizadas['val_ret']))) {
            $arrAtividadesUtilizadas = $retAtividadesMaisUtilizadas['val_ret'];

        } else {
            $arrAtividadesUtilizadas = Array();
        }

        if (count($arrAtividadesUtilizadas) > 0) {
            $conjuntoAtividadesUtilizadas = Array();
            $ccAtividadesUtilizadas = 0;

            foreach ($arrAtividadesUtilizadas as $codAtividadeUtilizada => $ccAtividadeUtilizada) {
                if ($ccAtividadesUtilizadas >= 5) {
                    break;
                }

                $retAtividadeUtilizada = $reqDefault->recuperaAtividadePorCodigo($codAtividadeUtilizada);

                if ((!$retAtividadeUtilizada['cod_ret']) && (!is_null($retAtividadeUtilizada['val_ret']))) {
                    $ccAtividadesUtilizadas++;

                    $thisAtividadeUtilizada = $retAtividadeUtilizada['val_ret'];

                    $conjuntoAtividadesUtilizadas[$thisAtividadeUtilizada->pegaTituloUnico()]['link'] = "/panopramanga/atividade/consulta?titulo=" . $thisAtividadeUtilizada->pegaTituloUnico();
                    $conjuntoAtividadesUtilizadas[$thisAtividadeUtilizada->pegaTituloUnico()]['titulo'] = $thisAtividadeUtilizada->pegaTitulo();

                }

            }

            $this->view->conjuntoAtividadesUtilizadas = $conjuntoAtividadesUtilizadas;

        }


        //n atividades mais recentes
        //  link: texto
        //  titulo: texto
        $retAtividadesRecentes = $reqDefault->listaAtividades("c.statusAtividade = 'adequada'", "c.postagemAtividade DESC LIMIT 5");

        $thisColecaoAtividadesRecentes = $retAtividadesRecentes['val_ret'];

        if ($thisColecaoAtividadesRecentes->count() > 0) {
            $conjuntoAtividadesRecentes = Array();

            foreach ($thisColecaoAtividadesRecentes as $thisAtividadeRecente) {
                $conjuntoAtividadesRecentes[$thisAtividadeRecente->pegaTituloUnico()]['link'] = "/panopramanga/atividade/consulta?titulo=" . $thisAtividadeRecente->pegaTituloUnico();
                $conjuntoAtividadesRecentes[$thisAtividadeRecente->pegaTituloUnico()]['titulo'] = $thisAtividadeRecente->pegaTitulo();

            }

            $this->view->conjuntoAtividadesRecentes = $conjuntoAtividadesRecentes;

        }


        //titulo_pagina: texto
        $dadosPagina['titulo_pagina'] = "Principal";

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

        $layout->nestedLayout = 'home';
        
    }



    
        public function coordenadorNovoAction()
    {
        /* Initialize model and retrieve data here */
        $nivelPagina = "coordenador";

        $html = new Moxca_Html_Html();

        $this->view->html = $html;

        $reqDefault = new MediadorDefault();

        $dadosPagina = Array();

        $auth = Zend_Auth::getInstance();

        if ($auth->hasIdentity()) {
            $identity = $auth->getIdentity();
        } else {
            $this->_redirect("/autenticacao/login/acessa");
        }

        /* Initialize view and populate here */



        //alerta_aulas
        // aulas_a_ajustar
        // link_aulas_a_ajustar
        $retAjustes = $reqDefault->listaTodosPlanosPorStatusPorMonitor($arrHorarios, "ajustar");

        $thisColecaoAjustes = $retAjustes['val_ret'];

        $ccAjustes = $thisColecaoAjustes->count();

        if ($ccAjustes) {
            $dadosPagina['alerta_aulas']['aulas_a_ajustar'] = $ccAjustes;
            $dadosPagina['alerta_aulas']['link_aulas_a_ajustar'] = "/planejamento/aula/lista?titulo=" . $identity->apelidoUsuario . "&planejamento=planejadas&plano=ajustar";
        }
        

        //alerta_aulas
        // aulas_a_relatar
        // link_aulas_a_relatar
        reset($conjuntoHorarios);
        foreach ($conjuntoHorarios as $codHorario => $dadosHorario) {
            $thisHorario = $dadosHorario['horario'];
            $thisEscola = $dadosHorario['escola'];
            $thisTurma = $dadosHorario['turma'];

            $arrDatasRelato = $html->retornaDatas($thisHorario->pegaDiaSemana(), $thisHorario->pegaInicio(), $thisTurma->pegaPostagem(), date("Y-m-d H:i:s"));

            foreach ($arrDatasRelato as $chave => $valor) {
                $retAula = $reqDefault->recuperaAulaPorDataPorHorario($thisHorario->pegaCodHorario(), substr($valor, 0, 10));

                if ((!$retAula['cod_ret']) && (!is_null($retAula['val_ret']))) {
                    $thisAula = $retAula['val_ret'];

                    if ($thisAula->pegaStatus() != "relatado") {
                        $ccSemRelato++;
                    }

                } else {
                    $ccSemRelato++;
                }

            }

        }

        if ($ccSemRelato) {
            $dadosPagina['alerta_aulas']['aulas_a_relatar'] = $ccSemRelato;
            $dadosPagina['alerta_aulas']['link_aulas_a_relatar'] = "/planejamento/aula/lista?titulo=" . $identity->apelidoUsuario . "&planejamento=arelatar";
        }


        $this->view->alertaAulas = $dadosPagina['alerta_aulas'];


        //n aulas
        //  link: texto
        //  data: data
        //  dia_semana: texto
        //  hora_inicio: texto
        //  hora_termino: texto
        //  turma: texto
        //  escola: texto
        //  proxima_aula: verdadeiro/falso
        //  aula_planejada: verdadeiro/falso
        //  link_planejar: texto
        //  plano_aprovado: verdadeiro/falso
        //  plano_a_ajustar: verdadeiro/falso
        //  plano_a_verificar: verdadeiro/falso
        //  aula_relatada: verdadeiro/falso
        //  link_relatar: texto
        reset($conjuntoHorarios);
        foreach ($conjuntoHorarios as $codHorario => $dadosHorario) {
            $thisHorario = $dadosHorario['horario'];
            $thisEscola = $dadosHorario['escola'];
            $thisTurma = $dadosHorario['turma'];

            $diaSemana = $thisHorario->pegaDiaSemana();
            $inicioTurma = $thisTurma->pegaPostagem();

            if ($ccColecaoHorarios > 2) {
                $dias = 7;
            } else if ($ccColecaoHorarios > 1) {
                $dias = 14;
            } else {
                $dias = 21;
            }

            $dataCorte = date("Y-m-d H:i:s");

            // (anteriores)
            $arrMinhasAulasAnteriores = $html->recuperaDatasAnteriores($diaSemana, $inicioTurma, $dias);

            while (list($chave, $valor) = each($arrMinhasAulasAnteriores)) {
                $retMinhaAulaAnterior = $reqDefault->recuperaAulaPorDataPorHorario($thisHorario->pegaCodHorario(), $chave);

                if ((!$retMinhaAulaAnterior['cod_ret']) && (!is_null($retMinhaAulaAnterior['val_ret']))) {
                    $thisAulaAnterior = $retMinhaAulaAnterior['val_ret'];

                    $retPlanoAulaAnterior = $reqDefault->recuperaPlanoPorCodigoAula($thisAulaAnterior->pegaCodAula());

                    if ((!$retPlanoAulaAnterior['cod_ret']) && (!is_null($retPlanoAulaAnterior['val_ret']))) {
                        $thisPlanoAulaAnterior = $retPlanoAulaAnterior['val_ret'];
                    }

                    $retRelatoAulaAnterior = $reqDefault->recuperaRelatoPorCodigoAula($thisAulaAnterior->pegaCodAula());

                    if ((!$retRelatoAulaAnterior['cod_ret']) && (!is_null($retRelatoAulaAnterior['val_ret']))) {
                        $thisRelatoAulaAnterior = $retRelatoAulaAnterior['val_ret'];
                    }

                }

                if (isset($thisAulaAnterior)) {
                    $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['link'] = "/registro/aula/consulta?aula=" . $thisAulaAnterior->pegaCodAula();
                }

                $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['dia_semana'] = strtoupper(substr($html->nomesDiasSemana[$thisHorario->pegaDiaSemana()], 0, 3));
                $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['hora_inicio'] = substr($thisHorario->pegaInicio(), 0, 5);
                $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['hora_termino'] = substr($thisHorario->pegaTermino(), 0, 5);
                $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['turma'] = $thisTurma->pegaTitulo();
                $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['escola'] = $thisEscola->pegaTitulo();

                $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['proxima_aula'] = false;
                $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['aula_planejada'] = false;
                $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['link_planejar'] = "";
                $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['plano_aprovado'] = false;
                $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['plano_a_ajustar'] = false;
                $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['plano_a_verificar'] = false;
                $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['aula_relatada'] = false;
                $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['link_relatar'] = "";

                //com plano
                if (isset($thisPlanoAulaAnterior)) {
                    $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['aula_planejada'] = true;

                    switch ($thisPlanoAulaAnterior->pegaStatus()) {
                        case "verificar":
                            $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['plano_a_verificar'] = true;
                        break;

                        case "ajustar":
                            $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['plano_a_ajustar'] = true;
                        break;

                        case "adequada":
                            $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['plano_aprovado'] = true;
                        break;

                        default:
                            $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['plano_a_verificar'] = true;
                        break;

                    }

                    //com relato
                    if (isset($thisRelatoAulaAnterior)) {
                        $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['aula_relatada'] = true;

                    } else if (strtotime($chave . " " . $thisHorario->pegaInicio()) < strtotime($dataCorte)) { //sem relato e data passada
                        $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['link_relatar'] = "/registro/aula/relata?h=" . $thisHorario->pegaCodHorario() . "&d=" . $chave;

                    }

                } else { //sem plano
                    //sem relato
                    if (!isset($thisRelatoAulaAnterior)) {
                        //data passada
                        if (strtotime($chave . " " . $thisHorario->pegaInicio()) < strtotime($dataCorte)) {
                            $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['link_relatar'] = "/registro/aula/relata?h=" . $thisHorario->pegaCodHorario() . "&d=" . $chave;

                        } else { //data futura
                            $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['link_planejar'] = "/planejamento/aula/planeja?h=" . $thisHorario->pegaCodHorario() . "&d=" . $chave;

                        }

                    } else {
                        $conjuntoAulasAnteriores[$chave][$thisHorario->pegaCodHorario()]['aula_relatada'] = true;
                    }

                }

                unset($thisAulaAnterior);
                unset($thisPlanoAulaAnterior);
                unset($thisRelatoAulaAnterior);

            }

            // (proximas)
            $arrMinhasProximasAulas = $html->recuperaProximasDatas($diaSemana, $inicioTurma, $dias);

            while (list($chave, $valor) = each($arrMinhasProximasAulas)) {
                $retMinhaProximaAula = $reqDefault->recuperaAulaPorDataPorHorario($thisHorario->pegaCodHorario(), $chave);

                if ((!$retMinhaProximaAula['cod_ret']) && (!is_null($retMinhaProximaAula['val_ret']))) {
                    $thisProximaAula = $retMinhaProximaAula['val_ret'];

                    $retPlanoProximaAula = $reqDefault->recuperaPlanoPorCodigoAula($thisProximaAula->pegaCodAula());

                    if ((!$retPlanoProximaAula['cod_ret']) && (!is_null($retPlanoProximaAula['val_ret']))) {
                        $thisPlanoProximaAula = $retPlanoProximaAula['val_ret'];
                    }

                    $retRelatoProximaAula = $reqDefault->recuperaRelatoPorCodigoAula($thisProximaAula->pegaCodAula());

                    if ((!$retRelatoProximaAula['cod_ret']) && (!is_null($retRelatoProximaAula['val_ret']))) {
                        $thisRelatoProximaAula = $retRelatoProximaAula['val_ret'];
                    }

                }

                if (isset($thisProximaAula)) {
                    $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['link'] = "/registro/aula/consulta?aula=" . $thisProximaAula->pegaCodAula();
                }

                $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['dia_semana'] = strtoupper(substr($html->nomesDiasSemana[$thisHorario->pegaDiaSemana()], 0, 3));
                $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['hora_inicio'] = substr($thisHorario->pegaInicio(), 0, 5);
                $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['hora_termino'] = substr($thisHorario->pegaTermino(), 0, 5);
                $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['turma'] = $thisTurma->pegaTitulo();
                $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['escola'] = $thisEscola->pegaTitulo();

                $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['proxima_aula'] = false;
                $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['aula_planejada'] = false;
                $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['link_planejar'] = "";
                $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['plano_aprovado'] = false;
                $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['plano_a_ajustar'] = false;
                $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['plano_a_verificar'] = false;
                $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['aula_relatada'] = false;
                $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['link_relatar'] = "";

                //com plano
                if (isset($thisPlanoProximaAula)) {
                    $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['aula_planejada'] = true;

                    switch ($thisPlanoProximaAula->pegaStatus()) {
                        case "verificar":
                            $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['plano_a_verificar'] = true;
                        break;

                        case "ajustar":
                            $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['plano_a_ajustar'] = true;
                        break;

                        case "adequada":
                            $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['plano_aprovado'] = true;
                        break;

                        default:
                            $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['plano_a_verificar'] = true;
                        break;

                    }

                    //com relato
                    if (isset($thisRelatoProximaAula)) {
                        $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['aula_relatada'] = true;

                    } else if (strtotime($chave . " " . $thisHorario->pegaInicio()) < strtotime($dataCorte)) { //sem relato e data passada
                        $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['link_relatar'] = "/registro/aula/relata?h=" . $thisHorario->pegaCodHorario() . "&d=" . $chave;

                    }

                } else { //sem plano
                    //sem relato
                    if (!isset($thisRelatoProximaAula)) {
                        //data passada
                        if (strtotime($chave . " " . $thisHorario->pegaInicio()) < strtotime($dataCorte)) {
                            $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['link_relatar'] = "/registro/aula/relata?h=" . $thisHorario->pegaCodHorario() . "&d=" . $chave;

                        } else { //data futura
                            $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['link_planejar'] = "/planejamento/aula/planeja?h=" . $thisHorario->pegaCodHorario() . "&d=" . $chave;

                        }

                    } else {
                        $conjuntoProximasAulas[$chave][$thisHorario->pegaCodHorario()]['aula_relatada'] = true;
                    }

                }

                unset($thisProximaAula);
                unset($thisPlanoProximaAula);
                unset($thisRelatoProximaAula);

            }

        }

        //anteriores
        ksort($conjuntoAulasAnteriores); //ordena

        $conjuntoAulasAnteriores = array_slice($conjuntoAulasAnteriores, -3, 3, true);

        //conta restantes
        $ccAnteriores = 0;
        foreach ($conjuntoAulasAnteriores as $dataAulaAnterior => $dadosAulaAnterior) {
            foreach ($dadosAulaAnterior as $idStr => $dadosHorarioAnterior) {
                $ccAnteriores++;
            }
        }

        //elimina restantes
        reset($conjuntoAulasAnteriores);
        $conjuntoFinalAulasAnteriores = Array();
        $ccAtual = 0;
        if ($ccAnteriores > 3) {
            foreach ($conjuntoAulasAnteriores as $dataAulaAnterior => $dadosAulaAnterior) {
                foreach ($dadosAulaAnterior as $idStr => $dadosHorarioAnterior) {
                    if ($ccAtual >= ($ccAnteriores-3)) {
                        $conjuntoFinalAulasAnteriores[$dataAulaAnterior][$idStr] = $conjuntoAulasAnteriores[$dataAulaAnterior][$idStr];
                    }

                    $ccAtual++;
                }
            }

        } else {
            $conjuntoFinalAulasAnteriores = $conjuntoAulasAnteriores;
        }


        //proximas
        ksort($conjuntoProximasAulas); //ordena

        $conjuntoProximasAulas = array_slice($conjuntoProximasAulas, 0, 3, true);

        //conta restantes
        $ccProximas = 0;

        foreach ($conjuntoProximasAulas as $dataProximaAula => $dadosProximaAula) {
            foreach ($dadosProximaAula as $idStr => $dadosProximoHorario) {
                $ccProximas++;
            }
        }

        //elimina restantes
        reset($conjuntoProximasAulas);

        $conjuntoFinalProximasAulas = Array();
        $ccAtual = 0;
        if ($ccProximas > 3) {
            foreach ($conjuntoProximasAulas as $dataProximaAula => $dadosProximaAula) {
                foreach ($dadosProximaAula as $idStr => $dadosProximoHorario) {
                    $ccAtual++;

                    if ($ccAtual <= 3) {
                        $conjuntoFinalProximasAulas[$dataProximaAula][$idStr] = $conjuntoProximasAulas[$dataProximaAula][$idStr];
                    }
                }
            }

        } else {
            $conjuntoFinalProximasAulas = $conjuntoProximasAulas;
        }

        //destaque
        $ccDestaque = 0;
        foreach($conjuntoFinalProximasAulas as $essaChave => $dadosAula) {
            foreach($dadosAula as $esseHorario => $campoAula) {
                if ($essaChave == substr($dataCorte, 0, 10)) { //hoje
                    if (strtotime($essaChave . " " . $campoAula['hora_inicio']) >= strtotime($dataCorte)) {
                        $chaveDestaque = $essaChave;
                        $horarioDestaque = $esseHorario;
                        break;
                    }

                } else {
                    $ccDestaque++;
                }

                if ($ccDestaque == 1) {
                    $chaveDestaque = $essaChave;
                    $horarioDestaque = $esseHorario;
                    break;
                }
            }
        }

        if (isset($chaveDestaque) && (isset($horarioDestaque))) {
            $conjuntoFinalProximasAulas[$chaveDestaque][$horarioDestaque]['proxima_aula'] = true;
        }


        $conjuntoAulas = array_merge($conjuntoFinalAulasAnteriores, $conjuntoFinalProximasAulas);

        $this->view->conjuntoAulas = $conjuntoAulas;


        //n ultimos relatos
        //  link: texto
        //  data: data
        //  dia_semana: texto
        //  hora_inicio: texto
        //  hora_termino: texto
        //  turma: texto
        //  escola: texto
        //  autor: texto
        //  link_autor: texto
        $retRelatos = $reqDefault->listaRelatos("ci.idiomaRelato = 'pt'", "c.codRelato DESC LIMIT 3");

        $thisColecaoRelatos = $retRelatos['val_ret'];

        if ($thisColecaoRelatos->count() > 0) {
            $conjuntoRelatos = Array();

            foreach ($thisColecaoRelatos as $thisRelato) {
                $retAula = $reqDefault->recuperaAulaPorCodigo($thisRelato->pegaCodAula());

                if ((!$retAula['cod_ret']) && (!is_null($retAula['val_ret']))) {
                    $thisAulaRelato = $retAula['val_ret'];
                }

                if (isset($thisAulaRelato)) {
                    $retHorario = $reqDefault->recuperaHorarioPorCodigo($thisAulaRelato->pegaCodHorario());

                    if ((!$retHorario['cod_ret']) && (!is_null($retHorario['val_ret']))) {
                        $thisHorarioRelato = $retHorario['val_ret'];
                    }

                    if (isset($thisHorarioRelato)) {
                        $retMonitor = $reqDefault->recuperaUsuarioPorCodigo($thisHorarioRelato->pegaCodMonitor());

                        if ((!$retMonitor['cod_ret']) && (!is_null($retMonitor['val_ret']))) {
                            $thisMonitorRelato = $retMonitor['val_ret'];
                        }

                        $retEscola = $reqDefault->recuperaEscolaPorCodigo($thisHorarioRelato->pegaCodEscola());

                        if ((!$retEscola['cod_ret']) && (!is_null($retEscola['val_ret']))) {
                            $thisEscolaRelato = $retEscola['val_ret'];
                        }

                        $retTurma = $reqDefault->recuperaTurmaPorCodigo($thisHorarioRelato->pegaCodTurma());

                        if ((!$retTurma['cod_ret']) && (!is_null($retTurma['val_ret']))) {
                            $thisTurmaRelato = $retTurma['val_ret'];
                        }

                    }

                }

                if (isset($thisMonitorRelato) && isset($thisEscolaRelato) && isset($thisTurmaRelato)) {
                    $conjuntoRelatos[$thisRelato->pegaCodRelato()]['link'] = "/registro/aula/consulta?aula=" . $thisAulaRelato->pegaCodAula();
                    $conjuntoRelatos[$thisRelato->pegaCodRelato()]['data'] = date("d/m/Y", strtotime($thisAulaRelato->pegaData()));
                    $conjuntoRelatos[$thisRelato->pegaCodRelato()]['dia_semana'] = strtoupper(substr($html->nomesDiasSemana[$thisHorarioRelato->pegaDiaSemana()], 0, 3));
                    $conjuntoRelatos[$thisRelato->pegaCodRelato()]['hora_inicio'] = substr($thisHorarioRelato->pegaInicio(), 0, 5);
                    $conjuntoRelatos[$thisRelato->pegaCodRelato()]['hora_termino'] = substr($thisHorarioRelato->pegaTermino(), 0, 5);
                    $conjuntoRelatos[$thisRelato->pegaCodRelato()]['turma'] = $thisTurmaRelato->pegaTitulo();
                    $conjuntoRelatos[$thisRelato->pegaCodRelato()]['escola'] = $thisEscolaRelato->pegaTitulo();
                    $conjuntoRelatos[$thisRelato->pegaCodRelato()]['autor'] = $thisMonitorRelato->pegaNome() . " " . $thisMonitorRelato->pegaSobrenome();
                    $conjuntoRelatos[$thisRelato->pegaCodRelato()]['link_autor'] = "/planejamento/aula/lista?titulo=" . $thisMonitorRelato->pegaApelido() . "&planejamento=relatadas";

                }

            }

            $this->view->conjuntoRelatos = $conjuntoRelatos;

        }


        //todos_relatos: texto
        $dadosPagina['todos_relatos'] = "/planejamento/aula/lista?planejamento=relatadas";

        $this->view->todosRelatos = $dadosPagina['todos_relatos'];


        //n ultimos planos
        //  link: texto
        //  data: data
        //  dia_semana: texto
        //  hora_inicio: texto
        //  hora_termino: texto
        //  turma: texto
        //  escola: texto
        //  autor: texto
        //  link_autor: texto
        $retPlanos = $reqDefault->listaPlanos("c.statusPlano = 'adequada' AND ci.idiomaPlano = 'pt'", "c.codPlano DESC LIMIT 3");

        $thisColecaoPlanos = $retPlanos['val_ret'];

        if ($thisColecaoPlanos->count() > 0) {
            $conjuntoPlanos = Array();

            foreach ($thisColecaoPlanos as $thisPlano) {
                $retAula = $reqDefault->recuperaAulaPorCodigo($thisPlano->pegaCodAula());

                if ((!$retAula['cod_ret']) && (!is_null($retAula['val_ret']))) {
                    $thisAulaPlano = $retAula['val_ret'];
                }

                if (isset($thisAulaPlano)) {
                    $retHorario = $reqDefault->recuperaHorarioPorCodigo($thisAulaPlano->pegaCodHorario());

                    if ((!$retHorario['cod_ret']) && (!is_null($retHorario['val_ret']))) {
                        $thisHorarioPlano = $retHorario['val_ret'];
                    }

                    if (isset($thisHorarioPlano)) {
                        $retMonitor = $reqDefault->recuperaUsuarioPorCodigo($thisHorarioPlano->pegaCodMonitor());

                        if ((!$retMonitor['cod_ret']) && (!is_null($retMonitor['val_ret']))) {
                            $thisMonitorPlano = $retMonitor['val_ret'];
                        }

                        $retEscola = $reqDefault->recuperaEscolaPorCodigo($thisHorarioPlano->pegaCodEscola());

                        if ((!$retEscola['cod_ret']) && (!is_null($retEscola['val_ret']))) {
                            $thisEscolaPlano = $retEscola['val_ret'];
                        }

                        $retTurma = $reqDefault->recuperaTurmaPorCodigo($thisHorarioPlano->pegaCodTurma());

                        if ((!$retTurma['cod_ret']) && (!is_null($retTurma['val_ret']))) {
                            $thisTurmaPlano = $retTurma['val_ret'];
                        }

                    }

                }

                if (isset($thisMonitorPlano) && isset($thisEscolaPlano) && isset($thisTurmaPlano)) {
                    $conjuntoPlanos[$thisPlano->pegaCodPlano()]['link'] = "/registro/aula/consulta?aula=" . $thisAulaPlano->pegaCodAula();
                    $conjuntoPlanos[$thisPlano->pegaCodPlano()]['data'] = date("d/m/Y", strtotime($thisAulaPlano->pegaData()));
                    $conjuntoPlanos[$thisPlano->pegaCodPlano()]['dia_semana'] = strtoupper(substr($html->nomesDiasSemana[$thisHorarioPlano->pegaDiaSemana()], 0, 3));
                    $conjuntoPlanos[$thisPlano->pegaCodPlano()]['hora_inicio'] = substr($thisHorarioPlano->pegaInicio(), 0, 5);
                    $conjuntoPlanos[$thisPlano->pegaCodPlano()]['hora_termino'] = substr($thisHorarioPlano->pegaTermino(), 0, 5);
                    $conjuntoPlanos[$thisPlano->pegaCodPlano()]['turma'] = $thisTurmaPlano->pegaTitulo();
                    $conjuntoPlanos[$thisPlano->pegaCodPlano()]['escola'] = $thisEscolaPlano->pegaTitulo();
                    $conjuntoPlanos[$thisPlano->pegaCodPlano()]['autor'] = $thisMonitorPlano->pegaNome() . " " . $thisMonitorPlano->pegaSobrenome();
                    $conjuntoPlanos[$thisPlano->pegaCodPlano()]['link_autor'] = "/planejamento/aula/lista?titulo=" . $thisMonitorPlano->pegaApelido() . "&planejamento=planejadas&plano=adequada";

                }

            }

            $this->view->conjuntoPlanos = $conjuntoPlanos;

        }


        //todos_planos: texto
        $dadosPagina['todos_planos'] = "/planejamento/aula/lista?planejamento=planejadas&plano=adequada";

        $this->view->todosPlanos = $dadosPagina['todos_planos'];


        //n aulas mais comentadas
        //  link: texto
        //  data: data
        //  dia_semana: texto
        //  hora_inicio: texto
        //  hora_termino: texto
        //  turma: texto
        //  escola: texto
        //  comentarios: texto
        //  autor: texto
        //  link_autor: texto
        $retAulasMaisComentadas = $reqDefault->listaAulasMaisComentadas();

        if ((!$retAulasMaisComentadas['cod_ret']) && (!is_null($retAulasMaisComentadas['val_ret']))) {
            $arrAulas = $retAulasMaisComentadas['val_ret'];

        } else {
            $arrAulas = Array();
        }

        if (count($arrAulas) > 0) {
            $conjuntoAulasComentadas = Array();
            $ccAulas = 0;

            foreach ($arrAulas as $codAula => $ccAula) {
                if ($ccAulas >= 3) {
                    break;
                }

                $retAula = $reqDefault->recuperaAulaPorCodigo($codAula);

                if ((!$retAula['cod_ret']) && (!is_null($retAula['val_ret']))) {
                    $thisAulaComentada = $retAula['val_ret'];
                }
                
                if (isset($thisAulaComentada)) {
                    $retHorario = $reqDefault->recuperaHorarioPorCodigo($thisAulaComentada->pegaCodHorario());

                    if ((!$retHorario['cod_ret']) && (!is_null($retHorario['val_ret']))) {
                        $thisHorarioComentado = $retHorario['val_ret'];
                    }
                    
                    if (isset($thisHorarioComentado)) {
                        $retMonitor = $reqDefault->recuperaUsuarioPorCodigo($thisHorarioComentado->pegaCodMonitor());

                        if ((!$retMonitor['cod_ret']) && (!is_null($retMonitor['val_ret']))) {
                            $thisMonitorComentado = $retMonitor['val_ret'];
                        }

                        $retEscola = $reqDefault->recuperaEscolaPorCodigo($thisHorarioComentado->pegaCodEscola());

                        if ((!$retEscola['cod_ret']) && (!is_null($retEscola['val_ret']))) {
                            $thisEscolaComentada = $retEscola['val_ret'];
                        }

                        $retTurma = $reqDefault->recuperaTurmaPorCodigo($thisHorarioComentado->pegaCodTurma());

                        if ((!$retTurma['cod_ret']) && (!is_null($retTurma['val_ret']))) {
                            $thisTurmaComentada = $retTurma['val_ret'];
                        }
                        
                    }
                    
                }

                if (isset($thisMonitorComentado) && isset($thisEscolaComentada) && isset($thisTurmaComentada)) {
                    $ccAulas++;

                    $conjuntoAulasComentadas[$codAula]['link'] = "/registro/aula/consulta?aula=" . $thisAulaComentada->pegaCodAula();
                    $conjuntoAulasComentadas[$codAula]['data'] = date("d/m/Y", strtotime($thisAulaComentada->pegaData()));
                    $conjuntoAulasComentadas[$codAula]['dia_semana'] = strtoupper(substr($html->nomesDiasSemana[$thisHorarioComentado->pegaDiaSemana()], 0, 3));
                    $conjuntoAulasComentadas[$codAula]['hora_inicio'] = substr($thisHorarioComentado->pegaInicio(), 0, 5);
                    $conjuntoAulasComentadas[$codAula]['hora_termino'] = substr($thisHorarioComentado->pegaTermino(), 0, 5);
                    $conjuntoAulasComentadas[$codAula]['turma'] = $thisTurmaComentada->pegaTitulo();
                    $conjuntoAulasComentadas[$codAula]['escola'] = $thisEscolaComentada->pegaTitulo();
                    $conjuntoAulasComentadas[$codAula]['comentarios'] = $ccAula;
                    $conjuntoAulasComentadas[$codAula]['autor'] = $thisMonitorComentado->pegaNome() . " " . $thisMonitorComentado->pegaSobrenome();
                    $conjuntoAulasComentadas[$codAula]['link_autor'] = "/planejamento/aula/lista?titulo=" . $thisMonitorComentado->pegaApelido();

                }

            }

            $this->view->conjuntoAulasComentadas = $conjuntoAulasComentadas;

        }

        
        //todas_aulas: texto
        $dadosPagina['todas_aulas'] = "/planejamento/aula/lista";

        $this->view->todasAulas = $dadosPagina['todas_aulas'];


        //alerta_atividades
        // atividades_a_ajustar
        // link_atividades_a_ajustar
        $retAjustesAtividade = $reqDefault->listaAtividades("c.statusAtividade = 'ajustar' AND c.autorAtividade= " . $identity->codUsuario . " AND ci.idiomaAtividade = 'pt'");

        $thisColecaoAjustesAtividade = $retAjustesAtividade['val_ret'];

        $ccAjustesAtividade = $thisColecaoAjustesAtividade->count();

        if ($ccAjustesAtividade) {
            $dadosPagina['alerta_atividades']['atividades_a_ajustar'] = $ccAjustesAtividade;
            $dadosPagina['alerta_atividades']['link_atividades_a_ajustar'] = "/panopramanga/atividade/lista?monitor=" . $identity->apelidoUsuario . "&status=ajustar";
        }

        $this->view->alertaAtividades = $dadosPagina['alerta_atividades'];


        //minhas_atividades: texto
        $dadosPagina['minhas_atividades'] = "/panopramanga/atividade/lista?monitor=" . $identity->apelidoUsuario;

        $this->view->minhasAtividades = $dadosPagina['minhas_atividades'];


        //n ultimos comentarios de atividades
        //  link_atividade: texto
        //  titulo_atividade: texto
        //  data_atividade: data
        //  autor_comentario: texto
        $retMinhasAtividades = $reqDefault->listaAtividades("c.statusAtividade = 'adequada' AND c.autorAtividade= " . $identity->codUsuario . " AND ci.idiomaAtividade = 'pt'");

        $thisColecaoMinhasAtividades = $retMinhasAtividades['val_ret'];

        $arrMinhasAtividades = Array();

        if ($thisColecaoMinhasAtividades->count() > 0) {
            foreach ($thisColecaoMinhasAtividades as $thisMinhaAtividade) {
                $arrMinhasAtividades[] = $thisMinhaAtividade->pegaCodAtividade();
            }
        }

        if (count($arrMinhasAtividades) > 0) {
            $strMinhasAtividades = implode(", ", $arrMinhasAtividades);

            $retComentariosAtividades = $reqDefault->listaComentarios("codAtividade IN (" . $strMinhasAtividades . ") AND idiomaComentario = 'pt'", "postagemComentario DESC LIMIT 3");

            $thisColecaoComentariosAtividades = $retComentariosAtividades['val_ret'];

            if ($thisColecaoComentariosAtividades->count() > 0) {
                $conjuntoComentariosAtividades = Array();

                foreach ($thisColecaoComentariosAtividades as $thisComentarioAtividade) {
                    $retAtividade = $reqDefault->recuperaAtividadePorCodigo($thisComentarioAtividade->pegaCodAtividade());

                    if ((!$retAtividade['cod_ret']) && (!is_null($retAtividade['val_ret']))) {
                        $thisAtividade = $retAtividade['val_ret'];
                    }

                    $retAutorComentario = $reqDefault->recuperaUsuarioPorCodigo($thisComentarioAtividade->pegaAutor());

                    if ((!$retAutorComentario['cod_ret']) && (!is_null($retAutorComentario['val_ret']))) {
                        $thisAutorComentario = $retAutorComentario['val_ret'];
                    }

                    if (isset($thisAtividade) && isset($thisAutorComentario)) {
                        $conjuntoComentariosAtividades[$thisComentarioAtividade->pegaCodComentario()]['link_atividade'] = "/panopramanga/atividade/consulta?titulo=" . $thisAtividade->pegaTituloUnico();
                        $conjuntoComentariosAtividades[$thisComentarioAtividade->pegaCodComentario()]['titulo_atividade'] = $thisAtividade->pegaTitulo();

                        $dataComentario = date("d/m/Y", strtotime($thisComentarioAtividade->pegaPostagem()));
                        $horarioComentario = date("H:i", strtotime($thisComentarioAtividade->pegaPostagem()));

                        $conjuntoComentariosAtividades[$thisComentarioAtividade->pegaCodComentario()]['data_atividade'] = $dataComentario . " às " . $horarioComentario;

                        $conjuntoComentariosAtividades[$thisComentarioAtividade->pegaCodComentario()]['autor_comentario'] = $thisAutorComentario->pegaNome() . " " . $thisAutorComentario->pegaSobrenome();

                    }

                }

                $this->view->conjuntoComentariosAtividades = $conjuntoComentariosAtividades;

            }

        }


        //n atividades mais comentadas
        //  link: texto
        //  titulo: texto
        //  data: data
        //  autor: texto
        //  comentarios: texto
        $retAtividadesMaisComentadas = $reqDefault->listaAtividadesMaisComentadas();

        if ((!$retAtividadesMaisComentadas['cod_ret']) && (!is_null($retAtividadesMaisComentadas['val_ret']))) {
            $arrAtividades = $retAtividadesMaisComentadas['val_ret'];

        } else {
            $arrAtividades = Array();
        }
        
        if (count($arrAtividades) > 0) {
            $conjuntoAtividadesComentadas = Array();
            $ccAtividades = 0;

            foreach ($arrAtividades as $codAtividade => $ccAtividade) {
                if ($ccAtividades >= 3) {
                    break;
                }

                $retAtividade = $reqDefault->recuperaAtividadePorCodigo($codAtividade);

                if ((!$retAtividade['cod_ret']) && (!is_null($retAtividade['val_ret']))) {
                    $thisAtividadeComentada = $retAtividade['val_ret'];

                    $retUltimoComentario = $reqDefault->listaComentarios("codAtividade = " . $thisAtividadeComentada->pegaCodAtividade() . " AND idiomaComentario = 'pt'", "postagemComentario DESC LIMIT 1");

                    $thisColecaoUltimoComentario = $retUltimoComentario['val_ret'];

                    if ($thisColecaoUltimoComentario->count() > 0) {
                        $thisUltimoComentario = $thisColecaoUltimoComentario->current();

                        $retAutorUltimoComentario = $reqDefault->recuperaUsuarioPorCodigo($thisUltimoComentario->pegaAutor());

                        if ((!$retAutorUltimoComentario['cod_ret']) && (!is_null($retAutorUltimoComentario['val_ret']))) {
                            $thisAutorUltimoComentario = $retAutorUltimoComentario['val_ret'];

                            $ccAtividades++;

                            $conjuntoAtividadesComentadas[$thisAtividadeComentada->pegaTituloUnico()]['link'] = "/panopramanga/atividade/consulta?titulo=" . $thisAtividadeComentada->pegaTituloUnico();
                            $conjuntoAtividadesComentadas[$thisAtividadeComentada->pegaTituloUnico()]['titulo'] = $thisAtividadeComentada->pegaTitulo();

                            $dataUltimoComentario = date("d/m/Y", strtotime($thisUltimoComentario->pegaPostagem()));
                            $horarioUltimoComentario = date("H:i", strtotime($thisUltimoComentario->pegaPostagem()));

                            $conjuntoAtividadesComentadas[$thisAtividadeComentada->pegaTituloUnico()]['data'] = $dataUltimoComentario . " às " . $horarioUltimoComentario;
                            $conjuntoAtividadesComentadas[$thisAtividadeComentada->pegaTituloUnico()]['autor'] = $thisAutorUltimoComentario->pegaNome() . " " . $thisAutorUltimoComentario->pegaSobrenome();
                            $conjuntoAtividadesComentadas[$thisAtividadeComentada->pegaTituloUnico()]['comentarios'] = $ccAtividade;

                        }

                    }
                    
                }
                
            }

            $this->view->conjuntoAtividadesComentadas = $conjuntoAtividadesComentadas;
            
        }
        

        //n atividades mais utilizadas
        //  link: texto
        //  titulo: texto
        $retAtividadesMaisUtilizadas = $reqDefault->listaAtividadesMaisUtilizadas();

        if ((!$retAtividadesMaisUtilizadas['cod_ret']) && (!is_null($retAtividadesMaisUtilizadas['val_ret']))) {
            $arrAtividadesUtilizadas = $retAtividadesMaisUtilizadas['val_ret'];

        } else {
            $arrAtividadesUtilizadas = Array();
        }

        if (count($arrAtividadesUtilizadas) > 0) {
            $conjuntoAtividadesUtilizadas = Array();
            $ccAtividadesUtilizadas = 0;

            foreach ($arrAtividadesUtilizadas as $codAtividadeUtilizada => $ccAtividadeUtilizada) {
                if ($ccAtividadesUtilizadas >= 5) {
                    break;
                }

                $retAtividadeUtilizada = $reqDefault->recuperaAtividadePorCodigo($codAtividadeUtilizada);

                if ((!$retAtividadeUtilizada['cod_ret']) && (!is_null($retAtividadeUtilizada['val_ret']))) {
                    $ccAtividadesUtilizadas++;

                    $thisAtividadeUtilizada = $retAtividadeUtilizada['val_ret'];

                    $conjuntoAtividadesUtilizadas[$thisAtividadeUtilizada->pegaTituloUnico()]['link'] = "/panopramanga/atividade/consulta?titulo=" . $thisAtividadeUtilizada->pegaTituloUnico();
                    $conjuntoAtividadesUtilizadas[$thisAtividadeUtilizada->pegaTituloUnico()]['titulo'] = $thisAtividadeUtilizada->pegaTitulo();

                }

            }

            $this->view->conjuntoAtividadesUtilizadas = $conjuntoAtividadesUtilizadas;

        }


        //n atividades mais recentes
        //  link: texto
        //  titulo: texto
        $retAtividadesRecentes = $reqDefault->listaAtividades("c.statusAtividade = 'adequada'", "c.postagemAtividade DESC LIMIT 5");

        $thisColecaoAtividadesRecentes = $retAtividadesRecentes['val_ret'];

        if ($thisColecaoAtividadesRecentes->count() > 0) {
            $conjuntoAtividadesRecentes = Array();

            foreach ($thisColecaoAtividadesRecentes as $thisAtividadeRecente) {
                $conjuntoAtividadesRecentes[$thisAtividadeRecente->pegaTituloUnico()]['link'] = "/panopramanga/atividade/consulta?titulo=" . $thisAtividadeRecente->pegaTituloUnico();
                $conjuntoAtividadesRecentes[$thisAtividadeRecente->pegaTituloUnico()]['titulo'] = $thisAtividadeRecente->pegaTitulo();

            }

            $this->view->conjuntoAtividadesRecentes = $conjuntoAtividadesRecentes;

        }


        //titulo_pagina: texto
        $dadosPagina['titulo_pagina'] = "Principal";

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

        $layout->nestedLayout = 'home';
        
    }


    
    
}

