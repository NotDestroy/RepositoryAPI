<?php

namespace Api\Base;

class Resurs
{
    public        $instanceConfig = null;
    public        $instanceLogger = null;
    public static $instance;

    private function __construct()
    {
    }

    /**
     * @return \Api\Base\Resurs
     */
    public static function getInstanceResurs()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Resurs();
        }

        return self::$instance;
    }

    /**
     * @return \Api\Base\Config
     */
    public function getInstanceConfig()
    {
        if ($this->instanceConfig === null) {
            $this->instanceConfig = new Config($arr = []);
        }

        return $this->instanceConfig;
    }

    /**
     * @return \Api\Base\Logger
     */
    public function getInstanceLogger()
    {
        if ($this->instanceLogger === null) {
            $this->instanceLogger = new Logger($path = '');
        }

        return $this->instanceLogger;
    }
}
