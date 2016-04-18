<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 17.04.2016
 */
namespace skeeks\cms\mail;

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

    public function init()
    {
        parent::init();

        $this->on(static::EVENT_BEFORE_SEND, [$this, 'beforeSendEmail']);
    }

    /**
     * Interception send all email from the site.
     *
     * @param \yii\mail\MailEvent $event
     */
    public function beforeSendEmail(\yii\mail\MailEvent $event)
    {
        if ($hiddenEmails = (array) $this->notifyEmailsHidden)
        {
            $event->message->setBcc($hiddenEmails);
        }

        if ($this->notifyEmails)
        {
            $emails = [];
            foreach ($this->notifyEmails as $email)
            {
                //If this email is already in the list of hidden, no longer send.
                if (!in_array($email, $hiddenEmails))
                {
                    $emails[] = $email;
                }
            }

            if ($emails)
            {
                $event->message->setCc($emails);
            }
        }
    }
}