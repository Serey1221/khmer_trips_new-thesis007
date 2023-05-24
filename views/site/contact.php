<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\captcha\Captcha;

$this->title = 'Contact';

?>
<?= $this->render('_section_search') ?>
<!-- Contact Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="text-center mb-3 pb-3">
            <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Contact</h6>
            <h1>Contact For Any Query</h1>
        </div>
        <?php $form = ActiveForm::begin(); ?>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="contact-form bg-white" style="padding: 30px;">
                    <div id="success"></div>
                    <form name="sentMessage" id="contactForm" novalidate="novalidate">

                        <?php // $form->field($model, 'name')->textInput(['maxlength' => true]) 
                        ?>

                        <?php // $form->field($model, 'email')->textInput(['maxlength' => true]) 
                        ?>

                        <?php // $form->field($model, 'subject')->textInput(['maxlength' => true]) 
                        ?>

                        <?php // $form->field($model, 'description')->textarea(['rows' => 4]) 
                        ?>

                        <div class="form-row">
                            <div class="control-group col-sm-6">
                                <input type="text" class="form-control p-4" id="name" placeholder="Your Name" required="required" data-validation-required-message="Please enter your name" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group col-sm-6">
                                <input type="email" class="form-control p-4" id="email" placeholder="Your Email" required="required" data-validation-required-message="Please enter your email" />
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control p-4" id="subject" placeholder="Subject" required="required" data-validation-required-message="Please enter a subject" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <textarea class="form-control py-3 px-4" rows="5" id="message" placeholder="Message" required="required" data-validation-required-message="Please enter your message"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary py-3 px-4" type="submit" id="sendMessageButton">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<!-- Contact End -->