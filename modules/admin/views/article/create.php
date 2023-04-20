<?php

use yii\helpers\Html;

$this->title = 'Add Article';
$this->params['breadcrumbs'][] = ['label' => 'Article', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-inspire-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>