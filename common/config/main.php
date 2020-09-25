<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'basketCG' => [
            'class' => \common\components\BasketCG::class,
            'cookieName' => 'basketCG',
            //'type' => 'db',
        ],
        'compareCG' => [
            'class' => \common\components\CompareCG::class
        ],
        'favoriteCG' => [
            'class' => \common\components\FavoriteCG::class
        ],
    ],
];
