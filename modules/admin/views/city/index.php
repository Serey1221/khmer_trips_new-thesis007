<?php

use app\modules\admin\models\City;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\CitySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Cities';
$this->params['pageTitle'][] = $this->title;
?>

<div class="city-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_search', ['model' => $searchModel]) ?>

    <div class="card">
        <div class="card-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'tableOptions' => [
                    'class' => 'table table-striped projects',
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

                    //'id',
                    [
                        'attribute' => 'img_url',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return Html::img($model->getUploadUrl('img_url'), ['alt' => 'yii', 'width' => '60', 'height' => '60']);
                        }
                    ],
                    'name',
                    'name_kh',
                    [
                        'attribute' => 'created_at',
                        'value' => function ($model) {
                            return Yii::$app->formater->timeAgo($model->created_at);
                        }
                    ],
                    [
                        'attribute' => 'status',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return $model->getStatusTemp();
                        }
                    ],
                    //'description',
                    //'country_id',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => Yii::t('app', 'Actions'),
                        'headerOptions' => ['class' => 'text-center'],
                        'contentOptions' => ['class' => 'text-center'],
                        'template' => ' {update} {delete}',
                        'buttons' => [
                            // 'view' => function ($url, $model) {
                            //     return Html::a('<i class="far fa-eye"></i>', $url, ['class' => 'btn btn-xs btn-icon btn-primary', 'data-pjax' => 0]);
                            // },
                            'update' => function ($url, $model) {
                                return Html::a('<i class="fas fa-pen"></i>', $url, ['class' => 'btn btn-xs btn-icon btn-info ', 'data-pjax' => 0]);
                            },
                            'delete' => function ($url, $model) {
                                return Html::a('<i class="fas fa-trash"></i>', $url, ['class' => 'btn btn-xs btn-icon btn-danger ', 'data-pjax' => 0]);
                            },

                        ],
                        'urlCreator' => function ($action, City $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        },
                    ],
                ],
            ]); ?>
        </div>
    </div>

</div>