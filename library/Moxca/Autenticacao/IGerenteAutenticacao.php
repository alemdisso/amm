<?php
interface Moxca_Autenticacao_IGerenteAutenticacao {

    function retornaUsuarioVazio();

    function criaUsuario(Moxca_Autenticacao_Usuario $obj);

    function efetuaLogin($email, $senha);

    function efetuaLogout();

    function recuperaUsuarioPorApelido($apelido);

    function atualizaUsuario(Moxca_Autenticacao_Usuario $obj);

    function recuperaUsuarioPorCodigo($codigo);

    function listaUsuariosPorPapel($id_papel);
    
    function listaUsuarios($where, $order);

    function existeEmail($email);

}