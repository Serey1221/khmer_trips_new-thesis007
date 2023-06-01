<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Product;
use app\modules\admin\models\ProductCity;
use app\modules\admin\models\ProductGallery;
use app\modules\admin\models\ProductItinerary;
use app\modules\admin\models\ProductRateModify;
use app\modules\admin\models\ProductSearch;
use app\modules\admin\models\ProductStyleData;
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
        $rateModify = ProductRateModify::find()->where(['product_id' => $id])->all();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'rateModify' => $rateModify
        ]);
    }

    public function actionForm($type = Product::ACTIVITY, $id = '')
    {
        if (!empty($id)) {
            $model = $this->findModel($id);
            $oldModel = $model->getOldAttributes();
            $isNewRecord = false;
        } else {
            $model = new Product();
            $model->type = $type;
            $isNewRecord = true;
            $length = 10;
            $result = false;
            $code = '';
            do {
                $code = substr(str_shuffle(str_repeat($x = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
                $has = Product::findOne(['code' => $code]);
                if (empty($has)) $result = true;
            } while (!$result);
            $model->code = $code;
        }
        $model->scenario = $model->type;
        if ($this->request->isPost && $model->load($this->request->post())) {
            $transaction_exception = Yii::$app->db->beginTransaction();
            try {

                if (!$model->save()) throw new Exception(print_r($model->getErrors()));

                if ($model->isActivity() && $isNewRecord) {
                    $bulk_data = [];
                    for ($i = 0; $i < 1; $i++) {
                        $bulk_data[] = [
                            'id' => null,
                            'product_id' => $model->id,
                            'city_id' => null,
                            'title' => '',
                            'description' => '',
                            'is_stay' => 0,
                            'is_breakfast' => 0,
                            'is_lunch' => 0,
                            'is_dinner' => 0,
                        ];
                    }
                    $postModel = new ProductItinerary();
                    if (!Yii::$app->db->createCommand()->batchInsert(ProductItinerary::tableName(), $postModel->attributes(), $bulk_data)->execute())
                        throw new Exception("Failed to save itinerary data!");
                } else {
                    if (
                        (!empty($oldModel['tourday']) && intval($oldModel['tourday']) !== intval($model->tourday)) ||
                        $isNewRecord
                    ) {
                        ProductItinerary::deleteAll(['product_id' => $model->id]);
                        $bulk_data = [];
                        for ($i = 0; $i < $model->tourday; $i++) {
                            $bulk_data[] = [
                                'id' => null,
                                'product_id' => $model->id,
                                'city_id' => null,
                                'title' => '',
                                'description' => '',
                                'is_stay' => 0,
                                'is_breakfast' => 0,
                                'is_lunch' => 0,
                                'is_dinner' => 0,
                            ];
                        }
                        $postModel = new ProductItinerary();
                        if (!Yii::$app->db->createCommand()->batchInsert(ProductItinerary::tableName(), $postModel->attributes(), $bulk_data)->execute())
                            throw new Exception("Failed to save itinerary data!");
                    }
                }

                ProductCity::deleteAll(['product_id' => $model->id]);
                if (!empty($model->city_id)) {
                    foreach ($model->city_id as $key => $value) {
                        $productCity = new ProductCity();
                        $productCity->product_id = $model->id;
                        $productCity->city_id = $value;
                        if (!$productCity->save()) throw new Exception(print_r($productCity->getErrors()));
                    }
                }

                ProductStyleData::deleteAll(['product_id' => $model->id]);
                if (!empty($model->style_id)) {
                    foreach ($model->style_id as $key => $value) {
                        $productStyle = new ProductStyleData();
                        $productStyle->product_id = $model->id;
                        $productStyle->style_id = $value;
                        if (!$productStyle->save()) throw new Exception(print_r($productStyle->getErrors()));
                    }
                }

                $transaction_exception->commit();
                Yii::$app->session->setFlash('success', "Item has been saved successfully");
                return $this->redirect(['form', 'id' => $model->id]);
            } catch (Exception $ex) {
                echo "<pre>";
                print_r($ex->getMessage());
                exit;
                Yii::$app->session->setFlash('warning', $ex->getMessage());
                $transaction_exception->rollBack();
            }
        }
        return $this->render('_form', [
            'model' => $model,
        ]);
    }

    public function actionFormItinerary($id)
    {
        $model = $this->findModel($id);
        $modelItinerary = ProductItinerary::find()->where(['product_id' => $model->id])->all();
        $product_id = $model->id;
        $modelItinerary = Yii::$app->db->createCommand("SELECT 
                    *,
                    IF(is_stay =1,'checked','') check_stay,
                    IF(is_breakfast =1,'checked','') check_breakfast,
                    IF(is_lunch =1,'checked','') check_lunch,
                    IF(is_dinner =1,'checked','') check_dinner
                
                FROM product_itinerary
                WHERE product_id = :product_id")->bindParam('product_id', $product_id)
            ->queryAll();
        if ($this->request->isPost && $model->load($this->request->post())) {
            $transaction_exception = Yii::$app->db->beginTransaction();
            try {

                if (!$model->save()) throw new Exception(print_r($model->getErrors()));

                ProductItinerary::deleteAll(['product_id' => $model->id]);
                $title = $this->request->post('title');
                $tour_city = $this->request->post('tour_city');
                $chk_stay = $this->request->post('hide_is_stay');
                $chk_breakfast = $this->request->post('hide_is_breakfast');
                $chk_lunch = $this->request->post('hide_is_lunch');
                $chk_dinner = $this->request->post('hide_is_dinner');
                $description = $this->request->post('description');
                if (!empty($title)) {
                    $bulk_data = [];
                    foreach ($title as $key => $value) {
                        $bulk_data[] = [
                            'id' => null,
                            'product_id' => $model->id,
                            'city_id' => (int)$tour_city[$key],
                            'title' => $value,
                            'description' => $description[$key],
                            'is_stay' => (int)$chk_stay[$key],
                            'is_breakfast' => (int)$chk_breakfast[$key],
                            'is_lunch' => (int)$chk_lunch[$key],
                            'is_dinner' => (int)$chk_dinner[$key],
                        ];
                    }
                    $postModel = new ProductItinerary();
                    if (!Yii::$app->db->createCommand()->batchInsert(ProductItinerary::tableName(), $postModel->attributes(), $bulk_data)->execute())
                        throw new Exception("Failed to save itinerary data!");
                }


                $transaction_exception->commit();
                Yii::$app->session->setFlash('success', "Item has been saved successfully");
                return $this->redirect(Yii::$app->request->referrer);
            } catch (Exception $ex) {
                echo "<pre>";
                print_r($ex->getMessage());
                exit;
                Yii::$app->session->setFlash('warning', $ex->getMessage());
                $transaction_exception->rollBack();
            }
        }
        return $this->render('_form_itinerary', [
            'model' => $model,
            'modelItinerary' => $modelItinerary
        ]);
    }

    public function actionFormGallery($id)
    {
        $model = $this->findModel($id);
        $modelGallery = ProductGallery::find()->all();
        return $this->render('_form_gallery', [
            'model' => $model,
            'modelGallery' => $modelGallery
        ]);
    }
    public function actionFormAddGallery($id = 0, $productId = 0)
    {
        $model = !empty(ProductGallery::findOne($id)) ? ProductGallery::findOne($id) : new ProductGallery();
        $model->scenario = 'admin';
        if ($this->request->isPost && $model->load($this->request->post())) {

            $transaction_exception = Yii::$app->db->beginTransaction();

            try {
                $model->product_id = $productId;
                if (!$model->save()) throw new Exception(Yii::$app->formater->errToString($model->getErrors()));

                $transaction_exception->commit();
                Yii::$app->session->setFlash('success', "Gallery saved successfully");
                return $this->redirect(Yii::$app->request->referrer);
            } catch (Exception $ex) {
                Yii::$app->session->setFlash('warning', $ex->getMessage());
                $transaction_exception->rollBack();
                return $this->redirect(Yii::$app->request->referrer);
            }
        }


        return $this->renderAjax('_form_add_gallery', [
            'model' => $model,
        ]);
    }


    public function actionFormTerm($id)
    {
        $model = $this->findModel($id);
        if ($this->request->isPost && $model->load($this->request->post())) {
            $transaction_exception = Yii::$app->db->beginTransaction();
            try {

                if (!$model->save()) throw new Exception(print_r($model->getErrors()));

                $transaction_exception->commit();
                Yii::$app->session->setFlash('success', "Item has been saved successfully");
                return $this->redirect(Yii::$app->request->referrer);
            } catch (Exception $ex) {
                echo "<pre>";
                print_r($ex->getMessage());
                exit;
                Yii::$app->session->setFlash('warning', $ex->getMessage());
                $transaction_exception->rollBack();
            }
        }
        return $this->render('_form_term', [
            'model' => $model,
        ]);
    }

    public function actionFormRate($id)
    {
        $model = $this->findModel($id);
        $modelRate = ProductRateModify::find()->where(['product_id' => $id])->all();
        return $this->render('_form_rate', [
            'model' => $model,
            'modelRate' => $modelRate
        ]);
    }

    public function actionAddRate($type = Product::ACTIVITY, $productId = '')
    {
        $modelProduct = $this->findModel($productId);
        $model = new ProductRateModify();
        $model->product_id = $productId;
        if ($this->request->isPost && $model->load($this->request->post())) {
            $transaction_exception = Yii::$app->db->beginTransaction();
            try {

                if (!$model->save()) throw new Exception(print_r($model->getErrors()));

                $transaction_exception->commit();
                Yii::$app->session->setFlash('success', "Item has been saved successfully");
                return $this->redirect(Yii::$app->request->referrer);
            } catch (Exception $ex) {
                echo "<pre>";
                print_r($ex->getMessage());
                exit;
                Yii::$app->session->setFlash('warning', $ex->getMessage());
                $transaction_exception->rollBack();
            }
        }
        return $this->renderAjax('form_rate', [
            'model' => $model,
            'type' => $type,
            'modelProduct' => $modelProduct
        ]);
    }
    public function actionUpdateRate($id)
    {
        $model = ProductRateModify::findOne($id);
        $modelProduct = $this->findModel($model->product_id);
        if ($this->request->isPost && $model->load($this->request->post())) {
            $transaction_exception = Yii::$app->db->beginTransaction();
            try {

                if (!$model->save()) throw new Exception(print_r($model->getErrors()));

                $transaction_exception->commit();
                Yii::$app->session->setFlash('success', "Item has been saved successfully");
                return $this->redirect(Yii::$app->request->referrer);
            } catch (Exception $ex) {
                echo "<pre>";
                print_r($ex->getMessage());
                exit;
                Yii::$app->session->setFlash('warning', $ex->getMessage());
                $transaction_exception->rollBack();
            }
        }
        return $this->renderAjax('form_rate', [
            'model' => $model,
            'type' => $model->product->type,
            'modelProduct' => $modelProduct
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
