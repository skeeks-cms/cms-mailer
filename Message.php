<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 31.07.2015
 */
namespace skeeks\cms\mail;

/**
 * Class Message
 * @package skeeks\cms\mail
 */
class Message extends \yii\swiftmailer\Message
{
    public function init()
    {
        if (!$this->getFrom())
        {
            $this->setFrom([\Yii::$app->cms->adminEmail => \Yii::$app->name]);
        }

        parent::init();
    }
}