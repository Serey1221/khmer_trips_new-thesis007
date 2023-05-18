<?php

use app\modules\admin\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\ProductSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Products';
$this->params['pageTitle'] = $this->title;
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['id' => 'product_data']); ?>
    <?= $this->render('_search', ['model' => $searchModel]) ?>

    <div class="card">
        <div class="card-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
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
                            return Html::img($model->getThumbUploadUrl('img_url'), ['alt' => 'yii', 'width' => '60', 'height' => '60']);
                        }
                    ],
                    'name',
                    //'namekh', 
                    //'tourday', 
                    //'tournight', //'tourhour', //'tourmin', //'pick_up', //'pick_up_kh', //'drop_off', //'drop_off_kh',
                    //'overview:ntext',
                    //'overviewkh:ntext',
                    //'highlight:ntext',
                    //'highlight_kh:ntext',
                    //'price_include_kh',
                    //'price_exclude_kh',
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
                    // 'status', 
                    //'created_by', 
                    //'updated_at', 
                    //'updated_by', 
                    //'deleted_at', 
                    //'deleted_by',
                    //'rate',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => Yii::t('app', 'Actions'),
                        'headerOptions' => ['class' => 'text-center'],
                        'contentOptions' => ['class' => 'text-center'],
                        'template' => '{view} {update} {delete}',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a('<i class="fas fa-eye"></i>', $url, ['class' => 'btn btn-xs btn-icon btn-warning ', 'data-pjax' => 0]);
                            },
                            'update' => function ($url, $model) {
                                return Html::a('<i class="fas fa-pen"></i>', $url, ['class' => 'btn btn-xs btn-icon btn-info ', 'data-pjax' => 0]);
                            },
                            'delete' => function ($url, $model) {
                                return Html::a('<i class="fas fa-trash"></i>', $url, ['class' => 'btn btn-xs btn-icon btn-danger ', 'data-pjax' => 0]);
                            },

                        ],
                        'urlCreator' => function ($action, Product $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        },
                    ],

                ],
            ]) ?>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>