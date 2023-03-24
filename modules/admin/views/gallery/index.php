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
<style>
  .row{
    padding-top:20px
  }
  .row_gallery .card {
    margin-bottom: 70px;
  }

  .row_gallery img {
    width: 100%;
    border-radius: 4px;
  }

  /* .row_gallery .carousel-caption {
    top: 50%;
    transform: translateY(-50%);
    bottom: initial;
    opacity: 0;
    transition: .5s ease;
  } */

  /* .row_gallery .gallery-image:hover .carousel-caption {
    opacity: 1;
  } */

  /* .row_gallery .gallery-image img {
    width: 100%;
    height: 160px;
    object-fit: contain;
  } */

  /* .row_gallery .gallery-image:hover img {
    opacity: .8;
    transition: .3s ease;
  } */

  .row_gallery .add-button i {
    font-size: 3rem;
    color: grey;
    opacity: .4;
  }

  .row_gallery .col:hover .add-button i {
    opacity: .8;
    cursor: pointer;
  }

  /* .row_gallery .col-lg-3 {
    padding-bottom: 1rem;
  } */
</style>
<h1><?= Html::encode($this->title) ?></h1>
        <!-- <div class="row">
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
        </div> -->
<?= $this->render('/admin/drawer_right') ?>

<div class="row row_gallery">
  <div class="col-lg-3">
    <div class="card card-body text-center justify-content-center h-100">
      <div class="add-button modalButton" data-title="Add gallery image" value="<?= Url::toRoute(['gallery/form']) ?>">
        <i class="nav-icon far fa-plus-square"></i>
      </div>
    </div>
  </div>
  <?php
  foreach ($model as $key => $value) {
  ?>
    <input style="position: absolute; z-index: -999; opacity: 0;" id="url_hidden_<?= $value->id ?>" value="<?= $value->getUploadUrl('img_url') ?>">
    <div class="col-lg-3">
      <div class="card card-body gallery-image p-0">
        <img src="<?= $value->getThumbUploadUrl('img_url') ?>" alt="<?= $value->title ?>">
        <div class="carousel-caption">
          <button type="button" class="btn btn-secondary btn-icon linkToCopy" data-id="<?= $value->id ?>"><i class="fas fa-link"></i></button>
          <button type="button" data-title="Update gallery image: <?= $value->title ?>" value="<?= Url::toRoute(['gallery/form', 'id' => $value->id]) ?>" class="btn btn-secondary btn-icon modalButton"><i class="bi bi-pencil-square"></i></button>
        </div>
      </div>
    </div>
  <?php
  }
  ?>
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