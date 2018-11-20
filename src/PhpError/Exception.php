<?php

namespace Api\Base\PhpError;

class Exception extends \Exception
{
    private $type;

    public function __construct($message, $type, $file, $line)
    {
        parent::__construct($message);
        $this->file = $file;
        $this->line = $line;
        $this->type = $type;
    }

    // ########################################

    public function getType()
    {
        return $this->type;
    }

    // ########################################
}
