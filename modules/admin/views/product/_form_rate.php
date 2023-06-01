<?php

use app\modules\admin\models\City;
use app\modules\admin\models\ProductRateModify;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\Product $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = "Price setup: [{$model->code}] - {$model->name}";
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

if (!$model->isNewRecord) {
  $model->city_id = ArrayHelper::getColumn($model->cities, 'city_id');
}
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
  <div class="card card-primary card-outline card-outline-tabs">
    <div class="card-header p-0 border-bottom-0">
      <?= $this->render('_tab_menu', ['model' => $model]) ?>
    </div>
    <div class="card-body">
      <?= $this->render('/admin/drawer_right') ?>
      <div class="float-right">
        <?= Html::button("<i class='fas fa-plus'></i> Add Rate", ['class' => 'modalButton btn btn-link', 'data-title' => 'Add Rate', 'value' => Url::toRoute(['add-rate', 'type' => $model->type, 'productId' => $model->id])]) ?>
      </div>
      <h3>Price setup</h3>
      <hr>
      <?php
      if (!empty($modelRate)) {
      ?>
        <table class="table">
          <thead>
            <tr>
              <th>Period</th>
              <th>Modify Rate</th>
              <th>Selling Rate</th>
              <th></th>
            </tr>
          </thead>
          <?php
          foreach ($modelRate as $key => $value) {
            if ($value->amount_type == ProductRateModify::FIXED_AMOUNT) {
              $modifyAmount = $value->amount;
            } else {
              $modifyAmount = ($value->product->rate * $value->amount) / 100;
            }
            $modifyAmount = Yii::$app->formater->Dollarformat($modifyAmount);
          ?>
            <tr>
              <td><?= $value->from_date . ' to ' . $value->to_date ?></td>
              <td><?= $value->amount, ' ', ($value->amount_type == 1 ? '$' : '%') ?></td>
              <td><?= $modifyAmount ?></td>
              <td><?= Html::button("<i class='fas fa-pen'></i> Update Rate", ['class' => 'modalButton btn btn-link', 'data-title' => 'Add Rate', 'value' => Url::toRoute(['update-rate', 'id' => $value->id])]) ?></td>
            </tr>
          <?php
          }
          ?>
        </table>
      <?php
      }
      ?>
    </div>
  </div>

</div>
<?php
$script = <<<JS
   $(document).on("click",".modalButton",function () {
        $("#modalDrawerRight").modal("show")
            .find("#modalContent")
            .load($(this).attr("value"));
        $("#modalDrawerRight").find("#modalDrawerRightLabel").text($(this).data("title"));
    });

 

JS;

$this->registerJs($script);

?>