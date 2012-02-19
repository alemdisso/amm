<?php
interface IMediadorAutorizacao {

    function checaLogin($nivel, $contexto="sistema");

    function recuperaUsuarioPorCodigo($codigo);

    function recuperaPapelPorCodigoUsuario($codigo);

    function listaHorarios($where="", $order="");

    function apagaMonitor($id_papel, $id_usuario);
    
    function listaTodosMonitores();

}