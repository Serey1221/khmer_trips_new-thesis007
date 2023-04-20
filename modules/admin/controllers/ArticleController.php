<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Article;
use app\modules\admin\models\ArticleSearch;
use Yii;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class ArticleController extends Controller
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

    $searchModel = new ArticleSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    $total_items = $dataProvider->getTotalCount();

    // list($page_size, $page) = \app\components\IndexPageSize::get($total_items);

    // $dataProvider->pagination->pageSize = $page_size;
    // $dataProvider->pagination->page = $page;

    return $this->render('index', [
      //'page_size' => $page_size,
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }

  /**
   * Creates a new Blog model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreate()
  {
    $model = new Article();

    if ($this->request->isPost && $model->load($this->request->post())) {

      $transaction_exception = Yii::$app->db->beginTransaction();

      try {

        if (!$model->save()) throw new Exception("Failed to Save! Code #001");

        $transaction_exception->commit();
        Yii::$app->session->setFlash('success', "Post saved successfully");

        $submit_type = $this->request->post('submit_type');
        if ($submit_type == 'save') {
          return $this->redirect(['update', 'id' => $model->id]);
        } else if ($submit_type == 'save_add_new') {
          return $this->redirect('create');
        } else if ($submit_type == 'save_close') {
          return $this->redirect(['index']);
        }
      } catch (Exception $ex) {
        Yii::$app->session->setFlash('warning', $ex->getMessage());
        $transaction_exception->rollBack();
        return $this->redirect(Yii::$app->request->referrer);
      }
    }

    return $this->render('create', [
      'model' => $model,
    ]);
  }

  public function actionUpdate($id)
  {
    $model = $this->findModel($id);

    if ($this->request->isPost && $model->load($this->request->post())) {

      $transaction_exception = Yii::$app->db->beginTransaction();

      try {
        if (!$model->save()) throw new Exception("Failed to Save! Code #001");

        $transaction_exception->commit();
        Yii::$app->session->setFlash('success', "Post saved successfully");
        $submit_type = $this->request->post('submit_type');
        if ($submit_type == 'save') {
          return $this->redirect(Yii::$app->request->referrer);
        } else if ($submit_type == 'save_add_new') {
          return $this->redirect('create');
        } else if ($submit_type == 'save_close') {
          return $this->redirect(['index']);
        } else if ($submit_type == 'save_duplicate') {
          $newModel = $model;
          $newModel->id = null;
          $newModel->isNewRecord = true;
          $newModel->title = $newModel->title . '-copy';
          $newModel->slug = $newModel->slug . '-copy';
          if (!$newModel->save()) throw new Exception("Failed to Save! Code #D-001");
          return $this->redirect(Yii::$app->request->referrer);
        }
      } catch (Exception $ex) {
        Yii::$app->session->setFlash('warning', $ex->getMessage());
        $transaction_exception->rollBack();
        return $this->redirect(Yii::$app->request->referrer);
      }
    }
    return $this->render('update', [
      'model' => $model,
    ]);
  }


  public function actionValidation($id = null)
  {

    $model = $id === null ? new Article() : Article::findOne($id);
    if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
      Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      return \yii\widgets\ActiveForm::validate($model);
    }
  }


  public function actionDelete($id)
  {
    $this->findModel($id)->delete();

    return $this->redirect(['index']);
  }

  protected function findModel($id)
  {
    if (($model = Article::findOne($id)) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
