<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Booking;
use app\modules\admin\models\BookingActivity;
use app\modules\admin\models\BookingPayment;
use app\modules\admin\models\BookingSearch;
use Exception;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BookingController implements the CRUD actions for Booking model.
 */
class BookingController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Booking models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BookingSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Booking model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $modelPayment = BookingPayment::find()
            ->where(['booking_id' => $model->id])
            ->orderBy(['created_at' => SORT_DESC])
            ->all();
        $modelActivity = BookingActivity::find()
            ->where(['booking_id' => $model->id])
            ->orderBy(['created_at' => SORT_DESC])
            ->all();
        return $this->render('view', [
            'model' => $model,
            'modelPayment' => $modelPayment,
            'modelActivity' => $modelActivity
        ]);
    }

    /**
     * Creates a new Booking model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Booking();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Booking model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEdit($id)
    {
        $model = $this->findModel(['code' => $id]);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionAddPayment($code)
    {
        $modelBooking = $this->findModel($code);
        $model = new BookingPayment();
        $model->booking_id = $modelBooking->id;
        $modelPayment = BookingPayment::find()->where(['booking_id' => $modelBooking->id])->all();

        if ($this->request->isPost && $model->load($this->request->post())) {

            $transaction_exception = Yii::$app->db->beginTransaction();

            try {
                if (!$model->save()) throw new Exception("Failed to Save! Code #001");

                BookingActivity::addActivity(['type' => BookingActivity::TYPE_PAYMENT, 'booking_id' => $modelBooking->id, 'payment_id' => $model->id]);

                $modelBooking->paid = $modelBooking->paid + $model->amount;
                if (!$modelBooking->save()) throw new Exception("Failed to update booking");

                $transaction_exception->commit();
                Yii::$app->session->setFlash('success', "Payment added successfully");

                return $this->redirect(Yii::$app->request->referrer);
            } catch (Exception $ex) {
                Yii::$app->session->setFlash('warning', $ex->getMessage());
                $transaction_exception->rollBack();
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
        return $this->renderAjax('_form_payment', [
            'model' => $model,
            'modelBooking' => $modelBooking,
            'modelPayment' => $modelPayment
        ]);
    }

    public function actionConfirmBooking($code)
    {
        $model = $this->findModel($code);

        $transaction_exception = Yii::$app->db->beginTransaction();

        try {
            $model->status = Booking::CONFIRMED;

            $latestIncrement = Yii::$app->db->createCommand("SELECT 
                count(id)
                FROM booking
            ")->queryScalar();
            $code = sprintf("%04d", (int)$latestIncrement + 1);
            $model->invoice_code = "INV" . date("ym") . $code;
            if (!$model->save()) throw new Exception("Something went wrong!");

            BookingActivity::addActivity(['type' => BookingActivity::TYPE_CONFIRM, 'booking_id' => $model->id]);

            $transaction_exception->commit();
            Yii::$app->session->setFlash('success', "Booking confirmed successful");
            return $this->redirect(Yii::$app->request->referrer);
        } catch (Exception $ex) {
            Yii::$app->session->setFlash('warning', $ex->getMessage());
            $transaction_exception->rollBack();
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    public function actionDeclineBooking($code)
    {
        $model = $this->findModel($code);

        $transaction_exception = Yii::$app->db->beginTransaction();

        try {
            $model->status = Booking::DECLINED;
            if (!$model->save()) throw new Exception("Something went wrong!");

            BookingActivity::addActivity(['type' => BookingActivity::TYPE_DECLINE, 'booking_id' => $model->id]);

            $transaction_exception->commit();
            Yii::$app->session->setFlash('success', "Booking confirmed successful");
            return $this->redirect(Yii::$app->request->referrer);
        } catch (Exception $ex) {
            Yii::$app->session->setFlash('warning', $ex->getMessage());
            $transaction_exception->rollBack();
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    public function actionCancelBooking($code)
    {
        $model = $this->findModel($code);

        $transaction_exception = Yii::$app->db->beginTransaction();

        try {
            $model->status = Booking::CANCELLED;
            if (!$model->save()) throw new Exception("Something went wrong!");

            BookingActivity::addActivity(['type' => BookingActivity::TYPE_CANCEL, 'booking_id' => $model->id]);

            $transaction_exception->commit();
            Yii::$app->session->setFlash('success', "Booking confirmed successful");
            return $this->redirect(Yii::$app->request->referrer);
        } catch (Exception $ex) {
            Yii::$app->session->setFlash('warning', $ex->getMessage());
            $transaction_exception->rollBack();
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    /**
     * Deletes an existing Booking model.
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

    /**
     * Finds the Booking model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Booking the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Booking::findOne(['code' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
