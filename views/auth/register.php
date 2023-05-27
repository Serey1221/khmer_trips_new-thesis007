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
<div class="row justify-content-center align-items-center h-100">
  <div class="col-12 col-lg-9 col-xl-7">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group mt-4">
          <input type="email" class="form-control p-4" name="registerEmail" placeholder="Your email" required="required" />
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <input type="password" class="form-control p-4" name="registerPassword" placeholder="Your password" required="required" />
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 mb-4 d-flex align-items-center">

        <div class="form-outline datepicker w-100">
          <input type="text" class="form-control form-control-lg" id="birthdayDate" />
          <label for="birthdayDate" class="form-label">Birthday</label>
        </div>

      </div>
      <div class="col-md-6 mb-4">

        <h6 class="mb-2 pb-1">Gender: </h6>

        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="femaleGender" value="option1" checked />
          <label class="form-check-label" for="femaleGender">Female</label>
        </div>

        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="maleGender" value="option2" />
          <label class="form-check-label" for="maleGender">Male</label>
        </div>

        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="otherGender" value="option3" />
          <label class="form-check-label" for="otherGender">Other</label>
        </div>

      </div>
    </div>
    <div class="row">
      <div class="col-md-6 mb-4 pb-2">

        <div class="form-outline">
          <input type="email" id="emailAddress" class="form-control form-control-lg" />
          <label class="form-label" for="emailAddress">Email</label>
        </div>

      </div>
      <div class="col-md-6 mb-4 pb-2">

        <div class="form-outline">
          <input type="tel" id="phoneNumber" class="form-control form-control-lg" />
          <label class="form-label" for="phoneNumber">Phone Number</label>
        </div>

      </div>
    </div>

  </div>
</div>



<div>
  <?= Html::submitButton("Sign Up Now", ['class' => 'btn btn-primary btn-block py-3']) ?>
</div>
<?php ActiveForm::end() ?>