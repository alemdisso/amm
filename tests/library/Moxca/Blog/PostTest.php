<?php

class PostTest extends ControllerTestCase
{


    private $post;
    public function setUp() {
        $this->post = new Moxca_Blog_Post();
        parent::setUp();
    }

    public function testIfNewPostIsEmpty()
    {
        $this->assertEquals($this->post->getId(), 0);
        $this->assertEquals($this->post->getTitle(), "");
        $this->assertEquals($this->post->getUri(), "");

    }

    public function testIfUriIsFormedAsExpected()
    {
        $this->post->setTitle("Cabe na mala");
        $this->assertEquals($this->post->getUri(), "cabe-na-mala");

        $this->post->setTitle("Coração valente");
        $this->assertEquals($this->post->getUri(), "coracao-valente");

        $this->post->setTitle("Festa no céu");
        $this->assertEquals($this->post->getUri(), "festa-no-ceu");

    }


}