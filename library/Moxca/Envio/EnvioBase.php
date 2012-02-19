<?php

class Moxca_Envio_EnvioBase {

    protected $codEnvio;
    protected $nomeRemetente;
    protected $emailRemetente;
    protected $nomeDestinatario;
    protected $emailDestinatario;
    protected $mensagem;
    protected $idioma;
    protected $arquivo;
    protected $classe;
    protected $codColaboracao;
    protected $linkColaboracao;
    protected $postagem;
    protected $ip;

    function __construct($codigo=0) {
        $this->db = Zend_Registry::get('db');

        // se existe codigo
        if (($codigo != 0) && (is_numeric($codigo))) {
            $row = $this->recuperaDadosEnvio("codEnvio = " . $codigo, "");

            $this->codEnvio = $row["codEnvio"];
            $codigo = $this->codEnvio;
            $this->nomeRemetente = $row["nomeRemetenteEnvio"];
            $this->emailRemetente = $row["emailRemetenteEnvio"];
            $this->nomeDestinatario = $row["nomeDestinatarioEnvio"];
            $this->emailDestinatario = $row["emailDestinatarioEnvio"];
            $this->mensagem = $row["mensagemEnvio"];
            $this->idioma = $row["idiomaEnvio"];
            $this->arquivo = $row["arquivoEnvio"];
            $this->classe = $row["classeEnvio"];
            $this->codColaboracao = $row["codColaboracaoEnvio"];
            $this->linkColaboracao = $row["linkColaboracaoEnvio"];
            $this->postagem = $row["postagemEnvio"];
            $this->ip = $row["ipEnvio"];

        } else { // inicializa dados de um novo item
            $this->codEnvio = 0;
            $this->nomeRemetente = "";
            $this->emailRemetente = "";
            $this->nomeDestinatario = "";
            $this->emailDestinatario = "";
            $this->mensagem = "";
            $this->idioma = "";
            $this->arquivo = "";
            $this->classe = "";
            $this->codColaboracao = "";
            $this->linkColaboracao = "";
            $this->postagem = date("Y-m-d H:i:s");
            $this->ip = $_SERVER["REMOTE_ADDR"];

        }

    }


    public function pegaCodEnvio() {
        return $this->codEnvio;

    } //pegaCodEnvio


    public function setaCodEnvio($codEnvio) {
        $this->codEnvio = $codEnvio;

    } //setaCodEnvio


    public function pegaNomeRemetente() {
        return $this->nomeRemetente;

    } //pegaNomeRemetente


    public function setaNomeRemetente($nomeRemetente) {
        $this->nomeRemetente = $nomeRemetente;

    } //setaNomeRemetente


    public function pegaEmailRemetente() {
        return $this->emailRemetente;

    } //pegaEmailRemetente


    public function setaEmailRemetente($emailRemetente) {
        $this->emailRemetente = $emailRemetente;

    } //setaEmailRemetente


    public function pegaNomeDestinatario() {
        return $this->nomeDestinatario;

    } //pegaNomeDestinatario


    public function setaNomeDestinatario($nomeDestinatario) {
        $this->nomeDestinatario = $nomeDestinatario;

    } //setaNomeDestinatario


    public function pegaEmailDestinatario() {
        return $this->emailDestinatario;

    } //pegaEmailDestinatario


    public function setaEmailDestinatario($emailDestinatario) {
        $this->emailDestinatario = $emailDestinatario;

    } //setaEmailDestinatario


    public function pegaMensagem() {
        return $this->mensagem;

    } //pegaMensagem


    public function setaMensagem($mensagem) {
        $this->mensagem = $mensagem;

    } //setaMensagem


    public function pegaIdioma() {
        return $this->idioma;

    } //pegaIdioma


    public function setaIdioma($idioma) {
        $this->idioma = $idioma;

    } //setaIdioma


    public function pegaArquivo() {
        return $this->arquivo;

    } //pegaArquivo


    public function setaArquivo($arquivo) {
        $this->arquivo = $arquivo;

    } //setaArquivo


    public function pegaClasse() {
        return $this->classe;

    } //pegaClasse


    public function setaClasse($classe) {
        $this->classe = $classe;

    } //setaClasse


    public function pegaCodColaboracao() {
        return $this->codColaboracao;

    } //pegaCodColaboracao


    public function setaCodColaboracao($codColaboracao) {
        $this->codColaboracao = $codColaboracao;

    } //setaCodColaboracao


    public function pegaLinkColaboracao() {
        return $this->linkColaboracao;

    } //pegaLinkColaboracao


    public function setaLinkColaboracao($linkColaboracao) {
        $this->linkColaboracao = $linkColaboracao;

    } //setaLinkColaboracao


    public function pegaPostagem() {
        return $this->postagem;

    } //pegaPostagem


    public function setaPostagem($postagem) {
        $this->postagem = $postagem;

    } //setaPostagem


    public function pegaIp() {
        return $this->ip;

    } //pegaIp


    public function setaIp($ip) {
        $this->ip = $ip;

    } //setaIp


    protected function recuperaDadosEnvio($where="", $order="") {
        if ($order)
            $order = "ORDER BY $order ";

        if ($where)
            $where = "WHERE $where ";

        $query = "SELECT * FROM envio_envios "
            . $where . $order;

        try {
            $result = $this->db->fetchRow($query);

        } catch (Exception $e) {
            throw new Exception("Query recuperaDadosEnvio nao funcionou");
        }

        return $result;

    } //recuperaDadosEnvio


}