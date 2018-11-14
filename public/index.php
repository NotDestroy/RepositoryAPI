<?php

include_once '..\vendor\autoload.php';

(new \Api\Base\Bootstrap(__DIR__))->run();

$q = new \Api\Base\Application();
$q->parseRequestUri();
