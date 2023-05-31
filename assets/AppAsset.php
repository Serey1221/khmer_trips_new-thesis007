<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css',
        'app/lib/owlcarousel/assets/owl.carousel.min.css',
        'app/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css',
        'app/css/style.css',
        'css/product.css'
    ];
    public $js = [
        'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js',
        'app/lib/easing/easing.min.js',
        'app/lib/owlcarousel/owl.carousel.min.js',
        'app/lib/tempusdominus/js/moment.min.js',
        'app/lib/tempusdominus/js/moment-timezone.min.js',
        'app/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js',
        'app/mail/jqBootstrapValidation.min.js',
        'app/mail/contact.js',
        'app/js/main.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset'
    ];
}
