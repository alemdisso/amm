<?php

class StringTest extends ControllerTestCase
{


    public function setUp() {
        parent::setUp();
    }

    public function testThatAnEmptyStringIsAValidString() {
       $validator = new Moxca_Util_ValidString();
       $emptyString = "";
       $this->assertTrue($validator->isValid($emptyString));
    }

    public function testThatATypicalStringIsAValidString() {
       $validator = new Moxca_Util_ValidString();
       $string = "ABCDE fghij";
       $this->assertTrue($validator->isValid($string));
    }

    public function testThatEvenSomeTinyStringsAreValidStrings() {
       $validator = new Moxca_Util_ValidString();
       $string = "A";
       $this->assertTrue($validator->isValid($string));
       $string = "bc";
       $this->assertTrue($validator->isValid($string));
       $string = "0";
       $this->assertTrue($validator->isValid($string));
    }

    public function testThatCanUsePercentAtString() {
       $validator = new Moxca_Util_ValidString();
       $string = "ABCDE 50%";
       $this->assertTrue($validator->isValid($string));
    }

    public function testThatCanUseSomeOtherCharsAtString() {
       $validator = new Moxca_Util_ValidString();
       $string = "ABCDE 50% ª º & sons. ";
       $this->assertTrue($validator->isValid($string));
    }


}