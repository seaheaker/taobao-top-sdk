<?php
/**
 * Taobao top client config
 * User: smallsea
 * Email: simple.smallsea@gmail.com
 * Date: 2018/12/25 16:16
 */

return [
    'default' => 'app',
    'connections' => [
        'app' => [
            'app_key'       => env('TAOBAO_APP_KEY', 'APP KEY'),
            'app_secret'    => env('TAOBAO_APP_SECRET', 'APP SECRET'),
            'format'        => 'json',
        ]
    ]
];