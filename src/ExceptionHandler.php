<?php

namespace Api\Base;

class ExceptionHandler
{

    function exceptionHandler(\Exception $exception)
    {
        $obResurs = \Api\Base\Resources::$instance;
        $obLogger = $obResurs->getInstanceLogger();
        $obLogger->writeException($exception);
    }
}
