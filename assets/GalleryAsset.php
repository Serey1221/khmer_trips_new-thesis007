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
class GalleryAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'plugins/ekko-lightbox/ekko-lightbox.css',
    ];
    public $js = [
        'plugins/ekko-lightbox/ekko-lightbox.min.js'
        
       
    ];
    public $depends = ['yii\web\YiiAsset', 'yii\bootstrap4\BootstrapAsset'];
}
