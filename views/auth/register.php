<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<p>Check out more easily and access your tickets on any device with your Khmertravel account.</p>
<hr>
<?php $form = ActiveForm::begin([
  'action' => Url::to('/site/register'), //'/site/register'
  'options' => ['id' => 'register_Form'],
  'enableAjaxValidation' => false,
  'enableClientValidation' => true
]); ?>
<div class="row">
  <div class="col-md-6 mb-2">
    <div class="form-group">
      <input type="text" class="form-control p-4" name="registerFirstName" placeholder="Your First Name" required="required" />
    </div>
  </div>
  <div class="col-md-6 mb-2">
    <div class="form-group">
      <input type="text" class="form-control p-4" name="registerLastName" placeholder="Your Last Name" required="required" />
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