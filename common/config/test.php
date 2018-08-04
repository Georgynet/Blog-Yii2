<?php
return [
    'id' => 'app-common-tests',
    'language' => 'en-US',
    'sourceLanguage' => 'en-US',
    'basePath' => dirname(__DIR__),
    'components' => [
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'common\models\User',
        ],
    ],
];
