<?php
interface Moxca_Autorizacao_IGerenteAutorizacao {

    function autorizaUsuario($identity, $nivel, $contexto);

    function recuperaPapelPorCodigoUsuario($id_usuario, $contexto="sistema");

    function recuperaPapelPorTitulo($titulo, $idioma);

    function incluiVisitante($id_usuario);

    function apagaMonitor($id_papel, $id_usuario);

}