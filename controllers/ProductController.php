<?php

namespace app\controllers;

use app\models\Product;
use app\models\ProductSearch;
use app\models\UserWishlist;
use app\modules\admin\models\ProductGallery;
use app\modules\admin\models\ProductItinerary;
use Yii;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ProductController extends \yii\web\Controller
{
  public function actions()
  {
    return [
      'error' => [
        'class' => 'yii\web\ErrorAction',
      ],
    ];
  }
  public function actionIndex()
  {
    $searchModel = new ProductSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }
  public function actionView($id, $selectedCity, $selectedDate, $totalGuest)
  {
    $model = $this->findModel($id);
    $modelGallery = ProductGallery::find()->where(['product_id' => $model->id])->all();
    $relatedProducts = Product::find()
      ->innerJoin('product_city', 'product.id = product_city.product_id')
      ->where(['product_city.city_id' => $selectedCity])
      ->groupBy(['product.id'])
      ->all();

    $modelItinerary = ProductItinerary::find()
      ->where(['product_id' => $model->id])
      ->all();

    return $this->render('view', [
      'model' => $model,
      'selectedCity' => $selectedCity,
      'selectedDate' => $selectedDate,
      'totalGuest' => $totalGuest,
      'relatedProducts' => $relatedProducts,
      'modelGallery' => $modelGallery,
      'modelItinerary' => $modelItinerary
    ]);
  }

  public function actionDependent()
  {
    /** @var \app\components\Rate $tate */
    $rate = Yii::$app->rate;
    if ($this->request->isAjax && $this->request->isPost) {
      if ($this->request->post('action') == 'search-availability') {
        $productCode = $this->request->post('productCode');
        $departure_date = $this->request->post('departure_date');

        $model = Product::findOne(['code' => $productCode]);
        if (!empty($model)) {
          return $rate->getPrice($model->id, $departure_date);
        }
        return 0;
      }
      if ($this->request->post('action') == 'update-wishlist') {
        $productCode = $this->request->post('productCode');
        $type = $this->request->post('type');
        $user_id = Yii::$app->user->identity->id;
        $product = Product::findOne(['code' => $productCode]);
        if ($type == 'add') {
          $wishlist = new UserWishlist();
          $wishlist->product_id = $product->id;
          $wishlist->user_id = $user_id;
          if ($wishlist->save()) {
            $status = 'added';
          }
        } else if ($type == 'remove') {
          $wishlist = UserWishlist::findOne(['product_id' => $product->id, 'user_id' => $user_id]);
          if ($wishlist->delete()) {
            $status = 'removed';
          }
        } else {
          $status = 'error';
        }
        $count = UserWishlist::find()->where(['user_id' => $user_id])->count();
        return json_encode(['status' => $status, 'total' => $count]);
      }
    }
  }

  public function actionValidation($id = null)
  {

    $model = $id === null ? new Product() : Product::findOne($id);
    if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
      Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      return \yii\widgets\ActiveForm::validate($model);
    }
  }

  protected function findModel($id)
  {
    if (($model = Product::findOne(['code' => $id])) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
