<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 25.03.2015
 */

namespace skeeks\cms\mail\controllers;

use skeeks\cms\helpers\RequestResponse;
use skeeks\cms\mail\models\forms\EmailConsoleForm;
use skeeks\cms\modules\admin\controllers\AdminController;
use skeeks\cms\modules\admin\controllers\helpers\rules\NoModel;
use skeeks\cms\modules\admin\models\forms\SshConsoleForm;
use skeeks\cms\rbac\CmsManager;
use yii\base\Exception;

/**
 * Class IndexController
 * @package skeeks\cms\modules\admin\controllers
 */
class AdminTestController extends AdminController
{
    public function init()
    {
        $this->name = \Yii::t('skeeks/mail', "Testing send email messages from site");

        $this->generateAccessActions = false;
        $this->permissionName = CmsManager::PERMISSION_ROLE_ADMIN_ACCESS;

        parent::init();
    }

    public function actionIndex()
    {
        $model = new EmailConsoleForm();

        $result = "";

        try {
            if ($model->load(\Yii::$app->request->post()) && $model->execute()) {
                $result = \Yii::t('skeeks/mail', "Submitted");
            } else {
                if (\Yii::$app->request->post()) {
                    $result = \Yii::t('skeeks/mail', "Not sent");
                }
            }
        } catch (\Exception $e) {
            //throw $e;
            $result = \Yii::t('skeeks/mail', "Not sent").": ".$e->getMessage();
        }


        return $this->render('index', [
            'model'  => $model,
            'result' => $result,
        ]);
    }


    public function actionSubmit()
    {
        $rr = new RequestResponse();
        $model = new EmailConsoleForm();

        if ($rr->isRequestAjaxPost()) {
            try {
                if ($model->load(\Yii::$app->request->post()) && $model->execute()) {
                    $rr->success = true;
                    $rr->message = "Письмо успешно отправлено";
                } else {
                    throw new Exception("Письмо не отправлено: ".print_r($model->errors, true));
                }
            } catch (\Exception $e) {
                //throw $e;
                $rr->success = false;
                $rr->message = $e->getMessage();
            }
        }

        return $rr;
    }


}