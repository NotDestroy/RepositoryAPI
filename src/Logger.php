<?php

namespace Api\Base;

class Logger
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * @param \Api\Base\Record $record
     * @param                  $textGroup
     *
     * @return bool
     */
    public function writeLog(\Api\Base\Record $record, $textGroup)
    {
        if (!file_exists($this->path)) {
            return false;
        }
        $content = [
            'message'        => $record->getMessage(),
            'type'           => $record->getType(),
            'additionalData' => json_encode(($record->getAdditionalData())),
            'group'          => $textGroup,
            'date'           => date("d-m-Y H:i:s")
        ];
        file_put_contents($this->path, json_encode($content));
    }

    /**
     * @param \Api\Base\ExceptionHandler $exception
     */
    public function writeException(ExceptionHandler $exception)
    {
        $arrTrace = $exception->getTrace();
        $record   = new Record($exception->getMessage(), 'Error', [
            'Line'     => $arrTrace[0]['line'],
            'function' => $arrTrace[0]['function'],
            'class'    => $arrTrace[0]['class']
        ]);

        $this->writeLog($record, $arrTrace[0]['file']);
    }
}
