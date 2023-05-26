<?php

use yii\bootstrap4\Html;
use yii\helpers\Url;

$controller = Yii::$app->controller->id;
$action = Yii::$app->controller->action->id; ?>
<!-- Navbar Start -->
<?= $this->render('like') ?>
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
                    <!-- <div class="nav-item dropdown"> <a href="#" class="nav-link dropdown-toggle <?= $action == 'bloggrid' ? 'active' : '' ?>" data-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu border-0 rounded-0 m-0">
                            <a href="<?= Yii::getAlias('@web/site/bloggrid') ?>" class="dropdown-item <?= $action == 'bloggrid' ? 'active' : '' ?>">Blog Grid</a>
                            <a href="<?= Yii::getAlias('@web/site/detail') ?>" class="dropdown-item <?= $action == 'detail' ? 'active' : '' ?>">Blog Detail</a>
                            <a href="<?= Yii::getAlias('@web/site/destinat') ?>" class="dropdown-item <?= $action == 'destinat' ? 'active' : '' ?>">Destination</a>
                            <a href="<?= Yii::getAlias('@web/site/guides') ?>" class="dropdown-item <?= $action == 'guides' ? 'active' : '' ?>">Travel Guides</a>
                            <a href="<?= Yii::getAlias('@web/site/client') ?>" class="dropdown-item <?= $action == 'client' ? 'active' : '' ?>">Testimonial</a>
                        </div>
                    </div> -->
                    <a href="<?= Yii::getAlias('@web/site/contact') ?>" class="nav-item nav-link <?= $action == 'contact' ? 'active' : '' ?>">Contact</a>
                    <a href="" class="nav-item nav-link" data-toggle="modal" data-target="#ModalLike"> <i class="fas fa-heart"></i> <span class="badge badge-pill badge-danger navbar-badge">5</span> </a>
                    <a href="" class="nav-item nav-link" data-toggle="modal" data-target="#exampleModal"> <i class="fas fa-shopping-cart"></i> <span class="badge badge-danger navbar-badge">3</span> </a>
                    <form class="form-inline my-2 my-lg-0">
                        <button class="btn btn-outline-primary my-2 my-sm-0" type="button" data-toggle="modal" data-target="#exampleModalCenter">Sign up</button>
                    </form>
                </div>
            </div>
        </nav>
    </div>
</div> <!-- Navbar End -->