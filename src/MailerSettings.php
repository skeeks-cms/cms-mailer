<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 17.04.2016
 */

namespace skeeks\cms\mail;

use skeeks\cms\base\Component;
use skeeks\yii2\form\fields\FieldSet;
use skeeks\yii2\form\fields\HtmlBlock;
use skeeks\yii2\form\fields\SelectField;
use skeeks\yii2\form\fields\TextareaField;
use yii\helpers\ArrayHelper;
use yii\validators\EmailValidator;
use yii\widgets\ActiveForm;

/**
 * Class MailerSettings
 * @package skeeks\cms\mail
 */
class MailerSettings extends Component
{
    /**
     * @var string E-Mail адрес или список адресов через запятую на который будут дублироваться все исходящие сообщения.
     */
    public $notifyEmailsHidden = '';

    /**
     * @var string E-Mail адрес или список адресов через запятую на который будут дублироваться все исходящие сообщения.
     */
    public $notifyEmails = '';

    public $transport_class = '';
    public $transport_host = '';
    public $transport_username = '';
    public $transport_password = '';
    public $transport_port = '';
    public $transport_encryption = '';


    static public function descriptorConfig()
    {
        return ArrayHelper::merge(parent::descriptorConfig(), [
            'name' => \Yii::t('skeeks/mail', 'Mailer'),
        ]);
    }

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [

            [['notifyEmailsHidden'], 'string'],
            [['notifyEmails'], 'string'],

            [['transport_class'], 'string'],
            [[
                'transport_host',
                'transport_password',
                'transport_port',
                'transport_encryption',
                'transport_username',
            ], 'string'],

            [[
                'transport_host',
                'transport_password',
                'transport_port',
                'transport_encryption',
                'transport_username',
            ], 'required', 'when' => function() {
                return ($this->transport_class == "Swift_SmtpTransport");
            }],

            [
                [
                    'transport_host',
                    'transport_password',
                    'transport_port',
                    'transport_encryption',
                    'transport_username',
                ], function($attribute) {
                    if ($this->transport_class != "Swift_SmtpTransport") {
                        if ($this->{$attribute} != "") {
                            $this->addError($attribute, "{$attribute} должен быть пустым");
                            return false;
                        }
                    }

                    return true;
                }
            ],

            [
                ['notifyEmailsHidden'],
                function ($attribute) {
                    if ($emails = explode(',', $this->notifyEmailsHidden)) {
                        foreach ($emails as $email) {
                            $validator = new EmailValidator();

                            if (!$validator->validate($email, $error)) {
                                $this->addError($attribute, $email.' — '.\Yii::t('skeeks/mail', 'Incorrect email address'));
                                return false;
                            }
                        }
                    }

                },
            ],

            [
                ['notifyEmails'],
                function ($attribute) {
                    if ($emails = explode(',', $this->notifyEmails)) {
                        foreach ($emails as $email) {
                            $validator = new EmailValidator();

                            if (!$validator->validate($email, $error)) {
                                $this->addError($attribute, $email.' — '.\Yii::t('skeeks/mail', 'Incorrect email address'));
                                return false;
                            }
                        }
                    }

                },
            ],
        ]);
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'notifyEmails'       => \Yii::t('skeeks/mail', 'Duplicate all sent letters'),
            'notifyEmailsHidden' => \Yii::t('skeeks/mail', 'Duplicate all sent letters as hidden'),

            'transport_username' => \Yii::t('skeeks/mail', 'Пользователь'),
            'transport_password' => \Yii::t('skeeks/mail', 'Пароль'),
            'transport_port' => \Yii::t('skeeks/mail', 'Порт'),
            'transport_host' => \Yii::t('skeeks/mail', 'Хост'),
            'transport_encryption' => \Yii::t('skeeks/mail', 'Шифрование'),
            'transport_class' => \Yii::t('skeeks/mail', 'Тип отправщика'),
        ]);
    }

    public function renderConfigForm(ActiveForm $form)
    {
        echo $form->field($this, 'notifyEmails')->textarea();
        echo $form->field($this, 'notifyEmailsHidden')->textarea();
    }


    /**
     * @return array
     */
    public function getConfigFormFields()
    {

        if ($mailerTransport = ArrayHelper::getValue(\Yii::$app->components, 'mailer.transport')) {
            $mailer = print_r($mailerTransport, true);
            $transport[] = [
                'class' => HtmlBlock::class,
                'content' => <<<HTML
Транспорт настроен программистом в файлах конфигов:
<pre>
{$mailer}
</pre>
HTML

            ];

        } else {
            $transport['transport_class'] = [
                'class'          => SelectField::class,
                'items'          => [
                    ''                    => 'Не настраивать',
                    'Swift_SmtpTransport' => 'Отправка через smtp',
                ],
                'elementOptions' => [
                    'data' => [
                        'form-reload' => 'true',
                    ],
                ],
            ];

            if ($this->transport_class == "Swift_SmtpTransport") {
                $transport[] = [
                    'class' => HtmlBlock::class,
                'content' => <<<HTML
                <div class="" style="margin-bottom: 20px;">
<a href="#" class="btn btn-default btn-xs sx-yandex-smtp" >Заполнить настройки для Yandex</a>
<br />
<br />
<a href="https://yandex.ru/support/mail/mail-clients.html" target="_blank">Документация yandex</a>
</div>
HTML
                ];
                $transport['transport_host'] = [];
                $transport['transport_port'] = [];
                $transport['transport_encryption'] = [];
                $transport['transport_username'] = [];
                $transport['transport_password'] = [];

                \Yii::$app->view->registerJs(<<<JS
$(".sx-yandex-smtp").on('click', function() {
    $("#mailersettings-transport_host").val('smtp.yandex.ru');
    $("#mailersettings-transport_port").val('465');
    $("#mailersettings-transport_encryption").val('ssl');
    return false;
});
JS
                );
            } else {
                $this->transport_host = '';
                $this->transport_port = '';
                $this->transport_encryption = '';
                $this->transport_password = '';
                $this->transport_password = '';
            }
        }




        return [
            'main'      => [
                'class'  => FieldSet::class,
                'name'   => 'Настройки уведомлений',
                'fields' => [
                    'notifyEmails'       => [
                        'class' => TextareaField::class,
                    ],
                    'notifyEmailsHidden' => [
                        'class' => TextareaField::class,
                    ],
                ],
            ],
            'transport' => [
                'class'  => FieldSet::class,
                'name'   => 'Настройки транспорта',
                'fields' => $transport,
            ],
        ];
    }

}