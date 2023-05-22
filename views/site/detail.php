<?php

use app\models\Article;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\helpers\Url;

$this->title = 'Blog Detail';
$this->params['breadcrumbs'][] = $this->title;

$formater = Yii::$app->formater;
?>
<?php // $this->render('booking'); 
?>
<style>
    .page-title {
        background-color: #7ab730;
        margin-top: 45px;
        height: 62px;
    }
</style>
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h4 class="text-justify py-3" style="color:white"><?= $model->title ?></h4>
            </div>
            <div class="col-lg-4">
                <div class="text-justify py-2">
                    <?php
                    echo Breadcrumbs::widget([
                        'class' => 'py-4',
                        'homeLink' => [
                            'label' => Yii::t('yii', 'Back to Blog'),
                            'url' => Yii::getAlias('@web/site/bloggrid'),

                        ],
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]);
                    ?>

                </div>

            </div>
        </div>

    </div>
</div>
<!-- Blog Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                <!-- Blog Detail Start -->
                <div class="pb-3">
                    <div class="blog-item">
                        <div class="position-relative">
                            <img alt="<?= $model->title ?>" class="img-fluid w-100" onerror="this.onerror=null;this.src='<?= Yii::getAlias('@web/img/not_found.png') ?>';" src="<?= $model->getUploadUrl('img_url') ?>" />
                        </div>
                    </div>
                    <div class=" mb-3" style="padding: 30px;">
                        <span class="text-primary">Written <?= Yii::$app->formater->date($model->created_date) ?></span>

                        <h3 class="mb-3"><?= $model->short_description ?></h3>
                        <p> <?= $model->description ?></p>
                    </div>
                </div>
                <!-- Blog Detail End -->

                <!-- Comment Form Start -->
                <!-- <div class="bg-white mb-3" style="padding: 30px;">
                    <h4 class="text-uppercase mb-4" style="letter-spacing: 5px;">Leave a comment</h4>
                    <form>
                        <div class="form-group">
                            <label for="name">Name *</label>
                            <input type="text" class="form-control" id="name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="url" class="form-control" id="website">
                        </div>

                        <div class="form-group">
                            <label for="message">Message *</label>
                            <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="form-group mb-0">
                            <input type="submit" value="Leave a comment" class="btn btn-primary font-weight-semi-bold py-2 px-3">
                        </div>
                    </form>
                </div> -->
                <!-- Comment Form End -->
            </div>

            <div class="col-lg-4 mt-5 mt-lg-0">
                <!-- Category List -->
                <div class="mb-5">
                    <h4 class="text-uppercase mb-4" style="letter-spacing: 5px;">Categories</h4>
                    <div class="bg-white" style="padding: 30px;">
                        <ul class="list-inline m-0">
                            <li class="mb-3 d-flex justify-content-between align-items-center">
                                <a class="text-dark" href="#"><i class="fa fa-angle-right text-primary mr-2"></i>Camping Trip</a>
                                <span class="badge badge-primary badge-pill">150</span>
                            </li>
                            <li class="mb-3 d-flex justify-content-between align-items-center">
                                <a class="text-dark" href="#"><i class="fa fa-angle-right text-primary mr-2"></i>Solo Travel</a>
                                <span class="badge badge-primary badge-pill">131</span>
                            </li>
                            <li class="mb-3 d-flex justify-content-between align-items-center">
                                <a class="text-dark" href="#"><i class="fa fa-angle-right text-primary mr-2"></i>Calture</a>
                                <span class="badge badge-primary badge-pill">78</span>
                            </li>
                            <li class="mb-3 d-flex justify-content-between align-items-center">
                                <a class="text-dark" href="#"><i class="fa fa-angle-right text-primary mr-2"></i>Adventure</a>
                                <span class="badge badge-primary badge-pill">56</span>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                <a class="text-dark" href="#"><i class="fa fa-angle-right text-primary mr-2"></i>Group Travel</a>
                                <span class="badge badge-primary badge-pill">98</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Recent Post -->
                <div class="mb-5">
                    <h4 class="text-uppercase mb-4" style="letter-spacing: 5px;">Recent Post</h4>
                    <?php if (!empty($threeblog)) {
                        foreach ($threeblog as $key => $value) {
                            $url = Url::toRoute(['site/detail', 'slug' => $value->slug]); ?>
                            <a class="d-flex align-items-center text-decoration-none bg-white mb-3" href="<?= $url ?>">
                                <img class="img-fluid w-100" onerror="this.onerror=null;this.src='<?= Yii::getAlias('@web/app/img/no-img.png') ?>';" src="<?= $value->getUploadUrl('img_url') ?>" alt="" style="max-width:40%;">
                                <div class="pl-3">
                                    <h6 class="ml-0"><?= $value['title'] ?></h6>
                                    <small class="">Written <?= $formater->date($value->created_date) ?></small>
                                </div>
                            </a>
                    <?php
                        }
                    } ?>
                </div>

                <!-- Tag Cloud -->
                <div class="mb-5">
                    <h4 class="text-uppercase mb-4" style="letter-spacing: 5px;">Tag Cloud</h4>
                    <div class="d-flex flex-wrap m-n1">
                        <?php
                        $suggesstion = Article::find()->orderBy(['created_date' => SORT_DESC])->all();
                        if (!empty($suggesstion)) {
                            foreach ($suggesstion as $key => $value) :
                                echo Html::button($value->title, ['data-value' => $value->title, 'class' => 'btnSuggestionSearch btn btn-light border-primary m-1']);
                            endforeach;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog End -->