<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception$exception */

use yii\helpers\Html;

$this->title = $name;
?>

<div class="site-error">
      <section class="d-flex align-items-center justify-content-center vh-100">
      <div class="error-page">
        <h2 class="headline text-warning"> 404</h2>

        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! <?= Html::encode(
              $this->title
          ) ?></h3>

          <p>
          <?= nl2br(Html::encode($message)) ?>
          </p>
          <p>
            We could not find the page you were looking for.
            Meanwhile, you may <a href="<?= Yii::$app
                ->homeUrl ?>">return to dashboard</a> or try using the search form.
          </p>

          <form class="search-form">
            <div class="input-group">
              <input type="text" name="search" class="form-control" placeholder="Search">

              <div class="input-group-append">
                <button type="submit" name="submit" class="btn btn-warning"><i class="fas fa-search"></i>
                </button>
              </div>
            </div>
            <!-- /.input-group -->
          </form>
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
</div>
