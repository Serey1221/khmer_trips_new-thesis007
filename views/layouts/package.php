<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

app\assets\SweetAlert2Asset::register($this);
AppAsset::register($this);

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

<body>
    <?php $this->beginBody(); ?>
    <?= $this->render('_navbar') ?>
    <?= $this->render('_header') ?>


    <main id="main" class="flex-shrink-0" role="main">

        <?= $content ?>
    </main>

    <?= $this->render('_footer') ?>
    <?= $this->render('_modalButton') ?>
    <?php $this->endBody(); ?>
</body>

</html>
<?= $this->render('_swal') ?>
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