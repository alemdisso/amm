<?php
class Moxca_Util_DateDisplay {

    public static function FormatDateToShow($rawMySqlDate)
    {
        if (!is_null($rawMySqlDate)) {
            $dateArray = explode("-", $rawMySqlDate);
            $formatedDate = $dateArray[2] . '/' . $dateArray[1] . '/' . $dateArray[0];
            return $formatedDate;
        } else {
            return null;
        }
    }
}

