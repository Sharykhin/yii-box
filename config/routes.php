<?php
return [

    [
        'pattern' => 'backend/catalog',
        'route' => 'backend/catalog/catalog-products'
    ],
    [
        'pattern' => 'backend',
        'route' => 'backend/default/index'
    ],
    '<controller:\w+>/<id:\d+>'=>'<controller>/view',
    '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
    '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
    '<module:\w+>/<controller:\w+>/<action:\w+>'=>'<module>/<controller>/<action>'


];