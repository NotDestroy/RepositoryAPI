<?php

namespace Api\Base;

class Exception extends \Exception
{
    public $message;
    public $type;
    public $group;
    public $additionalData = [];

    public function __construct($message, $type, $group, $additionalData = null, $flag = false)
    {
        $this->message        = $message;
        $this->type           = $type;
        $this->group          = $group;
        $this->additionalData = $additionalData;
        if($flag === true){
            $this->getMyExcMessage();
            $this->getType();
            $this->getGroup();
            $this->getAdditionalData();
        }
    }

    public function getMyExcMessage()
    {
        return $this->message;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getGroup()
    {
        return $this->group;
    }

    public function getAdditionalData()
    {
        $this->additionalData;
    }
}
