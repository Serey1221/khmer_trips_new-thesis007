<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\assets\EditorAsset;
use app\modules\admin\models\ArticleCategory;

EditorAsset::register($this);
// $category = ArrayHelper::map(ArticleCategory::find()->all(), 'id', 'name');
?>
<style>
    textarea {
        resize: none;
    }

    .form-group.note-form-group.note-group-select-from-files {
        display: none;
    }
</style>
<div class="blog-form">

    <?php
    $validationUrl = ['article/validation'];
    if (!$model->isNewRecord) {
        $validationUrl['id'] = $model->id;
    }
    $form = ActiveForm::begin([
        'options' => ['id' => 'articleForm', 'enctype' => 'multipart/form-data'],
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
        'validationUrl' => $validationUrl
    ]);
    ?>

    <div class="row">
        <div class="col-lg-9">
            <?= $form->field($model, 'title')->textInput(['class' => 'form-control form-control-lg', 'autofocus' => true, 'placeholder' => 'Blog Title'])->label(false) ?>
            <?= $form->field($model, 'short_description')->textArea(['rows' => 3, 'placeholder' => 'Short description'])->label(false) ?>
            <?= $form->field($model, 'description')->textArea()->label(false) ?>

        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'slug')->textInput()->label('URL Slug <abbr title="Required">*</abbr>') ?>
            <?php // $form->field($model, 'category_id')->dropDownList($category, ['data-toggle' => 'selectpicker', 'data-width' => "100%", 'data-size' => 5])->label('Category <abbr title="Required">*</abbr>') 
            ?>

            <p>Banner Image</p>
            <div class="form-upload-image">
                <div class="preview">
                    <?= Html::img($model->isNewRecord ? Yii::getAlias("@web/img/not_found_sq.png") : $model->getThumbUploadUrl('img_url'), ['class' => 'img-thumbnail', 'id' => 'image_upload-preview', 'onerror' => "this.onerror=null;this.src='" . Yii::getAlias('@web/img/not_found_sq.png') . "';"]) ?>
                </div>
                <label for="image_upload"><i class="fas fa-image"></i> Upload Image</label>
                <?= $form->field($model, 'img_url')->fileInput(['accept' => 'image/*', 'id' => 'image_upload'])->label(false) ?>
            </div>
            <div class="card border border-warning">
                <div class="card-body">
                    <div class="card-title"><?= Yii::t('app', 'Restriction Area') ?></div>

                    <div class="d-flex justify-content-between align-items-center">
                        <span class="font-weight-bold">Publish Post</span>
                        <?= $form->field($model, 'status')->hiddenInput()->label(false); ?>
                        <label class="switcher-control switcher-control-danger switcher-control-lg">
                            <input type="checkbox" value="<?= $model->status ?>" id="itemStatus" class="switcher-input" <?= $model->status == 1 ? 'checked' : '' ?>>
                            <span class="switcher-indicator"></span>
                            <span class="switcher-label-on"><i class="fas fa-check"></i></span>
                            <span class="switcher-label-off"><i class="fas fa-times"></i></span>
                        </label>
                    </div>
                </div>
            </div>
            <?php // Html::submitButton('Save', ['class' => 'btn btn-block btn-primary']) 
            ?>
            <input type="hidden" name="submit_type" value="save">
            <div class="btn-group btn-block" role="group" aria-label="Button group with nested dropdown">
                <button type="submut" class="btn btn-primary">Save</button>
                <!-- <div class="btn-group" role="group">
                    <button id="btnGroupDrop4" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop4">
                        <div class="dropdown-arrow"></div>
                        <a class="dropdown-item submit-button" data-type="save_add_new" href="#">Save and Create New</a>
                        <a class="dropdown-item submit-button" data-type="save_close" href="#">Save and Close</a>
                        <?php if (!$model->isNewRecord) { ?>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item submit-button" data-type="save_duplicate" href="#">Duplicate</a>
                        <?php } ?>
                    </div>
                </div> -->
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
                    ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                    ['float', ['floatLeft', 'floatRight', 'floatNone']],
                    ['custom', ['imageTitle']],
                    ['remove', ['removeMedia']],
                ],
                link: [
                    ['link', ['linkDialogShow', 'unlink']]
                ],
            },
            minHeight: 400,
            toolbar: [
                ['style', ['style','bold', 'italic', 'underline', 'ul', 'paragraph', 'clear']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'help']]
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