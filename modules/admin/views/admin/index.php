<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Admin';
$this->params['breadcrumbs'][] = 'Admin';
?>

<?php
$base_url = Yii::getAlias('@web');

$script = <<<JS
    var base_url = "$base_url";
JS;
$this->registerJs($script);


?>
