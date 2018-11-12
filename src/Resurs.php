<?php

namespace Api\Base;

class Resurs
{
    public        $instanceConfig = null;
    public        $instanceLogger = null;
    public        $arrResult      = [];
    public static $instance;

    private function __construct()
    {
        $this->instanceConfig = new Config($arrData);
        $this->instanceLogger = new Logger();
    }

    public static function getInstanceResurs()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Resurs();
        }

        return self::$instance;
    }

    public function getInstanceConfig()
    {
        return $this->instanceConfig;
    }

    public function getInstanceLogger()
    {
        return $this->instanceLogger;
    }
    //public function getInstanceConfig()
    //{
    //    if ($this->instanceConfig === null) {
    //        $this->instanceConfig = new Config();
    //    }
    //
    //    return $this->instanceConfig;
    //}
    //
    //public function getInstanceLogger()
    //{
    //    if ($this->instanceLogger === null) {
    //        $this->instanceLogger = new Logger();
    //    }
    //
    //    return $this->instanceLogger;
    //}
}
