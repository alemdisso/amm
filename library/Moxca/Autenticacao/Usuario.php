<?php

require_once ('UsuarioBase.php');

class Moxca_Autenticacao_Usuario extends Moxca_Autenticacao_UsuarioBase {
    
    function __construct($codigo=0, $titulo="") {
        parent::__construct($codigo, $titulo);

    }


}