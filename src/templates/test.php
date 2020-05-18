<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */
?>
<?= \skeeks\cms\mail\helpers\Html::beginTag("h1"); ?>
<?=\Yii::t('skeeks/mail','Тестовое сообщение')?> <?= \Yii::$app->cms->appName; ?>
<?= \skeeks\cms\mail\helpers\Html::endTag("h1"); ?>

<p style="font:Arial,Helvetica,sans-serif;">
    <?= $content; ?>
</p>
