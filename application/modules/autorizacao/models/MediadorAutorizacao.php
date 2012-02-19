<?php

require_once ('IMediadorAutorizacao.php');

class MediadorAutorizacao implements IMediadorAutorizacao {

    private $gerenteAutorizacao;


    function __construct() {

        $this->db = Zend_Registry::get('db');

        $this->gerenteAutorizacao = new Moxca_Autorizacao_GerenteAutorizacao();
    }


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

            $retAutorizaUsuario = $this->gerenteAutorizacao->autorizaUsuario($identity, $nivel, $contexto);

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
        
        $retPapel = $this->gerenteAutorizacao->apagaMonitor($id_papel, $id_usuario);

        if (!$retPapel['cod_ret']) {
            $gerenteAutenticacao = new Moxca_Autenticacao_GerenteAutenticacao();

            $retUsuario = $gerenteAutenticacao->recuperaUsuarioPorCodigo($id_usuario);

            if ((!$retUsuario['cod_ret']) && (!is_null($retUsuario['val_ret']))) {
                $thisUsuario = $retUsuario['val_ret'];

                $thisUsuario->setaStatus('inativo');

                $retAtualiza = $gerenteAutenticacao->atualizaUsuario($thisUsuario);

                if (!$retAtualiza['cod_ret']) {
                    $result['cod_ret'] = 0;
                }

            }

        }

        return $result;

    } //apagaMonitor
    
    
    /**
     * listaTodosMonitores
     *
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : Moxca_Autorizacao_Usuario[]).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function listaTodosMonitores() {
        $result['cod_ret'] = 1;
        $result['val_ret'] = null;

        $retPapel = $this->gerenteAutorizacao->recuperaPapelPorTitulo("monitor", "pt");

        if ((!$retPapel['cod_ret']) && (!is_null($retPapel['val_ret']))) {
            $thisPapel = $retPapel['val_ret'];

            $gerenteAutenticacao = new Moxca_Autenticacao_GerenteAutenticacao();

            $result = $gerenteAutenticacao->listaUsuariosPorPapel($thisPapel->pegaCodPapel());

        }

        return $result;

    } //listaTodosMonitores


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
        $result = $this->gerenteAutorizacao->recuperaPapelPorCodigoUsuario($codigo);

        return $result;

    } //recuperaPapelPorCodigoUsuario


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
     * listaHorarios
     *
     * @param string $where
     * @param string $order
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : Moxca_Planejamento_Horario[]).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function listaHorarios($where="", $order="") {
        $gerentePlanejamento = new Moxca_Planejamento_GerentePlanejamento();

        $result = $gerentePlanejamento->listaHorarios($where, $order);

        return $result;

    } //listaHorarios


}