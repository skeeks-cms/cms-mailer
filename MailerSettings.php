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

            [['notifyEmailsHidden'], 'string'],
            [['notifyEmails'], 'string'],

            [['notifyEmailsHidden'], function($attribute)
            {
                if ($emails = explode(',', $this->notifyEmailsHidden))
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
                if ($emails = explode(',', $this->notifyEmails))
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
            'notifyEmails'              => \Yii::t('skeeks/mail', 'Duplicate all sent letters'),
            'notifyEmailsHidden'        => \Yii::t('skeeks/mail', 'Duplicate all sent letters as hidden'),
        ]);
    }

    public function renderConfigForm(ActiveForm $form)
    {
        echo $form->field($this, 'notifyEmails')->textarea();
        echo $form->field($this, 'notifyEmailsHidden')->textarea();
    }

}