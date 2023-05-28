<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

?>

<h3 class="text-center">Portal login</h3>
<hr>
<?php $form = ActiveForm::begin([
    'action' => 'site/login',
    'options' => ['id' => 'registerForm'],
    'enableAjaxValidation' => false,
    'enableClientValidation' => true
]); ?>
<div class="row">
    <div class="col-md-12 mb-2">
        <div class="form-group">
            <input type="email" class="form-control p-4" name="registerEmail" placeholder="Your email" required="required" />
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 mb-2">
        <div class="form-group">
            <input type="password" class="form-control p-4" name="registerPassword" placeholder="Your password" required="required" />
        </div>
    </div>
</div>


<div>
    <?= Html::submitButton("Login Now", ['class' => 'btn btn-primary btn-block py-3']) ?>
</div>
<?php ActiveForm::end() ?>