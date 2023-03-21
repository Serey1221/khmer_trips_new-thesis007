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
<!-- <style>
    .city-index{
        padding-top:20px
    }
</style>     -->
<div class="city-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_search', ['model' => $searchModel]) ?>
    
    <div class="card">
        <div class="card-body p-0">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'tableOptions' => [
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
                'name_kh',
                'description',
                //'country_id',
                [
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, City $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>
        </div>
    </div>

</div>
