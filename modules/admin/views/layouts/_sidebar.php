<?php

use app\models\Booking;
use yii\bootstrap4\Html;
use yii\helpers\Url;

// Yii::$app->setHomeUrl(Yii::getAlias('@web/admin'));
$controller = Yii::$app->controller->id;
$action = Yii::$app->controller->action->id;
$controller_action = $controller . '-' . $action;

$countBooking = Booking::find()->where(['status' => Booking::BOOKED])->count();
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="<?= Yii::getAlias('@web/admin/dashboard') ?>" class="brand-link">
    <img src="../../img/Khmer_Travel.png" alt="Admin" class="brand-image img-circle elevation-3" style="opacity: .8">
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
        <li class="nav-item">
          <a href="<?= Yii::getAlias('@web/admin/dashboard') ?>" class="nav-link <?= $controller . '-' . $action === 'dashboard-index' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= Yii::getAlias('@web/admin/gallery') ?>" class="nav-link <?= $controller . '-' . $action === 'gallery-index' ? 'active' : '' ?>">
            <i class="nav-icon far fa-image"></i>
            <p>
              Gallery
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= Yii::getAlias('@web/admin/article') ?>" class="nav-link <?= $controller . '-' . $action === 'article-index' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-book"></i>
            <p>
              Blog
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= Yii::getAlias('@web/admin/city') ?>" class="nav-link <?= $controller . '-' . $action === 'city-index' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Cities
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= Yii::getAlias('@web/admin/product') ?>" class="nav-link <?= $controller === 'product' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-columns"></i>
            <p>
              Products
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= Yii::getAlias('@web/admin/guide-profile') ?>" class="nav-link <?= $controller . '-' . $action === 'guide-profile-index' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-map"></i>
            <p>
              Guide
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= Yii::getAlias('@web/admin/faqs') ?>" class="nav-link <?= $controller . '-' . $action === 'faqs-index' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-question-circle"></i>
            <p>
              Contact
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= Yii::getAlias('@web/admin/booking') ?>" class="nav-link <?= $controller  === 'booking' ? 'active' : '' ?>">
            <i class="nav-icon far fa-calendar-alt"></i>
            <p>
              Booking
              <span class="badge badge-info right"><?= $countBooking ?></span>
            </p>
          </a>
        </li>
        <li class="nav-item <?= $controller  === 'report' ? 'menu-is-opening menu-open' : '' ?>">
          <a href="#" class="nav-link <?= $controller  === 'report' ? 'active' : '' ?>">
            <i class="nav-icon far fa-chart-bar"></i>
            <p>
              Reports
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= Yii::getAlias('@web/admin/report/sale') ?>" class="nav-link <?= $controller_action  === 'report-sale' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Sales</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= Yii::getAlias('@web/admin/report/customer-revenue') ?>" class="nav-link <?= $controller_action  === 'report-customer-revenue' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Customers</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= Yii::getAlias('@web/admin/report/product-performance') ?>" class="nav-link <?= $controller_action  === 'report-product-performance' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Products Performance</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</aside>