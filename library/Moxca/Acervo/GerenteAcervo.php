<?php

require_once ('IGerenteAcervo.php');

class Moxca_Acervo_GerenteAcervo implements Moxca_Acervo_IGerenteAcervo {
	
    function __construct() {
        $this->db = Zend_Registry::get('db');
    }

    /**
     * find
     *
     * @param int $id
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : Item).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function find($id) {
        class_exists('Moxca_Acervo_MapeadorItem') || require('MapeadorItem.php');
        $thisMapeador = new Moxca_Acervo_MapeadorItem();

        $thisItem = $thisMapeador->find($id);
        

        if (is_object($thisItem)) {
            $result['cod_ret'] = 0;
            $result['val_ret'] = $thisItem;

        } else {
            $result['cod_ret'] = 1;
            $result['val_ret'] = null;

        }

        return $result;

    } //find

    /**
     * fetchAllItems
     *
     * @param int $id
     * @return $result['cod_ret'], $result['val_ret']
     *
     * @example cod_ret = 0; sucesso (val_ret : Item).
     * @example cod_ret = 1; falha (val_ret : vazio).
     */
    function fetchAllItems() {
        class_exists('Moxca_Acervo_ColecaoItem') || require('ColecaoItem.php');
        $thisColecao = new Moxca_Acervo_ColecaoItem();

        $thisColecao->listaItems();

        $result['cod_ret'] = 0;
        $result['val_ret'] = $thisColecao;

        return $result;

    } //fetchAllItems


	
}