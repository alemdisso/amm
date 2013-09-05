<?php

class StoryTest extends ControllerTestCase
{


    private $story;
    public function setUp() {
        $this->story = new Moxca_Collection_Story();
        parent::setUp();
    }

    public function testIfNewStoryIsEmpty()
    {
        $this->assertEquals($this->story->getId(), 0);
        $this->assertEquals($this->story->getTitle(), "");
        $this->assertEquals($this->story->getUri(), "");

    }

    public function testIfUriIsFormedAsExpected()
    {
        $this->story->setTitle("Cabe na mala");
        $this->assertEquals($this->story->getUri(), "cabe-na-mala");

        $this->story->setTitle("Coração valente");
        $this->assertEquals($this->story->getUri(), "coracao-valente");

        $this->story->setTitle("Festa no céu");
        $this->assertEquals($this->story->getUri(), "festa-no-ceu");

    }


}