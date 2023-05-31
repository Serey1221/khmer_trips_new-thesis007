<?php

use yii\widgets\ListView;

$this->title = "Product availability";

/** @var \app\components\Formater $formater */
$formater = Yii::$app->formater;

/** @var \app\components\Rate $tate */
$rate = Yii::$app->rate;
?>
<div class="container-fluid py-5">
  <div class="container pt-5 pb-3">
    <div class="mb-3 pb-3">
      <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Products</h6>
      <h1>Your Search: </h1>
    </div>


    <?= ListView::widget([
      'dataProvider' => $dataProvider,
      'options' => [
        'tag' => 'div',
        'class' => 'list-wrapper card',
        'id' => 'list-wrapper',
      ],
      'layout' => "<div class='card-body'>{items}</div>",
      'itemView' => function ($model, $key, $index, $widget) use ($formater, $rate) {
        return $this->render('_item', ['model' => $model, 'formater' => $formater, 'rate' => $rate]);
      },
    ]);
    ?>

  </div>
</div>
<?= $this->render('//site/_wishlist_script') ?>