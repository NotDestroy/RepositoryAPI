<?php

namespace Api\Base;

class Bootstrap
{
    private $rootPath;

    /**
     * @param string $rootPath
     */
    public function __construct($rootPath)
    {
        $this->rootPath = $rootPath;
    }
    public function run()
    {
        $obExceptionHandler = new ExceptionHandler();
        set_exception_handler(array($obExceptionHandler, 'exceptionHandler'));

        $ObErrHandler = new ErrorHandler();
        $errorTypes = E_WARNING | E_NOTICE;
        set_error_handler(array($ObErrHandler, 'errorHandler'), $errorTypes);

        $ObErrHandler = new FatalErrorHandler();
        ob_start(array($ObErrHandler, 'fatalErrorHandler'));

        $ObErrHandler = new FatalErrorHandler();
        register_shutdown_function(array($ObErrHandler, 'fatalErrorHandler'));
    }
}
