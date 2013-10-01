<?php

class MarkupTest extends ControllerTestCase
{


    public function setUp() {
        parent::setUp();
    }

    public function testThatAnEmptyMarkupIsAValidMarkup() {
       $validator = new Moxca_Util_ValidMarkup();
       $emptyString = "";
       $this->assertTrue($validator->isValid($emptyString));
    }

    public function testThatATypicalMarkupIsAValidMarkup() {
       $validator = new Moxca_Util_ValidMarkup();
       $string = "<p>Ser&aacute; que vai rolar assim mesmo&nbsp;</p>";
       $this->assertTrue($validator->isValid($string));
    }

    public function testThatQuotesCanBeUsedAtMarkup() {
       $validator = new Moxca_Util_ValidMarkup();
       $string = '<p>Ser&aacute; que vai rolar assim mesmo&nbsp; <img src="/img/269744_10150230579712675_675877674_7614519_2255808_n.jpg" alt="" width="130" height="130" /></p>';
       $this->assertTrue($validator->isValid($string));
    }

    public function testThatThisNotSoLongTextIsAtValidMarkup() {
       $validator = new Moxca_Util_ValidMarkup();
       $string = '<p><img src="/img/310017_518859571487482_41703599_n.jpg" alt="" width="152" height="202" />this is some text&nbsp;this is some text&nbsp;this is some text&nbsp;this is some text&nbsp;this is some text&nbsp;this is some text&nbsp;this is some text&nbsp;this is some text&nbsp;this is some text&nbsp;this is some text&nbsp;this is some text&nbsp;this is some text&nbsp;</p>';
       $this->assertTrue($validator->isValid($string));
    }

    public function testThatEvenSomeTinyStringsAreValidMarkups() {
       $validator = new Moxca_Util_ValidMarkup();
       $string = "A";
       $this->assertTrue($validator->isValid($string));
       $string = "bc";
       $this->assertTrue($validator->isValid($string));
       $string = "0";
       $this->assertTrue($validator->isValid($string));
    }

    public function testThatCanUsePercentAtString() {
       $validator = new Moxca_Util_ValidMarkup();
       $string = "ABCDE 50%";
       $this->assertTrue($validator->isValid($string));
    }

    public function testThatCanUseSomeOtherCharsAtMarkup() {
       $validator = new Moxca_Util_ValidMarkup();
       $string = "ABCDE 50% ª º & sons. ";
       $this->assertTrue($validator->isValid($string));
    }


}