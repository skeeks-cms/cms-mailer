<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010-2014 SkeekS (Sx)
 * @date 30.01.2015
 * @since 1.0.0
 */
/* @var $this yii\web\View */
/* @var $model \skeeks\cms\modules\admin\models\forms\SshConsoleForm */
use yii\helpers\Html;
?>
<div class="row">
    <div class="col-6">
        <div class="sx-bg-secondary" style="padding: 10px;">
            <? $form = \skeeks\cms\base\widgets\ActiveFormAjaxSubmit::begin([
                'action'               => \yii\helpers\Url::to(['submit']),
                'enableAjaxValidation' => false,
                //'enableClientValidation' => false,
                'clientCallback'       => new \yii\web\JsExpression(<<<JS
    function (ActiveFormAjaxSubmit) {
    
            
        ActiveFormAjaxSubmit.on('error', function(e, response) {
            
            ActiveFormAjaxSubmit.AjaxQueryHandler.set("allowResponseSuccessMessage", false);
            ActiveFormAjaxSubmit.AjaxQueryHandler.set("allowResponseErrorMessage", false);
            
            $("#sx-result-error").show().empty();
            $("#sx-result-submit").hide().empty();

            if (response.message) {
                $("#sx-result-error").append(response.message);
            }
        });
        
        
        ActiveFormAjaxSubmit.on('success', function(e, response) {
            
            ActiveFormAjaxSubmit.AjaxQueryHandler.set("allowResponseSuccessMessage", false);
            ActiveFormAjaxSubmit.AjaxQueryHandler.set("allowResponseErrorMessage", false);
            
            $("#sx-result-error").hide().empty();
            $("#sx-result-submit").show().empty();

            if (response.message) {
                $("#sx-result-submit").append(response.message);
            }
        });
    }
JS
                ),
            ]) ?>

            <?= $form->field($model, 'to')->textInput([
                'placeholder' => 'email',
                'value'       => \Yii::$app->user->identity->email,
            ]); ?>

            <?= $form->field($model, 'from')->textInput([
                'placeholder' => 'email',
                'value'       => \Yii::$app->cms->adminEmail,
            ]); ?>

            <?= $form->field($model, 'subject')->textInput([
                'placeholder' => \Yii::t('skeeks/mail', 'Subject'),
                'value'       => \Yii::t('skeeks/mail', 'Letter test'),
            ]); ?>

            <?= $form->field($model, 'content')
                ->widget(
                    \skeeks\cms\widgets\formInputs\comboText\ComboTextInputWidget::class
                );
            ?>

            <?= Html::tag('div',
                Html::submitButton(\Yii::t('skeeks/mail', "Отправить"), ['class' => 'btn btn-primary']),
                ['class' => 'form-group']
            ); ?>

            <div id="sx-result-submit" class="alert-success alert" style="display: none;">
            </div>
            <div id="sx-result-error" class="alert-danger alert" style="display: none;">
            </div>

            <? $form::end() ?>

        </div>
    </div>
    <div class="col-6">
        <h4><?= \Yii::t('skeeks/mail', 'Configuration of component {cms} sending {email}', ['cms' => 'cms', 'email' => 'email']) ?>: </h4>
        <div class="sx-result-config">
        <pre id="sx-result">


<p><?= \Yii::t('skeeks/mail', 'Mail component') ?>: <?= \Yii::$app->mailer->className(); ?></p>

<p><?= \Yii::t('skeeks/mail', 'Transport') ?>: <?= (new \ReflectionObject(\Yii::$app->mailer->transport))->getName(); ?></p>

<? if ($mailerData = \yii\helpers\ArrayHelper::getValue(\Yii::$app->components, "mailer.transport")) : ?>
    <p><?= \Yii::t('skeeks/mail', 'Настройки траспорта из кода: ') ?>: <?= print_r($mailerData, true); ?></p>
<? else: ?>
    <p><?= \Yii::t('skeeks/mail', 'Настройки траспорта из компонента: ') ?>: <?= print_r(\Yii::$app->mailerSettings->toArray(), true); ?></p>
<? endif; ?>

<p><?= \Yii::t('skeeks/mail', 'Transport running') ?>: <?= (int)\Yii::$app->mailer->transport->isStarted(); ?></p>
<p><?= \Yii::t('skeeks/mail', 'Mailer viewPath') ?>: <?= \Yii::$app->mailer->viewPath; ?></p>
<p><?= \Yii::t('skeeks/mail', 'Mailer messageClass') ?>: <?= \Yii::$app->mailer->messageClass; ?></p>
        </pre>
        </div>


        <h4><?= \Yii::t('skeeks/mail', 'Configuration of {php} sending {email}', ['php' => 'php', 'email' => 'email']) ?>: </h4>
        <div class="sx-result-config">
        <pre id="sx-result">
<p><?= \Yii::t('skeeks/mail', 'Sendmail Path') ?>: <?= ini_get('sendmail_path') ?></p>
<p><?= \Yii::t('skeeks/mail', 'Sendmail From') ?>: <?= ini_get('sendmail_from') ?></p>
        </pre>
        </div>
    </div>
</div>




