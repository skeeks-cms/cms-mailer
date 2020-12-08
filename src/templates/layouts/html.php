<?php
use yii\helpers\Html;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */


?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?= \Yii::$app->charset ?>"/>
    <title><?= Html::encode($this->title) ?></title>
    <style>
        h1 {
            color: #333;
            font-size: 32px;
            font-weight: normal;
            margin-bottom: 13px;
            margin-top: 0px;
            line-height: 37px;
        }

        h2 {
            color: #333;
            font-size: 28px;
            font-weight: normal;
            margin-bottom: 10px;
            margin-top: 0px;
        }

        h3 {
            color: #333;
            font-size: 24px;
            font-weight: normal;
            margin-bottom: 7px;
            margin-top: 0px;
        }

        h4 {
            color: #333;
            font-size: 20px;
            font-weight: normal;
            margin-bottom: 6px;
            margin-top: 0px;
        }

        h5 {
            color: #333;
            font-size: 16px;
            font-weight: normal;
            margin-bottom: 6px;
            margin-top: 0px;
        }

        p {
            margin-bottom: 5px;
            margin-top: 0;
        }

        body {
            font: Arial, Helvetica, sans-serif;
        }

        hr {
            margin: 0;
            border-bottom: 1px solid #c0c0c063;
            /* height: 1px; */
            /* color: transparent; */
            /* color: white; */
            background: none;
            border-top: 0;
            border-left: 0;
            border-right: 0;
            margin-bottom: 10px;
        }

        table td {
            padding: 5px;
        }

        table tr {
            border-bottom: 1px solid #eaeaea;
        }
    </style>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div style="width:100%;min-width:700px;background-position:0 0;background-repeat:no-repeat;border:0 none;font-size:100%;font-style:inherit;font-weight:inherit;font:Arial,Helvetica,sans-serif;margin:0;padding:0;text-align:left;vertical-align:baseline;">
    <div style="background: #eaeaea; color:#363636; padding:20px;">
        <div style="width:92%;margin:20px auto 20px;padding:10px;background:#fff;">
            <table style="width: 100%;">
                <tbody>
                <tr>
                    <td colspan="2">
                        <?= $content; ?>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <p style="border-bottom: 1px solid #eaeaea;"></p>
                    </td>
                </tr>

                <tr>
                    <td valign="center" style="
                    width: 50px;
    height: 30px;
    line-height: 30px;">
                        <a href="<?= \Yii::$app->cms->homePage; ?>" target="_blank" style="width: 50px;">
                            <?php if (\Yii::$app->skeeks->site->image) : ?>
                                <img style="max-height: 50px;" src="<?= \Yii::$app->skeeks->site->image->absoluteSrc; ?>">
                            <?php else : ?>
                                <img style="max-height: 50px;" src="<?= \Yii::$app->cms->logo(); ?>">
                            <?php endif; ?>
                        </a>
                    </td>
                    <td valign="top">
                        <p style="font-size:11px;padding:1px 0 0;line-height:50px;margin:0 0 1px;">
                            <?= \Yii::t('skeeks/mail', 'If you have any problems with our website'); ?> — <a href="mailto:<?= \Yii::$app->cms->adminEmail; ?>"><?= \Yii::t('skeeks/mail',
                                    'please do not hesitate to contact us'); ?></a>.
                            <?php /*if(\Yii::$app->skeeks->site->cmsSitePhone) : */ ?><!--
                                <br /><a href="tel:<?php /*echo \Yii::$app->skeeks->site->cmsSitePhone->value; */ ?>"><?php /*echo \Yii::$app->skeeks->site->cmsSitePhone->value; */ ?></a>
                            --><?php /*endif; */ ?>

                        </p>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>



