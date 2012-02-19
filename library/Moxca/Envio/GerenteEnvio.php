<?php

require_once ('IGerenteEnvio.php');

class Moxca_Envio_GerenteEnvio implements Moxca_Envio_IGerenteEnvio {

    function __construct() {
        $this->db = Zend_Registry::get('db');
    }


    /**
     * retornaEnvioVazio
     *
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : Moxca_Envio_Envio).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function retornaEnvioVazio() {
        class_exists('Moxca_Envio_Envio') || require('Envio.php');
        $thisEnvio = new Moxca_Envio_Envio();

        $result['cod_ret'] = 0;
        $result['val_ret'] = $thisEnvio;

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
        class_exists('Moxca_Envio_MapeadorEnvio') || require('MapeadorEnvio.php');
        $thisMapeador = new Moxca_Envio_MapeadorEnvio();

        if ($insereOk = $thisMapeador->insereEnvio($obj)) {
            class_exists('Moxca_Html_Html') || require('Html.php');
            $html = new Moxca_Html_Html();

            $mail = new Zend_Mail();

            $mail->setFrom($obj->pegaEmailRemetente(), utf8_decode($obj->pegaNomeRemetente()));

            $mail->setSubject(utf8_decode("Conta de Usuário - Programa Repertórios"));

            $filename = "./txt/" . $obj->pegaArquivo();

            $handle = fopen($filename, "r");
            $conteudo = fread($handle, filesize($filename));
            fclose($handle);

            $this->setaEquivalencia("nome", $obj->pegaNomeDestinatario());
            $this->setaEquivalencia("link", $obj->pegaLinkColaboracao());

            $message = $this->trocaEquivalencias($conteudo);

            $mail->setBodyHtml(nl2br($html->make_clickable($message)));

            $mail->setDefaultReplyTo($obj->pegaEmailRemetente(), utf8_decode($obj->pegaNomeRemetente()));

            $mail->addTo($obj->PegaEmailDestinatario(), utf8_decode($obj->PegaNomeDestinatario()));

            if (substr($_SERVER['SERVER_NAME'], 0, 5) == "local") {
                echo "from= " . $mail->getFrom() . "<br />";
                echo "subject= " . utf8_encode($mail->getSubject()) . "<br />";
                echo "body= " . utf8_encode($message) . "<br />";
                echo "to= " . print_r($mail->getRecipients()) . "<br />";

            } else {
                $mail->send();
            }

            $result['cod_ret'] = 0;

        } else {
            $result['cod_ret'] = 1;
        }

        return $result;

    } //enviaAtivacaoConta

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
        class_exists('Moxca_Envio_MapeadorEnvio') || require('MapeadorEnvio.php');
        $thisMapeador = new Moxca_Envio_MapeadorEnvio();
        
        if ($insereOk = $thisMapeador->insereEnvio($obj)) {
            class_exists('Moxca_Html_Html') || require('Html.php');
            $html = new Moxca_Html_Html();

            $mail = new Zend_Mail();

            $mail->setFrom($obj->pegaEmailRemetente(), utf8_decode($obj->pegaNomeRemetente()));

            $mail->setSubject(utf8_decode("Novas Credenciais - Programa Repertórios"));

            $filename = "./txt/" . $obj->pegaArquivo();

            $handle = fopen($filename, "r");
            $conteudo = fread($handle, filesize($filename));
            fclose($handle);

            $this->setaEquivalencia("nome", $obj->pegaNomeDestinatario());
            $this->setaEquivalencia("link", $obj->pegaLinkColaboracao());

            $message = $this->trocaEquivalencias($conteudo);

            $mail->setBodyHtml(nl2br($html->make_clickable($message)));

            $mail->setDefaultReplyTo($obj->pegaEmailRemetente(), utf8_decode($obj->pegaNomeRemetente()));

            $mail->addTo($obj->PegaEmailDestinatario(), utf8_decode($obj->PegaNomeDestinatario()));

            if (substr($_SERVER['SERVER_NAME'], 0, 5) == "local") {
                echo "from= " . $mail->getFrom() . "<br />";
                echo "subject= " . utf8_encode($mail->getSubject()) . "<br />";
                echo "body= " . utf8_encode($message) . "<br />";
                echo "to= " . print_r($mail->getRecipients()) . "<br />";

            } else {
                $mail->send();
            }

            $result['cod_ret'] = 0;

        } else {
            $result['cod_ret'] = 1;
        }

        return $result;

    } //enviaRenovacaoSenha


    private function setaEquivalencia($termo, $valor) {
        $this->equivalencias[$termo] = $valor;
    }


    private function trocaEquivalencias($texto) {
        reset($this->equivalencias);

        $textoNovo = $texto;

        while(list ($termo, $valor) = each($this->equivalencias)) {
            $textoNovo = str_replace("[" . $termo . "]", $valor, $textoNovo);
        }

        return($textoNovo);
    }


    private function limpaCampo($texto) {
        $limpo = str_replace(";", "&#059;", $texto);
        $limpo = str_replace("~","-",$limpo);
        $limpo = str_replace("\"","&quot;",$limpo);
        $limpo = str_replace("'","&#039;",$limpo);
        $limpo = stripslashes($limpo);
        //$limpo = strip_tags($limpo, "<a><strong><i><em><b><ul><li><ol><p>");
        return ($limpo);
    }


}