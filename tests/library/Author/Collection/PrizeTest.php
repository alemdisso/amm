<?php

class PrizeTest extends ControllerTestCase
{


    private $prize;
    public function setUp() {
        parent::setUp();
    }

    public function testIfCanCreateANewPrize()
    {
        $this->prize = new Author_Collection_Prize(1);
        $this->assertEquals($this->prize->getId(), 0);
        $this->assertEquals($this->prize->getPrizeName(), "");
        $this->assertEquals($this->prize->getInstitutionName(), "");

    }


}