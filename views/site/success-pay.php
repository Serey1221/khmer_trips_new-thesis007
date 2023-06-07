<?php

use yii\helpers\Url;
?>
<div class="container" style="margin-top: 150px;">
    <div class="row text-center">
        <div class="col-lg-7">
            <br><br>
            <h1>Payment successful</h1>
            <h3>Dear, Customer</h3>
            <p style="font-size:20px;color:#5C5C5C;">Thank you for choosing our company. We have received your full payment and have sent the receipt to your email already. We wish you have a pleasant day.</p>
            <a href="<?= Yii::$app->homeUrl ?>" class="btn btn-primary">Back Home</a>
<<<<<<< HEAD

=======
            <?php
            $booking = Yii::$app->request->get('booking');
            if (!empty($booking)) {
                echo \yii\helpers\Html::a('View My Booking', ['user/view-booking', 'code' => $booking], ['class' => 'btn btn-info ml-3']);
            }
            ?>
>>>>>>> 4425128 (add button view my booking)
            <br><br>
        </div>
        <div class="col-lg-5">
            <img src="../app/img/success-pay.jpg" alt="Success Payment" style="max-width:110%;">
        </div>
    </div>
</div>