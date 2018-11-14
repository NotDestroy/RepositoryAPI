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

    private function exceptionHandler (\Exception $exception)
    {
        $obResurs = \Api\Base\Resources::$instance;
        $obLogger = $obResurs->getInstanceLogger();
        $obLogger->writeException($exception);
    }

    private function errorHandler($errNo, $errMess, $errFile, $errLine)
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

    private function fatalErrorHandler()
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
            $obResurs = \Api\Base\Resources::$instance;
            $obLogger = $obResurs->getInstanceLogger();
            $obLogger->writeLog($record, $group);
        }
    }

    public function run()
    {
        set_exception_handler('exceptionHandler');

        $errorTypes   = E_WARNING | E_NOTICE;
        set_error_handler('errorHandler', $errorTypes);

        ob_start('fatalErrorHandler');

        register_shutdown_function('fatalErrorHandler');
    }
}
