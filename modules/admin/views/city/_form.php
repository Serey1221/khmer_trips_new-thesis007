<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\City $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="city-form">

    <?php $form = ActiveForm::begin([
        'options' => ['id' => 'cityForm', 'enctype' => 'multipart/form-data'],
    ]); ?>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true,'placeholder' => ' Name of City'])->label(false) ?>

                <?= $form->field($model, 'name_kh')->textInput(['maxlength' => true,'placeholder' => ' Name Khmer of City'])->label(false) ?>

                <?= $form->field($model, 'description')->textarea(['rows' => 6,'placeholder'=>'Short Description'])->label(false) ?>

                <?php // $form->field($model, 'country_id')->textInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>

                </div>
            </div>
        </div>
    </div>
   
    <?php ActiveForm::end(); ?>

</div>
