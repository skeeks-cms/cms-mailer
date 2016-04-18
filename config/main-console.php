<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 27.08.2015
 */
return [

    'components' =>
    [
        'mailer' => [
            'class'         => 'skeeks\cms\mail\Mailer',
        ],
    ],

    'modules' =>
    [
        'mailer' => [
            'class'                 => 'skeeks\cms\mail\Module',
            "controllerNamespace"   => 'skeeks\cms\mail\console\controllers'
        ]
    ]
];