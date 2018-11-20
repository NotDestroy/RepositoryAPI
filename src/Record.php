<?php

namespace Api\Base;

class Record
{
    private $message;
    private $type;
    private $line;

    /**
     * @param $message
     * @param $type
     * @param $line
     */
    public function __construct($message, $type, $line)
    {
        $this->message = $message;
        $this->type = $type;
        $this->line = 'on line ' . $line;
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
     * @return string
     */
    public function getLine()
    {
        return $this->line;
    }

}
