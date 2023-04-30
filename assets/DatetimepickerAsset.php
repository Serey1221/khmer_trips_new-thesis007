<?php

namespace app\assets;

use yii\web\AssetBundle;

class DatetimepickerAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css',
        // 'app/css/bootstrap-datetimepicker.min.css',
        'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css',
        'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css',

    ];
    /**
     * @var array
     */
    public $js = [
        'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js',
        'https://cdn.jsdelivr.net/momentjs/latest/moment.min.js',
        'app/js/bootstrap-datetimepicker.min.js',
        'https://cdn.jsdelivr.net/jquery/latest/jquery.min.js',
        // 'app/js/date.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
