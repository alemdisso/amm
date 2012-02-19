<?php

class Moxca_Autenticacao_ColecaoUsuario implements Iterator {
	
    private $usuarios = array();
    private $indice = 0;
    private $total = 0;

    function __construct() {
        $this->db = Zend_Registry::get('db');
    }


    /**
     * @see Iterator::rewind()
     */
    public function rewind() {
        $this->indice = 0;
    } //rewind


    /**
     * @see Iterator::current()
     */
    public function current() {
        return $this->recupera($this->indice);
    } //current


    /**
     * @see Iterator::key()
     */
    public function key() {
        return $this->indice;
    } //key


    /**
     * @see Iterator::next()
     */
    public function next() {
        $usuario = $this->recupera($this->indice);

        if ($usuario) {
            $this->indice++;
        }

        return $usuario;

    } //next


    /**
     * @see Iterator::valid()
     */
    public function valid() {
        return (!is_null($this->current()));
    } //valid


    private function adiciona(Moxca_Autenticacao_Usuario $obj) {
        $this->usuarios[$this->total] = $obj;
        $this->total++;

    } //adiciona


    private function recupera($pos) {
        if (($pos >= $this->total) || ($pos < 0)) {
            return null;
        }

        if (isset($this->usuarios[$pos])) {
            return $this->usuarios[$pos];
        }

    } //recupera


    public function count() {
        return $this->total;
    } //count


    public function offset($pos) {
        if (($pos >= $this->total) || ($pos < 0)) {
            return null;
        }

        if (isset($this->usuarios[$pos])) {
            $this->indice = $pos;
        }

    } //offset


    public function listaUsuarios($where="", $order="") {
        class_exists('Moxca_Autenticacao_Usuario') || require('Usuario.php');

        if ($order)
            $order = "ORDER BY $order ";

        if ($where)
            $where = "WHERE $where ";

        $query = "SELECT codUsuario "
            . "FROM autenticacao_usuarios "
            . $where . $order;

        try {
            $result = $this->db->fetchAll($query);

        } catch (Exception $e) {
            throw new Exception("Query listaUsuarios nao funcionou");
        }


         foreach ($result as $row) {
            $this->adiciona(new Moxca_Autenticacao_Usuario($row['codUsuario']));
         }

    } //listaUsuarios


    public function listaUsuariosPorPapel($id_papel) {
        class_exists('Moxca_Autenticacao_Usuario') || require('Usuario.php');

        $query = "SELECT DISTINCT pu.codUsuario "
            . "FROM autorizacao_papeis_usuarios pu "
            . "INNER JOIN autenticacao_usuarios u "
            . "ON pu.codUsuario = u.codUsuario "
            . "WHERE pu.codPapel = " . $id_papel . " "
            . "ORDER BY u.nomeUsuario, u.sobrenomeUsuario";

        try {
            $result = $this->db->fetchAll($query);

        } catch (Exception $e) {
            throw new Exception("Query listaUsuariosPorPapel nao funcionou");
        }

         foreach ($result as $row) {
            $this->adiciona(new Moxca_Autenticacao_Usuario($row['codUsuario']));
         }

    } //listaUsuariosPorPapel


}