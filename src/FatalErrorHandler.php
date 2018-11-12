<?php

namespace Api\Base;

class FatalErrorHandler
{
    public function fatalErrorHandler()
    {
        $errorInfo = error_get_last();
        if (is_array($errorInfo) && in_array($errorInfo['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
            $message        = $errorInfo['message'];
            $group          = $errorInfo['file'];
            $type           = 'Fatal Error';
            $additionalData = [
                'Line' => $errorInfo['line']
            ];
            $record         = new Record($message, $type, $additionalData);
            $logger         = new \Api\Base\Logger();
            $logger->writeLog($record, $group);
        }
    }
}
