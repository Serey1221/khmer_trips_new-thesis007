<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\City $model */
/** @var yii\widgets\ActiveForm $form */
?>
<style>
    .city-form {
        padding-top: 20px
    }
</style>
<div class="city-form">

    <?php
    $validationUrl = ['city/validation'];
    if (!$model->isNewRecord) {
        $validationUrl['id'] = $model->id;
    }
    $form = ActiveForm::begin([
        'options' => ['id' => 'cityForm', 'enctype' => 'multipart/form-data'],
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
        'validationUrl' => $validationUrl
    ]); ?>
    <div class="card">
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-lg-9">
                    <?= $form->field($model, 'name')->textInput(['class' => 'form-control form-control-lg', 'maxlength' => true, 'placeholder' => ' Name of City'])->label(false) ?>
                    <?= $form->field($model, 'name_kh')->textInput(['class' => 'form-control form-control-lg', 'maxlength' => true, 'placeholder' => ' Name Khmer of City'])->label(false) ?>
                    <?= $form->field($model, 'description')->textarea(['rows' => 12, 'placeholder' => 'Short Description'])->label(false) ?>
                    <?= Html::submitButton('<i class="far fa-save mr-1"></i> Save', ['class' => 'btn btn-success']) ?>
                </div>
                <div class="form-group col-lg-3">
                    <div class="form-upload-image">
                        <div class="preview">
                            <?= Html::img($model->isNewRecord ? Yii::getAlias("@web/app/img/not_found_sq.png") : $model->getThumbUploadUrl('img_url'), ['class' => 'img-thumbnail', 'id' => 'image_upload-preview', 'onerror' => "this.onerror=null;this.src='" . Yii::getAlias('@web/img/not_found_sq.png') . "';"]) ?>
                        </div>
                        <label for="image_upload"><i class="fas fa-image"></i> Upload Image</label>
                        <?= $form->field($model, 'img_url')->fileInput(['accept' => 'image/*', 'id' => 'image_upload'])->label(false) ?>
                    </div>
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
                </div>
            </div>

        </div>
    </div>

    <?php ActiveForm::end(); ?>


</div>
<?php
$script = <<<JS

    $(".submit-button").click(function(){
        var type = $(this).data("type");
        $("input[name='submit_type']").val(type);
        $('#cityForm').trigger('submit');
    });
    
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
            $("#city-status").val(1);
        }else{
            $("#city-status").val(0);
        }
    })

    

JS;

$this->registerJs($script);

?>