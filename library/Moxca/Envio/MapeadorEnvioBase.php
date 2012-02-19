<?php

class Moxca_Envio_MapeadorEnvioBase {

    function __construct() {
        $this->db = Zend_Registry::get('db');
    }


    public function insereEnvio(Moxca_Envio_Envio $novo) {
        if (!$novo->pegaCodEnvio()) {

            $data1 = array(
                'nomeRemetenteEnvio' => addslashes($this->limpaCampo($novo->pegaNomeRemetente())),
            	'emailRemetenteEnvio' => addslashes($this->limpaCampo($novo->pegaEmailRemetente())),
                'nomeDestinatarioEnvio' => addslashes($this->limpaCampo($novo->pegaNomeDestinatario())),
                'emailDestinatarioEnvio' => addslashes($this->limpaCampo($novo->pegaEmailDestinatario())),
                'mensagemEnvio' => addslashes($this->limpaCampo($novo->pegaMensagem())),
                'idiomaEnvio' => $novo->pegaIdioma(),
                'arquivoEnvio' => $novo->pegaArquivo(),
                'classeEnvio' => $novo->pegaClasse(),
                'codColaboracaoEnvio' => $novo->pegaCodColaboracao(),
                'linkColaboracaoEnvio' => $novo->pegaLinkColaboracao(),
                'postagemEnvio' => $novo->pegaPostagem(),
                'ipEnvio' => $novo->pegaIp()
            );

            $this->db->insert('envio_envios', $data1);

            // registra nova chave de identificacao
            $novo->setaCodEnvio($this->db->lastInsertId());

            //echo $novo->pegaCodEnvio();

            return (1);

        } else {

            return (0);

        }

    } //insereEnvio


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