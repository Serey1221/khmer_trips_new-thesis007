<?php

use app\assets\DatetimepickerAsset;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\ArrayHelper;

DatetimepickerAsset::register($this);

$this->title = 'Sale Report';
$this->params['breadcrumbs'][] = ['label' => 'Reports', 'url' => 'javascript:;'];
$this->params['breadcrumbs'][] = $this->title;

/** @var app\components\Formater $formater */
$formater = Yii::$app->formater;

$customer = Yii::$app->db->createCommand("SELECT 
customer.id, CONCAT(customer.first_name,' ',customer.last_name) customer_name
FROM customer
INNER JOIN booking ON booking.customer_id = customer.id
GROUP BY customer.id
")->queryAll();
$customer = ArrayHelper::map($customer, 'id', 'customer_name');
?>
<?php
$form = ActiveForm::begin([
  'action' => [Yii::$app->controller->action->id],
  'method' => 'get',
  'options' => ['autocomplete' => 'off'],
]);
?>
<div class="row my-3">
  <div class="col-lg-3">
    <label for="dateRange">Period</label>
    <input type="text" name="dateRange" value="<?= $fromDate . ' - ', $toDate ?>" id="dateRange" class="form-control" readonly />
  </div>
  <div class="col-lg-3">
    <label for="customerId">Customer</label>
    <?= Html::dropDownList('customerId', $customerId, $customer, ['prompt' => 'All', 'class' => 'custom-select', 'id' => 'customerId']) ?>
  </div>
  <div class="col-lg-6">
    <div class="text-right">
      <?= Html::a("<i class='fas fa-file-csv'></i> Export CSV", [
        'report/export-sale', 'fromDate' => $fromDate, 'toDate' => $toDate, 'customerId' => $customerId
      ], ['class' => 'btn btn-secondary mt-4']); ?>
    </div>
  </div>
</div>
<button type="submit" id="submitSearch" hidden class="btn btn-warning hide">Apply Change</button>
<?php ActiveForm::end(); ?>
<div class="card">
  <div class="card-body">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Sale date</th>
          <th>Customer</th>
          <th>Code</th>
          <th>Product</th>
          <th class="text-right">Price</th>
          <th>Qty</th>
          <th class="text-right">Amount</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (!empty($data)) {
          foreach ($data as $key => $value) {
            $key++;
        ?>
            <tr>
              <td><?= $key ?></td>
              <td><?= $formater->dateTime($value['created_at']) ?></td>
              <td><?= $value['customer_name'] ?></td>
              <td><?= Html::a($value['code'], ['booking/view', 'id' => $value['code']], ['target' => '_blank']) ?></td>
              <td><?= Html::a($value['name'], ['product/form', 'id' => $value['product_id']], ['target' => '_blank']) ?></td>
              <td class="text-right"><?= $value['price'] ?></td>
              <td><?= $value['total_guest'] ?> pax(s)</td>
              <td class="text-right"><?= $value['total_price'] ?></td>
            </tr>
        <?php
          }
        } else {
          echo "<tr><th colspan='100%'>There are no records found.</th></tr>";
        }
        ?>
      </tbody>
      <tfoot>
        <tr>
          <th class="text-right" colspan="7"><mark>Total Sale Amount</mark></th>
          <th class="text-right"><mark><?= $formater->DollarFormat(array_sum(array_column($data, 'total_price'))) ?></mark></th>
        </tr>
      </tfoot>
    </table>
  </div>
</div>

<?php
$script = <<<JS

  $(document).on("change","#customerId", function(){
      $('#submitSearch').trigger('submit');
  });

  $('#dateRange').daterangepicker({
      autoUpdateInput: false,
      drops: 'down',
      locale: {
          cancelLabel: 'Cancel',
            format: 'YYYY-MM-DD'
      }
  });

  $('#dateRange').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
      $('#submitSearch').trigger('submit');
  });

  $('#dateRange').on('cancel.daterangepicker', function(ev, picker) {
      // $(this).val('');
  });

JS;
$this->registerJs($script);
?>