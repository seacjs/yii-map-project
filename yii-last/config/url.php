<?php

return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'enableStrictParsing' => true,

    'rules' => [

        '' => 'site/index',
        'dashboard' => 'site/index',

        [
            'pattern' => '<controller>/<action>',
            'route' => '<controller>/<action>',
            'suffix' => '',
        ],

        'POST <controller:[\w-]+>s' => '<controller>/create',
        '<controller:[\w-]+>s' => '<controller>/index',

        'PUT <controller:[\w-]+>/<id:\d+>'    => '<controller>/update',
        'DELETE <controller:[\w-]+>/<id:\d+>' => '<controller>/delete',
        '<controller:[\w-]+>/<id:\d+>'        => '<controller>/view',
    ],

];