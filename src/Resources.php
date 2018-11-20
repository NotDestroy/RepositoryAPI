<?php

namespace Api\Base;

class Resources
{
    private        $instanceConfig = null;
    private        $instanceLogger = null;
    public static $instance;

    private function __construct()
    {
    }

    /**
     * @return \Api\Base\Resources
     */
    public static function getInstanceResurs()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Resources();
        }

        return self::$instance;
    }

    /**
     * @return \Api\Base\Config
     */
    public function getInstanceConfig()
    {
        if ($this->instanceConfig === null) {
            $this->instanceConfig = new Config([]);
        }

        return $this->instanceConfig;
    }

    /**
     * @return \Api\Base\Logger
     */
    public function getInstanceLogger($path)
    {
        if ($this->instanceLogger === null) {
            $this->instanceLogger = new Logger($path);
        }

        return $this->instanceLogger;
    }
}
