<?php

return [

    'components' => [
        'mailer' => [
            'class' => 'skeeks\cms\mail\Mailer',
            'view'  => [
                'theme' => [
                    'pathMap' => [
                        '@app/mail' => [
                            '@app/mail',
                            '@common/mail',
                            '@skeeks/cms/mail/templates',
                        ],
                    ],
                ],
            ],
        ],

        'mailerSettings' => [
            'class' => 'skeeks\cms\mail\MailerSettings',
        ],

        'i18n' => [
            'translations' => [
                'skeeks/mail' => [
                    'class'    => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@skeeks/cms/mail/messages',
                    'fileMap'  => [
                        'skeeks/mail' => 'main.php',
                    ],
                ],
            ],
        ],

        'authManager' => [
            'config' => [
                'roles' => [
                    [
                        'name'  => \skeeks\cms\rbac\CmsManager::ROLE_ADMIN,
                        'child' => [
                            //Есть доступ к системе администрирования
                            'permissions' => [
                                "mailer/admin-test",
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];