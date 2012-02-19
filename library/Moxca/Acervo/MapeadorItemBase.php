<?php

class Moxca_Acervo_MapeadorItemBase {
	
    function __construct() {
        $this->db = Zend_Registry::get('db');
    }

    public function find($id) {
        $query = "SELECT * FROM acervo_items"
            . " WHERE id = '" . $id . "'";
        

        try {
            $row = $this->db->fetchRow($query);

        } catch (Exception $e) {
            throw new Exception("Query find (ItemBase) nao funcionou");
        }

        if ($id = $row['id']) {
            class_exists('Moxca_Acervo_Item') || require('Item.php');
            $thisItem = new Moxca_Acervo_Item($id);

            return ($thisItem);

        } else {
            return null;

        }

    } //find

    public function fetchAllItems() {
        $query = "SELECT * FROM acervo_items"
            . " WHERE id > 0";

        try {
            $result = $this->db->fetchAll($query);

        } catch (Exception $e) {
            throw new Exception("Query fetchAllItems (ItemBase) nao funcionou");
        }

        return ($result);

    } // fetchAllItems



	
}