<?php

namespace Api\Base;

class Config
{
    private $arrData = [];
    private $obArrayWrapper;

    public function __construct(array $arr)
    {
        $this->arrData = $arr;
        $this->obArrayWrapper = new \Api\Base\Utils\ArrayWrapper($this->arrData);
    }

    /**
     * @param string $key node/node/node^n
     *
     * @return bool
     */
    public function has($key)
    {
        return $this->obArrayWrapper->has($key);
    }

    /**
     * @param string $key node/node/node^n
     *
     * @return mixed|null
     */
    public function get($key)
    {
        return $this->obArrayWrapper->get($key);
    }
}
