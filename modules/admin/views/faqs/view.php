<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\Faqs $model */

$this->title = $model->subject;
$this->params['breadcrumbs'][] = ['label' => 'Contact', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="faqs-view mt-3">

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4>Enquiry from: <?= $model->name ?></h4>
                    <hr class="my-4">
                    <h5><span class="text-muted">Subject:</span> <?= $model->subject ?></h5>
                    <h5><span class="text-muted">Description:</span></h5>
                    <p><?= nl2br($model->description) ?></p>
                </div>
            </div>
        </div>
    </div>

</div>