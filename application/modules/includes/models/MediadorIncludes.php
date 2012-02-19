<?php

require_once ('IMediadorIncludes.php');

class MediadorIncludes implements IMediadorIncludes {


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

    
}