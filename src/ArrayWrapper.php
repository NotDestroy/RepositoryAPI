<?php

namespace Api\Base;

class ArrayWrapper
{
    private $array;

    public function __construct(array $data)
    {
        $this->array = $data;
    }

    /**
     * @param $key
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
     * @param $key
     *
     * @return mixed|null
     * @throws \Api\Base\KeyNotFound
     */
    public function get($key)
    {
        $arrKeys     = explode('/', $key);
        $amount      = count($arrKeys);
        $rightAmount = ($amount - 1);
        $dataArr     = $this->array;
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

    /**
     * @param $keys
     * @param $value
     *
     * @return array
     */
    public function set($keys, $value)
    {
        $arrKeys         = explode('/', $keys);
        $amountKeys      = count($arrKeys);
        $rightAmountKeys = ($amountKeys - 1);
        $levelArr        = &$this->array;
        $saveLevelArr    = &$this->array;
        $result          = [];
        $i               = 0;
        foreach ($arrKeys as $key) {
            if (isset($saveLevelArr[$key])) {
                if (is_array($saveLevelArr[$key])) {
                    $saveLevelArr = &$saveLevelArr[$key];
                } else {
                    $saveLevelArr[$key] = [];
                }
            } else {
                if ($arrKeys[$rightAmountKeys] === $key) {
                    $saveLevelArr[$key] = $value;
                    $result             = $this->array;
                } else {
                    if ($arrKeys[0] === $key) {
                        $levelArr[$arrKeys[$i]] = [];
                    } else {
                        $saveLevelArr[$key] = [];
                    }
                    if (isset($saveLevelArr[$key])) {
                        $saveLevelArr = &$saveLevelArr[$key];
                    }
                }
            }
            $i++;
        }

        return $result;
    }
}


