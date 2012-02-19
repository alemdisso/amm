<?php

class Moxca_Acervo_ItemBase {
	
    protected $db;
    protected $id;
    protected $editora;
    protected $arquivoCapa;
    protected $titulo;
	
    function __construct($id=0, $language="pt") {
        $this->db = Zend_Registry::get('db');


        $this->id = $id;

        if ((is_numeric($id)) && ($id > 0)) {
            $row = $this->fetchItemData("id = " . $id, "");
            $this->id = $row['id'];
            $this->titulo = $row['titulo'];
            $this->editora = $row['editora'];
            $this->arquivoCapa = $row['arquivoCapa'];

        } else { // inicializa dados de um novo item
            $this->id = 0;
            $this->titulo = "";
            $this->editora = "";
            $this->arquivoCapa = "";

        }

    }

    public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid guestbook property');
        }
        $this->$method($value);
    }
 
    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid guestbook property');
        }
        return $this->$method();
    }
 
    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }
 

    public function getDb() {
        return $this->db;

    } //getDb


    public function setDb($db) {
        $this->id = $db;

    } //setDb


    public function getId() {
        return $this->id;

    } //getId


    public function setId($id) {
        $this->id = $id;
        return $this;

    } //setId


    public function getEditora() {
        return $this->editora;

    } //getEditora


    public function setEditora($editora) {
        $this->editora = $editora;
        return $this;

    } //setEditora


    public function getTitulo() {
        return $this->titulo;

    } //getTitulo


    public function setTitulo($titulo) {
        $this->titulo = $titulo;
        return $this;

    } //setTitulo


    public function getCapaArquivo() {
        return $this->capaArquivo;

    } //getCapaArquivo


    public function setCapaArquivo($titulo) {
        $this->capaArquivo = $titulo;
        return $this;

    } //setCapaArquivo


    protected function fetchItemData($where="", $order="") {
        if ($order)
            $order = "ORDER BY $order ";

        if ($where)
            $where = "WHERE $where ";

        $query = "SELECT * FROM acervo_items "
            . $where . $order;
        try {
            $result = $this->db->fetchRow($query);
             

        } catch (Exception $e) {
            throw new Exception("Query fetchItemData nao funcionou");
        }

        return $result;

    } //fetchItemData

	
}