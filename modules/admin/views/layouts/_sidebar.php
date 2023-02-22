<?php

use yii\bootstrap4\Html;
use yii\helpers\Url;

Yii::$app->setHomeUrl(Yii::getAlias('@web/admin/admin'));
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?= Yii::$app->homeUrl ?>" class="brand-link">
      <img src="../../img/logo.png" alt="Admin" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Khmer Travel</span>
    </a>
    <div class="sidebar">
      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="img/user8-128x128.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div> -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu-open">
            <a href="<?= Yii::$app->homeUrl ?>" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/page" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Gallery
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= Yii::getAlias('@web/admin/city') ?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Citys
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="<?= Yii::getAlias('@web/admin/product') ?>" class="nav-link">
              <i class="nav-icon fas fa-columns"></i>
              <p>
                Products
              </p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>