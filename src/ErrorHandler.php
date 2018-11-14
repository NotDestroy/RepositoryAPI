<?php

namespace Api\Base;

class ErrorHandler
{

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
        $obResurs = \Api\Base\Resources::$instance;
        $obLogger = $obResurs->getInstanceLogger();
        $obLogger->writeLog($record, $group);

        throw new Exception($message, $type, $group, $additionalData, true);
    }
}
