<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\ProductSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>
<style>
    .blank_space_label {
        padding-top: 32px;
    }
</style>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="row">
        <div class="col-lg-4">
            <label>Date Range</label>
            <div id="order__date__range" style="cursor: pointer;" class="form-control">
                <i class="fas fa-calendar text-muted"></i>&nbsp;
                <span></span> <i class="fa fa-caret-down text-muted float-right"></i>
            </div>
        </div>
        <div class="col-lg-4">
            
        </div>
        <div class="col-lg-4">
            <div class="float-right">
                <div class="blank_space_label"></div>
                <?= Html::a(
                    '<i class="fas fa-pencil-alt mr-1"></i> Add Product',
                    ['create'],
                    [
                        'class' => 'btn rounded-pill btn-success',
                        'data-pjax' => 0,
                    ]
                ) ?>
            </div>
        </div>
    </div>

    <?php // $form->field($model, 'id')?>

    <?php
// $form->field($model, 'name')
?>

    <?php
// $form->field($model, 'namekh')
?>

    <?php
// $form->field($model, 'tourday')
?>

    <?php
// $form->field($model, 'tournight')
?>

    <?php
// echo $form->field($model, 'tourhour')
?>

    <?php
// echo $form->field($model, 'tourmin')
?>

    <?php
// echo $form->field($model, 'overview')
?>

    <?php
// echo $form->field($model, 'overviewkh')
?>

    <?php
// echo $form->field($model, 'highlight')
?>

    <?php
// echo $form->field($model, 'highlight_kh')
?>

    <?php
// echo $form->field($model, 'pick_up')
?>

    <?php
// echo $form->field($model, 'pick_up_kh')
?>

    <?php
// echo $form->field($model, 'drop_off')
?>

    <?php
// echo $form->field($model, 'drop_off_kh')
?>

    <?php
// echo $form->field($model, 'price_include_kh')
?>

    <?php
// echo $form->field($model, 'price_exclude_kh')
?>

    <?php
// echo $form->field($model, 'status')
?>

    <?php
// echo $form->field($model, 'created_at')
?>

    <?php
// echo $form->field($model, 'created_by')
?>

    <?php
// echo $form->field($model, 'updated_at')
?>

    <?php
// echo $form->field($model, 'updated_by')
?>

    <?php
// echo $form->field($model, 'deleted_at')
?>

    <?php
// echo $form->field($model, 'deleted_by')
?>

    <?php
// echo $form->field($model, 'rate')
?>

    <div class="form-group">
        <?php
// Html::submitButton('Search', ['class' => 'btn btn-primary']);
?>
        <?php
// Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary',]);
?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
