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
     * @param string $key node/node/node^n
     *
     * @return bool
     */
    public function has($key)
    {
        $obArrayWrapper = new \Api\Base\ArrayWrapper($this->arrData);
        return $obArrayWrapper->has($key);
    }

    /**
     * @param string $key node/node/node^n
     *
     * @return mixed|null
     */
    public function get($key)
    {
        $obArrayWrapper = new \Api\Base\ArrayWrapper($this->arrData);
        return $obArrayWrapper->get($key);
    }
}
