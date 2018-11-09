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
            'e' => true,
            'w' => [
                's' => '222',
                'l' => [
                    'j' => '000'
                ]
            ]
        ]
    ]
];
$q   = new \Api\Base\ArrayWrapper($arr);

var_dump($q->get('c/y/e'));

