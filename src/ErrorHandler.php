<?php

namespace Api\Base;

class ErrorHandler
{
    /**
     * @param $errNo
     * @param $errMess
     * @param $errFile
     * @param $errLine
     */
    public function errorHandler($errNo, $errMess, $errFile, $errLine)
    {
        $message        = $errMess;
        $type           = $errNo;
        $group          = $errFile;
        $additionalData = [
            'Line' => ' on line ' . $errLine,
        ];
        if ($errNo == E_WARNING) {
            $type = 'Warning';
        }
        if ($errNo == E_NOTICE) {
            $type = 'Notice';
        }
        $record = new Record($message, $type, $additionalData);
        $logger = new \Api\Base\Logger();
        $logger->writeLog($record, $group);
    }
}
