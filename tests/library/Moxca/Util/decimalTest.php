<?php

class DecimalTest extends ControllerTestCase
{


    public function setUp() {
        parent::setUp();
    }

    public function testThatAPositiveDecimalValueIsValid() {
       $validator = new Moxca_Util_ValidDecimal();
       $aDecimal = 1.76;
       $this->assertTrue($validator->isValid($aDecimal));
    }

    public function testThatAPositiveIntegerValueIsValid() {
       $validator = new Moxca_Util_ValidDecimal();
       $aDecimal = 89;
       $this->assertTrue($validator->isValid($aDecimal));
    }

    public function testThatANegativeDecimalValueIsValid() {
       $validator = new Moxca_Util_ValidDecimal();
       $aDecimal = -3.0008;
       $this->assertTrue($validator->isValid($aDecimal));
    }

    public function testThatAStringValueIsNotValid() {
       $validator = new Moxca_Util_ValidDecimal();
       $notADecimal = "one decimal point thirty-three";
       $this->assertFalse($validator->isValid($notADecimal));
    }


}