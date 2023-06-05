<?php
$this->title = 'My Profile';
/** @var app\components\Formater $formater */
$formater = Yii::$app->formater;
?>
<div class="container py-5 mt-5">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">User</a></li>
                    <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <?= $this->render('_left_menu') ?>
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row my-3">
                        <div class="col-lg-12">
                            <?php

                            use app\assets\DatePickerAsset;
                            use yii\bootstrap4\ActiveForm;
                            use yii\bootstrap4\Html;

                            $form = ActiveForm::begin([
                                'options' => ['id' => 'customerForm'],
                                'enableAjaxValidation' => false,
                                'enableClientValidation' => true,
                            ]);
                            ?>
                            <h5>Profile Details</h5>
                            <hr>
                            <div class="row">
                                <div class="col-lg-6">
                                    <?= $form->field($customer, 'first_name')->textInput()->label("First name") ?>
                                </div>
                                <div class="col-lg-6">
                                    <?= $form->field($customer, 'last_name')->textInput()->label("Last name") ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <?= $form->field($customer, 'gender')->dropdownList(['male' => 'Male', 'female' => 'Female'], ['prompt' => 'Rather not say', 'class' => 'custom-select'])->label("Gender") ?>
                                </div>
                                <div class="col-lg-6">
                                    <?= $form->field($customer, 'date_of_birth')->textInput() ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?= $form->field($customer, 'address')->textInput() ?>
                                </div>
                            </div>
                            <h5>Contact Details</h5>
                            <hr>
                            <div class="row">
                                <div class="col-lg-6">
                                    <?= $form->field($customer, 'email')->textInput(['readonly' => true])->label("Email") ?>
                                </div>
                                <div class="col-lg-6">
                                    <?= $form->field($customer, 'phone_number')->textInput()->label("Phone number") ?>
                                </div>
                            </div>
                            <hr>
                            <?= Html::submitButton('Save Changes', ['class' => 'btn btn-primary']); ?>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
DatePickerAsset::register($this);
$script = <<<JS
    
    flatpickr('#customer-date_of_birth', {
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
    });
JS;
$this->registerJs($script);
?>