<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Blog';
$this->params['pageTitle'] = $this->title;
?>
<div class="article-index">
  <?php Pjax::begin(['id' => 'article_data']); ?>
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
        //'layout' => "{summary}<hr>\n{items}\n<div class='d-flex justify-content-center' id='custompagination'>{pager}</div>",
        'columns' => [
          ['class' => 'yii\grid\SerialColumn'],
          [
            'attribute' => 'img_url',
            'format' => 'raw',
            'value' => function ($model) {
              return Html::img($model->getThumbUploadUrl('img_url'), ['alt' => 'yii', 'width' => '60', 'height' => '60']);
            }
          ],
          'title',
          'slug',
          [
            'attribute' => 'created_date',
            'value' => function ($model) {
              return Yii::$app->formater->timeAgo($model->created_date);
            }
          ],
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
              // 'view' => function ($url, $model) {
              //   return Html::a('<i class="far fa-eye"></i>', Yii::getAlias("@web/destination.html"), ['class' => 'btn btn-sm btn-icon btn-secondary', 'target' => '_blank']);
              // },
              'update' => function ($url, $model) {
                return Html::a('<i class="fas fa-pen"></i>', $url, ['class' => 'btn btn-xs btn-icon btn-info', 'data-pjax' => 0]);
              },
              'delete' => function ($url, $model) {
                return Html::a('<i class="fas fa-trash"></i>', $url, ['class' => 'btn btn-xs btn-icon btn-danger ', 'data-pjax' => 0]);
              },
            ],

          ],
        ],
      ]); ?>
    </div>
  </div>
  <?php Pjax::end(); ?>
</div>