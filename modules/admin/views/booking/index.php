<?php

use app\modules\admin\models\Booking;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\BookingSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Bookings';
$this->params['pagetitle'][] = $this->title;
?>
<div class="booking-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php // Html::a('Create Booking', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'tableOptions'=>[
            'class'=>'table table-striped projects',
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'product_id',
            'from_date',
            'to_date',
            'total_amount',
            'paid',
            //'created_at',
            //'created_by:ntext',
            //'updated_at',
            //'updated_by:ntext',
            //'status',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($model) {
                return $model->getStatusTemp();
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Booking $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
