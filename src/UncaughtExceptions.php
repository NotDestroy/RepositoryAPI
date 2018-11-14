<?php

namespace Api\Base;

class UncaughtExceptions
{
    /**
     * @param \Exception $exception
     */
    function exceptionHandler(\Exception $exception)
    {
        $arrTrace       = $exception->getTrace();
        $message        = $exception->getMessage();
        $type           = 'Error';
        $group          = $arrTrace[0]['file'];
        $additionalData = [
            'Line'     => $arrTrace[0]['line'],
            'function' => $arrTrace[0]['function'],
            'class'    => $arrTrace[0]['class']
        ];
        $record         = new Record($message, $type, $additionalData);
        $obResurs       = \Api\Base\Resurs::$instance;
        $obLogger       = $obResurs->getInstanceLogger();
        $obLogger->writeLog($record, $group);
    }
}
