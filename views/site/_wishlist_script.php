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
