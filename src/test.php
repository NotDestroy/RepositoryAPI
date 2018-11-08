<?php
include_once '..\vendor\autoload.php';
$arr = [
    'a'           => '333',
    'b'           => '444',
    'REQUIRE_URI' => 'index.php',
    'c'           => [
        'f' => '555',
        't' => '666',
        'y' => [
            'e' => '111',
            'w' => [
                's' => '222',
                'l' => [
                    'j' => '000'
                ]
            ]
        ]
    ]
];
$q   = new \Api\Base\Config\Config($arr);

var_dump($q->get('c/y/w/l/j'));

