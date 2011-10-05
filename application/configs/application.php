<?php
return array(
    'db' => array(
        'dns' => 'sqlite:' . __DIR__ . '/../../db/development.db',
        'username' => '',
        'password' => '',
    ),
    'loader' => array(
        'Kernel' => __DIR__ . '/../../library/Kernel',
        'Application\\Controller' => __DIR__ . '/../controllers',
        'Application\\Model' => __DIR__ . '/../models',
        'Application\\Service' => __DIR__ . '/../services',
    ),
    'router' => array(
        '/' => array('index', 'index'),
        '/index/save' => array('index', 'save'),
    )
);

