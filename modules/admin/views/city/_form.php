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
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => ' Name of City'])->label(false) ?>
                    <?= $form->field($model, 'name_kh')->textInput(['maxlength' => true, 'placeholder' => ' Name Khmer of City'])->label(false) ?>
                    <?= $form->field($model, 'description')->textarea(['rows' => 6, 'placeholder' => 'Short Description'])->label(false) ?>
                    <?= Html::submitButton('<i class="far fa-save mr-1"></i> Save', ['class' => 'btn btn-success']) ?>
                </div>
                <div class="form-group col-lg-3">
                    <!-- <p>Banner Image</p> -->
                    <div class="form-upload-image">
                        <div class="preview">
                            <?= Html::img($model->isNewRecord ? Yii::getAlias("@web/app/img/not_found_sq.png") : $model->getThumbUploadUrl('img_url'), ['class' => 'img-thumbnail', 'id' => 'image_upload-preview', 'onerror' => "this.onerror=null;this.src='" . Yii::getAlias('@web/img/not_found_sq.png') . "';"]) ?>
                        </div>
                        <label for="image_upload"><i class="fas fa-image"></i> Upload Image</label>
                        <?= $form->field($model, 'img_url')->fileInput(['accept' => 'image/*', 'id' => 'image_upload'])->label(false) ?>
                    </div>
                </div>
            </div>
            <!-- <div class="form-row">
                <div class="form-group col-lg-12">


                    <?php // $form->field($model, 'country_id')->textInput() 
                    ?>
                </div>
            </div> -->
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

    $("#itemStatus").change(function(){
        if($(this).is(":checked")){
            $("#article-status").val(1);
        }else{
            $("#article-status").val(0);
        }
    })

    function summerTextEditor(textareaID){
        $(textareaID).summernote({
            imageTitle: {
                specificAltField: true,
            },
            popover: {
                image: [
                    ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                    ['float', ['floatLeft', 'floatRight', 'floatNone']],
                    ['remove', ['removeMedia']],
                ],
                link: [
                    ['link', ['linkDialogShow', 'unlink']]
                ],
            },
            minHeight: 400,
            toolbar: [
                ['style', ['style','bold', 'italic', 'underline', 'ul', 'paragraph', 'clear']],
                ['color', ['color']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen','codeview', 'help']]
            ]
           
        });
    }

    summerTextEditor("#article-description");

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