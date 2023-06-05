<?php
$formater = Yii::$app->formater;
?>
<div class="col-lg-4">
  <div class="card mb-4">
    <div class="card-body">
      <div class="text-center">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
        <h5 class="my-2"><?= Yii::$app->user->identity->customer->getFullName() ?></h5>
        <p>joined at <?= $formater->date(Yii::$app->user->identity->created_at) ?></p>
      </div>
      <hr>
      <a href="<?= Yii::getAlias('@web/user/index') ?>" class="text-dark"><i class="fas fa-user mr-3"></i> Profile</a>
      <hr>
      <a href="<?= Yii::getAlias('@web/user/booking') ?>" class="text-dark"><i class="fas fa-list mr-3"></i> My Booking</a>
    </div>
  </div>
</div>