<?php

use app\modules\admin\models\City;
use app\modules\admin\models\ProductStyle;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\Product $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = $model->isNewRecord ? "Create Product" : "Update Product: [{$model->code}] - {$model->name}";
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile("https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js", ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerCssFile("https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css", ['depends' => [\yii\bootstrap4\BootstrapAsset::class]]);


if (!$model->isNewRecord) {
    $model->city_id = ArrayHelper::getColumn($model->cities, 'city_id');
    $model->style_id = ArrayHelper::getColumn($model->styles, 'style_id');
}

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

$currencyInput = "{label}<div class='input-group'>
        <div class='input-group-prepend'>
            <span class='input-group-text'><i class='fas fa-dollar-sign'></i></span>
        </div>
        {input}
</div>{error}{hint}";
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
                <div class="col-lg-3">
                    <p class="font-weight-bold">Banner Image</p>
                    <div class="form-upload-image">
                        <div class="preview">
                            <?= Html::img($model->isNewRecord ? Yii::getAlias("@web/app/img/not_found_sq.png") : $model->getThumbUploadUrl('img_url'), ['class' => 'img-thumbnail', 'id' => 'image_upload-preview', 'onerror' => "this.onerror=null;this.src='" . Yii::getAlias('@web/img/not_found_sq.png') . "';"]) ?>
                        </div>
                        <label for="image_upload"><i class="fas fa-image"></i> Upload Image</label>
                        <?= $form->field($model, 'img_url')->fileInput(['accept' => 'image/*', 'id' => 'image_upload'])->label(false) ?>
                    </div>
                </div>
                <div class="col-lg offset-lg-1">
                    <?= $form->field($model, 'name', [
                        'template' =>
                        iconTemplate("flag-icon flag-icon-gb flag-icon-squared")
                    ]) ?>

                    <?= $form->field($model, 'namekh', [
                        'template' =>
                        iconTemplate("flag-icon flag-icon-kh flag-icon-squared")
                    ]) ?>
                    <div class="row">
                        <?php
                        if ($model->isTour()) {
                        ?>
                            <div class="col-lg-3">
                                <?= $form->field($model, 'tourday')->textInput(['type' => 'number', 'min' => 0]) ?>
                            </div>
                            <div class="col-lg-3">
                                <?= $form->field($model, 'tournight')->textInput(['type' => 'number', 'min' => 0])  ?>
                            </div>
                        <?php } ?>
                        <?php
                        if ($model->isActivity()) {
                        ?>
                            <div class="col-lg-3">
                                <?= $form->field($model, 'tourhour')->textInput(['type' => 'number', 'min' => 0])  ?>
                            </div>
                            <div class="col-lg-3">
                                <?= $form->field($model, 'tourmin')->textInput(['type' => 'number', 'min' => 0])  ?>
                            </div>
                        <?php } ?>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'code')->textInput(['readonly' => true]) ?>
                        </div>
                        <div class="col-lg-3">
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
                    <div class="row">
                        <div class="col-lg-12">
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
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <?= $form->field($model, 'style_id')->widget(Select2::class, [
                                'data' => ArrayHelper::map(ProductStyle::find()->all(), 'id', 'name'),
                                'theme' => Select2::THEME_BOOTSTRAP,
                                'options' => ['placeholder' => 'Select'],
                                'showToggleAll' => false,
                                'pluginOptions' => [
                                    'multiple' => true,
                                    'maximumSelectionLength' => 3,
                                    'allowClear' => true
                                ],
                            ]); ?>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'rate', ['template' => $currencyInput])->textInput(['type' => 'number'])->label('Rack Rate') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <?= $form->field($model, 'status')->hiddenInput()->label(false); ?>
                            <input type="checkbox" class="custom-control-input" value="<?= $model->status ?>" id="itemStatus" <?= $model->status == 1 ? 'checked' : '' ?>>
                            <label class="custom-control-label" for="itemStatus">Publish this service to website</label>
                        </div>
                    </div>
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