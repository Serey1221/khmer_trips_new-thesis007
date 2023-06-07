<?php
$this->title = 'Your wishlist';
?>
<style>
    .text-justify {
        text-align: center;
    }
</style>
<section class="h-100 h-custom mt-5">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12">
                <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="d-flex justify-content-between align-items-center mb-5">
                                        <h1 class="fw-bold mb-0 text-black">Your wishlist</h1>
                                        <h6 class="mb-0 text-muted"> <i class="fas fa-heart"></i> <?= count($model) ?> service(s)</h6>
                                    </div>
                                    <?php
                                    if (!empty($model)) {
                                        foreach ($model as $key => $value) {
                                            echo "<div id='item_wishlist_{$value->code}'>";
                                            echo $value->getListItemTemplate([]);
                                            echo "</div>";
                                        }
                                    } else {
                                        echo "<h5>There are no wishlist.</h5>";
                                    }
                                    ?>

                                    <div class="pt-5">
                                        <h6 class="mb-0"><a href="<?= Yii::getAlias('@web/site/package') ?>" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i> Back to shop</a></h6>
                                    </div>
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
\app\assets\SweetAlert2Asset::register($this);
$script = <<<JS

  var baseUrl = "$baseUrl";

  $(".product-fav-button").click(function(){
    var productCode = $(this).data("id");
    var type = $(this).hasClass('active') ? 'remove' : 'add';
    $.ajax({
      url: baseUrl + "/product/dependent",
      method: 'post',
      data: {
        productCode: productCode,
        type: type,
        action: 'update-wishlist',
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

        $(".wishlist-badge").text(data.total);
        
        if(data.status == 'added'){
          Toast.fire({
            icon: 'success',
            title: 'Product has been added to your wishlist!'
          });
          $(".product-fav-button[data-id='"+productCode+"']").addClass('active');
          $(".product-fav-button[data-id='"+productCode+"'] i").removeClass('far fa-heart').addClass('fas fa-heart');
        }
        else if(data.status == 'removed'){
          Toast.fire({
            icon: 'success',
            title: 'Product has been removed from your wishlist!'
          });
          $("#item_wishlist_"+productCode).remove();
          $(".product-fav-button[data-id='"+productCode+"']").removeClass('active');
          $(".product-fav-button[data-id='"+productCode+"'] i").removeClass('fas fa-heart').addClass('far fa-heart');
        }else{
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
