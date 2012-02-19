<?php

require_once ('IGerenteAutenticacao.php');

class Moxca_Autenticacao_GerenteAutenticacao implements Moxca_Autenticacao_IGerenteAutenticacao {
	
    function __construct() {
        $this->db = Zend_Registry::get('db');
    }


    /**
     * retornaUsuarioVazio
     *
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : Usuario).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function retornaUsuarioVazio() {
        class_exists('Moxca_Autenticacao_Usuario') || require('Usuario.php');
        $thisUsuario = new Moxca_Autenticacao_Usuario();

        $result['cod_ret'] = 0;
        $result['val_ret'] = $thisUsuario;

        return $result;

    } //retornaUsuarioVazio


    /**
     * criaUsuario
     *
     * @param Moxca_Autenticacao_Usuario $obj
     * @return $result['cod_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : id_usuario).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function criaUsuario(Moxca_Autenticacao_Usuario $obj) {
        class_exists('Moxca_Autenticacao_MapeadorUsuario') || require('MapeadorUsuario.php');
        $thisMapeador = new Moxca_Autenticacao_MapeadorUsuario();

        if ($insereOk = $thisMapeador->insereUsuario($obj)) {
            $result['cod_ret'] = 0;
            $result['val_ret'] = $obj->pegaCodUsuario();

        } else {
            $result['cod_ret'] = 1;
            $result['val_ret'] = null;

        }

        return $result;

    } //criaUsuario


    /**
     * efetuaLogin
     *
     * @param string $email
     * @param string $senha
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : id_usuario).
     * @example cod_ret = 1; falha, combinação login e senha não funcionou (val_ret : vazio).
     * @example cod_ret = 2; falha, usuário inativo ou abandono (val_ret : vazio).
     * @example cod_ret = 3; falha, usuário banido (val_ret : vazio).
     * @example cod_ret = 4; falha, login inexistente (val_ret : vazio).
     */
    function efetuaLogin($email, $senha) {
        $senhamd5 = md5($this->limpaCampo($senha));

        //get a reference to the singleton instance of Zend_Auth
        $auth = Zend_Auth::getInstance();

        //configure the instance with constructor parameters
        $authAdapter = new Zend_Auth_Adapter_DbTable($this->db, 'autenticacao_usuarios', 'apelidoUsuario', 'senhaUsuario');

        //set the input credential values
        $authAdapter->setIdentity($email);
        $authAdapter->setCredential($senhamd5);

        //perform the authentication query
        $authResult = $authAdapter->authenticate();

        if ($authResult->isValid()) {
            //print the identity
            //echo $authResult->getIdentity() . "\n\n";
            //print_r($authAdapter->getResultRowObject());

            $thisUsuario = $authAdapter->getResultRowObject();

            if (($thisUsuario->statusUsuario == "inativo") || ($thisUsuario->statusUsuario == "abandono")) {
                $result['cod_ret'] = 2;
                $result['val_ret'] = null;

            } else if ($thisUsuario->statusUsuario == "banido") {
                $result['cod_ret'] = 3;
                $result['val_ret'] = null;

            } else {
                $result['cod_ret'] = 0;
                $result['val_ret'] = $thisUsuario->codUsuario;

                //store the identity as an object where only the username and real_name have been returned
                $storage = $auth->getStorage();
                //$storage->write($thisUsuario->apelidoUsuario);
                $storage->write($authAdapter->getResultRowObject(null,'password'));

            }

        } else {
            switch ($authResult->getCode()) {
                case Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND: //do stuff for nonexistent identity
                    $result['cod_ret'] = 4;
                    $result['val_ret'] = null;

                break;

                case Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID: //do stuff for invalid credential
                    $result['cod_ret'] = 1;
                    $result['val_ret'] = null;

                break;

                default: //do stuff for other failure
                    $result['cod_ret'] = 1;
                    $result['val_ret'] = null;

                break;

            }

        }

        return $result;

    } //efetuaLogin


    /**
     * efetuaLogout
     *
     * @return $result['cod_ret']
     *
     * @example cod_ret = 0; sucesso.
     * @example cod_ret = 1; falha.
     */
    function efetuaLogout() {
        Zend_Auth::getInstance()->clearIdentity();
        Zend_Session::destroy();

        $result['cod_ret'] = 0;

        return $result;

    } //efetuaLogout


    /**
     * recuperaUsuarioPorApelido
     *
     * @param string $apelido
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : Moxca_Autenticacao_Usuario).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function recuperaUsuarioPorApelido($apelido) {
        class_exists('Moxca_Autenticacao_MapeadorUsuario') || require('MapeadorUsuario.php');
        $thisMapeador = new Moxca_Autenticacao_MapeadorUsuario();

        $thisUsuario = $thisMapeador->recuperaUsuarioPorApelido($apelido);

        if (is_object($thisUsuario)) {
            $result['cod_ret'] = 0;
            $result['val_ret'] = $thisUsuario;
        
        } else {
            $result['cod_ret'] = 1;
            $result['val_ret'] = null;

        }

        return $result;

    } //recuperaUsuarioPorApelido


    /**
     * atualizaUsuario
     *
     * @param Moxca_Autenticacao_Usuario $obj
     * @return $result['cod_ret']
     *
     * @example cod_ret = 0; sucesso.
     * @example cod_ret = 1; falha.
     */
    function atualizaUsuario(Moxca_Autenticacao_Usuario $obj) {
        class_exists('Moxca_Autenticacao_MapeadorUsuario') || require('MapeadorUsuario.php');
        $thisMapeador = new Moxca_Autenticacao_MapeadorUsuario();

        $atualizaOk = $thisMapeador->atualizaUsuario($obj);

        if ($atualizaOk) {
            $result['cod_ret'] = 0;
        } else {
            $result['cod_ret'] = 1;
        }

        return $result;

    } //atualizaUsuario


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
        $result['cod_ret'] = 1;
        $result['val_ret'] = null;

        if (($codigo) && (is_numeric($codigo))) {
            class_exists('Moxca_Autenticacao_MapeadorUsuario') || require('MapeadorUsuario.php');
            $thisMapeador = new Moxca_Autenticacao_MapeadorUsuario();

            $thisUsuario = $thisMapeador->recuperaUsuarioPorCodigo($codigo);

            if (is_object($thisUsuario)) {
                $result['cod_ret'] = 0;
                $result['val_ret'] = $thisUsuario;
            }

        }

        return $result;

    } //recuperaUsuarioPorCodigo


    /**
     * listaUsuariosPorPapel
     *
     * @param int $id_papel
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : Moxca_Autenticacao_Usuario[]).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function listaUsuariosPorPapel($id_papel) {
        class_exists('Moxca_Autenticacao_ColecaoUsuario') || require('ColecaoUsuario.php');
        $thisColecao = new Moxca_Autenticacao_ColecaoUsuario();

        $thisColecao->listaUsuariosPorPapel($id_papel);

        $result['cod_ret'] = 0;
        $result['val_ret'] = $thisColecao;

        return $result;

    } //listaUsuariosPorPapel
    
    
    /**
     * listaUsuarios
     *
     * @param string $where
     * @param string $order
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : Moxca_Planejamento_Usuario[]).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function listaUsuarios($where, $order) {
        class_exists('Moxca_Autenticacao_ColecaoUsuario') || require('ColecaoUsuario.php');
        $thisColecao = new Moxca_Autenticacao_ColecaoUsuario();

        $thisColecao->listaUsuarios($where, $order);

        $result['cod_ret'] = 0;
        $result['val_ret'] = $thisColecao;

        return $result;

    } //listaUsuarios


    private function limpaCampo($texto) {
        $limpo = str_replace(";", "&#059;", $texto);
        $limpo = str_replace("~","-",$limpo);
        $limpo = str_replace("\"","&quot;",$limpo);
        $limpo = str_replace("'","&#039;",$limpo);
        $limpo = stripslashes($limpo);
        //$limpo = strip_tags($limpo, "<a><strong><i><em><b><ul><li><ol><p>");
        return ($limpo);
    }
	
    /**
     * existeEmail
     *
     * @param string $email
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : Moxca_Autenticacao_ColecaoUsuario).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function existeEmail($email) {
        class_exists('Moxca_Autenticacao_ColecaoUsuario') || require('ColecaoUsuario.php');
        $thisColecao = new Moxca_Autenticacao_ColecaoUsuario();

        $thisColecao->listaUsuarios("emailUsuario = '$email'");

        if ($thisColecao->count() > 0) {
            $result['cod_ret'] = 0;
            $result['val_ret'] = $thisColecao;

        } else {
            $result['cod_ret'] = 1;
            $result['val_ret'] = false;

        }

        return $result;

        
     
    } //existeEmail


	
}