<?php

use app\modules\admin\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\ProductSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Products';
$this->params['pageTitle'] = $this->title;
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

<?= $this->render('_search', ['model' => $searchModel]) ?>
 <div class="card">
    <div class="card-body p-0">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        // 'rowOptions'   => function ($model, $key, $index, $grid) {
        //     return ['data-id' => $model->id, 'class' => 'cs-pointer'];
        //   },
        'tableOptions' => [
            'id' => 'tableProduct',
            // 'class' => 'table table-hover',
            'class'=>'table table-striped projects',
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
            //'id',
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
            'created_at',
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
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action,Product $model, $key,$index,$column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
            ],
        ],
    ]) ?>
    </div>
</div>

</div>
