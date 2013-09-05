<?php

class Amm_Collection_WorkTypes {

    private $titles = array();


    public function __construct() {
        $this->titles = array(

            Amm_Collection_WorkTypeConstants::TYPE_NIL      => _("#Nil"),
            Amm_Collection_WorkTypeConstants::TYPE_CHILDREN => _("#Children"),
            Amm_Collection_WorkTypeConstants::TYPE_YOUNG    => _("#Young"),
            Amm_Collection_WorkTypeConstants::TYPE_FICTION  => _("#Fiction"),
            Amm_Collection_WorkTypeConstants::TYPE_ESSAY    => _("#Essay"),
        );
    }

    public function TitleForType($type)
    {
            switch ($type) {
                case Amm_Collection_WorkTypeConstants::TYPE_PROSPECTING:
                case Amm_Collection_WorkTypeConstants::TYPE_PLANNING:
                case Amm_Collection_WorkTypeConstants::TYPE_PROPOSAL:
                case Amm_Collection_WorkTypeConstants::TYPE_EXECUTION:
                case Amm_Collection_WorkTypeConstants::TYPE_ACCOUNTABILITY:
                case Amm_Collection_WorkTypeConstants::TYPE_CANCELED:
                case Amm_Collection_WorkTypeConstants::TYPE_SUSPENDED:
                case Amm_Collection_WorkTypeConstants::TYPE_FINISHED:
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
                if ($k != Amm_Collection_WorkTypeConstants::TYPE_NIL) {
                    $data[$k] = $v;
                }
            }
            return($data);
        }
    }
}