<?php

class Moxca_Util_DecimalConverter
{
    public function identifyDecimalComma($value)
    {
            $decimalComma = false;

            $findDot = false;
            $findComma = false;
            $dotPosition = null;
            $commaPosition = null;
            //find .
            if ($x = strpos($value, ".")) {
                $findDot = true;
                $dotPosition = $x;
            }

            //find ,
            if ($x = strpos($value, ",")) {
                $findComma = true;
                $commaPosition = $x;
            }

            if (($findDot) && ($findComma)) {
                if ($commaPosition > $dotPosition) {
                    $decimalComma = true;
                } else {
                    $decimalComma = false;
                }
            } else {
                if ($findComma) {
                    $decimalComma = true;
                }
            }

            if($decimalComma) {
               return true;
            } else {
               return false;
            }
    }

    public function convertDecimalCommaToDecimalDot($value)
    {
        if ($this->identifyDecimalComma($value)) {
            $temp = explode(",", $value);
            $integral = $temp[0];
            $integral = str_replace(".", "", $integral);
            $fractional = $temp[1];
            return $integral . "." . $fractional;
        } else {
            return $value;
        }
    }

    public function getDecimalDotValue($value, Moxca_Util_ValidDecimal $validator)
    {
        if ($validator->isValid($value)) {
            if ($this->identifyDecimalComma($value)) {
                return $this->convertDecimalCommaToDecimalDot($value);
            } else {
                return $value;
            }
        } else {
            throw new Moxca_Util_DecimalException("Invalid value");
        }
    }



}

?>
