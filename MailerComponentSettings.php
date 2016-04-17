<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 17.04.2016
 */
namespace skeeks\cms\mailer;
use skeeks\cms\base\Component;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/**
 * Class MailerComponentSettings
 * @package skeeks\cms\mailer
 */
class MailerComponentSettings extends Component
{
    public $theme = '';

    static public function descriptorConfig()
    {
        return ArrayHelper::merge(parent::descriptorConfig(), [
            'name' => \Yii::t('skeeks/view', 'Template')
        ]);
    }

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['theme'], 'string'],
        ]);
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'theme'    => \Yii::t('skeeks/view', 'Theme'),
        ]);
    }

    public function renderConfigForm(ActiveForm $form)
    {
        $themes = [];
        if (\Yii::$app->view instanceof ViewComponent && \Yii::$app->view->themes)
        {
            foreach (\Yii::$app->view->themes as $code => $data)
            {
                if (!$code || !is_string($code))
                {
                    continue;
                }

                $name = ArrayHelper::getValue((array) $data, 'name');
                $themes[$code] = $name ? $name : $code;
            }
        }

        if ($themes)
        {
            echo $form->field($this, 'theme')->listBox($themes, ['size' => 1]);
        } else
        {
            echo \Yii::t('skeeks/view', 'There are no customizable themes in the project');
        }
    }

}