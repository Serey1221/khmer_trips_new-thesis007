<?php

use yii\helpers\Html;

$activeForm = Yii::$app->controller->action->id == 'form' ? 'active' : '';
$activeItinerary = Yii::$app->controller->action->id == 'form-itinerary' ? 'active' : '';
$activeGallery = Yii::$app->controller->action->id == 'form-gallery' ? 'active' : '';
$activeTerm = Yii::$app->controller->action->id == 'form-term' ? 'active' : '';
$activeRate = Yii::$app->controller->action->id == 'form-rate' ? 'active' : '';
?>
<ul class="nav nav-tabs" id="product-tab-menu" role="tablist">
  <li class="nav-item">
    <?= Html::a("Service detail", ["product/form", 'id' => $model->id], ['class' => "nav-link $activeForm"]); ?>
  </li>
  <?php
  if (!$model->isNewRecord) {
  ?>
    <li class="nav-item">
      <?= Html::a("Itinerary", ["product/form-itinerary", 'id' => $model->id], ['class' => "nav-link $activeItinerary"]); ?>
    </li>
    <li class="nav-item">
      <?= Html::a("Gallery", ["product/form-gallery", 'id' => $model->id], ['class' => "nav-link $activeGallery"]); ?>
    </li>
    <li class="nav-item">
      <?= Html::a("Term & Condition", ["product/form-term", 'id' => $model->id], ['class' => "nav-link $activeTerm"]); ?>
    </li>
    <li class="nav-item">
      <?= Html::a("Price Setup", ["product/form-rate", 'id' => $model->id], ['class' => "nav-link $activeRate"]); ?>
    </li>
  <?php } ?>
</ul>