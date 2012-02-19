<?php

class Moxca_Autenticacao_MapeadorUsuarioBase {
	
    function __construct() {
        $this->db = Zend_Registry::get('db');
    }


    public function insereUsuario(Moxca_Autenticacao_Usuario $novo) {
        if (!$novo->pegaCodUsuario()) {
            $data = array(
                'nomeUsuario' => addslashes($this->limpaCampo($novo->pegaNome())),
                'sobrenomeUsuario' => addslashes($this->limpaCampo($novo->pegaSobrenome())),
                'apelidoUsuario' => addslashes($this->limpaCampo($novo->pegaApelido())),
                'senhaUsuario' => addslashes($this->limpaCampo($novo->pegaSenha())),
                'emailUsuario' => addslashes($this->limpaCampo($novo->pegaEmail())),
                'statusUsuario' => $novo->pegaStatus()
            );

            $this->db->insert('autenticacao_usuarios', $data);

            // registra nova chave de identificacao
            $novo->setaCodUsuario($this->db->lastInsertId());

            //echo $novo->pegaCodUsuario();

            return (1);

        } else {
            return (0);
        }

    } //insereUsuario


    public function atualizaUsuario(Moxca_Autenticacao_Usuario $atual) {
        if ($atual->pegaCodUsuario()) {
            class_exists('Moxca_Autenticacao_Usuario') || require('Usuario.php');
            $anterior = new Moxca_Autenticacao_Usuario($atual->pegaCodUsuario());

            $data = Array();

            //nome
            if ($atual->pegaNome() != $anterior->pegaNome()) {
                $data['nomeUsuario'] = addslashes($this->limpaCampo($atual->pegaNome()));
            }

            //sobrenome
            if ($atual->pegaSobrenome() != $anterior->pegaSobrenome()) {
                $data['sobrenomeUsuario'] = addslashes($this->limpaCampo($atual->pegaSobrenome()));
            }

            //senha
            if ($atual->pegaSenha() != $anterior->pegaSenha()) {
                $data['senhaUsuario'] = addslashes($this->limpaCampo($atual->pegaSenha()));
            }

            //status
            if ($atual->pegaStatus() != $anterior->pegaStatus()) {
                $data['statusUsuario'] = addslashes($this->limpaCampo($atual->pegaStatus()));
            }

            //renovaSenha
            if ($atual->pegaRenovaSenha() != $anterior->pegaRenovaSenha()) {
                $data['renovaSenhaUsuario'] = addslashes($this->limpaCampo($atual->pegaRenovaSenha()));
            }

            //prazoRenovaSenha
            if ($atual->pegaPrazoRenovaSenha() != $anterior->pegaPrazoRenovaSenha()) {
                $data['prazoRenovaSenhaUsuario'] = addslashes($this->limpaCampo($atual->pegaPrazoRenovaSenha()));
            }

            if (count($data)) {
                $result = $this->db->update('autenticacao_usuarios', $data, 'codUsuario = ' . $atual->pegaCodUsuario());

                if ($result) {
                    return (1);
                } else {
                    return (0);
                }

            }

            return (1);

        } else {
            return (0);
        }

    } //atualizaUsuario


    public function recuperaUsuarioPorCodigo($codigo) {
        class_exists('Moxca_Autenticacao_Usuario') || require('Usuario.php');
        $thisUsuario = new Moxca_Autenticacao_Usuario($codigo, "");

        if ($thisUsuario->pegaCodUsuario()) {
            return ($thisUsuario);

        } else {
            return null;
        }

    } //recuperaUsuarioPorCodigo


    public function recuperaUsuarioPorApelido($apelido) {
        class_exists('Moxca_Autenticacao_Usuario') || require('Usuario.php');
        $thisUsuario = new Moxca_Autenticacao_Usuario("", $apelido);

        if ($thisUsuario->pegaCodUsuario()) {
            return ($thisUsuario);

        } else {
            return null;
        }

    } //recuperaUsuarioPorApelido


    public function recuperaUsuarioPorEmail($email) {
    
        class_exists('Moxca_Autenticacao_Usuario') || require('Usuario.php');
        $thisUsuario = new Moxca_Autenticacao_Usuario("", $apelido);

        if ($thisUsuario->pegaCodUsuario()) {
            return ($thisUsuario);

        } else {
            return null;
        }


    } //recuperaUsuarioPorEmail


    protected function limpaCampo($texto) {
        //$limpo = str_replace(";", "&#059;", $texto);
        $limpo = str_replace("~","-",$texto);
        if (!preg_match("/a href/i",$limpo)) {
            $limpo = str_replace("\"","&quot;",$limpo);
            $limpo = str_replace("'","&#039;",$limpo);
        }
        $limpo = stripslashes($limpo);
        //$limpo = strip_tags($limpo, "<a><strong><i><em><b><ul><li><ol><p>");
        return ($limpo);
    }
	
	
}