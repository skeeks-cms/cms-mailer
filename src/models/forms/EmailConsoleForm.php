<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 12.03.2015
 */

namespace skeeks\cms\mail\models\forms;

use skeeks\cms\models\User;
use Yii;
use yii\base\Model;

/**
 * Class EmailConsoleForm
 * @package skeeks\cms\mail\models\forms
 */
class EmailConsoleForm extends Model
{
    public $content;
    public $to;
    public $from;
    public $subject;

    public function attributeLabels()
    {
        return [
            'content'   => \Yii::t('skeeks/mail','Content'),
            'subject'   => \Yii::t('skeeks/mail','Subject'),
            'to'        => \Yii::t('skeeks/mail','To'),
            'from'      => \Yii::t('skeeks/mail','From')
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['subject', 'to', 'from', 'content'], 'required'],
            [['subject', 'to', 'from', 'content'], 'string'],
            [['to', 'from'], 'email'],
        ];
    }



    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function execute()
    {
        if ($this->validate())
        {
            $message = \Yii::$app->mailer->compose('@skeeks/cms/mail/templates/test', [
                'content'      => $this->content,
            ])
            ->setFrom([$this->from => \Yii::$app->cms->appName])
            ->setTo($this->to)
            ->setSubject($this->subject . ' ' . \Yii::$app->cms->appName);

            return $message->send();
        } else
        {
            return false;
        }
    }


}
