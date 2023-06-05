<?php

use app\modules\admin\models\Booking;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\BookingSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

/** @var app\components\Formater $formater */
$formater = Yii::$app->formater;

$this->title = 'Booking List';
$this->params['pagetitle'][] = $this->title;
?>
<style>
    .cs-pointer {
        cursor: pointer;
    }
</style>
<div class="booking-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <hr class="border-0">

    <div class="card">
        <div class="card-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'rowOptions'   => function ($model, $key, $index, $grid) {
                    return ['data-id' => $model->code, 'class' => 'cs-pointer'];
                },
                'tableOptions' => [
                    'class' => 'table table-hover',
                    'id' => 'tableBooking',
                    'cellspacing' => '0',
                    'width' => '100%',

                ],
                'pager' => [
                    'class' => 'yii\bootstrap4\LinkPager'
                ],
                'layout' => "
                    <div class='table-responsive'>
                        {items}
                    </div>
                    <hr>
                    <div class='row'>
                        <div class='col-md-6'>
                            {summary}
                        </div>
                        <div class='col-md-6'>
                            {pager}
                        </div>
                    </div>
                ",
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'created_at',
                        'label' => 'Booked at',
                        'value' => function ($model) use ($formater) {
                            return $formater->dateTime($model->created_at);
                        }
                    ],
                    [
                        'attribute' => 'code',
                        'label' => 'Order ID',
                        'format' => 'raw',
                        'contentOptions' => ['class' => 'text-info'],
                        'value' => function ($model) use ($formater) {
                            return "#{$model->code}";
                        }
                    ],
                    [
                        'attribute' => 'customer_id',
                        'label' => 'Customer',
                        'format' => 'raw',
                        'value' => function ($model) use ($formater) {
                            return $model->customer->getFullName();
                        }
                    ],
                    'total_amount',
                    'paid',
                    [
                        'attribute' => 'status',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return $model->getBookingStatus();
                        }
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
<?php
$this->registerJs("

  $('#tableBooking td').click(function (e) {
      var code = $(this).closest('tr').data('id');
      if(e.target == this)
          location.href = '" . Url::to(['booking/view']) . "?id=' + code;
  });

");
?>