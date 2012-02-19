<?php

class Moxca_Envio_ColecaoEnvio implements Iterator {

    private $envios = array();
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
        $envio = $this->recupera($this->indice);

        if ($envio) {
            $this->indice++;
        }

        return $envio;

    } //next


    /**
     * @see Iterator::valid()
     */
    public function valid() {
        return (!is_null($this->current()));
    } //valid


    private function adiciona(Moxca_Envio_Envio $obj) {
        $this->envios[$this->total] = $obj;
        $this->total++;

    } //adiciona


    private function recupera($pos) {
        if (($pos >= $this->total) || ($pos < 0)) {
            return null;
        }

        if (isset($this->envios[$pos])) {
            return $this->envios[$pos];
        }

    } //recupera


    public function count() {
        return $this->total;
    } //count


    public function offset($pos) {
        if (($pos >= $this->total) || ($pos < 0)) {
            return null;
        }

        if (isset($this->envios[$pos])) {
            $this->indice = $pos;
        }

    } //offset


    public function listaEnvios($where="", $order="") {
        class_exists('Moxca_Envio_Envio') || require('Envio.php');

        if ($order)
            $order = "ORDER BY $order ";

        if ($where)
            $where = "WHERE $where ";

        $query = "SELECT codEnvio "
            . "FROM envio_envios "
            . $where . $order;

        try {
            $result = $this->db->fetchAll($query);

        } catch (Exception $e) {
            throw new Exception("Query listaEnvios nao funcionou");
        }

         foreach ($result as $row) {
            $this->adiciona(new Moxca_Envio_Envio($row['codEnvio']));
         }

    } //listaEnvios


}