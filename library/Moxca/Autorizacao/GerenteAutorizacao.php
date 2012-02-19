<?php

require_once ('IGerenteAutorizacao.php');

class Moxca_Autorizacao_GerenteAutorizacao implements Moxca_Autorizacao_IGerenteAutorizacao {
	
    function __construct() {
        $this->db = Zend_Registry::get('db');
    }


    /**
     * autorizaUsuario
     *
     * @param Object $identity
     * @param string $nivel
     * @param string $contexto
     * @return $result['cod_ret']
     *
     * @example cod_ret = 0; sucesso.
     * @example cod_ret = 1; falha.
     */
    function autorizaUsuario($identity, $nivel, $contexto) {
        $result['cod_ret'] = 1;

        if ($identity->statusUsuario == "ativo") {
            $valorNiveis = Array();

            $valorNiveis["desconhecido"] = 0;
            $valorNiveis["visitante"] = 5;
            $valorNiveis["aluno"] = 10;
            $valorNiveis["mediador"] = 15;
            $valorNiveis["monitor"] = 20;
            $valorNiveis["secretario"] = 25;
            $valorNiveis["coordenador"] = 30;
            $valorNiveis["administrador"] = 35;

            if (key_exists($nivel, $valorNiveis)) {
                $retPapelUsuario = $this->recuperaPapelPorCodigoUsuario($identity->codUsuario, $contexto);

                if ((!$retPapelUsuario['cod_ret']) && (!is_null($retPapelUsuario['val_ret']))) {
                    $thisPapel = $retPapelUsuario['val_ret'];

                    if (key_exists($thisPapel->pegaTituloUnico(), $valorNiveis)) {

                        if ($valorNiveis[$thisPapel->pegaTituloUnico()] >= $valorNiveis[$nivel]) {
                            $result['cod_ret'] = 0;
                        }

                    }

                }

            }

        }

        return $result;

    } //autorizaUsuario


    /**
     * recuperaPapelPorCodigoUsuario
     *
     * @param int $id_usuario
     * @param string $contexto
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : Papel).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function recuperaPapelPorCodigoUsuario($id_usuario, $contexto="sistema") {
        class_exists('Moxca_Autorizacao_MapeadorPapel') || require('MapeadorPapel.php');
        $thisMapeador = new Moxca_Autorizacao_MapeadorPapel();

        $thisPapel = $thisMapeador->recuperaPapelPorCodigoUsuario($id_usuario, $contexto);

        if (is_object($thisPapel)) {
            $result['cod_ret'] = 0;
            $result['val_ret'] = $thisPapel;

        } else {
            $result['cod_ret'] = 1;
            $result['val_ret'] = null;

        }

        return $result;

    } //recuperaPapelPorCodigoUsuario


    /**
     * recuperaPapelPorTitulo
     *
     * @param string $titulo
     * @param string $idioma
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : Moxca_Autorizacao_Papel).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function recuperaPapelPorTitulo($titulo, $idioma) {
        $result['cod_ret'] = 1;
        $result['val_ret'] = null;

        class_exists('Moxca_Autorizacao_MapeadorPapel') || require('MapeadorPapel.php');
        $thisMapeador = new Moxca_Autorizacao_MapeadorPapel();

        $thisPapel = $thisMapeador->recuperaPapelPorTitulo($titulo, $idioma);

        if (is_object($thisPapel)) {
            $result['cod_ret'] = 0;
            $result['val_ret'] = $thisPapel;
        }

        return $result;

    } //recuperaPapelPorTitulo


    /**
     * incluiVisitante
     *
     * @param int $id_usuario
     * @return $result['cod_ret']
     *
     * @example cod_ret = 0; sucesso.
     * @example cod_ret = 1; falha.
     */
    function incluiVisitante($id_usuario) {
        $result['cod_ret'] = 1;

        $retPapel = $this->recuperaPapelPorTitulo("visitante", "pt");

        if ((!$retPapel['cod_ret']) && (!is_null($retPapel['val_ret']))) {
            $thisPapel = $retPapel['val_ret'];

            class_exists('Moxca_Autorizacao_MapeadorPapel') || require('MapeadorPapel.php');
            $thisMapeador = new Moxca_Autorizacao_MapeadorPapel();

            if ($insereOk = $thisMapeador->inserePapelUsuario($thisPapel->pegaCodPapel(), $id_usuario, "sistema")) {
                $result['cod_ret'] = 0;
            }

        }

        return $result;

    } //incluiVisitante


    /**
     * apagaMonitor
     *
     * @param int $id_papel
     * @param int $id_usuario
     * @return $result['cod_ret']
     *
     * @example cod_ret = 0; sucesso.
     * @example cod_ret = 1; falha.
     */
    function apagaMonitor($id_papel, $id_usuario) {
        $result['cod_ret'] = 1;

        class_exists('Moxca_Autorizacao_MapeadorPapel') || require('MapeadorPapel.php');
        $thisMapeador = new Moxca_Autorizacao_MapeadorPapel();

        if ($apagaOk = $thisMapeador->excluiPapelUsuario($id_papel, $id_usuario, "sistema")) {
            $retVisitante = $this->incluiVisitante($id_usuario);

            if (!$retVisitante['cod_ret']) {
                $result['cod_ret'] = 0;
            }

        }

        return $result;

    } //apagaMonitor


    private function limpaCampo($texto) {
        $limpo = str_replace(";", "&#059;", $texto);
        $limpo = str_replace("~","-",$limpo);
        $limpo = str_replace("\"","&quot;",$limpo);
        $limpo = str_replace("'","&#039;",$limpo);
        $limpo = stripslashes($limpo);
        //$limpo = strip_tags($limpo, "<a><strong><i><em><b><ul><li><ol><p>");
        return ($limpo);
    }
	
	
}