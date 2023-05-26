<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

?>

<p>Check out more easily and access your tickets on any device with your Khmertravel account.</p>
<hr>
<?php $form = ActiveForm::begin([
  'action' => 'site/register',
  'options' => ['id' => 'registerForm'],
  'enableAjaxValidation' => false,
  'enableClientValidation' => true
]); ?>

<div class="form-group mt-4">
  <input type="email" class="form-control p-4" name="registerEmail" placeholder="Your email" required="required" />
</div>
<div class="form-group">
  <input type="password" class="form-control p-4" name="registerPassword" placeholder="Your password" required="required" />
</div>

<div>
  <?= Html::submitButton("Sign Up Now", ['class' => 'btn btn-primary btn-block py-3']) ?>
</div>
<?php ActiveForm::end() ?>