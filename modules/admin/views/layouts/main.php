<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\assets\AdminAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use app\assets\SweetAlert2Asset;
use yii\helpers\Url;

SweetAlert2Asset::register($this);

//AppAsset::register($this);
AdminAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag([
    'name' => 'viewport',
    'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no',
]);
$this->registerMetaTag([
    'name' => 'description',
    'content' => $this->params['meta_description'] ?? '',
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $this->params['meta_keywords'] ?? '',
]);
$this->registerLinkTag([
    'rel' => 'icon',
    'type' => 'image/x-icon',
    'href' => Yii::getAlias('@web/Khmer_Travel.ico'),
]);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head(); ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <?php $this->beginBody(); ?>
    <div class="wrapper">
        <?= $this->render('_navbar') ?>
        <?= $this->render('_sidebar') ?>

        <!-- <header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest
                ? ['label' => 'Login', 'url' => ['/site/login']]
                : '<li class="nav-item">' .
                Html::beginForm(['/site/logout']) .
                Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'nav-link btn btn-link logout']
                ) .
                Html::endForm() .
                '</li>',
        ],
    ]);
    NavBar::end();
    ?>
    
</header> -->

        <main id="main" class="flex-shrink-0" role="main">
            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        <?php if (!empty($this->params['breadcrumbs'])) : ?>
                            <?= Breadcrumbs::widget([
                                'links' => $this->params['breadcrumbs'],
                            ]) ?>
                        <?php endif; ?>
                        <?= Alert::widget() ?>
                        <?= $content ?>

                    </div>
                </div>
            </div>
        </main>
    </div>
    <?= $this->render('_footer') ?>
    
    <?php $this->endBody(); ?>
</body>
</html>
<?= $this->render('_toast') ?>
<script type="text/javascript">
    yii.confirm = function(message, okCallback, cancelCallback) {
        var val = $(this).data('value');

        if ($(this).hasClass('sign-out-user')) {

            Swal.fire({
                title: "Warning!",
                text: "Are you sure you want to logout?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Logout now!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(val); // <--- submit form programmatically
                }
            });
        } else {
            $.post(val);
        }
    };
</script>
<?php $this->endPage(); ?>