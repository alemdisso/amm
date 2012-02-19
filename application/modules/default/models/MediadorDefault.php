<?php

require_once ('IMediadorDefault.php');

class MediadorDefault implements IMediadorDefault {


    function __construct() {

        $this->db = Zend_Registry::get('db');

    }

    /**
     * recuperaPapelPorCodigoUsuario
     *
     * @param int $codigo
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : Moxca_Autorizacao_Papel).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function recuperaPapelPorCodigoUsuario($codigo) {
        $gerenteAutorizacao = new Moxca_Autorizacao_GerenteAutorizacao();

        $result = $gerenteAutorizacao->recuperaPapelPorCodigoUsuario($codigo);

        return $result;

    } //recuperaPapelPorCodigoUsuario


    /**
     * listaPlanos
     *
     * @param string $where
     * @param string $order
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : Moxca_Planejamento_Plano[]).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function listaPlanos($where="", $order="") {
        $gerentePlanejamento = new Moxca_Planejamento_GerentePlanejamento();

        $result = $gerentePlanejamento->listaPlanos($where, $order);

        return $result;

    } //listaPlanos


    /**
     * listaTodosHorariosPorMonitor
     *
     * @param int $id_monitor
     * @param string $ordem
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : Moxca_Planejamento_Horario[]).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function listaTodosHorariosPorMonitor($id_monitor, $ordem="") {
        $gerentePlanejamento = new Moxca_Planejamento_GerentePlanejamento();

        $result = $gerentePlanejamento->listaTodosHorariosPorMonitor($id_monitor, $ordem);

        return $result;

    } //listaTodosHorariosPorMonitor


    /**
     * listaTodasAulasPorHorario
     *
     * @param int $id_horario
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : Moxca_Planejamento_Aula[]).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function listaTodasAulasPorHorario($id_horario) {
        $gerentePlanejamento = new Moxca_Planejamento_GerentePlanejamento();

        $result = $gerentePlanejamento->listaTodasAulasPorHorario($id_horario);

        return $result;

    } //listaTodasAulasPorHorario


    /**
     * recuperaTurmaPorCodigo
     *
     * @param int $codigo
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : Moxca_Planejamento_Turma).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function recuperaTurmaPorCodigo($codigo) {
        $gerentePlanejamento = new Moxca_Planejamento_GerentePlanejamento();

        $result = $gerentePlanejamento->recuperaTurmaPorCodigo($codigo);

        return $result;

    } //recuperaTurmaPorCodigo


    /**
     * recuperaAulaPorDataPorHorario
     *
     * @param int $id_horario
     * @param date $data
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : Moxca_Planejamento_Aula).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function recuperaAulaPorDataPorHorario($id_horario, $data) {
        $gerentePlanejamento = new Moxca_Planejamento_GerentePlanejamento();

        $result = $gerentePlanejamento->recuperaAulaPorDataPorHorario($id_horario, $data);

        return $result;

    } //recuperaAulaPorDataPorHorario


    /**
     * recuperaPlanoPorCodigoAula
     *
     * @param int $id_aula
     * @param string $idioma
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : Moxca_Planejamento_Plano).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function recuperaPlanoPorCodigoAula($id_aula, $idioma="pt") {
        $gerentePlanejamento = new Moxca_Planejamento_GerentePlanejamento();

        $result = $gerentePlanejamento->recuperaPlanoPorCodigoAula($id_aula, $idioma);

        return $result;

    } //recuperaPlanoPorCodigoAula


    /**
     * recuperaRelatoPorCodigoAula
     *
     * @param int $id_aula
     * @param string $idioma
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : Moxca_Registro_Relato).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function recuperaRelatoPorCodigoAula($id_aula, $idioma="pt") {
        $gerenteRegistro = new Moxca_Registro_GerenteRegistro();

        $result = $gerenteRegistro->recuperaRelatoPorCodigoAula($id_aula, $idioma);

        return $result;

    } //recuperaRelatoPorCodigoAula


    /**
     * recuperaEscolaPorCodigo
     *
     * @param string $codigo
	 * @param string $idioma
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : Moxca_Planejamento_Escola).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function recuperaEscolaPorCodigo($codigo, $idioma="pt") {
        $gerentePlanejamento = new Moxca_Planejamento_GerentePlanejamento();

        $result = $gerentePlanejamento->recuperaEscolaPorCodigo($codigo, $idioma);

        return $result;

    } //recuperaEscolaPorCodigo


    /**
     * listaRelatos
     *
     * @param string $where
     * @param string $order
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : Moxca_Registro_Relato[]).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function listaRelatos($where="", $order="") {
        $gerenteRegistro = new Moxca_Registro_GerenteRegistro();

        $result = $gerenteRegistro->listaRelatos($where, $order);

        return $result;

    } //listaRelatos


    /**
     * recuperaHorarioPorCodigo
     *
     * @param int $codigo
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : Moxca_Planejamento_Horario).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function recuperaHorarioPorCodigo($codigo) {
        $gerentePlanejamento = new Moxca_Planejamento_GerentePlanejamento();

        $result = $gerentePlanejamento->recuperaHorarioPorCodigo($codigo);

        return $result;

    } //recuperaHorarioPorCodigo


    /**
     * recuperaUsuarioPorCodigo
     *
     * @param int $codigo
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : Moxca_Autenticacao_Usuario).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function recuperaUsuarioPorCodigo($codigo) {
        $gerenteAutenticacao = new Moxca_Autenticacao_GerenteAutenticacao();

        $result = $gerenteAutenticacao->recuperaUsuarioPorCodigo($codigo);

        return $result;

    } //recuperaUsuarioPorCodigo


    /**
     * recuperaAulaPorCodigo
     *
     * @param int $codigo
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : Moxca_Planejamento_Aula).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function recuperaAulaPorCodigo($codigo) {
        $gerentePlanejamento = new Moxca_Planejamento_GerentePlanejamento();

        $result = $gerentePlanejamento->recuperaAulaPorCodigo($codigo);

        return $result;

    } //recuperaAulaPorCodigo


    /**
     * listaTodosPlanosPorStatusPorMonitor
     *
     *
     * @param Array $arrHorarios
     * @param string $status
     * @param string $idioma
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : Moxca_Planejamento_Plano[]).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function listaTodosPlanosPorStatusPorMonitor(Array $arrHorarios, $status, $idioma="pt") {
        $gerentePlanejamento = new Moxca_Planejamento_GerentePlanejamento();

        $result = $gerentePlanejamento->listaTodosPlanosPorStatusPorMonitor($arrHorarios, $status, $idioma);

        return $result;

    } //listaTodosPlanosPorStatusPorMonitor


    /**
     * listaAulasMaisComentadas
     *
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : arrAulas[]).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function listaAulasMaisComentadas() {
        $result['cod_ret'] = 1;
        $result['val_ret'] = null;

        $gerentePlanejamento = new Moxca_Planejamento_GerentePlanejamento();

        $retPlanos = $gerentePlanejamento->listaAulasMaisPlanosComentados();

        if ((!$retPlanos['cod_ret']) && (!is_null($retPlanos['val_ret']))) {
            $arrPlanos = $retPlanos['val_ret'];
        }

        $gerenteRegistro = new Moxca_Registro_GerenteRegistro();

        $retRelatos = $gerenteRegistro->listaAulasMaisRelatosComentados();

        if ((!$retRelatos['cod_ret']) && (!is_null($retRelatos['val_ret']))) {
            $arrRelatos = $retRelatos['val_ret'];
        }

        $arrAulas = Array();

        foreach($arrPlanos as $codAula => $ccComentarios) {
            $arrAulas[$codAula] = $ccComentarios;
        }

        foreach($arrRelatos as $codAula => $ccComentarios) {
            if (key_exists($codAula, $arrAulas)) {
                $arrAulas[$codAula] += $ccComentarios;
            } else {
                $arrAulas[$codAula] = $ccComentarios;
            }
        }

        arsort($arrAulas); //ordena

        //$arrAulas = array_slice($arrAulas, 0, 3, true); //3 mais comentadas

        $result['cod_ret'] = 0;
        $result['val_ret'] = $arrAulas;

        return $result;

    } //listaAulasMaisComentadas


    /**
     * listaAtividades
     *
     * @param string $where
     * @param string $order
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : Moxca_Panopramanga_Atividade[]).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function listaAtividades($where="", $order="") {
        $gerentePanopramanga = new Moxca_Panopramanga_GerentePanopramanga();

        $result = $gerentePanopramanga->listaAtividades($where, $order);

        return $result;

    } //listaAtividades


    /**
     * listaComentarios
     *
     * @param string $where
     * @param string $order
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : Moxca_Panopramanga_Comentario[]).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function listaComentarios($where="", $order="") {
        $gerentePanopramanga = new Moxca_Panopramanga_GerentePanopramanga();

        $result = $gerentePanopramanga->listaComentarios($where, $order);

        return $result;

    } //listaComentarios


    /**
     * recuperaAtividadePorCodigo
     *
     * @param int $codigo
     * @param string $idioma
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : Moxca_Panopramanga_Atividade).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function recuperaAtividadePorCodigo($codigo, $idioma="pt") {
        $gerentePanopramanga = new Moxca_Panopramanga_GerentePanopramanga();

        $result = $gerentePanopramanga->recuperaAtividadePorCodigo($codigo, $idioma);

        return $result;

    } //recuperaAtividadePorCodigo


    /**
     * listaAtividadesMaisComentadas
     *
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : $arrAtividade[]).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function listaAtividadesMaisComentadas() {
        $result['cod_ret'] = 1;
        $result['val_ret'] = null;

        $gerentePanopramanga = new Moxca_Panopramanga_GerentePanopramanga();

        $retAtividades = $gerentePanopramanga->listaAtividadesMaisComentadas();

        $arrAtividades = Array();

        if ((!$retAtividades['cod_ret']) && (!is_null($retAtividades['val_ret']))) {
            $arrAtividades = $retAtividades['val_ret'];
        }
        
        $result['cod_ret'] = 0;
        $result['val_ret'] = $arrAtividades;

        return $result;

    } //listaAtividadesMaisComentadas


    /**
     * listaAtividadesMaisUtilizadas
     *
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : $arrAtividade[]).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function listaAtividadesMaisUtilizadas() {
        $result['cod_ret'] = 1;
        $result['val_ret'] = null;

        $gerenteRegistro = new Moxca_Registro_GerenteRegistro();

        $retAtividades = $gerenteRegistro->listaAtividadesMaisUtilizadas();

        $arrAtividades = Array();

        if ((!$retAtividades['cod_ret']) && (!is_null($retAtividades['val_ret']))) {
            $arrAtividades = $retAtividades['val_ret'];
        }

        $result['cod_ret'] = 0;
        $result['val_ret'] = $arrAtividades;

        return $result;

    } //listaAtividadesMaisUtilizadas


    /**
     * listaPlanosNaoVerificadosProximasAulas
     *
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : Moxca_Planejamento_Plano[]).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function listaPlanosNaoVerificadosProximasAulas() {
        $gerentePlanejamento = new Moxca_Planejamento_GerentePlanejamento();

        $result = $gerentePlanejamento->listaPlanosNaoVerificadosProximasAulas();

        return $result;

    } //listaPlanosNaoVerificadosProximasAulas


    /**
     * listaTodosMonitores
     *
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : Moxca_Autenticacao_Usuario[]).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function listaTodosMonitores() {
        $result['cod_ret'] = 1;
        $result['val_ret'] = null;

        $gerenteAutorizacao = new Moxca_Autorizacao_GerenteAutorizacao();

        $retPapel = $gerenteAutorizacao->recuperaPapelPorTitulo("monitor", "pt");

        if ((!$retPapel['cod_ret']) && (!is_null($retPapel['val_ret']))) {
            $thisPapel = $retPapel['val_ret'];

            $gerenteAutenticacao = new Moxca_Autenticacao_GerenteAutenticacao();

            $result = $gerenteAutenticacao->listaUsuariosPorPapel($thisPapel->pegaCodPapel());

        }

        return $result;

    } //listaTodosMonitores

    
}