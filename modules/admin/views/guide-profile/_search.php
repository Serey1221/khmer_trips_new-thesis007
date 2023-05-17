<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\GuideProfileSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
  .blank_space_label {
    padding-top: 32px;
  }
</style>
<div class="order-search">

  <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'options' => ['data-pjax' => true, 'id' => 'formGuideProfileSearch'],
    'method' => 'get',
  ]); ?>
  <div class="row">
    <div class="col-lg-4 offset-lg-6">
      <?= $form->field($model, 'globalSearch')->textInput(['placeholder' => 'Search by guide name'])->label('Search') ?>
    </div>
    <div class="col-lg-2">
      <div class="float-right">
        <div class="blank_space_label"></div>
        <?= Html::a('<i class="fas fa-plus mr-1"></i> Add Guide', ['create'], ['class' => 'btn rounded-pill btn-success']) ?>
      </div>
    </div>
  </div>

  <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<<JS


    $(document).on("change","#guideprofilesearch-globalsearch", function(){
        $('#formGuideProfileSearch').trigger('submit');
    });


    $(".triggerModal").click(function(){
        $("#modal").modal("show")
            .find("#modalContent")
            .load($(this).attr("value"));
        $("#modal").find("#modal-label").text($(this).data("title"));

    });

JS;
$this->registerJs($script);
?>