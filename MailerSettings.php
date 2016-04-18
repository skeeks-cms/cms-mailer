<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 17.04.2016
 */
namespace skeeks\cms\mail;
use skeeks\cms\base\Component;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/**
 * Class MailerSettings
 * @package skeeks\cms\mail
 */
class MailerSettings extends Component
{
    /**
     * @var string E-Mail администратора сайта (отправитель по умолчанию).
     */
    public $senderEmail                  = '';

    /**
     * @var string
     */
    public $senderName                   = '';

    /**
     * @var string E-Mail адрес или список адресов через запятую на который будут дублироваться все исходящие сообщения.
     */
    public $notifyEmailsHidden     = '';

    /**
     * @var string E-Mail адрес или список адресов через запятую на который будут дублироваться все исходящие сообщения.
     */
    public $notifyEmails           = '';



    static public function descriptorConfig()
    {
        return ArrayHelper::merge(parent::descriptorConfig(), [
            'name' => \Yii::t('skeeks/mail', 'Mailer')
        ]);
    }

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [

            [['senderEmail'], 'string'],
            [['senderEmail'], 'email'],

            [['notifyEmailsHidden'], 'string'],
            [['notifyEmails'], 'string'],

            [['notifyEmailsHidden'], 'string'],
            [['notifyEmails'], 'string'],

            [['notifyEmailsHidden'], function($attribute)
            {
                if ($emails = $this->notifyAdminEmailsToArray())
                {
                    foreach ($emails as $email)
                    {
                        $validator = new EmailValidator();

                        if (!$validator->validate($email, $error))
                        {
                            $this->addError($attribute, $email . ' — ' . \Yii::t('skeeks/mail', 'Incorrect email address'));
                            return false;
                        }
                    }
                }

            }],

            [['notifyEmails'], function($attribute)
            {
                if ($emails = $this->notifyAdminEmailsHiddenToArray())
                {
                    foreach ($emails as $email)
                    {
                        $validator = new EmailValidator();

                        if (!$validator->validate($email, $error))
                        {
                            $this->addError($attribute, $email . ' — ' . \Yii::t('skeeks/mail', 'Incorrect email address'));
                            return false;
                        }
                    }
                }

            }],
        ]);
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'senderEmail'               => \Yii::t('skeeks/mail', 'E-mail address of the sender'),
            'senderName'                => \Yii::t('skeeks/mail', 'Name of the sender'),
            'notifyEmails'              => 'Email адреса уведомлений',
            'notifyEmailsHidden'        => 'Изображение заглушка',
        ]);
    }

    public function renderConfigForm(ActiveForm $form)
    {
        echo $form->field($this, 'senderEmail');
        echo $form->field($this, 'senderName');

        echo $form->field($this, 'notifyEmails')->textarea();
        echo $form->field($this, 'notifyEmailsHidden')->textarea();
    }

}