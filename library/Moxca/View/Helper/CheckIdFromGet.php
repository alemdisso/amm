<?php

class Author_View_Helper_CheckIdFromGet extends Zend_View_Helper_Abstract
{
    public function checkIdFromGet($data)
    {
        $filters = array(
            'id' => new Zend_Filter_Alnum(),
        );
        $validators = array(
            'id' => array('Digits', new Zend_Validate_GreaterThan(0)),
        );
        $input = new Zend_Filter_Input($filters, $validators, $data);
        if ($input->isValid()) {
            $id = $input->id;
            return $id;
        }
        throw new Moxca_Auth_UserException(_("#Invalid User Id from Get"));
    }
}

