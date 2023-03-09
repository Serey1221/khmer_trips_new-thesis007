<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\CitySearch $model */
/** @var yii\widgets\ActiveForm $form */
?>
<style>
    .blank_space_label {
        padding-top: 0;
    }
</style>
<div class="city-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="row">
        <div class="col-lg-4">

        </div>
        <div class="col-lg-4">

        </div>
        <div class="col-lg-4">
                <div class="float-right">
                    <div class="blank_space_label"></div>
                    <?= Html::a(
                        '<i class="fas fa-pencil-alt mr-1"></i> Add City',
                        ['create'],
                        [
                            'class' => 'btn rounded-pill btn-success',
                            'data-pjax' => 0,
                        ]
                    ) ?>
                </div>
        </div>
    </div>

    <?php //$form->field($model, 'id') ?>

    <?php //$form->field($model, 'name') ?>

    <?php //$form->field($model, 'name_kh') ?>

    <?php //$form->field($model, 'description') ?>

    <?php //$form->field($model, 'country_id') ?>

    <!-- <div class="form-group">
        <?php //Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php // Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div> -->

    <?php ActiveForm::end(); ?>

</div>
