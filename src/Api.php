<?php

namespace Api\Base;

class Api
{
    private $commands;
    private $requestUri;
    private $method;

    public function __construct(array $commands, $requestUri)
    {
        $this->commands   = $commands;
        $this->requestUri = $requestUri;
    }

    public function getMethod()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        if ($this->method == 'POST' && array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER)) {
            if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE') {
                $this->method = 'DELETE';
            } else {
                if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT') {
                    $this->method = 'PUT';
                }
            }
        }
    }

    public function getAction($method)
    {
        switch ($method) {
            case 'GET':
                if ($this->requestUri) {
                    return 'viewAction';
                } else {
                    return 'indexAction';
                }
                break;
            case 'POST':
                return 'createAction';
                break;
            case 'PUT':
                return 'updateAction';
                break;
            case 'DELETE':
                return 'deleteAction';
                break;
            default:
                return null;
        }
    }

}
