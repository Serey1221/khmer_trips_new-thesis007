<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\City;
use yii\db\Expression;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'layout' => 'error',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
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
        // $data = $this->queryData();

        $numberCity = City::find()
            ->where(['id' => 1])
            ->all();

        return $this->render('index', [
            'numberCity' => $numberCity,
        ]);
        // echo '<pre>';
        // print_r($numberCity);
        // echo '</pre';
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
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
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $this->layout = 'package';
        $model = new ContactForm();
        if (
            $model->load(Yii::$app->request->post()) &&
            $model->contact(Yii::$app->params['adminEmail'])
        ) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page
     *
     * @return string
     */
    public function actionService()
    {
        $this->layout = 'package';
        return $this->render('service');
    }
    public function actionAbout()
    {
        $this->layout = 'package';
        return $this->render('about');
    }
    public function actionPackage()
    {
        $this->layout = 'package';

        return $this->render('package');
    }
    public function actionBloggrid()
    {
        $this->layout = 'package';

        return $this->render('bloggrid');
    }
    public function actionDetail()
    {
        $this->layout = 'package';

        return $this->render('detail');
    }
    public function actionDestinat()
    {
        $this->layout = 'package';

        return $this->render('destinat');
    }
    public function actionGuides()
    {
        $this->layout = 'package';

        return $this->render('guides');
    }
    public function actionClient()
    {
        $this->layout = 'package';

        return $this->render('client');
    }
}
