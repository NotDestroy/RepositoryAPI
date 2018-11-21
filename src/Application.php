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
        if ($obConfig->has('command')) {
            foreach ($obConfig->get('command') as $oneCommand) {
                if (array_key_exists('path', $oneCommand)) {
                    if ($oneCommand['path'] === $this->requestUri) {
                        if (array_key_exists('method', $oneCommand)) {
                            if ($oneCommand['method'] === $this->method) {
                                if (array_key_exists('handler', $oneCommand)) {
                                    if (is_subclass_of($oneCommand['handler'],
                                        'Api\Base\Command\Handler\BaseInterface')) {
                                        $ob = new $oneCommand['handler']();

                                        return $ob->process();
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        return false;
    }

    // ########################################

    private
    function requestStatus(
        $code
    ) {
        $status = [
            200 => 'OK',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error',
        ];

        return ($status[$code]) ? $status[$code] : $status[500];
    }
}
