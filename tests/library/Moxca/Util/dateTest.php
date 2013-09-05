<?php

class DateTest extends ControllerTestCase
{
    public function setUp() {
        parent::setUp();
    }
        
    public function testThatInvalidDateIsntValid() {
       $validator = new Moxca_Util_ValidDate();
       $invalidDate = "30-30-2003";
       $this->assertFalse($validator->isValid($invalidDate));
       $invalidDate = "an7yth4ing3";
       $this->assertFalse($validator->isValid($invalidDate));
    }
    
    public function testTryingToConvertBadDateRaiseError() {
       $converter = new Moxca_Util_DateConverter();
       $invalidDate = "30-30-2003";
       $this->setExpectedException('Moxca_Util_DateException');
       $date = $converter->convertDateToMySQLFormat($invalidDate);
       $invalidDate = "an7yth4ing3";
       $this->setExpectedException('Moxca_Util_DateException');
       $date = $converter->convertDateToMySQLFormat($invalidDate);
    }
}