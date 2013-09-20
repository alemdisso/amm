<?php

class ValidUriTest extends ControllerTestCase
{


    public function setUp() {
        parent::setUp();
    }

    public function testThatASingleTermIsValid() {
       $validator = new Moxca_Util_ValidUri();
       $term = "mico";
       $this->assertTrue($validator->isValid($term));
    }

    public function testThatTwoTermsAndaHyphenAreValid() {
       $validator = new Moxca_Util_ValidUri();
       $term = "mico-maneco";
       $this->assertTrue($validator->isValid($term));
    }


}