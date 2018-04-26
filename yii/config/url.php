<?php

return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'enableStrictParsing' => true,

    'rules' => [

        '' => 'site/index',
        'dashboard' => 'site/index',
        'server/check' => 'server/check',
        'server/info' => 'server/info',
        'server/province' => 'server/province',

        [
            'pattern' => '<controller>/<action>',
            'route' => '<controller>/<action>',
            'suffix' => '',
        ],



//        'POST <controller:[\w-]+>s' => '<controller>/create',
//        '<controller:[\w-]+>s' => '<controller>/index',
//
//        'PUT <controller:[\w-]+>/<id:\d+>'    => '<controller>/update',
//        'DELETE <controller:[\w-]+>/<id:\d+>' => '<controller>/delete',
//        '<controller:[\w-]+>/<id:\d+>'        => '<controller>/view',


    ],

];