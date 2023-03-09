<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\assets\GalleryAsset;

GalleryAsset::register($this);

$this->title = 'Gallery';
$this->params['pageTitle'] = $this->title;

$base_url = Yii::getAlias("@web");
?>
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h4 class="card-title">Gallery</h4>
              </div>
              <div class="card-body">
                <div class="row">
                    <div class="add-button modalButton" data-title="Add gallery image" value="<?= Url::toRoute(['gallery/form']) ?>">
                      <i class="bi bi-plus-circle"></i>
                    </div>
                    <div class="col-sm-2">
                      <a href="https://via.placeholder.com/1200/FFFFFF.png?text=1" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery">
                        <img src="https://via.placeholder.com/300/FFFFFF?text=1" class="img-fluid mb-2" alt="white sample"/>
                      </a>
                    </div>
                    <div class="col-sm-2">
                    <a href="https://via.placeholder.com/1200/000000.png?text=2" data-toggle="lightbox" data-title="sample 2 - black" data-gallery="gallery">
                      <img src="https://via.placeholder.com/300/000000?text=2" class="img-fluid mb-2" alt="black sample"/>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      
<?php
$script = <<<JS

    $(document).on("click",".modalButton",function () {
        $("#modalDrawerRight").modal("show")
            .find("#modalContent")
            .load($(this).attr("value"));
        $("#modalDrawerRight").find("#modalDrawerRightLabel").text($(this).data("title"));
    });

    $(".linkToCopy").click(function(){
      var id = $(this).data("id");
      $("#url_hidden_"+id).select();
      document.execCommand("copy");
    });

JS;
$this->registerJs($script);
?>