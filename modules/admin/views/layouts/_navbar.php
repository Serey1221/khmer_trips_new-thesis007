<?php

use yii\bootstrap4\Html;
use yii\helpers\Url;

Yii::$app->setHomeUrl(Yii::getAlias('@web/admin/admin'));
?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <!-- <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" data-toggle="push-menu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li> -->
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Navbar Search -->
    <li class="nav-item">
      <!-- <a class="nav-link" data-widget="navbar-search" href="#" role="button">
        <i class="fas fa-search"></i>
      </a> -->
      <div class="navbar-search-block">
        <form class="form-inline">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
              <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </li>
    <li class="nav-item dropdown user-menu">
      <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        <img src="../../img/user2-160x160.jpg" class="user-image img-circle elevation-2" alt="User Image">
        <span class="d-none d-md-inline"><?= Yii::$app->user->isGuest ? 'Guest' : Yii::$app->user->identity->username ?></span>
      </a>
      <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <li class="user-header bg-primary">
          <img src="../../img/user2-160x160.jpg" class="img-circle elevation-2" alt="UserImage">

          <p>
            Admin CMS
            <small>Member since Nov. 2012</small>
          </p>
        </li>
        <li class="user-footer">
          <!-- <a href="#" class="btn btn-default btn-flat">Profile</a> -->
          <a class="btn btn-default btn-flat" href="<?= Url::toRoute(['user/index']) ?>">
            <span class="bi bi-person mr-2"></span> <?= Yii::t('app', 'Profile') ?>
          </a>

          <!-- <a href="<?= \yii\helpers\Url::to(['/admin/site/logout',]) ?>" class="btn btn-default btn-flat float-right " data-confirm="Are you sure?" method="post">Sign out</a> -->

          <?= Html::a('<span class="bi-box-arrow-left mr-2"></span> ' . Yii::t('app', 'Log out'), ['#'], [
            'class' => 'btn btn-default btn-flat float-right sign-out-user',
            'data' => [
              'confirm' => 'Are you sure, you want to Logout?',
              'value' => Url::toRoute('/admin/site/logout'),
              'method' => 'post',
            ]
          ]) ?>
        </li>
      </ul>
    </li>
    <!-- <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
  </ul>
</nav>
<!-- /.navbar -->
<?php
$script = <<<JS

$('[data-widget="push-menu"]').on('click', function (){
        $('[data-widget="push-menu"]').PushMenu("toggle");
    });
    

JS;

$this->registerJs($script);
?>