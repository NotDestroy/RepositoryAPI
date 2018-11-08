<?php

namespace Api\Base\Config;

class Config
{
    private $arrData = [];

    public function __construct(array $arr)
    {
        $this->arrData = $arr;
    }

    /**
     * @param string $key format node/node/node^n
     *
     * @return bool
     */
    public function has($key)
    {
        $obArrWrapper = new \Api\Base\ArrayWrapper($this->arrData);

        return $obArrWrapper->has($key);
    }

    /**
     * @param string $key format node/node/node^n
     *
     * @return mixed|null
     * @throws \Api\Base\KeyNotFound
     */
    public function get($key)
    {
        if (!$this->has($key)) {
            throw new \Api\Base\KeyNotFound('Ошибка: такого ключа не существует');
        }

        $obArrWrapper = new \Api\Base\ArrayWrapper($this->arrData);
        return $obArrWrapper->get($key);
    }
}
