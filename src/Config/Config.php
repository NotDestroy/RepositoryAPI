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
        try {
            $this->get($key);
        } catch
        (\Api\Base\KeyNotFound $e) {
            return false;
        }

        return true;
    }

    /**
     * @param string $key node/node/node^n
     *
     * @return mixed|null
     * @throws \Api\Base\KeyNotFound
     */
    public function get($key)
    {
        $arrKeys     = explode('/', $key);
        $amount      = count($arrKeys);
        $rightAmount = ($amount - 1);
        $dataArr     = $this->arrData;
        for ($i = 0; $i <= $amount; $i++) {
            if (empty($dataArr)) {
                throw new \Api\Base\KeyNotFound('Ошибка: такого ключа не существует');
            }
            if (array_key_exists($arrKeys[$i], $dataArr)) {
                if ($rightAmount === $i) {
                    return $dataArr[$arrKeys[$i]];
                } else {
                    $dataArr = $dataArr[$arrKeys[$i]];
                    continue;
                }
            } else {
                throw new \Api\Base\KeyNotFound('Ошибка: такого ключа не существует');
            }
        }
        throw new \Api\Base\KeyNotFound('Ошибка: такого ключа не существует');
    }
}
