<?php

namespace Api\Base;

class Logger
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * @param \Api\Base\Record $record
     * @param                  $textGroup
     *
     * @return bool
     */
    public function writeLog(\Api\Base\Record $record, $textGroup)
    {
        if (!file_exists($this->path)) {
            return false;
        }
        $content      = 'Message => ' . $record->getMessage() . ";\r\nErr_Line => " .
            $record->getLine() . ";\r\nErr_File => " . $textGroup . ";\r\nTime => " . date("d-m-Y H:i:s") . ";\r\n\r\n";

        $pathLog = $this->path . '\\' . $record->getType() . '.log';
        $fileOpen = fopen($pathLog, 'a');
        fwrite($fileOpen, $content);
        fclose($fileOpen);
    }

    /**
     * @param $exception
     */
    public function writeException($exception)
    {
        $arrTrace = $exception->getTrace();
        $record   = new Record($exception->getMessage(), 'Exception', $arrTrace[0]['line']);
        $this->writeLog($record, $arrTrace[0]['file']);
    }
}
