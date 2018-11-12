<?php

namespace Api\Base;

class Record
{
    private $message;
    private $type;
    private $additionalData;

    /**
     * @param       $message
     * @param       $type
     * @param array $additionalData
     */
    public function __construct($message, $type, array $additionalData)
    {
        $this->message = $message;
        $this->type = $type;
        $this->additionalData = $additionalData;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function getAdditionalData()
    {
        return $this->additionalData;
    }

}
