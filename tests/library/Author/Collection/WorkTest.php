<?php

class WorkTest extends ControllerTestCase
{


    private $work;
    public function setUp() {
        $this->work = new Author_Collection_Work();
        parent::setUp();
    }

    public function testIfNewWorkIsEmpty()
    {
        $this->assertEquals($this->work->getId(), 0);
        $this->assertEquals($this->work->getTitle(), "");
        $this->assertEquals($this->work->getUri(), "");

    }

    public function testIfUriIsFormedAsExpected()
    {
        $this->work->setTitle("Cabe na mala");
        $this->assertEquals($this->work->getUri(), "cabe-na-mala");

        $this->work->setTitle("Coração valente");
        $this->assertEquals($this->work->getUri(), "coracao-valente");

        $this->work->setTitle("Festa no céu");
        $this->assertEquals($this->work->getUri(), "festa-no-ceu");

    }


}