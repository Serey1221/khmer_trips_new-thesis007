<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\FaqsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>
<style>
    .blank_space_label {
        padding-top: 32px;
    }
</style>
<div class="faqs-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'options' => ['data-pjax' => true, 'id' => 'formFaqsSearch'],
        'method' => 'get',
    ]); ?>
    <div class="row">
        <div class="col-lg-4 offset-lg-6">
            <?= $form->field($model, 'globalSearch')->textInput(['placeholder' => 'Search by Contact title'])->label('Search') ?>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>