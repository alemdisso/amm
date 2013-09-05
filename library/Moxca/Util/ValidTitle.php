<?php
class Moxca_Util_ValidTitle extends Zend_Validate_Abstract {
    function isValid($value) {
        if ($value == "") {
            return false;
        }
        $nameValidator = new Zend_Validate_Regex("/^[0-9A-Za-zÀ-ú_#\'\"\*\[\]\(\)\-\.\,\:\;\!\?\—\/\%ªº&| ]{0,120}$/");
        return $nameValidator->isValid($value);
    }
}

?>
