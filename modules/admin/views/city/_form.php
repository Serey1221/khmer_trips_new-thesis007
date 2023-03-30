<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\City $model */
/** @var yii\widgets\ActiveForm $form */
?>
<style>
    .city-form {
        padding-top: 20px
    }
</style>
<div class="city-form">

    <?php $form = ActiveForm::begin([
        'options' => ['id' => 'cityForm', 'enctype' => 'multipart/form-data'],
    ]); ?>
    <div class="card">
        <div class="card-body">
            <div class="form-row">
                <div class="orm-group col-lg-6">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => ' Name of City'])->label(false) ?>
                </div>
                <div class="orm-group col-lg-6">
                    <?= $form->field($model, 'name_kh')->textInput(['maxlength' => true, 'placeholder' => ' Name Khmer of City'])->label(false) ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-lg-12">
                    <?= $form->field($model, 'description')->textarea(['rows' => 6, 'placeholder' => 'Short Description'])->label(false) ?>

                    <?php // $form->field($model, 'country_id')->textInput() 
                    ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-lg-3">
                    <div class="form-group">
                        <?= Html::submitButton('<i class="far fa-save mr-1"></i> Save', ['class' => 'btn btn-success']) ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>