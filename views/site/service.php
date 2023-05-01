<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\captcha\Captcha;

$this->title = 'Service';

?>
<?= $this->render('booking'); ?>
<?= $this->render('_sub_service'); ?>
<?= $this->render('testimonial'); ?>

