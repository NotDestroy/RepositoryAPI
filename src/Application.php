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
        if (!$obConfig->has('command')) {
            return false;
        }
        foreach ($obConfig->get('command') as $oneCommand) {
            if (!array_key_exists('path', $oneCommand)) {
                throw new \Api\Base\Config\Exception\KeyNotFound('Ошибка: такого ключа не существует');
            }
            if (!array_key_exists('method', $oneCommand)) {
                throw new \Api\Base\Config\Exception\KeyNotFound('Ошибка: такого ключа не существует');
            }
            if (!array_key_exists('handler', $oneCommand)) {
                throw new \Api\Base\Config\Exception\KeyNotFound('Ошибка: такого ключа не существует');
            }
            if (is_subclass_of($oneCommand['handler'],
                    'Api\Base\Command\Handler\BaseInterface') && $oneCommand['method'] === $this->method
                && $oneCommand['path'] === $this->requestUri) {
                $ob = new $oneCommand['handler']();

                return $ob->process();
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
