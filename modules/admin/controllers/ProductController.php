<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Product;
use app\modules\admin\models\ProductSearch;
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
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionCreate($type = Product::ACTIVITY)
    {
        $model = new Product();
        $model->type = $type;
        $model->scenario = $model->type;
        if ($this->request->isPost && $model->load($this->request->post())) {
            $transaction_exception = Yii::$app->db->beginTransaction();
            try {

                if (!$model->save()) throw new Exception(print_r($model->getErrors()));

                $transaction_exception->commit();
                Yii::$app->session->setFlash('success', "Item has been saved successfully");
                return $this->redirect(['view', 'id' => $model->id]);
            } catch (Exception $ex) {
                echo "<pre>";
                print_r($ex->getMessage());
                exit;
                Yii::$app->session->setFlash('warning', $ex->getMessage());
                $transaction_exception->rollBack();
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = $model->type;

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    public function actionValidation($id = null)
    {

        $model = $id === null ? new Product() : Product::findOne($id);
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
        if (($model = Product::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
