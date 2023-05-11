<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\Product $model */
/** @var yii\widgets\ActiveForm $form */
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

    <?php $form = ActiveForm::begin([
        'options' => ['id' => 'productForm', 'enctype' => 'multipart/form-data'],
    ]); ?>
    <div class="card">
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-lg-9">
                    <?php // $form->field($model, 'name')->textInput(['maxlength' => true]) 
                    ?>
                    <div class="form-row">
                        <div class="form-group col-lg-12">
                            <?= $form->field($model, 'name', [
                                'template' =>
                                '<div>
                        <span class="flag-icon flag-icon-gb flag-icon-squared"></span>
                        <label class="form-label">
                            {label}
                            <span class="required">*</span>
                        </label>
                        <div class="form-item">{input}</div>
                     </div>'
                            ]) ?>
                            <?= $form->field($model, 'namekh', ['template' =>
                            '<div >
                        <span class="flag-icon flag-icon-kh flag-icon-squared"></span>
                        <label class="form-label">
                            {label}
                    
                            <span class="required">*</span>
                        </label>
                        <div class="form-item">{input}</div>
                     </div>']) ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-3">
                            <?= $form->field($model, 'tourday', ['template' =>
                            '<div>
                    <label class="form-label">
                        {label}
                    </label>
                    <div class="form-item">{input}</div>
                    </div>']) ?>
                        </div>
                        <div class="form-group col-lg-3">
                            <?= $form->field($model, 'tournight', ['template' =>
                            '<div>
                    <label class="form-label">
                        {label}
                    </label>
                    <div class="form-item">{input}</div>
                    </div>'])  ?>
                        </div>
                        <div class="form-group col-lg-3">
                            <?= $form->field($model, 'tourhour', ['template' =>
                            '<div>
                    <label class="form-label">
                        {label}
                    </label>
                    <div class="form-item">{input}</div>
                    </div>'])  ?>
                        </div>
                        <div class="form-group col-lg-3">
                            <?= $form->field($model, 'tourmin', ['template' =>
                            '<div>
                    <label class="form-label">
                        {label}
                    </label>
                    <div class="form-item">{input}</div>
                    </div>'])  ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <?= $form->field($model, 'overview')->textarea(['rows' => 3]) ?>
                        </div>
                        <div class="form-group col-lg-6">
                            <?= $form->field($model, 'overviewkh')->textarea(['rows' => 3]) ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <?= $form->field($model, 'highlight')->textarea(['rows' => 3]) ?>
                        </div>
                        <div class="form-group col-lg-6">
                            <?= $form->field($model, 'highlight_kh')->textarea(['rows' => 3]) ?>
                        </div>
                    </div>



                    <div class="form-row">
                        <div class="form-check col-lg-2">
                            <?= $form->field($model, 'pick_up')->radio(['maxlength' => true]) ?>
                        </div>
                        <div class="form-check col-lg-2">
                            <?= $form->field($model, 'pick_up_kh')->radio(['maxlength' => true]) ?>
                        </div>
                        <div class="form-check col-lg-2">
                            <?= $form->field($model, 'drop_off')->radio(['maxlength' => true]) ?>
                        </div>
                        <div class="form-check col-lg-2">
                            <?= $form->field($model, 'drop_off_kh')->radio(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-check col-lg-4">
                            <?= $form->field($model, 'price_include_kh')->checkbox(['maxlength' => true]) ?>
                        </div>
                        <div class="form-check col-lg-4">
                            <?= $form->field($model, 'price_exclude_kh')->checkbox(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <?= $form->field($model, 'rate', [])->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-check form-switch col-lg-6">
                            <?= $form->field($model, 'status')->checkbox() ?>

                        </div>
                    </div>
                </div>
                <div class="form-group col-lg-3">
                    <p>Banner Image</p>
                    <div class="form-upload-image">
                        <div class="preview">
                            <?= Html::img($model->isNewRecord ? Yii::getAlias("@web/app/img/not_found_sq.png") : $model->getThumbUploadUrl('img_url'), ['class' => 'img-thumbnail', 'id' => 'image_upload-preview', 'onerror' => "this.onerror=null;this.src='" . Yii::getAlias('@web/img/not_found_sq.png') . "';"]) ?>
                        </div>
                        <label for="image_upload"><i class="fas fa-image"></i> Upload Image</label>
                        <?= $form->field($model, 'img_url')->fileInput(['accept' => 'image/*', 'id' => 'image_upload'])->label(false) ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton('<i class="far fa-save mr-1"></i>  Save', ['class' => 'btn btn-success']) ?>
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
        $('#articleForm').trigger('submit');
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