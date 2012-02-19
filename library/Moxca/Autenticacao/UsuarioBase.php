<?php

class Moxca_Autenticacao_UsuarioBase {
	
    protected $codUsuario;
    protected $nome;
    protected $sobrenome;
    protected $apelido;
    protected $email;
    protected $senhaHash;
    protected $status;
    protected $renovaSenha;
    protected $prazoRenovaSenha;
	
    function __construct($codigo=0, $titulo="") {
        $this->db = Zend_Registry::get('db');

        // se existe codigo
        if (($codigo != 0) || ($titulo!="")) {
            if ((is_numeric($codigo)) && ($codigo)) {
                // recupera dados do item existente
                $query = "SELECT *"
                . " FROM autenticacao_usuarios"
                . " WHERE codUsuario = $codigo";

            } else {
                $query = "SELECT *"
                . " FROM autenticacao_usuarios"
                . " WHERE apelidoUsuario = '$titulo'";
                
            }

            try {
                $row = $this->db->fetchRow($query);

            } catch (Exception $e) {
                throw new Exception("Query UsuarioBase nao funcionou");
            }

            // atribui dados do database ao objeto
            $this->codUsuario = $row['codUsuario'];
            $this->nome = $row['nomeUsuario'];
            $this->sobrenome = $row['sobrenomeUsuario'];
            $this->apelido = $row['apelidoUsuario'];
            $this->senhaHash = $row['senhaUsuario'];
            $this->email = $row['emailUsuario'];
            $this->status = $row['statusUsuario'];
            $this->renovaSenha = $row['renovaSenhaUsuario'];
            $this->prazoRenovaSenha = $row['prazoRenovaSenhaUsuario'];

        } else {
            // inicializa dados de um novo item
            $this->codUsuario = 0;
            $this->nome = "";
            $this->sobrenome = "";
            $this->apelido = "";
            $this->senhaHash = "";
            $this->email = "";
            $this->status = "inativo";
            $this->renovaSenha = "";
            $this->prazoRenovaSenha = "";

        }

    }


    public function pegaCodUsuario() {
            return $this->codUsuario;

    } //pegaCodUsuario


    public function setaCodUsuario($codUsuario) {
            $this->codUsuario = $codUsuario;

    } //setaCodUsuario


    public function pegaNome() {
            return ($this->nome);

    } //pegaNome


    public function setaNome($nome) {
            $this->nome = $nome;

    } //setaNome


    public function pegaSobrenome() {
            return ($this->sobrenome);

    } //pegaSobrenome


    public function setaSobrenome($sobrenome) {
            $this->sobrenome = $sobrenome;

    } //setaSobrenome


    public function pegaApelido() {
            return ($this->apelido);

    } //pegaApelido


    public function setaApelido($apelido) {
        if ($this->apelido != $apelido) {
            $query = "SELECT codUsuario FROM autenticacao_usuarios"
                . " WHERE codUsuario != " . $this->pegaCodUsuario() . " AND apelidoUsuario = '" . $apelido . "'";

            $result = $this->db->fetchOne($query);

            if ($result) {
                return(false);

            } else {
                $this->apelido = $apelido;
                return(true);

            }

        } else {
            return(true);

        }

    } //setaApelido


    public function pegaSenha() {
            return ($this->senhaHash);

    } //pegaSenha


    public function setaSenha($senha) {
            $this->senhaHash = md5($senha);

    } //setaSenha


    public function pegaEmail() {
            return ($this->email);

    } //pegaEmail


    public function setaEmail($email) {
        if ($email) {
            $query = "SELECT *"
                . " FROM autenticacao_usuarios"
                . " WHERE emailUsuario = '" . $email . "' AND codUsuario != " . $this->codUsuario;

            $result = $this->db->fetchOne($query);

            if ($result) {
                return(false);

            } else {
                $this->email = $email;
                return(true);

            }

        } else {
            return(false);

        }

    } //setaEmail


    public function pegaStatus() {
            return ($this->status);

    } //pegaStatus


    public function setaStatus($status) {
            $this->status = $status;

    } //setaStatus
	


    public function pegaRenovaSenha() {
            return ($this->renovaSenha);

    } //PegaRenovaSenha


    public function setaRenovaSenha($hash) {
        $this->renovaSenha = $hash;

    } //setaPrazoRenovaSenha



    public function pegaPrazoRenovaSenha() {
            return ($this->prazoRenovaSenha);

    } //pegaPrazoRenovaSenha


    public function setaPrazoRenovaSenha($prazo) {
        $this->prazoRenovaSenha = $prazo;

    } //setaPrazoRenovaSenha


	
}