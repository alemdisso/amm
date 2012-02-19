<?php

class Moxca_Autorizacao_MapeadorPapelBase {
	
    function __construct() {
        $this->db = Zend_Registry::get('db');
    }


    public function recuperaPapelPorCodigoUsuario($id_usuario, $contexto) {
        $query = "SELECT codPapel FROM autorizacao_papeis_usuarios"
            . " WHERE codUsuario = '" . $id_usuario . "' AND contextoPapel = '" . $contexto . "'";

        //echo $query;

        try {
            $row = $this->db->fetchRow($query);

        } catch (Exception $e) {
            throw new Exception("Query recuperaPapelPorCodigoUsuario nao funcionou");
        }

        if ($codigo = $row['codPapel']) {
            class_exists('Moxca_Autorizacao_Papel') || require('Papel.php');
            $thisPapel = new Moxca_Autorizacao_Papel($codigo);

            return ($thisPapel);

        } else {
            return null;

        }

    } //recuperaPapelPorCodigoUsuario


    public function recuperaPapelPorTitulo($titulo, $idioma) {
        $query = "SELECT codPapel FROM autorizacao_papeis_idiomas"
            . " WHERE tituloUnicoPapel = '" . $titulo . "' AND idiomaPapel = '" . $idioma . "'";

        try {
            $row = $this->db->fetchRow($query);

        } catch (Exception $e) {
            throw new Exception("Query recuperaPapelPorTitulo nao funcionou");
        }

        if ($codigo = $row['codPapel']) {
            class_exists('Moxca_Autorizacao_Papel') || require('Papel.php');
            $thisPapel = new Moxca_Autorizacao_Papel($codigo);

            return ($thisPapel);

        } else {
            return null;

        }

    } //recuperaPapelPorTitulo


    public function inserePapelUsuario($id_papel, $id_usuario, $contexto) {
        if ((is_numeric($id_papel)) && (is_numeric($id_usuario))) {
            $data = array(
                'codPapel' => $id_papel,
                'codUsuario' => $id_usuario,
                'contextoPapel' => addslashes($this->limpaCampo($contexto))
            );

            $this->db->insert('autorizacao_papeis_usuarios', $data);

            return (1);

        } else {
            return (0);

        }

    } //inserePapelUsuario


    public function excluiPapelUsuario($id_papel, $id_usuario, $contexto) {
        try {
            $result = $this->db->delete("autorizacao_papeis_usuarios", "codPapel = " . $id_papel . " AND codUsuario = " . $id_usuario . " AND contextoPapel = '" . $contexto . "'");

        } catch (Exception $e) {
            throw new Exception("Query excluiPapelUsuario nao funcionou");

        }

        return (true);


    } //excluiPapelUsuario


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