<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 17.04.2016
 */
namespace skeeks\cms\mail;

use yii\helpers\ArrayHelper;
/**
 * Class Mailer
 * @package skeeks\cms\mail
 */
class Mailer extends \yii\swiftmailer\Mailer
{
    /**
     * @var string message default class name.
     */
    public $messageClass = 'skeeks\cms\mail\Message';

    /**
     * @var array Duplicate all sent messages
     */
    public $notifyEmails        = [];

    /**
     * @var array Duplicate all sent letters as hidden
     */
    public $notifyEmailsHidden  = [];


    /**
     * @var array
     */
    public $tagStyles =
    [
        'h1' => 'color:#1D5800;font-size:32px;font-weight:normal;margin-bottom:13px;margin-top:20px;',
        'h2' => 'color:#1D5800;font-size:28px;font-weight:normal;margin-bottom:10px;margin-top:17px;',
        'h3' => 'color:#1D5800;font-size:24px;font-weight:normal;margin-bottom:7px;margin-top:14px;',
        'h4' => 'color:#1D5800;font-size:20px;font-weight:normal;margin-bottom:6px;margin-top:11px;',
        'h5' => 'color:#1D5800;font-size:16px;font-weight:normal;margin-bottom:6px;margin-top:8px;',
        'p' => 'font:Arial,Helvetica,sans-serif;',
    ];

    public function init()
    {
        //Если транспорт не настроен программистом, пробуем взять настрйки из админки
        if (!ArrayHelper::getValue(\Yii::$app->components, 'mailer.transport')) {
            if (\Yii::$app->mailerSettings->transport_class) {
                $this->transport = [
                    'class'      => \Yii::$app->mailerSettings->transport_class,
                    'host'       => \Yii::$app->mailerSettings->transport_host,
                    'username'   => \Yii::$app->mailerSettings->transport_username,
                    'password'   => \Yii::$app->mailerSettings->transport_password,
                    'port'       => \Yii::$app->mailerSettings->transport_port,
                    'encryption' => \Yii::$app->mailerSettings->transport_encryption,
                ];
            }
        }

        parent::init();

        if (\Yii::$app->mailerSettings)
        {
            if (\Yii::$app->mailerSettings->notifyEmailsHidden)
            {
                $this->notifyEmailsHidden = explode(',', \Yii::$app->mailerSettings->notifyEmailsHidden);
            }

            if (\Yii::$app->mailerSettings->notifyEmails)
            {
                $this->notifyEmails = explode(',', \Yii::$app->mailerSettings->notifyEmails);
            }
        }



        $this->on(static::EVENT_BEFORE_SEND, [$this, 'beforeSendEmail']);
    }

    /**
     * Interception send all email from the site.
     *
     * @param \yii\mail\MailEvent $event
     */
    public function beforeSendEmail(\yii\mail\MailEvent $event)
    {
        $to = $event->message->getTo();

        if ($hiddenEmails = (array) $this->notifyEmailsHidden)
        {
            $hiddenEmailsReady = [];
            foreach ($hiddenEmails as $email)
            {
                //If this email is already in the list of hidden, no longer send.
                if (!isset($to[$email]))
                {
                    $hiddenEmailsReady[] = $email;
                }
            }

            if ($hiddenEmailsReady)
            {
                $event->message->setBcc($hiddenEmailsReady);
            }
        }

        if ($this->notifyEmails)
        {
            $notifyEmailsReady = [];
            foreach ($this->notifyEmails as $email)
            {
                //If this email is already in the list of hidden, no longer send.
                if (!in_array($email, $hiddenEmails))
                {
                    $notifyEmailsReady[] = $email;
                }
            }

            if ($notifyEmailsReady)
            {
                $event->message->setCc($notifyEmailsReady);
            }
        }
    }
}