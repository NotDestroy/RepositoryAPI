<?php

namespace Api\Base;

class Logger
{
    /**
     * @param \Api\Base\Record $record
     * @param                  $textGroup
     *
     * @return bool
     */
    public function writeLog(\Api\Base\Record $record, $textGroup)
    {

        $obResurs = \Api\Base\Resurs::$instance;
        $obConfig = $obResurs->getInstanceConfig();
        $path     = $obConfig->get('path');
        if (!file_exists($path)) {
            return false;
        }
        $content = [
            'message'        => $record->getMessage(),
            'type'           => $record->getType(),
            'additionalData' => json_encode(($record->getAdditionalData())),
            'group'          => $textGroup,
            'date'           => date("d-m-Y H:i:s")
        ];
        file_put_contents($path, json_encode($content));
    }
}
