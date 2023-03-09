<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\Product $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin([
        'options' => ['id' => 'productForm', 'enctype' => 'multipart/form-data'],
    ]); ?>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true,'placeholder' => 'Product Name']) ?>

                    <?= $form->field($model, 'namekh')->textInput(['maxlength' => true,'placeholder' => 'Product Name Khmer']) ?>

                    <?= $form->field($model, 'tourday')->textInput(['placeholder' => 'Add  tourday']) ?>

                    <?= $form->field($model, 'tournight')->textInput() ?>

                    <?= $form->field($model, 'tourhour')->textInput() ?>

                    <?= $form->field($model, 'tourmin')->textInput() ?>

                    <?= $form->field($model, 'overview')->textarea(['rows' => 6]) ?>

                    <?= $form->field($model, 'overviewkh')->textarea(['rows' => 6]) ?>

                    <?= $form->field($model, 'highlight')->textarea(['rows' => 6]) ?>

                    <?= $form->field($model, 'highlight_kh')->textarea(['rows' => 6]) ?>

                </div>
                <div class="col-lg-6">
                    <?= $form->field($model, 'pick_up')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'pick_up_kh')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'drop_off')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'drop_off_kh')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'price_include_kh')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'price_exclude_kh')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'status')->textInput() ?>

                    <?= $form->field($model, 'created_at')->textInput() ?>

                    <?= $form->field($model, 'created_by')->textInput() ?>

                    <?= $form->field($model, 'updated_at')->textInput() ?>

                    <?= $form->field($model, 'updated_by')->textInput() ?>

                    <?= $form->field($model, 'deleted_at')->textInput() ?>

                    <?= $form->field($model, 'deleted_by')->textInput() ?>

                    <?= $form->field($model, 'rate')->textInput(['maxlength' => true]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    

   

    <?php ActiveForm::end(); ?>

</div>
