<?php

namespace app\controllers;

use app\models\Product;
use app\models\ProductSearch;
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
    $relatedProducts = Product::find()
      ->innerJoin('product_city', 'product.id = product_city.product_id')
      ->where(['product_city.city_id' => $selectedCity])
      ->groupBy(['product.id'])
      ->all();

    return $this->render('view', [
      'model' => $model,
      'selectedCity' => $selectedCity,
      'selectedDate' => $selectedDate,
      'totalGuest' => $totalGuest,
      'relatedProducts' => $relatedProducts
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
