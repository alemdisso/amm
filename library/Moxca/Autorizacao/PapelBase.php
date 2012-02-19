<?php

class Moxca_Autorizacao_PapelBase {
	
    protected $codPapel;
    protected $rank;
    protected $codPapelIdioma;
    protected $idioma;
    protected $titulo;
    protected $tituloUnico;
	
    function __construct($codigo=0, $language="pt") {
        $this->db = Zend_Registry::get('db');

        if (!$language) {
            $language="pt";
        }

        $this->codPapel = $codigo;

        if ((is_numeric($codigo)) && ($codigo)) {
            $row = $this->recuperaDadosPapel("codPapel = " . $codigo, "");

            $this->codPapel = $row['codPapel'];
            $codigo = $this->codPapel;
            $this->rank = $row['rankPapel'];

            $rowIdioma = $this->recuperaDadosPapelIdioma("codPapel = " . $codigo . " AND idiomaPapel = '" . $language . "'", "");

            $this->codPapelIdioma = $rowIdioma['codPapelIdioma'];
            $this->idioma = $rowIdioma['idiomaPapel'];
            $this->titulo = $rowIdioma['tituloPapel'];
            $this->tituloUnico = $rowIdioma['tituloUnicoPapel'];

        } else { // inicializa dados de um novo item
            $this->codPapel = 0;
            $this->rank = 0;
            $this->codPapelIdioma = 0;
            $this->idioma = "";
            $this->titulo = "";
            $this->tituloUnico = "";

        }

    }


    public function pegaCodPapel() {
        return $this->codPapel;

    } //pegaCodPapel


    public function setaCodPapel($codPapel) {
        $this->codPapel = $codPapel;

    } //setaCodPapel


    public function pegaRank() {
        return $this->rank;

    } //pegaRank


    public function setaRank($rank) {
        $this->rank = $rank;

    } //setaRank


    public function pegaCodPapelIdioma() {
        return $this->codPapelIdioma;

    } //pegaCodPapelIdioma


    public function setaCodPapelIdioma($codPapelIdioma) {
        $this->codPapelIdioma = $codPapelIdioma;

    } //setaCodPapelIdioma


    public function pegaIdioma() {
        return $this->idioma;

    } //pegaIdioma


    public function setaIdioma($idioma) {
        $this->idioma = $idioma;

    } //setaIdioma


    public function pegaTitulo() {
        return $this->titulo;

    } //pegaTitulo


    public function setaTitulo($titulo) {
        $this->titulo = $titulo;

    } //setaTitulo


    public function pegaTituloUnico() {
        return $this->tituloUnico;

    } //pegaTituloUnico


    public function setaTituloUnico($titulo) {
        $this->tituloUnico = $titulo;

    } //setaTituloUnico


    protected function recuperaDadosPapel($where="", $order="") {
        if ($order)
            $order = "ORDER BY $order ";

        if ($where)
            $where = "WHERE $where ";

        $query = "SELECT * FROM autorizacao_papeis "
            . $where . $order;

        try {
            $result = $this->db->fetchRow($query);

        } catch (Exception $e) {
            throw new Exception("Query recuperaDadosPapel nao funcionou");
        }

        return $result;

    } //recuperaDadosPapel


    protected function recuperaDadosPapelIdioma($where="", $order="") {
        if ($order)
            $order = "ORDER BY $order ";

        if ($where)
            $where = "WHERE $where ";

        $query = "SELECT * FROM autorizacao_papeis_idiomas "
            . $where . $order;

        //echo $query;
        
        try {
            $result = $this->db->fetchRow($query);

        } catch (Exception $e) {
            throw new Exception("Query recuperaDadosPapelIdioma nao funcionou");
        }

        return $result;

    } //recuperaDadosPapelIdioma
	
	
}