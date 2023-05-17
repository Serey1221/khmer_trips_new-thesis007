<?php

namespace app\assets;

use yii\web\AssetBundle;

class DatePickerAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css'

    ];
    /**
     * @var array
     */
    public $js = [
        'https://cdn.jsdelivr.net/npm/flatpickr'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
