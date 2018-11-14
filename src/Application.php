<?php

namespace Api\Base;

class Application
{
    private $requestUri = [];
    private $requestParams = [];

    public function __construct()
    {
        header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: *");
        header("Content-Type: application/json");
        //todo version
        $this->requestUri    = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        $this->requestParams = $_REQUEST;
    }
    public function parseRequestUri()
    {
        if (!empty($this->route)) {
            $route = substr($this->route, 1);
            $parts = explode('/', $route);
            if ($parts[0] == "") {
                array_pop($parts);
            }
        }
        //todo проверка варсии
        //todo проверка команды
        //todo ошибку

    }

    public function requestStatus($code) {
        $status = array(
            200 => 'OK',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error',
        );
        return ($status[$code])?$status[$code]:$status[500];
    }
}
