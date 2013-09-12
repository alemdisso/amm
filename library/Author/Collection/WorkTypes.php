<?php

class Author_Collection_WorkTypes {

    private $titles = array();


    public function __construct() {
        $this->titles = array(

            Author_Collection_WorkTypeConstants::TYPE_NIL      => _("#Nil"),
            Author_Collection_WorkTypeConstants::TYPE_CHILDREN => _("#Children"),
            Author_Collection_WorkTypeConstants::TYPE_YOUNG    => _("#Young"),
            Author_Collection_WorkTypeConstants::TYPE_FICTION  => _("#Fiction"),
            Author_Collection_WorkTypeConstants::TYPE_ESSAY    => _("#Essay"),
        );
    }

    public function TitleForType($type)
    {
            switch ($type) {
                case Author_Collection_WorkTypeConstants::TYPE_PROSPECTING:
                case Author_Collection_WorkTypeConstants::TYPE_PLANNING:
                case Author_Collection_WorkTypeConstants::TYPE_PROPOSAL:
                case Author_Collection_WorkTypeConstants::TYPE_EXECUTION:
                case Author_Collection_WorkTypeConstants::TYPE_ACCOUNTABILITY:
                case Author_Collection_WorkTypeConstants::TYPE_CANCELED:
                case Author_Collection_WorkTypeConstants::TYPE_SUSPENDED:
                case Author_Collection_WorkTypeConstants::TYPE_FINISHED:
                    return $this->titles[$type];
                    break;

                default:
                    return _("#Unknown type");
                    break;
            }
    }

    public function AllTitles($includeNull = false)
    {

        if ($includeNull) {
            return $this->titles;
        } else {
            $data = array();
            foreach ($this->titles as $k => $v) {
                if ($k != Author_Collection_WorkTypeConstants::TYPE_NIL) {
                    $data[$k] = $v;
                }
            }
            return($data);
        }
    }
}