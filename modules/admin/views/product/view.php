<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\Product $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-lg-8">
            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'name',
                    'namekh',
                    'tourday',
                    'tournight',
                    'tourhour',
                    'tourmin',
                    'overview:ntext',
                    'overviewkh:ntext',
                    'highlight:ntext',
                    'highlight_kh:ntext',
                    'pick_up',
                    'pick_up_kh',
                    'drop_off',
                    'drop_off_kh',
                    'price_include_kh',
                    'price_exclude_kh',
                    'status',
                    // 'created_at',
                    // 'created_by',
                    // 'updated_at',
                    // 'updated_by',
                    // 'deleted_at',
                    // 'deleted_by',
                    'rate',
                ],
            ]) ?>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="float-right">
                        <?= Html::a("<i class='fas fa-plus'></i> Add Rate", ['add-rate', 'type' => $model->type]) ?>
                    </div>
                    <h3>Rate modify

                    </h3>
                    <hr>
                    <?php
                    if (!empty($rateModify)) {
                    ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Period</th>
                                    <th>Rate</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <?php
                            foreach ($rateModify as $key => $value) {
                            ?>
                                <tr>
                                    <td><?= $value->from_date . ' to ' . $value->to_date ?></td>
                                    <td><?= $value->amount, ' ', ($value->amont_type == 1 ? '$' : '%') ?></td>
                                    <td><?= Html::a("<i class='fas fa-pen'></i>", ['update-rate', 'id' => $value->id]) ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>


</div>