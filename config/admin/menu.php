<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 12.03.2015
 */
return [

    'other' =>
    [
        'items' =>
        [
            [
                "label"     => \Yii::t('skeeks/mail', 'Mailer'),
                "img"       => ['\skeeks\cms\mail\assets\MailerAsset', 'icons/email.png'],

                'items' =>
                [
                    [
                        "label"     => \Yii::t('skeeks/mail', 'Testing sending'),
                        "url"       => ["mailer/admin-test"],
                        "img"       => ['\skeeks\cms\mail\assets\MailerAsset', 'icons/email.png'],
                    ],

                    [
                        "label" => \Yii::t('skeeks/mail', 'Settings'),
                        "url"   => ["cms/admin-settings", "component" => 'skeeks\cms\mail\MailerSettings'],
                        "img"       => ['\skeeks\cms\modules\admin\assets\AdminAsset', 'images/icons/settings.png'],
                        "activeCallback"       => function(\skeeks\cms\modules\admin\helpers\AdminMenuItem $adminMenuItem)
                        {
                            return (bool) (\Yii::$app->request->getUrl() == $adminMenuItem->getUrl());
                        },
                    ],
                ]
            ],
        ]
    ]
];