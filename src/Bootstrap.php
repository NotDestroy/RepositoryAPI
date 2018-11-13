<?php

namespace Api\Base;

class Bootstrap
{
    public $rootPath;

    /**
     * @param string $rootPath
     */
    public function __construct($rootPath)
    {
        $this->rootPath = $rootPath;
    }
    public function run()
    {
        require_once __DIR__ . '/Exception.php';
        require_once __DIR__ . '/ErrorHandler.php';
        require_once __DIR__ . '/FatalErrorHandler.php';
        require_once __DIR__ . '/UncaughtExceptions.php';
    }
}
