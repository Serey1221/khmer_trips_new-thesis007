<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\Faqs $model */
/** @var yii\widgets\ActiveForm $form */
?>
<div class="card">
    <div class="card-body">
        <div class="faqs-form">

            <?php $form = ActiveForm::begin(); ?>
            <div class="row">
                <div class="col-lg-8">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>
                </div>
                <div class="col-lg-4 mt-4">
                    <div class="card border shadow bg-white rounded">
                        <div class="card-body ">
                            <div class="card-title  ml-4"><?= Yii::t('app', 'Restriction Area') ?></div>
                            <hr class="mt-4">
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
                <div class="form-group">
                    <?= Html::submitButton('<i class="far fa-save mr-1"></i> Save', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>
<?php
$script = <<<JS

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