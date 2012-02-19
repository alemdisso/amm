<?php

require_once ('IMediadorAcervo.php');

class MediadorAcervo implements IMediadorAcervo {

    private $gerenteAcervo;


    function __construct() {
        $this->db = Zend_Registry::get('db');

        $this->gerenteAcervo = new Moxca_Acervo_GerenteAcervo();
    }


    /**
     * fetchAllItems
     *
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : Moxca_Acervo_Usuario[]).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function fetchAllItems() {

        $result = $this->gerenteAcervo->fetchAllItems();

        return $result;

    } //fetchAllItems


    /**
     * find
     *
     * @param int $id
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : Moxca_Acervo_Obra).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function find($id) {
        $result = $this->gerenteAcervo->find($id);


        return $result;

    } //find

   
    
}