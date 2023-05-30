<?php

use app\modules\admin\models\City;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\Product $model */
/** @var yii\widgets\ActiveForm $form */

$this->registerJsFile("https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js", ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerCssFile("https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css", ['depends' => [\yii\bootstrap4\BootstrapAsset::class]]);

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
                            <?= $form->field($model, 'overview')->textarea(['rows' => 6]) ?>
                        </div>
                        <div class="form-group col-lg-6">
                            <?= $form->field($model, 'overviewkh')->textarea(['rows' => 6]) ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <?= $form->field($model, 'highlight')->textarea(['rows' => 6]) ?>
                        </div>
                        <div class="form-group col-lg-6">
                            <?= $form->field($model, 'highlight_kh')->textarea(['rows' => 6]) ?>
                        </div>
                    </div>



                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <?= $form->field($model, 'pick_up')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="form-group col-lg-6">
                            <?= $form->field($model, 'pick_up_kh')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <?= $form->field($model, 'drop_off')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="form-group col-lg-6">
                            <?= $form->field($model, 'drop_off_kh')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="form-row ">
                        <div class="form-group col-lg-6">
                            <?= $form->field($model, 'price_include')->textarea(['rows' => 4]) ?>
                        </div>
                        <div class="form-group col-lg-6">
                            <?= $form->field($model, 'price_include_kh')->textarea(['rows' => 4]) ?>
                        </div>
                    </div>
                    <div class="form-row ">
                        <div class="form-group col-lg-6">
                            <?= $form->field($model, 'price_exclude')->textarea(['rows' => 4]) ?>
                        </div>
                        <div class="form-group col-lg-6">
                            <?= $form->field($model, 'price_exclude_kh')->textarea(['rows' => 4]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <?= $form->field($model, 'city_id')->widget(Select2::class, [
                                'data' => ArrayHelper::map(City::find()->all(), 'id', 'name'),
                                'theme' => Select2::THEME_BOOTSTRAP,
                                'options' => ['placeholder' => 'Select'],
                                'pluginOptions' => [
                                    'multiple' => true,
                                    'allowClear' => true
                                ],
                            ]); ?>
                        </div>
                        <div class="col-lg-6">
                            <div hidden class="hide">
                                <?= $form->field($model, 'rating')->hiddenInput()->label(false); ?>
                            </div>
                            <label>Star Rating</label>
                            <div class="rating">
                                <input type="radio" name="rating" <?= $model->rating == 5 ? 'checked' : '' ?> value="5" id="5"><label for="5">☆</label>
                                <input type="radio" name="rating" <?= $model->rating == 4 ? 'checked' : '' ?> value="4" id="4"><label for="4">☆</label>
                                <input type="radio" name="rating" <?= $model->rating == 3 ? 'checked' : '' ?> value="3" id="3"><label for="3">☆</label>
                                <input type="radio" name="rating" <?= $model->rating == 2 ? 'checked' : '' ?> value="2" id="2"><label for="2">☆</label>
                                <input type="radio" name="rating" <?= $model->rating == 1 ? 'checked' : '' ?> value="1" id="1"><label for="1">☆</label>
                            </div>
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
                            <div class=""><?= Yii::t('app', 'Restriction Area') ?></div>
                            <hr>
                            <?= $form->field($model, 'rate')->textInput(['type' => 'number'])->label('Rate') ?>

                            <div class="form-group">
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
            $("#product-status").val(1);
        }else{
            $("#product-status").val(0);
        }
    })

    $(".rating input").click(function(){
        var rate = $(this).val();
        $("#product-rating").val(rate);
    });

JS;

$this->registerJs($script);

?>