<?php
namespace app\modules\admin;
use Yii;

class Admin extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\admin\controllers';
    public $layout = 'main';
    public $defaultRoute = 'admin/index';
    public function init()
    {
        parent::init();

        $this->layout = '@app/modules/admin/views/layouts/main';
        Yii::$app->errorHandler->errorAction = 'admin/admin/error';
        Yii::$app->user->loginUrl = ['admin/site/login'];
    }
}
?>
