<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\GuideProfile;
use app\modules\admin\models\GuideProfileSearch;
use Codeception\Scenario;
use Exception;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GuideProfileController implements the CRUD actions for GuideProfile model.
 */
class GuideProfileController extends Controller
{
  public function actions()
  {
    return [
      'error' => [
        'class' => 'yii\web\ErrorAction',
      ],
    ];
  }
  /**
   * @inheritDoc
   */

  /**
   * Lists all GuideProfile models.
   *
   * @return string
   */
  public function actionIndex()
  {
    $searchModel = new GuideProfileSearch();
    $dataProvider = $searchModel->search($this->request->queryParams);

    return $this->render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }

  /**
   * Displays a single GuideProfile model.
   * @param int $id ID
   * @return string
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionView($id)
  {
    return $this->render('view', [
      'model' => $this->findModel($id),
    ]);
  }

  /**
   * Creates a new GuideProfile model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return string|\yii\web\Response
   */
  public function actionCreate()
  {
    $model = new GuideProfile();
    $model->scenario = 'form';

    if ($this->request->isPost && $model->load($this->request->post())) {
      $transaction_exception = Yii::$app->db->beginTransaction();
      try {

        if (!$model->save()) throw new Exception("Failed to Save! Code #001");

        $transaction_exception->commit();
        Yii::$app->session->setFlash('success', "Post saved successfully");
        return $this->redirect(['index']);
      } catch (Exception $ex) {
        Yii::$app->session->setFlash('warning', $ex->getMessage());
        $transaction_exception->rollBack();
        return $this->redirect(Yii::$app->request->referrer);
      }
    }

    return $this->render('form', [
      'model' => $model,
    ]);
  }

  /**
   * Updates an existing GuideProfile model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param int $id ID
   * @return string|\yii\web\Response
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionUpdate($id)
  {
    $model = $this->findModel($id);
    $model->scenario = 'form';

    if ($this->request->isPost && $model->load($this->request->post())) {
      $transaction_exception = Yii::$app->db->beginTransaction();
      try {

        if (!$model->save()) throw new Exception("Failed to Save! Code #001");

        $transaction_exception->commit();
        Yii::$app->session->setFlash('success', "Post saved successfully");
        return $this->redirect(['index']);
      } catch (Exception $ex) {
        Yii::$app->session->setFlash('warning', $ex->getMessage());
        $transaction_exception->rollBack();
        return $this->redirect(Yii::$app->request->referrer);
      }
    }

    return $this->render('form', [
      'model' => $model,
    ]);
  }

  /**
   * Deletes an existing GuideProfile model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param int $id ID
   * @return \yii\web\Response
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionDelete($id)
  {
    $this->findModel($id)->delete();

    return $this->redirect(['index']);
  }

  public function actionValidation($id = null)
  {

    $model = $id === null ? new GuideProfile() : GuideProfile::findOne($id);
    if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
      Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      return \yii\widgets\ActiveForm::validate($model);
    }
  }
  /**
   * Finds the GuideProfile model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param int $id ID
   * @return GuideProfile the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = GuideProfile::findOne(['id' => $id])) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
