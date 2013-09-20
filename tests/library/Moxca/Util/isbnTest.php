<?php

class IsbnTest extends ControllerTestCase
{


    public function setUp() {
        parent::setUp();
    }

    public function testThat10DigitIsValid() {
       $validator = new Moxca_Util_ValidIsbn();
       $isbn10String = "1234567890";
       $this->assertTrue($validator->isValid($isbn10String));

       $validator = new Moxca_Util_ValidIsbn();
       $isbn10String = "123456789X";
       $this->assertTrue($validator->isValid($isbn10String));
    }

    public function testThat13DigitIsValid() {
       $validator = new Moxca_Util_ValidIsbn();
       $isbn10String = "1234567890123";
       $this->assertTrue($validator->isValid($isbn10String));

       $validator = new Moxca_Util_ValidIsbn();
       $isbn10String = "123456789012X";
       $this->assertTrue($validator->isValid($isbn10String));
    }


}