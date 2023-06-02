<?php

namespace app\controllers;

use app\models\Article;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\City;
use app\models\Gallery;
use app\models\GuideProfile;
use app\models\Product;
use app\models\RegisterForm;
use app\models\RegisterUser;
use app\models\User;
use Exception;
use app\models\ArticleSearch;
use app\models\ProductSearch;
use yii\data\Pagination;
use yii\db\Expression;
use yii\web\NotFoundHttpException;

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
    public function newproductData()
    {
        return Product::find()
            ->where(['status' => 1])
            ->orderBy(['created_at' => SORT_DESC])
            ->one();
    }
    public function threeproductData()
    {
        return Product::find()
            ->where(['status' => 1])
            ->orderBy(['created_at' => SORT_DESC])
            ->limit(3)
            ->all();
    }
    public function productData()
    {
        return Product::find()
            ->where(['status' => 1])
            ->orderBy(new Expression('rand()'))
            ->limit(6)
            ->all();
    }
    public function cityData()
    {
        return City::find()
            ->where(['status' => 1])
            ->orderBy(new Expression('rand()'))
            ->limit(6)
            ->all();
    }
    public function guideData()
    {
        return GuideProfile::find()
            ->where(['status' => 1])
            ->orderBy(new Expression('rand()'))
            ->limit(4)
            ->all();
    }
    public function blogData()
    {
        return Article::find()
            ->where(['status' => 1])
            ->orderBy(new Expression('rand()'))
            ->limit(8)
            ->all();
    }
    public function threeblogData()
    {
        return Article::find()
            ->where(['status' => 1])
            ->orderBy(new Expression('rand()'))
            ->limit(3)
            ->all();
    }
    protected function findModelBySlug($slug)
    {
        if (($model = Article::findOne(['slug' => $slug])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException();
        }
    }
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        $city = $this->cityData();
        $guide = $this->guideData();
        $blog = $this->blogData();
        $threeblog = $this->threeblogData();
        $product = $this->productData();

        // echo '<pre>';
        // print_r($numberCity);
        // echo '</pre>';

        $searchModel = new ProductSearch();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'city' => $city,
            'guide' => $guide,
            'blog' => $blog,
            'threeblog' => $threeblog,
            'product' => $product,

        ]);
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
        if ($model->load(Yii::$app->request->post())) {
            if ($model->login()) {
                // return $this->goBack();
                return $this->redirect(Yii::$app->request->referrer);
            }
        }

        $model->password = '';
        return $this->renderAjax('//auth/login', [
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

    public function actionRegister()
    {
        if ($this->request->isPost) {

            $transaction_exception = Yii::$app->db->beginTransaction();

            try {

                $user = new RegisterUser();
                $user->email = $this->request->post('registerEmail');
                $user->auth_key =  Yii::$app->security->generateRandomString();
                $user->username = $user->email;
                $user->password_hash = Yii::$app->security->generatePasswordHash($this->request->post('registerPassword'));
                $user->status = 1;
                $user->created_at = date("Y-m-d H:i:s");
                $user->user_type = 2;
                if (!$user->save()) throw new Exception("Failed to Save! Code #001");

                $model = new RegisterForm();
                $model->first_name = $this->request->post('registerFirstName');
                $model->last_name = $this->request->post('registerLastName');
                $model->phone_number = $this->request->post('registerPhonenumber');
                $model->user_id = $user->id;
                $model->email = $this->request->post('registerEmail');
                if (!$model->save()) throw new Exception("Failed to Save! Code #002");

                $identity = RegisterUser::findOne(['username' => $user->username]);
                Yii::$app->user->login($identity, 3600 * 24 * 30);

                $transaction_exception->commit();
                Yii::$app->session->setFlash('success', "You have register successfully");
                return $this->redirect(Yii::$app->request->referrer);
            } catch (Exception $ex) {
                $transaction_exception->rollBack();
                echo "<pre>";
                print_r($ex->getMessage());
                exit;
                // Yii::$app->session->setFlash('warning', $ex->getMessage());
                $transaction_exception->rollBack();
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $this->layout = 'package';
        $searchModel = new ProductSearch();
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
            'searchModel' => $searchModel
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
        $searchModel = new ProductSearch();

        return $this->render('service', [
            'searchModel' => $searchModel,
        ]);
    }
    public function actionAbout()
    {
        $this->layout = 'package';
        $searchModel = new ProductSearch();
        return $this->render('about', [
            'searchModel' => $searchModel,
        ]);
    }
    public function actionPackage()
    {
        $this->layout = 'package';

        $city = $this->cityData();
        $product = $this->productData();
        $newproduct = $this->newproductData();
        $searchModel = new ProductSearch();

        return $this->render('package', [
            'city' => $city,
            'product' => $product,
            'newproduct' => $newproduct,
            'searchModel' => $searchModel
        ]);
    }
    public function actionBloggrid()
    {
        $searchModel = new ArticleSearch();
        $this->layout = 'package';
        $searchModel = new ProductSearch();

        // //preparing the query
        // $query = Article::find();
        // // get the total number of users
        // $count = $query->count();
        // //creating the pagination object
        // $pagination = new Pagination(['totalCount' => $count, 'defaultPageSize' => 1]);
        // //limit the query using the pagination and retrieve the users
        // $models = $query->offset($pagination->offset)
        //     ->limit($pagination->limit)
        //     ->all();

        $blog = $this->blogData();
        $threeblog = $this->threeblogData();

        return $this->render('bloggrid', [
            'blog' => $blog,
            'threeblog' => $threeblog,
            // 'models' => $models,
            // 'pagination' => $pagination,
            'searchModel' => $searchModel
        ]);
    }
    public function actionDetail($slug = '')
    {
        $threeblog = $this->threeblogData();


        return $this->render('detail', [
            'threeblog' => $threeblog,
            'model' => $this->findModelBySlug($slug),
        ]);
    }
    public function actionDestination()
    {
        $this->layout = 'package';

        return $this->render('destination');
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
    public function actionBooking()
    {

        $numberCity = City::find()
            ->indexBy('id')
            ->all();

        return $this->render('booking', [
            'numberCity' => $numberCity,
        ]);
    }
    public function actionBookingDetail()
    {

        $threeproduct = $this->threeproductData();

        return $this->render('booking-detail', [
            'threeproduct' => $threeproduct,
        ]);
    }
    public function actionAddCart()
    {

        return $this->render('add-cart');
    }
    public function actionCheckout()
    {
        return $this->render('checkout');
    }
    public function actionSuccessPay()
    {
        $this->layout = 'success';

        return $this->render('success-pay');
    }
    public function actionAvailability()
    {
        return $this->render('availability');
    }
    public function actionSearch()
    {
        return $this->render('carousel-search');
    }
    public function actionWishlist()
    {
        if (Yii::$app->user->isGuest) {
            $model = [];
        } else {
            $model = Product::find()
                ->innerJoin('user_wishlist', 'product.id = user_wishlist.product_id')
                ->where(['user_id' => Yii::$app->user->identity->id])
                ->all();
        }
        return $this->render('wishlist', ['model' => $model]);
    }
}
