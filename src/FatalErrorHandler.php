<?php

namespace Api\Base;

class FatalErrorHandler
{
    /**
     * @throws \Api\Base\Exception
     */
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
            $obResurs = \Api\Base\Resurs::$instance;
            $obLogger = $obResurs->getInstanceLogger();
            $obLogger->writeLog($record, $group);
        }
    }
}
