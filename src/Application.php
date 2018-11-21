<?php

namespace Api\Base;

class Application
{
    private $requestUri;
    private $method;

    // ########################################

    public function __construct()
    {
        $this->requestUri = $_SERVER['REQUEST_URI'];
        $this->method     = $_SERVER['REQUEST_METHOD'];
    }

    // ########################################

    public function process()
    {

        $obResurs = \Api\Base\Resources::getInstanceResurs();
        $obConfig = $obResurs->getInstanceConfig();
        if ($obConfig->has('command/path')) {
            if ($obConfig->get('command/path') === $this->requestUri) {
                if ($obConfig->has('command/method')) {
                    if ($obConfig->get('command/method') === $this->method) {
                        if ($obConfig->has('command/handler')) {
                            if (is_subclass_of($obConfig->get('command/handler'),
                                'Api\Base\Command\Handler\BaseInterface')) {
                                return $obConfig->get('command/handler');
                            }
                        }
                    }
                }
            }
        }

        return false;
    }

    // ########################################

    private function requestStatus($code)
    {
        $status = [
            200 => 'OK',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error',
        ];

        return ($status[$code]) ? $status[$code] : $status[500];
    }
}
