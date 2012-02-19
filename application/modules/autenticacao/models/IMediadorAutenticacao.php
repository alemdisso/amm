<?php
interface IMediadorAutenticacao {

    function retornaUsuarioVazio();

    function criaUsuario(Moxca_Autenticacao_Usuario $obj);

    function efetuaLogin($email, $senha);

    function efetuaLogout();

    function checaLogin($nivel, $contexto="sistema");

    function recuperaPapelPorCodigoUsuario($id_usuario, $contexto="sistema");

    function recuperaUsuarioPorApelido($apelido);

    function atualizaUsuario(Moxca_Autenticacao_Usuario $obj);

    function retornaEnvioVazio();

    function enviaAtivacaoConta(Moxca_Envio_Envio $obj);

    function recuperaUsuarioPorCodigo($id_usuario);

    function incluiVisitante($id_usuario);
    
    function listaUsuarios($where="", $order="");

    function existeEmail($email);
    
    function enviaRenovacaoSenha(Moxca_Envio_Envio $obj);

}