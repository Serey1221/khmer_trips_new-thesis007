<?php

use app\assets\DatePickerAsset;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;

DatePickerAsset::register($this);
$city = ArrayHelper::map(Yii::$app->rate->city(), 'id', 'name');
$guest = Yii::$app->rate->guest();
?>

<div class="container-fluid booking mt-5 pb-5">
    <div class="container pb-5">
        <div class="bg-light shadow" style="padding: 30px;">
            <?php $form = ActiveForm::begin([
                'action' => ['product/index'],
                'options' => ['data-pjax' => false, 'id' => 'formProductsearch'],
                'method' => 'get',
            ]); ?>
            <div class="row align-items-center" style="min-height: 60px;">

                <div class="col-md">
                    <h4 class="title">Location</h4>
                    <?= $form->field($model, 'selectedCity')->dropdownList($city, ['prompt' => 'All', 'class' => 'custom-select'])->label("Your destination") ?>
                </div>
                <div class="col-md">
                    <h4 class="title">Date</h4>
                    <?= $form->field($model, 'selectedDate')->textInput(['class' => 'form-control bg-white', 'value' => date("Y-m-d")])->label("Departure date") ?>
                </div>

                <div class="col-md">
                    <h4 class="title">Guest</h4>
                    <?= $form->field($model, 'totalGuest')->dropdownList($guest, ['class' => 'custom-select'])->label("Number of guest") ?>
                </div>
                <div class="col-md">
                    <button class="btn btn-primary btn-block" type="submit" style="margin-top: 52px;">Submit</button>
                </div>
            </div>
        </div>

    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
$script = <<<JS
    
    flatpickr('#productsearch-selecteddate', {
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
        minDate: 'today'
    });
JS;
$this->registerJs($script);
?>