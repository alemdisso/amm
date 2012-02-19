<?php
interface IMediadorDefault {

    function recuperaPapelPorCodigoUsuario($codigo);

    function listaPlanos($where="", $order="");

    function listaTodosHorariosPorMonitor($id_monitor, $ordem="");

    function listaTodasAulasPorHorario($id_horario);

    function recuperaTurmaPorCodigo($codigo);

    function recuperaAulaPorDataPorHorario($id_horario, $data);

    function recuperaPlanoPorCodigoAula($id_aula, $idioma="pt");

    function recuperaRelatoPorCodigoAula($id_aula, $idioma="pt");

    function recuperaEscolaPorCodigo($codigo, $idioma="pt");

    function listaRelatos($where="", $order="");

    function recuperaHorarioPorCodigo($codigo);

    function recuperaUsuarioPorCodigo($codigo);

    function recuperaAulaPorCodigo($codigo);

    function listaTodosPlanosPorStatusPorMonitor(Array $arrHorarios, $status, $idioma="pt");

    function listaAulasMaisComentadas();

    function listaAtividades($where="", $order="");

    function listaComentarios($where="", $order="");

    function recuperaAtividadePorCodigo($codigo, $idioma="pt");

    function listaAtividadesMaisComentadas();

    function listaAtividadesMaisUtilizadas();

    function listaPlanosNaoVerificadosProximasAulas();

    function listaTodosMonitores();

}