<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Gallery;
use Yii;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class GalleryController extends Controller
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
    $model = Gallery::find()->all();

    return $this->render('index', [
      'model' => $model,
    ]);
  }

  public function actionForm($id = 0)
  {
    $model = !empty(Gallery::findOne($id)) ? Gallery::findOne($id) : new Gallery();
    $model->scenario = 'admin';
    if ($this->request->isPost && $model->load($this->request->post())) {

      $transaction_exception = Yii::$app->db->beginTransaction();

      try {
        // echo "<pre>";
        // print_r($model->img_url);
        // exit();
        if (!$model->save()) throw new Exception(Yii::$app->formater->errToString($model->getErrors()));

        $transaction_exception->commit();
        Yii::$app->session->setFlash('success', "Data saved successfully");
        return $this->redirect(Yii::$app->request->referrer);
      } catch (Exception $ex) {
        Yii::$app->session->setFlash('warning', $ex->getMessage());
        $transaction_exception->rollBack();
        return $this->redirect(Yii::$app->request->referrer);
      }
    }


    return $this->renderAjax('form', [
      'model' => $model,
    ]);
  }
}
