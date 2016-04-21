Mailer for SkeekS CMS
===================================

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist skeeks/cms-mailer "*"
```

or add

```
"skeeks/cms-mailer": "*"
```

Configuration app
----------

```php

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
        'class'         => 'skeeks\cms\mail\Module',
    ]
]

```

##Links
* [Web site](http://en.cms.skeeks.com)
* [Web site (rus)](http://cms.skeeks.com)
* [Author](http://skeeks.com)
* [ChangeLog](https://github.com/skeeks-cms/cms-mailer/blob/master/CHANGELOG.md)

___

> [![skeeks!](https://gravatar.com/userimage/74431132/13d04d83218593564422770b616e5622.jpg)](http://skeeks.com)  
<i>SkeekS CMS (Yii2) — quickly, easily and effectively!</i>  
[skeeks.com](http://skeeks.com) | [en.cms.skeeks.com](http://en.cms.skeeks.com) | [cms.skeeks.com](http://cms.skeeks.com) | [marketplace.cms.skeeks.com](http://marketplace.cms.skeeks.com)


