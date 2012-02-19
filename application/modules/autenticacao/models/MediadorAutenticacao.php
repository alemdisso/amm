<?php

require_once ('IMediadorAutenticacao.php');

class MediadorAutenticacao implements IMediadorAutenticacao {

    private $gerenteAutenticacao;


    function __construct() {

        $this->db = Zend_Registry::get('db');

        $this->gerenteAutenticacao = new Moxca_Autenticacao_GerenteAutenticacao();
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
        $result = $this->gerenteAutenticacao->retornaUsuarioVazio();

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
        $result = $this->gerenteAutenticacao->criaUsuario($obj);

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
            $result = $this->gerenteAutenticacao->efetuaLogin($email, $senha);

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
            $result = $this->gerenteAutenticacao->efetuaLogout();

            return $result;

    } //efetuaLogout


    /**
     * checaLogin
     *
     * @param string $nivel
     * @param string $contexto
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : identity).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function checaLogin($nivel, $contexto="sistema") {
        $auth = Zend_Auth::getInstance();

        $result['cod_ret'] = 1;
        $result['val_ret'] = null;

        if ($auth->hasIdentity()) {
            $identity = $auth->getIdentity();

            $gerenteAutorizacao = new Moxca_Autorizacao_GerenteAutorizacao();

            $retAutorizaUsuario = $gerenteAutorizacao->autorizaUsuario($identity, $nivel, $contexto);

            if (!$retAutorizaUsuario['cod_ret']) {
                $result['cod_ret'] = 0;
                $result['val_ret'] = $identity;

            } else {
                header("location: /autenticacao/login/acessa");
                exit;
            }

        } else {
            header("location: /autenticacao/login/acessa");
            exit;
        }

        return $result;

    } //checaLogin


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
        $gerenteAutorizacao = new Moxca_Autorizacao_GerenteAutorizacao();

        $result = $gerenteAutorizacao->recuperaPapelPorCodigoUsuario($id_usuario, $contexto);

        return $result;

    } //recuperaPapelPorCodigoUsuario


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
        $result = $this->gerenteAutenticacao->recuperaUsuarioPorApelido($apelido);

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
        $result = $this->gerenteAutenticacao->atualizaUsuario($obj);

        return $result;

    } //atualizaUsuario


    /**
     * retornaEnvioVazio
     *
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : Moxca_Envio_Envio).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function retornaEnvioVazio() {
        $gerenteEnvio = new Moxca_Envio_GerenteEnvio();

        $result = $gerenteEnvio->retornaEnvioVazio();

        return $result;

    } //retornaEnvioVazio


    /**
     * enviaAtivacaoConta
     *
     * @param Moxca_Envio_Envio $obj
     * @return $result['cod_ret']
     *
     * @example cod_ret = 0; sucesso.
     * @example cod_ret = 1; falha.
     */
    function enviaAtivacaoConta(Moxca_Envio_Envio $obj) {
        $gerenteEnvio = new Moxca_Envio_GerenteEnvio();

        $result = $gerenteEnvio->enviaAtivacaoConta($obj);

        return $result;

    } //enviaAtivacaoConta


    /**
     * recuperaUsuarioPorCodigo
     *
     * @param int $id_codigo
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : Moxca_Autenticacao_Usuario).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function recuperaUsuarioPorCodigo($id_usuario) {
        $result = $this->gerenteAutenticacao->recuperaUsuarioPorCodigo($id_usuario);

        return $result;

    } //recuperaUsuarioPorCodigo


    /**
     * incluiVisitante
     *
     * @param int $id_codigo
     * @return $result['cod_ret']
     *
     * @example cod_ret = 0; sucesso.
     * @example cod_ret = 1; falha.
     */
    function incluiVisitante($id_usuario) {
        $gerenteAutorizacao = new Moxca_Autorizacao_GerenteAutorizacao();

        $result = $gerenteAutorizacao->incluiVisitante($id_usuario);

        return $result;

    } //incluiVisitante
    
    
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
    function listaUsuarios($where="", $order="") {
        $result = $this->gerenteAutenticacao->listaUsuarios($where, $order);

        return $result;

    } //listaUsuarios

    /**
     * existeEmail
     *
     * @param string $email
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : Moxca_Autenticacao_Usuario).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function existeEmail($email) {
        $result = $this->gerenteAutenticacao->existeEmail($email);

        return $result;

    } //recuperaUsuarioPorApelido


    /**
     * enviaRenovacaoSenha
     *
     * @param Moxca_Envio_Envio $obj
     * @return $result['cod_ret']
     *
     * @example cod_ret = 0; sucesso.
     * @example cod_ret = 1; falha.
     */
    function enviaRenovacaoSenha(Moxca_Envio_Envio $obj) {
        $gerenteEnvio = new Moxca_Envio_GerenteEnvio();

        $result = $gerenteEnvio->enviaRenovacaoSenha($obj);

        return $result;

    } //enviaRenovacaoSenha


    
    
    
}