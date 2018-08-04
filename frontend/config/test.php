<?php
return [
    'id' => 'app-frontend-tests',
    'language' => 'en-US',
    'sourceLanguage' => 'en-US',
    'components' => [
        'assetManager' => [
            'basePath' => __DIR__ . '/../web/assets',
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
        'request' => [
            'cookieValidationKey' => 'test',
        ],
    ],
];
