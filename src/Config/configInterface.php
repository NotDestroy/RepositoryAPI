<?php

interface configInterface
{
    /**
     * @param $pathAuthoload
     * @param $pathDb
     * @param $basePath
     * @param $bootstrap
     * @param $components
     * @param $log
     *
     * @return array $config
     */
public function getConfig($pathAuthoload, $pathDb, $basePath, $bootstrap, $components, $log);

    /**
     * @param $class
     * @param $dsn
     * @param $userName
     * @param $password
     * @param $charset
     *
     * @return array $config
     */
public function getConfigDb($class, $dsn, $userName, $password, $charset);

}
