<?php

class PositiveIntegerTest extends ControllerTestCase
{
    private $validator;
    
    public function setUp() {
        parent::setUp();
        $this->validator = new Moxca_Util_ValidPositiveInteger();
    }
        
    public function testThatAPositiveIntegerValueIsValid() {
       $aNumber = 89;
       $this->assertTrue($this->validator->isValid($aNumber));
    }
    
    public function testThatANegativeIntegerValueIsNotValid() {
       $aNumber = -7;
       $this->assertFalse($this->validator->isValid($aNumber));
    }
    
    public function testThatAStringValueIsNotValid() {
       $notANumber = "one two três quatorze";
       $this->assertFalse($this->validator->isValid($notANumber));
    }
}