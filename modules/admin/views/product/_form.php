<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\Product $model */
/** @var yii\widgets\ActiveForm $form */
?>
<style>
    .product-form {
        padding-top: 20px
    }

    .required {
        color: red;
    }
</style>
<div class="product-form">

    <?php $form = ActiveForm::begin([
        'options' => ['id' => 'productForm', 'enctype' => 'multipart/form-data'],
    ]); ?>
    <div class="card">
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-lg-3">
                    <?php // $form->field($model, 'name')->textInput(['maxlength' => true]) 
                    ?>
                    <?= $form->field($model, 'name', [
                        'template' =>
                        '<div>
                        <span class="flag-icon flag-icon-gb flag-icon-squared"></span>
                        <label class="form-label">
                            {label}
                            <span class="required">*</span>
                        </label>
                        <div class="form-item">{input}</div>
                     </div>'
                    ]) ?>
                </div>
                <div class="form-group col-lg-3">
                    <?= $form->field($model, 'namekh', ['template' =>
                    '<div >
                        <span class="flag-icon flag-icon-kh flag-icon-squared"></span>
                        <label class="form-label">
                            {label}
                    
                            <span class="required">*</span>
                        </label>
                        <div class="form-item">{input}</div>
                     </div>']) ?>
                </div>
                <div class="form-group col-lg-2">
                    <?= $form->field($model, 'tourday', ['template' =>
                    '<div>
                    <label class="form-label">
                        {label}
                    </label>
                    <div class="form-item">{input}</div>
                    </div>']) ?>
                </div>
                <div class="form-group col-lg-2">
                    <?= $form->field($model, 'tournight', ['template' =>
                    '<div>
                    <label class="form-label">
                        {label}
                    </label>
                    <div class="form-item">{input}</div>
                    </div>'])  ?>
                </div>
                <div class="form-group col-lg-1">
                    <?= $form->field($model, 'tourhour', ['template' =>
                    '<div>
                    <label class="form-label">
                        {label}
                    </label>
                    <div class="form-item">{input}</div>
                    </div>'])  ?>
                </div>
                <div class="form-group col-lg-1">
                    <?= $form->field($model, 'tourmin', ['template' =>
                    '<div>
                    <label class="form-label">
                        {label}
                    </label>
                    <div class="form-item">{input}</div>
                    </div>'])  ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-lg-6">
                    <?= $form->field($model, 'overview')->textarea(['rows' => 3]) ?>
                </div>
                <div class="form-group col-lg-6">
                    <?= $form->field($model, 'overviewkh')->textarea(['rows' => 3]) ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-lg-6">
                    <?= $form->field($model, 'highlight')->textarea(['rows' => 3]) ?>
                </div>
                <div class="form-group col-lg-6">
                    <?= $form->field($model, 'highlight_kh')->textarea(['rows' => 3]) ?>
                </div>
            </div>



            <div class="form-row">
                <div class="form-check col-lg-2">
                    <?= $form->field($model, 'pick_up')->radio(['maxlength' => true]) ?>
                </div>
                <div class="form-check col-lg-2">
                    <?= $form->field($model, 'pick_up_kh')->radio(['maxlength' => true]) ?>
                </div>
                <div class="form-check col-lg-2">
                    <?= $form->field($model, 'drop_off')->radio(['maxlength' => true]) ?>
                </div>
                <div class="form-check col-lg-2">
                    <?= $form->field($model, 'drop_off_kh')->radio(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-check col-lg-2">
                    <?= $form->field($model, 'price_include_kh')->checkbox(['maxlength' => true]) ?>
                </div>
                <div class="form-check col-lg-2">
                    <?= $form->field($model, 'price_exclude_kh')->checkbox(['maxlength' => true]) ?>
                </div>
            </div>

            <?php // $form->field($model, 'created_at')->textInput() 
            ?>

            <?php // $form->field($model, 'created_by')->textInput() 
            ?>

            <?php // $form->field($model, 'updated_at')->textInput() 
            ?>

            <?php // $form->field($model, 'updated_by')->textInput() 
            ?>

            <?php // $form->field($model, 'deleted_at')->textInput() 
            ?>

            <?php // $form->field($model, 'deleted_by')->textInput() 
            ?>
            <div class="form-row">
                <div class="form-group col-lg-6">
                    <?= $form->field($model, 'rate')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-check form-switch col-lg-6">
                    <?= $form->field($model, 'status')->checkbox() ?>

                </div>
            </div>
            <div class="form-group">
                <?= Html::submitButton('<i class="far fa-save mr-1"></i>  Save', ['class' => 'btn btn-success']) ?>
            </div>

        </div>
    </div>
</div>
</div>






<?php ActiveForm::end(); ?>

</div>