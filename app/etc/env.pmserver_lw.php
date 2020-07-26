<?php
return [
    'backend' => [
        'frontName' => 'pmadmin'
    ],
    'db' => [
        'connection' => [
            'indexer' => [
                'host' => 'localhost',
                'dbname' => 'lw_toneart',
                'username' => 'lw_toneart',
                'password' => 'lw_toneart',
                'active' => '1',
                'persistent' => null
            ],
            'default' => [
                'host' => 'localhost',
                'dbname' => 'lw_toneart',
                'username' => 'lw_toneart',
                'password' => 'lw_toneart',
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
        'config' => 0,
        'layout' => 0,
        'block_html' => 0,
        'collections' => 0,
        'reflection' => 0,
        'db_ddl' => 0,
        'compiled_config' => 0,
        'eav' => 0,
        'customer_notification' => 0,
        'config_integration' => 0,
        'config_integration_api' => 0,
        'full_page' => 0,
        'target_rule' => 0,
        'config_webservice' => 0,
        'translate' => 0,
        'google_product' => 0,
        'vertex' => 0
    ],
    'downloadable_domains' => [
        'dev.toneart-shop.de'
    ],
    'install' => [
        'date' => 'Thu, 02 Apr 2020 09:56:25 +0000'
    ]
];
