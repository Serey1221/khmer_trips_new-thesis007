<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $model->isNewRecord ? "Add New Guide" : "Update Guide: {$model->name}";
$languages = [
  'english' => 'English',
  'korea' => 'Korea',
  'cambodia' => 'Cambodia'
];
?>
<style>
  .guide-profile-form {
    padding-top: 20px
  }
</style>
<div class="guide-profile-form">
  <?php
  $validationUrl = ['guide-profile/validation'];
  if (!$model->isNewRecord) {
    $validationUrl['id'] = $model->id;
  }
  $form = ActiveForm::begin([
    'options' => ['id' => 'guide-profileForm', 'enctype' => 'multipart/form-data'],
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
    'validationUrl' => $validationUrl
  ]); ?>
  <div class="card">
    <div class="card-header">
      <div class="h3"><?= $this->title ?></div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-lg-4">
          <div class="form-upload-image">
            <div class="preview">
              <?= Html::img($model->isNewRecord ? Yii::getAlias("@web/app/img/not_found_sq.png") : $model->getThumbUploadUrl('img_url'), ['class' => 'img-thumbnail', 'id' => 'image_upload-preview', 'onerror' => "this.onerror=null;this.src='" . Yii::getAlias('@web/img/not_found_sq.png') . "';"]) ?>
            </div>
            <label for="image_upload"><i class="fas fa-image"></i> Upload Image</label>
            <?= $form->field($model, 'img_url')->fileInput(['accept' => 'image/*', 'id' => 'image_upload'])->label(false) ?>
          </div>
        </div>
        <div class="col-lg-8">
          <?= $form->field($model, 'name')->textInput(['class' => 'form-control form-control-lg', 'maxlength' => true, 'placeholder' => 'Enter name of guide'])->label() ?>
          <?= $form->field($model, 'language')->dropDownList($languages, ['class' => 'form-control form-control-lg', 'prompt' => 'Select'])->label() ?>
          <div class="card border shadow bg-white rounded">
            <div class="card-body ">
              <div class="card-title ml-4 mb-3"><?= Yii::t('app', 'Restriction Area') ?></div>

              <div class="form-group ml-4">
                <div class="custom-control custom-switch">
                  <?= $form->field($model, 'status')->hiddenInput()->label(false); ?>
                  <input type="checkbox" class="custom-control-input" value="<?= $model->status ?>" id="itemStatus" <?= $model->status == 1 ? 'checked' : '' ?>>
                  <label class="custom-control-label" for="itemStatus">Publish Post</label>
                </div>
              </div>
            </div>
          </div>
          <?= Html::submitButton($model->isNewRecord ? '<i class="far fa-save mr-1"></i> Add New' : '<i class="far fa-save mr-1"></i> Save Changes', ['class' => 'btn btn-success']) ?>

        </div>
      </div>

    </div>
  </div>

  <?php ActiveForm::end(); ?>


</div>
<?php
$script = <<<JS
    
    $("#image_upload").change(function(){
        if(event.target.files.length > 0){
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("image_upload-preview");
            preview.src = src;
            preview.style.display = "block";
        }
    });

    $("#itemStatus").change(function(){
        if($(this).is(":checked")){
            $("#guide-profile-status").val(1);
        }else{
            $("#guide-profile-status").val(0);
        }
    })    

JS;

$this->registerJs($script);

?>