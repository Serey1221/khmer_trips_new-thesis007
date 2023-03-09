<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\assets\EditorAsset;

EditorAsset::register($this);
$inputFloatLabel = '<div class="form-label-group">{input} {label} {error}{hint}</div>';
?>
<?php
$form = ActiveForm::begin([
  'options' => ['id' => 'galleryForm', 'enctype' => 'multipart/form-data'],
]); ?>
<div class="form-upload-image">
  <div class="preview">
    <?= Html::img($model->isNewRecord ? Yii::getAlias("@web/img/placeholder.png") : $model->getThumbUploadUrl('img_url'), ['class' => 'img-thumbnail', 'id' => 'image_upload-preview']) ?>
  </div>
  <label for="image_upload"><i class="fas fa-image"></i> Upload Image</label>
  <?= $form->field($model, 'img_url')->fileInput(['accept' => 'image/*', 'id' => 'image_upload'])->label(false) ?>
</div>
<?= $form->field($model, 'title', ['template' => $inputFloatLabel])->textInput(['class' => 'form-control']) ?>
<?= $form->field($model, 'sub_title', ['template' => $inputFloatLabel])->textInput(['class' => 'form-control']) ?>
<?= $form->field($model, 'description')->textArea(['rows' => 2]); ?>


<?= Html::submitButton('<i class="far fa-save"></i> Save changes', ['class' => 'btn btn-primary', 'id' => 'save_button'])
?>
<?php ActiveForm::end(); ?>

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

JS;
$this->registerJs($script);
?>