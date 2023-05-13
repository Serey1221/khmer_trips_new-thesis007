<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\Product $model */
/** @var yii\widgets\ActiveForm $form */

function iconTemplate($icon)
{
    return "<div>
<span class='{$icon}'></span>
<label class='form-label'>
    {label}
    <span class='required'>*</span>
</label>
<div class='form-item'>{input}</div>
</div>";
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
                                iconTemplate("flag-icon flag-icon-gb flag-icon-squared")
                            ]) ?>
                            <?= $form->field($model, 'namekh', ['template' =>
                            iconTemplate("flag-icon flag-icon-kh flag-icon-squared")]) ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <?php
                        if ($model->isTour()) {
                        ?>
                            <div class="form-group col-lg-3">
                                <?= $form->field($model, 'tourday') ?>
                            </div>
                            <div class="form-group col-lg-3">
                                <?= $form->field($model, 'tournight')  ?>
                            </div>
                        <?php } ?>
                        <?php
                        if ($model->isActivity()) {
                        ?>
                            <div class="form-group col-lg-3">
                                <?= $form->field($model, 'tourhour')  ?>
                            </div>
                            <div class="form-group col-lg-3">
                                <?= $form->field($model, 'tourmin')  ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <?= $form->field($model, 'overview')->textarea(['rows' => 4]) ?>
                        </div>
                        <div class="form-group col-lg-6">
                            <?= $form->field($model, 'overviewkh')->textarea(['rows' => 4]) ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <?= $form->field($model, 'highlight')->textarea(['rows' => 4]) ?>
                        </div>
                        <div class="form-group col-lg-6">
                            <?= $form->field($model, 'highlight_kh')->textarea(['rows' => 4]) ?>
                        </div>
                    </div>



                    <div class="form-row">
                        <div class="form-check col-lg-6">
                            <?= $form->field($model, 'pick_up')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="form-check col-lg-6">
                            <?= $form->field($model, 'pick_up_kh')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-check col-lg-6">
                            <?= $form->field($model, 'drop_off')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="form-check col-lg-6">
                            <?= $form->field($model, 'drop_off_kh')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="form-row ">
                        <div class="form-check col-lg-6">
                            <?= $form->field($model, 'price_include')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="form-check col-lg-6">
                            <?= $form->field($model, 'price_include_kh')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="form-row ">
                        <div class="form-check col-lg-6">
                            <?= $form->field($model, 'price_exclude')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="form-check col-lg-6">
                            <?= $form->field($model, 'price_exclude_kh')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div hidden class="hide">
                                <?= $form->field($model, 'rate')->hiddenInput()->label(false); ?>
                            </div>
                            <label>Star Rating</label>
                            <div class="rating">
                                <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label>
                                <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label>
                                <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
                                <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
                                <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-check form-switch col-lg-6">
                            <?php // $form->field($model, 'status')->checkbox() 
                            ?>

                        </div>
                    </div>
                </div>
                <div class="form-group col-lg-3">
                    <p class="font-weight-bold">Banner Image</p>
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
        $('#productForm').trigger('submit');
    });


    $("#itemStatus").change(function(){
        if($(this).is(":checked")){
            $("#product-status").val(1);
        }else{
            $("#product-status").val(0);
        }
    })

    

    $("#image_upload").change(function(){
        if(event.target.files.length > 0){
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("image_upload-preview");
            preview.src = src;
            preview.style.display = "block";
        }
    });

    $(".rating input").click(function(){
        var rate = $(this).val();
        $("#product-rate").val(rate);
    });

JS;

$this->registerJs($script);

?>