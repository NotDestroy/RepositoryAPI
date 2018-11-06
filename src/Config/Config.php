<?php

class Config implements configInterface
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
    public function getConfig($pathAuthoload, $pathDb, $basePath, $bootstrap, $components, $log)
    {
        return $config = [
            'pathAuthoload' => $pathAuthoload,
            'pathDb'        => $pathDb,
            'basePath'      => $basePath,
            'bootstrap'     => $bootstrap,
            'components'    => $components,
            'log'           => $log,
        ];
    }

    /**
     * @param $class
     * @param $dsn
     * @param $userName
     * @param $password
     * @param $charset
     *
     * @return array $config
     */
    public function getConfigDb($class, $dsn, $userName, $password, $charset)
    {
        return $config = [
            'class'    => $class,
            'dsn'      => $dsn,
            'username' => $userName,
            'password' => $password,
            'charset'  => $charset,

        ];
    }
}
