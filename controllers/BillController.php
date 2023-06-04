<?php

namespace app\controllers;


use Yii;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class BillController extends \yii\web\Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    public function actionInvoice()
    {


        return $this->render('invoice');
    }

    public function actionReciept()
    {

        return $this->render('reciept');
    }
    public function actionVoucher()
    {

        return $this->render('voucher');
    }
}
