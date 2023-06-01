<?php

use app\modules\admin\models\City;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\Product $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = "Term and Condition: [{$model->code}] - {$model->name}";
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile("https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js", ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerCssFile("https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css", ['depends' => [\yii\bootstrap4\BootstrapAsset::class]]);


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
      <?php
      $validationUrl = ['product/validation'];
      if (!$model->isNewRecord) {
        $validationUrl['id'] = $model->id;
      }
      $form = ActiveForm::begin([
        'options' => ['id' => 'productForm', 'enctype' => 'multipart/form-data'],
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
        'validationUrl' => $validationUrl
      ]); ?>

      <div class="row">
        <div class="col-lg-6">
          <?= $form->field($model, 'price_include')->textarea(['rows' => 4]) ?>
        </div>
        <div class="col-lg-6">
          <?= $form->field($model, 'price_include_kh')->textarea(['rows' => 4]) ?>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <?= $form->field($model, 'price_exclude')->textarea(['rows' => 4]) ?>
        </div>
        <div class="col-lg-6">
          <?= $form->field($model, 'price_exclude_kh')->textarea(['rows' => 4]) ?>
        </div>
      </div>

      <hr>
      <div class="form-group text-right">
        <?= Html::submitButton('<i class="far fa-save mr-1"></i> Save Changes', ['class' => 'btn btn-success']) ?>
      </div>
      <?php ActiveForm::end(); ?>
    </div>
  </div>

</div>
<?php
$script = <<<JS

 

JS;

$this->registerJs($script);

?>