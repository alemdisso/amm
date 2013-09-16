<?php

class Author_Collection_Editor {

    protected $id;
    protected $name;
    protected $uri;
    protected $country;

    function __construct($id=0) {
        $this->id = (int)$id;
        $this->name = null;
        $this->uri = null;
        $this->country = null;
    }

    public function getId() {
        return $this->id;
    } //getId

    public function SetId($id) {
        if (($this->id == 0) && ($id > 0)) {
            $this->id = (int)$id;
        } else {
            throw new Author_Collection_EditorException('It\'s not possible to change a editor\'s ID');
        }
    } //SetId

    public function getName()
    {
        return $this->name;
    } //getName

    public function SetName($name)
    {
        $validator = new Moxca_Util_ValidString();
        if ($validator->isValid($name)) {
            if ($this->name != $name) {
                $this->name = $name;
                $converter = new Moxca_Util_StringToAscii();
                $this->uri = $converter->toAscii($this->name);
            }
        } else {
            throw new Author_Collection_EditorException("This ($name) is not a valid name.");
        }

    } //SetName

    public function getUri()
    {
        return $this->uri;
    } //getUri


}