<?php

return [

    'paths' => ['api/*', 'admin/*'],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['http://localhost:5173' , 'https://portfolio-chi-eight-sdpluap8mf.vercel.app',],
    

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];