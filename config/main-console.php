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
            'view'          =>
            [
                'theme' =>
                [
                    'pathMap' =>
                    [
                        '@app/mail' =>
                        [
                            '@app/mail',
                            '@skeeks/cms/mail/templates'
                        ]
                    ]
                ]
            ]
        ],

        'mailerSettings' => [
            'class'         => 'skeeks\cms\mail\MailerSettings',
        ],

        'i18n' => [
            'translations' =>
            [
                'skeeks/mail' => [
                    'class'             => 'yii\i18n\PhpMessageSource',
                    'basePath'          => '@skeeks/cms/mail/messages',
                    'fileMap' => [
                        'skeeks/mail' => 'main.php',
                    ],
                ]
            ]
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