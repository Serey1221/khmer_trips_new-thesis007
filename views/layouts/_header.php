 <?php
//  $this->title = '';
//  $this->params['pageTitle'][] = $this->title;
 ?>
 <!-- Header Start -->
 <div class="container-fluid page-header">
        <div class="container">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                <h3 class="display-4 text-white text-uppercase"><?= $this->params['pageTitle'][] = $this->title;?></h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="<?= Yii::$app->homeUrl ?>">Home</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase"><?= $this->params['pageTitle'][] = $this->title;?></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

