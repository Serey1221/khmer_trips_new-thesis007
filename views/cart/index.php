<?php

use yii\helpers\Html;

$this->title = 'Your cart';

/** @var \app\components\Formater $formater */
$formater = Yii::$app->formater;

/** @var \app\components\Rate $tate */
$rate = Yii::$app->rate;
?>
<style>
  .text-justify {
    text-align: center;
  }

  .product-item .product-image {
    height: 150px;
  }

  .product-item .product-price {
    font-size: 1.2rem;
  }

  .product-quantity {
    text-align: center;
    background-color: #fff !important;
  }
</style>
<section class="h-100 h-custom mt-5">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12">
        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-8">
                <div class="p-5">
                  <div class="d-flex justify-content-between align-items-center mb-5">
                    <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                    <h6 class="mb-0 text-muted"><?= count($model) ?> items</h6>
                  </div>
                  <hr>
                  <?php
                  if (!empty($model)) {
                    foreach ($model as $key => $value) {
                      $product = $value->product;
                      $imageUrl = $product->getUploadUrl('img_url');
                      $notFound = Yii::getAlias('@web/app/img/no-img.png');
                      $onerror = "this.onerror=null;this.src=\"{$notFound}\"";
                  ?>
                      <div class="row product-item cart-item-row" data-key="<?= $key ?>">
                        <!-- <div class="col-lg-3">
                          <?= Html::img($imageUrl, ['onerror' => $onerror, 'class' => 'product-image']) ?>
                        </div> -->
                        <div class='col-lg-9 align-self-center'>
                          <h5 class="mb-2"><?= $product->name ?></h5>
                          <div class='product-location my-1'>
                            <i class='fas fa-map-marker-alt'></i> <?= $product->getLocation() ?>
                          </div>
                          <div class='product-rating my-1'><?= $formater->starRatingReview($product->rating) ?></div>
                          <p class="font-size-sm mb-1">Duration: <?= $product->getDuration() ?></p>
                          <p class="font-size-sm mb-1">Code: <?= $product->code ?></p>
                        </div>
                        <div class="col-lg-3">
                          <div class="d-flex">
                            <button class="btn btn-link px-2 product-quantity-change" data-cart="<?= $value->id ?>" data-key="<?= $key ?>" data-formula="decrease">
                              <i class="fas fa-minus"></i>
                            </button>
                            <input min="0" name="quantity" readonly value="<?= $value->total_guest ?>" type="number" data-key="<?= $key ?>" class="form-control form-control-lg product-quantity" />
                            <button class="btn btn-link px-2 product-quantity-change" data-cart="<?= $value->id ?>" data-key="<?= $key ?>" data-formula="increase">
                              <i class="fas fa-plus"></i>
                            </button>
                          </div>
                          <div class='text-right my-2'>
                            <span class="product-price"><?= $formater->DollarFormat($value->price) ?></span>
                            <small class="d-block">per pax</small>
                          </div>
                        </div>
                        <div class="w-100 my-4"></div>
                      </div>
                  <?php
                    }
                  } else {
                    echo "<h5>There are no item in cart.</h5>";
                  }
                  ?>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="p-5">
                  <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                  <hr class="my-4">

                  <div class="d-flex justify-content-between mb-4">
                    <h5>
                      <span class="totalCartItem"><?= count($model) ?></span> x Item(s)
                    </h5>
                    <h5 class="cartTotalPrice"><?= $formater->DollarFormat($cartTotalPrice) ?></h5>
                  </div>


                  <hr class="my-4">

                  <div class="d-flex justify-content-between mb-5">
                    <h5 class="">Total price
                      <small>
                        <p class="mb-0">(including VAT)</p>
                      </small>
                    </h5>
                    <h5 class="cartTotalPrice"><?= $formater->DollarFormat($cartTotalPrice) ?></h5>
                  </div>
                  <?php
                  if (count($model) > 0) {
                  ?>
                    <a href="<?= Yii::getAlias('@web/cart/check-out') ?>" class="btn btn-primary btn-lg btn-block m-0"></i> Go to checkout</a>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
$baseUrl = Yii::getAlias("@web");
$script = <<<JS
  var baseUrl = "$baseUrl";
  $(document).on("click",".product-quantity-change", function(){
    var cartId = $(this).data("cart");
    var key = $(this).data("key");
    var formula = $(this).data("formula");
    var current = $(".product-quantity[data-key="+key+"]").val();
    current = parseInt(current);
    if(formula == 'increase'){
      current++
    }else{
      if(current > 1){
        current--;
      }else{
        Swal.fire({
          title: "Warning!",
          text: "Are you sure you want to delete this item?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Confirm'
        }).then((result) => {
          if (result.isConfirmed) {
            $(".cart-item-row[data-key="+key+"]").remove();
            $.ajax({
              url: baseUrl + "/cart/dependent",
              method: 'post',
              data: {
                cartId: cartId,
                current: 0,
                action: 'update-cart',
              },
              success: function(res){
                var data = JSON.parse(res);
                var Toast = Swal.mixin({
                  toast: true,
                  position: "bottom-end",
                  showConfirmButton: false,
                  timer: 5000,
                  iconColor: "#fff",
                  background: "#7ab730",
                  customClass: {
                    container: "colored-toast",
                  }
                });

                $(".cart-badge").text(data.total);
                $(".totalCartItem").text(data.total);
                $(".cartTotalPrice").text(` $ \${parseFloat(data.cartTotalPrice).toFixed(2)}`)
                
                if(data.status == 'removed'){
                  Toast.fire({
                    icon: 'success',
                    title: 'Item has been removed from your cart!'
                  });
                }else if(data.status == 'error'){
                  Toast.fire({
                    icon: 'error',
                    title: 'Something went wrong!'
                  });
                  console.log(data.status);
                }
              },
              error: function(err){
                console.log(err);
              }
            });
          }
        });
      }
    
    }
    $(".product-quantity[data-key="+key+"]").val(current);
    
    $.ajax({
      url: baseUrl + "/cart/dependent",
      method: 'post',
      data: {
        cartId: cartId,
        current: current,
        action: 'update-cart',
      },
      success: function(res){
        var data = JSON.parse(res);
        var Toast = Swal.mixin({
          toast: true,
          position: "bottom-end",
          showConfirmButton: false,
          timer: 5000,
          iconColor: "#fff",
          background: "#7ab730",
          customClass: {
            container: "colored-toast",
          }
        });

        $(".cart-badge").text(data.total);
        $(".totalCartItem").text(data.total);
        $(".cartTotalPrice").text(` $ \${parseFloat(data.cartTotalPrice).toFixed(2)}`)
        if(data.status == 'error'){
          Toast.fire({
            icon: 'error',
            title: 'Something went wrong!'
          });
          console.log(data.status);
        }
      },
      error: function(err){
        console.log(err);
      }
    });
  });

JS;
$this->registerJs($script);
?>