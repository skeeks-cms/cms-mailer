<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 27.08.2015
 */
return [

    'components' => [
        'backendAdmin' => [
            'menu' => [
                'data' => [
                    'settings' => [
                        'items' => [
                            [
                                "name"     =>['skeeks/mail', 'Mailer'],
                                "image"       => ['\skeeks\cms\assets\CmsAsset', 'images/icons/admin-menu/mail.svg'],
                
                                'items' =>
                                [
                                    [
                                        "name"     =>['skeeks/mail', 'Testing sending'],
                                        "url"       => ["mailer/admin-test"],
                                        "image"       => ['\skeeks\cms\assets\CmsAsset', 'images/icons/admin-menu/mail.svg'],
                                    ],
                
                                    [
                                        "name" =>['skeeks/mail', 'Settings'],
                                        "url"   => ["cms/admin-settings", "component" => 'skeeks\cms\mail\MailerSettings'],
                                        "image"       => ['\skeeks\cms\assets\CmsAsset', 'images/icons/admin-menu/settings.svg'],
                                        "activeCallback"       => function($adminMenuItem) {
                                            return (bool) (\Yii::$app->request->getUrl() == $adminMenuItem->getUrl());
                                        },
                                    ],
                                ]
                            ],
                        ]
                    ]
                ],
            ],
        ],
    ],
    
    'modules'    => [
        'mailer' => [
            'class' => 'skeeks\cms\mail\Module',
        ],
    ],
];
