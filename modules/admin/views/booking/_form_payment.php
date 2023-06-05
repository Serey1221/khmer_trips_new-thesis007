<?php

use app\modules\admin\models\PaymentMethod;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->registerJsFile('@web/vendor/moment/min/moment.min.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$formater = Yii::$app->formater;
$paymentMethod = ArrayHelper::map(PaymentMethod::find()->all(), 'id', 'name');
$form = ActiveForm::begin([
  'options' => ['id' => 'frmAddPayment']
]);
?>
<div class="row">
  <div class="col-lg-6">
    <?= $form->field($model, 'date')->textInput(['class' => 'form-control flatpickr-date', 'value' => $model->isNewRecord ? date("Y-m-d") : $model->date]) ?>
  </div>
</div>
<p class="mb-0"><label for="">Quick amount</label></p>
<div class="btn-group w-100 mb-3 btn-quick-amount" role="group" aria-label="Basic example">
  <button type="button" data-option="1" class="btn btn-secondary">25% of Balance Amount</button>
  <button type="button" data-option="2" class="btn btn-secondary">50% of Balance Amount</button>
  <button type="button" data-option="3" class="btn btn-secondary">Full Paid</button>
</div>
<div class="row">
  <div class="col-lg-6">
    <?= $form->field($model, 'amount')->textInput(['type' => 'number', 'step' => 0.01, 'max' => $modelBooking->balance_amount, 'value' => $modelBooking->balance_amount]) ?>
  </div>
  <div class="col-lg-6">
    <?= $form->field($model, 'method_id')->dropDownList($paymentMethod, ['prompt' => 'Select', 'class' => 'custom-select']); ?>
  </div>
</div>

<?= $form->field($model, 'remark')->textarea(['rows' => 3]) ?>

<?= Html::submitButton('Save', ['class' => 'rounded-pill btn btn-warning font-weight-semibold px-5']) ?>

<?php ActiveForm::end(); ?>

<?php
if (!empty($modelPayment)) {
  echo '<hr/>';
  echo '<div class="row"><div class="col-lg-8">';
  $paymentStr = "<table class='table table-hover'>";
  $paymentStr .= "<thead class='thead-light'>
            <tr><th class='border-0' colspan='100%'>Current payment transaction:</th></tr>
            <tr>
              <th>Date</th>
              <th>Method</th>
              <th class='text-right'>Amount</th>
            </tr>
            </thead>";
  $paymentStr .= '<tbody>';
  foreach ($modelPayment as $key => $value) {
    $paymentStr .= "<tr>
            <td>{$formater->date($value->date)}</td>
            <td>{$value->method->name}</td>
            <td class='text-right'>{$formater->DollarFormat($value->amount)}</td>
          </tr>";
  }
  $paymentStr .= "</tbody>";
  $paymentStr .= "<tfoot>
        <tr>
        <th class='text-right' colspan='2'>Total:</th>
        <th class='text-right'>{$formater->DollarFormat($modelBooking->paid_amount)}</th>
        </tr>
        <tr>
        <th class='text-right text-red' colspan='2'>Balance:</th>
        <th class='text-right text-red'>{$formater->DollarFormat($modelBooking->balance_amount)}</th>
        </tr>
    </tfoot>";
  $paymentStr .= "</table>";
  echo $paymentStr;
  echo "</div></div>";
}
?>

<?php

$script = <<<JS
  flatpickr(".flatpickr-date", {
      altInput: true,
      altFormat: "F j, Y",
      dateFormat: "Y-m-d",
      minDate: moment("$modelBooking->created_at").format("YYYY-MM-DD")
      // defaultDate: moment().subtract(10, "year").format("YYYY-MM-DD")
  });


  $(".btn-quick-amount button").click(function(){
    var option = $(this).data("option");
    var full_amount = $modelBooking->balance_amount;
    full_amount = parseFloat(full_amount);
    var amount = 0;
    switch (option) {
      case 1:
        amount = full_amount * 25/100;
        break;
      case 2:
        amount = full_amount * 50/100;
        break;
      case 3:
        amount = full_amount;
        break;
      default:
        amount = full_amount;
        break;
    }
    $("#bookingpayment-amount").val(parseFloat(amount).toFixed(2));
  });

JS;
$this->registerJs($script);
?>