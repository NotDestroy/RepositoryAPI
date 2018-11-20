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

    // ########################################

    public function run()
    {
        set_exception_handler(function (\Exception $exception) {
            $this->exceptionHandler($exception);
        });

        $errorTypes = E_WARNING | E_NOTICE;
        set_error_handler(function ($errNo, $errMess, $errFile, $errLine) {
            $this->errorHandler($errNo, $errMess, $errFile, $errLine);
        }, $errorTypes);

        //ob_start(function () {
        //    $this->fatalErrorHandler();
        //});

        register_shutdown_function(function () {
            $this->fatalErrorHandler();
        });
    }

    private function exceptionHandler(\Exception $exception)
    {
        $obResurs = \Api\Base\Resources::getInstanceResurs();
        $obLogger = $obResurs->getInstanceLogger($this->rootPath . '\vars\logs');
        $obLogger->writeException($exception);
    }

    private function errorHandler($errNo, $errMess, $errFile, $errLine)
    {
        if ($errNo == E_WARNING) {
            $type = 'Warning';
        }
        if ($errNo == E_NOTICE) {
            $type = 'Notice';
        }
        $record   = new Record($errMess, $type, $errLine);
        $obResurs = \Api\Base\Resources::getInstanceResurs();
        $obLogger = $obResurs->getInstanceLogger($this->rootPath . '\vars\logs');
        $obLogger->writeLog($record, $errFile);

        throw new PhpError\Exception($errMess, $type, $errFile, $errLine);
    }

    private function fatalErrorHandler()
    {
        $errorInfo = error_get_last();
        if (is_array($errorInfo) && in_array($errorInfo['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
            $record   = new Record($errorInfo['message'], 'Fatal Error', $errorInfo['line']);
            $obResurs = \Api\Base\Resources::getInstanceResurs();
            $obLogger = $obResurs->getInstanceLogger($this->rootPath . '\vars\logs');
            $obLogger->writeLog($record, $errorInfo['file']);
        }
    }
}
