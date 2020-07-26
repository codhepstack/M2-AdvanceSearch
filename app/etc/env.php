<?php
return [
    'backend' => [
        'frontName' => 'pmadmin'
    ],
    'db' => [
        'connection' => [
            'indexer' => [
                'host' => 'localhost',
                'dbname' => 'toneart_m2',
                'username' => 'root',
                'password' => 'DBroot@2020',
                'active' => '1',
                'persistent' => null
            ],
            'default' => [
                'host' => 'localhost',
                'dbname' => 'toneart_m2',
                'username' => 'root',
                'password' => 'DBroot@2020',
                'active' => '1',
                'driver_options' => [

                ]
            ]
        ],
        'table_prefix' => ''
    ],
    'crypt' => [
        'key' => 'd2e9ae1f3d80f4e92fd93f0cfd558d4e'
    ],
    'resource' => [
        'default_setup' => [
            'connection' => 'default'
        ]
    ],
    'x-frame-options' => 'SAMEORIGIN',
    'MAGE_MODE' => 'developer',
    'session' => [
        'save' => 'files'
    ],
    'cache' => [
        'frontend' => [
            'default' => [
                'id_prefix' => '2a2_'
            ],
            'page_cache' => [
                'id_prefix' => '2a2_'
            ]
        ]
    ],
    'lock' => [
        'provider' => 'db',
        'config' => [
            'prefix' => null
        ]
    ],
    'cache_types' => [
        'config' => 1,
        'layout' => 1,
        'block_html' => 1,
        'collections' => 1,
        'reflection' => 1,
        'db_ddl' => 1,
        'compiled_config' => 1,
        'eav' => 1,
        'customer_notification' => 1,
        'config_integration' => 1,
        'config_integration_api' => 1,
        'full_page' => 1,
        'target_rule' => 1,
        'config_webservice' => 1,
        'translate' => 1,
        'google_product' => 1,
        'vertex' => 1
    ],
    'downloadable_domains' => [
        'dev.toneart-shop.de'
    ],
    'install' => [
        'date' => 'Thu, 02 Apr 2020 09:56:25 +0000'
    ]
];
