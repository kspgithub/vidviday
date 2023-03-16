<?php
return [
    'environments' => [
        'production' => [
            'paths' => [
                '*' => [
                    'disallow' => [
                        '/cgi-bin/',
                        '/wp-admin/',
                        '/?',
                        '*?s=',
                        '*&s=',
                        '/search',
                        '/author/',
                        '*/embed$',
                        '*/page/',
                        '*/xmlrpc.php',
                        '*utm*=',
                        '*openstat=',
                    ],
                    'allow' => []
                ],
            ],
            'sitemaps' => [
                'sitemap.xml'
            ]
        ],
        'development' => [
            'paths' => [
                '*' => [
                    'disallow' => [
                        '/cgi-bin/',
                        '/wp-admin/',
                        '/?',
                        '*?s=',
                        '*&s=',
                        '/search',
                        '/author/',
                        '*/embed$',
                        '*/page/',
                        '*/xmlrpc.php',
                        '*utm*=',
                        '*openstat=',
                    ],
                    'allow' => []
                ],
            ],
            'sitemaps' => [
                'sitemap.xml'
            ]
        ],
        'local' => [
            'paths' => [
                '*' => [
                    'disallow' => [
                        '/cgi-bin/',
                        '/wp-admin/',
                        '/?',
                        '*?s=',
                        '*&s=',
                        '/search',
                        '/author/',
                        '*/embed$',
                        '*/page/',
                        '*/xmlrpc.php',
                        '*utm*=',
                        '*openstat=',
                    ],
                    'allow' => []
                ],
            ],
            'sitemaps' => [
                'sitemap.xml'
            ]
        ],
    ]
];
