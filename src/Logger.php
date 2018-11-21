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
     * @param \Api\Base\Logger\Record $record
     * @param                         $textGroup
     */
    public function writeLog(\Api\Base\Logger\Record $record, $textGroup)
    {
        if (!file_exists($this->path)) {
            mkdir($this->path, 0777, true);
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
        $record   = new Logger\Record($exception->getMessage(), 'Exception', $arrTrace[0]['line']);
        $this->writeLog($record, $arrTrace[0]['file']);
    }
}
