<?php

use app\modules\admin\models\Faqs;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\FaqsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Faqs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faqs-index">

    <?php Pjax::begin(['id' => 'faqs_data']); ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_search', ['model' => $searchModel]); ?>
    <div class="card">
        <div class="card-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'tableOptions' => [
                    'class' => 'table table-striped projects',
                    'cellspacing' => '0',
                    'width' => '100%',
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

                    // 'id',
                    // 'name',
                    // 'email:email',
                    'subject',
                    'description',
                    //'status',
                    //'created_date',
                    //'created_by',
                    //'updated_date',
                    //'updated_by',
                    [
                        'attribute' => 'status',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return $model->getStatusTemp();
                        }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => Yii::t('app', 'Actions'),
                        'headerOptions' => ['class' => 'text-center'],
                        'contentOptions' => ['class' => 'text-center'],
                        'template' => '{update} {delete}',
                        'buttons' => [
                            'update' => function ($url, $model) {
                                return Html::a('<i class="fas fa-pen"></i>', $url, ['class' => 'btn btn-xs btn-icon btn-info ', 'data-pjax' => 0]);
                            },
                            'delete' => function ($url, $model) {
                                return Html::a('<i class="fas fa-trash"></i>', $url, ['class' => 'btn btn-xs btn-icon btn-danger ', 'data-pjax' => 0]);
                            },
                        ],

                    ],
                    // [

                    //     'urlCreator' => function ($action, Faqs $model, $key, $index, $column) {
                    //         return Url::toRoute([$action, 'id' => $model->id]);
                    //     }
                    // ],
                ],
            ]); ?>
        </div>
    </div>
    <?php Pjax::end(); ?>


</div>