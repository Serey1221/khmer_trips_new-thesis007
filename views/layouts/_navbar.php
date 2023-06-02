<?php

use app\models\Cart;
use app\models\UserWishlist;
use yii\bootstrap4\Dropdown;
use yii\bootstrap4\Html;
use yii\helpers\Url;

$controller = Yii::$app->controller->id;
$action = Yii::$app->controller->action->id; ?>
<!-- Navbar Start -->
<?= $this->render('log_in') ?>
<?= $this->render('add-cart') ?>
<?= $this->render('sign_up') ?>
<div class="container-fluid position-relative nav-bar p-0">
    <div class="container-lg position-relative p-0 px-lg-3" style="z-index: 9;">
        <nav class="navbar navbar-expand-lg bg-light navbar-light shadow-lg py-3 py-lg-0 pl-3 pl-lg-5"> <a href="<?= Yii::$app->homeUrl ?>" class="navbar-brand">
                <h3 class="m-0 text-primary"><img src="<?= Yii::getAlias("@web/img/Khmer_Travel.png"); ?>" width="50px" /> <span class="text-dark">KHMER</span>TRAVEL</h3>
            </a> <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse"> <span class="navbar-toggler-icon"></span> </button>
            <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                <div class="navbar-nav ml-auto py-0">
                    <a href="<?= Yii::$app->homeUrl ?>" class="nav-item nav-link <?= $controller . '-' . $action === 'site-index' ? 'active' : '' ?>">Home</a>
                    <a href="<?= Yii::getAlias('@web/site/about') ?>" class="nav-item nav-link <?= $action == 'about' ? 'active' : '' ?>">About</a>
                    <a href="<?= Yii::getAlias('@web/site/service') ?>" class="nav-item nav-link <?= $action == 'service' ? 'active' : '' ?>">Service</a>
                    <a href="<?= Yii::getAlias('@web/site/package') ?>" class="nav-item nav-link <?= $action == 'package' ? 'active' : '' ?>">Packages</a>
                    <a href="<?= Yii::getAlias('@web/site/bloggrid') ?>" class="nav-item nav-link <?= $action == 'bloggrid' ? 'active' : '' ?>">Blog</a>
                    <a href="<?= Yii::getAlias('@web/site/contact') ?>" class="nav-item nav-link <?= $action == 'contact' ? 'active' : '' ?>">Contact</a>
                    <a href="<?= Yii::getAlias('@web/site/wishlist') ?>" class="nav-item nav-link <?= $action == 'wishlist' ? 'active' : '' ?> "> <i class="fas fa-heart"></i> <span class="badge badge-pill badge-danger wishlist-badge navbar-badge"><?= Yii::$app->user->isGuest ? 0 : UserWishlist::find()->where(['user_id' => Yii::$app->user->identity->id])->count(); ?></span> </a>
                    <a href="<?= Yii::getAlias('@web/cart/index') ?>" class="nav-item nav-link <?= $controller . $action == 'cartindex' ? 'active' : '' ?> "> <i class="fas fa-shopping-cart"></i> <span class="badge badge-pill badge-danger cart-badge navbar-badge"><?= Yii::$app->user->isGuest ? 0 : Cart::find()->where(['created_by' => Yii::$app->user->identity->id])->count(); ?></span> </a>

                    <?php
                    if (Yii::$app->user->isGuest) {
                    ?>
                        <!-- <div class="form-inline my-2 my-lg-0">
                            <button class="btn btn-outline-primary my-2 my-sm-0" type="button" data-toggle="modal" data-target="#exampleModalCenter">Sign up</button>
                        </div> -->
                        <div class="form-inline my-2 my-lg-0 ml-2">
                            <button class="btn btn-outline-primary my-2 my-sm-0 modalButton" type="button" data-title="KHMER TRAVEL" value="<?= Url::toRoute('site/login') ?>">Log in</button>
                        </div>
                    <?php } else { ?>
                        <div class="dropdown">
                            <a href="#" data-toggle="dropdown" class="nav-item nav-link"> <i class="fas fa-user"></i> <?= !empty(Yii::$app->user->identity->customer) ? Yii::$app->user->identity->customer->first_name . ' ' . Yii::$app->user->identity->customer->last_name  : Yii::$app->user->identity->username ?></a>
                            <?php
                            echo Dropdown::widget([
                                'items' => [
                                    ['label' => '<i class="fas fa-user"></i> Profile', 'linkOptions' => ['data-pjax' => 0], 'url' => ['user/index'], 'encode' => false],
                                    "<hr class='my-2'>",
                                    ['label' => '<i class="fas fa-list"></i> My Booking', 'linkOptions' => ['data-pjax' => 0], 'url' => ['user/booking'], 'encode' => false],
                                    "<hr class='my-2'>",
                                    ['label' => '<i class="fas fa-sign-out-alt"></i> Logout', 'linkOptions' => [
                                        'class' => 'sign-out-user',
                                        'data' => [
                                            'confirm' => 'Are you sure, you want to Logout?',
                                            'value' => Url::toRoute(['site/logout']),
                                            'method' => 'post',
                                        ]
                                    ], 'url' => '#', 'encode' => false],

                                ],
                            ]);
                            ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </nav>
    </div>
</div> <!-- Navbar End -->
<?php
$script = <<<JS
    $(document).on("click",".modalButton",function () {
        $("#modalDialog").modal("show")
            .find("#modalDialogContent")
            .load($(this).attr("value"));
        $("#modalDialog").find("#modalDialogTitle").text($(this).data("title"));
    });

JS;
$this->registerJs($script);
?>