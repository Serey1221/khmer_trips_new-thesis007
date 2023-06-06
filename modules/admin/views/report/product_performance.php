<?php

use app\assets\DatetimepickerAsset;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\ArrayHelper;

DatetimepickerAsset::register($this);

$this->title = 'Product Performance Report';
$this->params['breadcrumbs'][] = ['label' => 'Reports', 'url' => 'javascript:;'];
$this->params['breadcrumbs'][] = $this->title;

/** @var app\components\Formater $formater */
$formater = Yii::$app->formater;

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
    <div class="text-right">
      <?= Html::a("<i class='fas fa-file-csv'></i> Export CSV", [
        'report/export-product-performance', 'fromDate' => $fromDate, 'toDate' => $toDate
      ], ['class' => 'btn btn-secondary mt-4']); ?>
    </div>
  </div>
</div>
<button type="submit" id="submitSearch" hidden class="btn btn-warning hide">Apply Change</button>
<?php ActiveForm::end(); ?>
<div class="row">
  <div class="col-lg-6">
    <div class="card">
      <div class="card-body">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Product</th>
              <th width="20%" class="text-right">Total</th>
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
                  <td><?= $value['name'] ?></td>
                  <td class="text-right">
                    <div><strong><?= $value['total_price'] ?></strong></div>
                    <?= "x{$value['total_booking']} booking(s)" ?>
                  </td>
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
              <th class="text-right" colspan="2"><mark>Total Amount</mark></th>
              <th class="text-right"><mark><?= $formater->DollarFormat(array_sum(array_column($data, 'total_price'))) ?></mark></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>


<?php
$script = <<<JS

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