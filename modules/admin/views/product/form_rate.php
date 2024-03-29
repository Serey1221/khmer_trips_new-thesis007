<?php

use app\assets\DatetimepickerAsset;
use app\modules\admin\models\City;
use app\modules\admin\models\Product;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

DatetimepickerAsset::register($this);

$this->title = $model->isNewRecord ? "Add New Rate Modify" : "Update Rate Modify";
$products = ArrayHelper::map(Product::find()->andWhere(['type' => $type])->all(), 'id', 'name');
?>

<div class="product-rate-form">
  <?php
  $form = ActiveForm::begin([
    'options' => ['id' => 'product-rateForm'],
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
  ]); ?>

  <div class="row">

    <div class="col-lg-12">
      <label>Date Range</label>
      <div id="order__date__range" style="cursor: pointer;" class="form-control">
        <i class="fas fa-calendar-alt text-muted"></i>&nbsp;
        <span></span> <i class="fa fa-caret-down text-muted float-right"></i>
      </div>
      <?= $form->field($model, 'from_date')->hiddenInput()->label(false) ?>
      <?= $form->field($model, 'to_date')->hiddenInput()->label(false) ?>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <?= $form->field($model, 'amount')->textInput(['type' => 'number', 'placeholder' => "Rack Rate : $ {$modelProduct->rate}"])->label('Amount') ?>
    </div>
    <div class="col-lg-6">
      <?= $form->field($model, 'amount_type')->dropDownList([1 => 'Amount', 2 => 'Percentage'], ['class' => 'custom-select'])->label('Amount Type') ?>
    </div>
  </div>

  <?= Html::submitButton($model->isNewRecord ? '<i class="far fa-save mr-1"></i> Add New' : '<i class="far fa-save mr-1"></i> Save Changes', ['class' => 'btn btn-success']) ?>

</div>


<?php ActiveForm::end(); ?>


</div>

<?php
$script = <<<JS

    var is_filter = $("#productratemodify-from_date").val() != ''?true:false;

    if(!is_filter){
        var start = moment().startOf('week');
        var end = moment();
    }else{
        var start = moment($("#productratemodify-from_date").val());
        var end = moment($("#productratemodify-to_date").val());
    }

    function cb(start, end) {
        $('#order__date__range span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
        $("#productratemodify-from_date").val(start.format('YYYY-MM-D'));
        $("#productratemodify-to_date").val(end.format('YYYY-MM-D'));
    }

    $('#order__date__range').daterangepicker({
        minDate: moment(),
        startDate: start,
        endDate: end,
       
    }, cb);

    cb(start, end);


JS;
$this->registerJs($script);
?>