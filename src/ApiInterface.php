<?php

interface ApiInterface
{

public function __construct();

public function getParams();

public function response($data, $status = 500);

public function requestStatus($code);

}
