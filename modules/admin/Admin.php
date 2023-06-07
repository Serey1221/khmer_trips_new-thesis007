<?php

namespace app\modules\admin;

use Yii;

class Admin extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\admin\controllers';
    public $layout = 'main';
    public $defaultRoute = 'dashboard';

    public function init()
    {
        parent::init();

        $this->layout = '@app/modules/admin/views/layouts/main';

        Yii::$app->errorHandler->errorAction = 'admin/admin/error';

        Yii::$app->homeUrl = Yii::getAlias('@web/admin/dashboard');

        Yii::$app->user->identityClass = 'app\modules\admin\models\User';
        Yii::$app->user->loginUrl = ['admin/site/login'];
        Yii::$app->user->idParam = '_khmertravelAdminParamID';
        Yii::$app->user->identityCookie = ['name' => '_identity-admin-khmertravel', 'httpOnly' => false];

        Yii::$app->set('session', [
            'class' => 'yii\web\Session',
            'name' => 'admin-khmertravel',
        ]);
    }
}
