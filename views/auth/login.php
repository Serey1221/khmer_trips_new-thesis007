<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

?>
<section class="login-form-section">
    <h3 class="text-center">Log in to <span class="text-uppercase">Khmertravel</span></h3>
    <hr>
    <?php $form = ActiveForm::begin([
        'action' => ['site/login'],
        'options' => ['id' => 'registerForm'],
        // 'enableAjaxValidation' => false,
        // 'enableClientValidation' => true
    ]); ?>
    <?= $form->field($model, 'username')->textInput(['class' => 'form-control p-4', 'placeholder' => "Enter your email address"])->label(false) ?>

    <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control p-4', 'placeholder' => "Enter your password"])->label(false) ?>
    <div>
        <?= Html::submitButton("Login Now", ['class' => 'btn btn-primary btn-block py-3']) ?>
    </div>
    <?php ActiveForm::end() ?>
    <div class="text-center my-3">
        Don't Have an account? <a class="btnBackToRegister" href="javascript:;">Create Now</a>
    </div>
</section>
<section class="signup-form-section" style="display: none;">
    <p>Check out more easily and access your tickets on any device with your Khmertravel account.</p>
    <hr>
    <?php $form = ActiveForm::begin([
        'action' => 'site/register',
        'options' => ['id' => 'registerForm'],
        'enableAjaxValidation' => false,
        'enableClientValidation' => true
    ]); ?>
    <div class="row">
        <div class="col-md-12 mb-2">
            <div class="form-group">
                <input type="text" class="form-control p-4" name="registerName" placeholder="Your Name" required="required" />
            </div>
        </div>
    </div>
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
                <input type="number" class="form-control p-4" name="registerPhonenumber" placeholder="Phone Number" required="required" />
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
        <?= Html::submitButton("Sign Up Now", ['class' => 'btn btn-primary btn-block py-3']) ?>
    </div>
    <?php ActiveForm::end() ?>
    <div class="text-center my-3">
        Already have an account? <a class="btnBacktoLogin" href="javascript:;">Login Now</a>
    </div>
</section>

<?php
$script = <<<JS

    $(".btnBackToRegister").click(function(){
        $("section.signup-form-section").show();
        $("section.login-form-section").hide();
    });

    $(".btnBacktoLogin").click(function(){
        $("section.signup-form-section").hide();
        $("section.login-form-section").show();
    });

JS;
$this->registerJs($script);
?>