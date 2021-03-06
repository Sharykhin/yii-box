<?php
return [
    [
      'pattern' => '/',
      'route' => 'site/index'
    ],

    [
        'pattern' => 'backend/catalog',
        'route' => 'backend/catalog/catalog-products'
    ],
    [
        'pattern' => 'backend',
        'route' => 'backend/default/index'
    ],
    '<controller:\w+>/<id:\d+>' => '<controller>/view',
    '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
    '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
    '<module:\w+>/<submodule:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<submodule>/<controller>/<action>',
    '<module:[a-zA-Z0-9_-]+>/<submodule:[a-zA-Z0-9_-]+>/<controller:[a-zA-Z0-9_-]+>/<action:[a-zA-Z0-9_-]+>' => '<module>/<submodule>/<controller>/<action>',
    '<module:[a-zA-Z0-9_-]+>/<submodule:[a-zA-Z0-9_-]+>/<controller:[a-zA-Z0-9_-]+>' => '<module>/<submodule>/<controller>/index'


];