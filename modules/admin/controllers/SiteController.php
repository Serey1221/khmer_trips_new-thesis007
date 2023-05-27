<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\modules\admin\models\LoginForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        Yii::$app->setHomeUrl(Yii::getAlias('@web/admin/admin'));

        $this->layout = 'login';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /*
    public function beforeAction($action)
    {
        // if (parent::beforeAction($action)) {
        //     //change layout for error action after
        //     //checking for the error action name
        //     //so that the layout is set for errors only
        //     if ($action->id == 'error') {
        //         $this->layout = 'error';
        //     }
        //     return true;
        // }
        if (parent::beforeAction($action)) {
            // change layout for error action
            if ($action->id == 'error') {
                $this->layout = 'error';
            }
            return true;
        } else {
            return false;
        }
    }
    */
}
