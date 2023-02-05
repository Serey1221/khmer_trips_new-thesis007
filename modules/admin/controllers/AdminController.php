<?php
namespace app\modules\admin\controllers;

use yii\web\Controller;

class AdminController extends Controller
{
    public function actions()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index', 'error'],
                        'allow' => true,
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'layout' => 'error',
            ],
        ];
    }
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function beforeAction($action)
    {
        if ($action->id == 'error') {
            $this->layout = 'error';
        }

        return parent::beforeAction($action);
    }
}
?>
