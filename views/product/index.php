<?php

use yii\widgets\ListView;

$this->title = "Product availability";

/** @var \app\components\Formater $formater */
$formater = Yii::$app->formater;

/** @var \app\components\Rate $tate */
$rate = Yii::$app->rate;
?>
<style>
  .product-item .product-image {
    height: 220px;
    width: 100%;
    object-fit: cover;
    border-radius: 10px;
  }

  .product-item .product-title {
    font-size: 1.2rem;
    font-weight: 600;
    line-height: 1.8rem;
    color: #333;
  }

  .product-item .product-duration {
    font-size: .9rem;
  }

  .product-item .product-location {
    font-size: .9rem;
  }

  .product-item .product-rating {
    font-size: .9rem;
    color: gainsboro;
  }

  .product-item .product-price {
    font-size: 1.6rem;
    line-height: 1.6rem;
    color: red;
    font-weight: 600;
  }

  .product-item .product-code {
    font-size: .9rem;
  }

  .product-item .product-fav-button {
    position: absolute;
    top: 8px;
    right: 24px;
  }

  .product-item .product-fav-button i {
    font-size: 1.4rem;
    color: #7ab730;
  }

  .product-item .product-fav-button:hover,
  .product-item .product-fav-button.active {
    background-color: red;
    cursor: pointer;
  }

  .product-item .product-fav-button:hover i,
  .product-item .product-fav-button.active i {
    color: #fff;
    cursor: pointer;
  }
</style>
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