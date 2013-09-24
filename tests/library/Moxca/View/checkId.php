<?php

class CheckIdTest extends ControllerTestCase
{


    public function setUp() {
        parent::setUp();
    }

    public function testThatDefaultIdWithValidValueWorks() {
        $value = 7;
        $data = array('id' => $value);
        $helper = new Moxca_View_Helper_CheckIdFromGet();

        $this->assertEquals($helper->checkIdFromGet($data), $value);
    }

/**
 * @expectedException Moxca_View_Helper_Exception
 */
    public function testThatInvalidValueRaisesError() {
        $value = "abc";
        $data = array('id' => $value);
        $helper = new Moxca_View_Helper_CheckIdFromGet();
//        $this->setExpectedException('Moxca_View_Helper_Exception');
        $id = $helper->checkIdFromGet($data);
        $this->assertEquals('-7', $id);
    }


}