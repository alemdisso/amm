<?php

class Moxca_Acervo_ColecaoItem implements Iterator {
	
    private $items = array();
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
        $item = $this->recupera($this->indice);

        if ($item) {
            $this->indice++;
        }

        return $item;

    } //next


    /**
     * @see Iterator::valid()
     */
    public function valid() {
        return (!is_null($this->current()));
    } //valid


    private function adiciona(Moxca_Acervo_Item $obj) {
        $this->items[$this->total] = $obj;
        $this->total++;

    } //adiciona


    private function recupera($pos) {
        if (($pos >= $this->total) || ($pos < 0)) {
            return null;
        }

        if (isset($this->items[$pos])) {
            return $this->items[$pos];
        }

    } //recupera


    public function count() {
        return $this->total;
    } //count


    public function offset($pos) {
        if (($pos >= $this->total) || ($pos < 0)) {
            return null;
        }

        if (isset($this->items[$pos])) {
            $this->indice = $pos;
        }

    } //offset


    public function listaItems($where="", $order="") {
        class_exists('Moxca_Acervo_Item') || require('Item.php');

        if ($order)
            $order = "ORDER BY $order ";

        if ($where)
            $where = "WHERE $where ";

        $query = "SELECT codItem "
            . "FROM autenticacao_items "
            . $where . $order;

        try {
            $result = $this->db->fetchAll($query);

        } catch (Exception $e) {
            throw new Exception("Query listaItems nao funcionou");
        }


         foreach ($result as $row) {
            $this->adiciona(new Moxca_Acervo_Item($row['codItem']));
         }

    } //listaItems


    public function listaItemsPorPapel($id_papel) {
        class_exists('Moxca_Acervo_Item') || require('Item.php');

        $query = "SELECT DISTINCT pu.codItem "
            . "FROM autorizacao_papeis_items pu "
            . "INNER JOIN autenticacao_items u "
            . "ON pu.codItem = u.codItem "
            . "WHERE pu.codPapel = " . $id_papel . " "
            . "ORDER BY u.nomeItem, u.sobrenomeItem";

        try {
            $result = $this->db->fetchAll($query);

        } catch (Exception $e) {
            throw new Exception("Query listaItemsPorPapel nao funcionou");
        }

         foreach ($result as $row) {
            $this->adiciona(new Moxca_Acervo_Item($row['codItem']));
         }

    } //listaItemsPorPapel


}