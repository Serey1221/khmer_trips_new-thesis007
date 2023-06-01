<?php

use app\modules\admin\models\City;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\Product $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = "Product itinerary: [{$model->code}] - {$model->name}";
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$product_id = $model->id;
$city_itinerary = Yii::$app->db->createCommand("SELECT city.id, city.name
FROM city
INNER JOIN product_city ON product_city.city_id = city.id
WHERE product_city.product_id = :product_id
")->bindParam(":product_id", $product_id)->queryAll();
$city_itinerary = ArrayHelper::map($city_itinerary, 'id', 'name');

?>
<style>
  .product-form {
    padding-top: 20px
  }

  .required {
    color: red;
  }

  .select2-container {
    width: 100% !important;
  }

  .action_button {
    align-items: flex-end;
    display: flex;
    flex-direction: column;
  }

  .action_button button {
    margin-bottom: .5rem;
  }
</style>
<div class="product-form">
  <div class="card card-primary card-outline card-outline-tabs">
    <div class="card-header p-0 border-bottom-0">
      <?= $this->render('_tab_menu', ['model' => $model]) ?>
    </div>
    <div class="card-body">
      <?php
      $validationUrl = ['product/validation'];
      if (!$model->isNewRecord) {
        $validationUrl['id'] = $model->id;
      }
      $form = ActiveForm::begin([
        'options' => ['id' => 'productForm', 'enctype' => 'multipart/form-data'],
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
        'validationUrl' => $validationUrl
      ]); ?>
      <div class="row">
        <div class="col-lg-6">
          <?= $form->field($model, 'overview')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-lg-6">
          <?= $form->field($model, 'overviewkh')->textarea(['rows' => 6]) ?>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <?= $form->field($model, 'highlight')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-lg-6">
          <?= $form->field($model, 'highlight_kh')->textarea(['rows' => 6]) ?>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <?= $form->field($model, 'pick_up')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6">
          <?= $form->field($model, 'pick_up_kh')->textInput(['maxlength' => true]) ?>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <?= $form->field($model, 'drop_off')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6">
          <?= $form->field($model, 'drop_off_kh')->textInput(['maxlength' => true]) ?>
        </div>
      </div>

      <div id="itinerary_day_accordion" class="card-expansion each_item">

        <?php
        if (empty($modelItinerary)) {
          $modelItinerary = [
            [
              'title' => '',
              'city_id' => NULL,
              'is_stay' => 0,
              'check_stay' => '',
              'is_breakfast' => 0,
              'check_breakfast' => '',
              'is_lunch' => 0,
              'check_lunch' => '',
              'is_dinner' => 0,
              'check_dinner' => '',
              'description' => '',
            ]
          ];
        }
        foreach ($modelItinerary as $key => $value) {
          $item_id = 'itinerary_day_accordion-' . $key;
          $day = $key + 1;
        ?>
          <div class="card card-bordered-info row_line" id="row_line_<?= $key ?>" data-id="<?= $key ?>">
            <div class="card-body font-weight-normal border-0">
              <div class="row">
                <div class="col-md-10">
                  <div class="form-group">
                    <label for="title_day_<?= $key ?>">Title</label>
                    <div class="input-group input-group-alt">
                      <div class="input-group-prepend">
                        <span class="input-group-text day_number">Day <?= $day++ ?></span>
                      </div>
                      <input type="text" required id="title_day_<?= $key ?>" data-id="<?= $key ?>" name="title[]" value='<?= $value["title"]; ?>' class="form-control title_day" placeholder="Title">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group mb-3">
                        <?php
                        echo "<label for=\"tour_city_" . $key . "\">City Visited</label>";
                        echo Select2::widget([
                          'name' => 'tour_city[]',
                          'value' => $value['city_id'],
                          'data' => $city_itinerary,
                          'theme' => Select2::THEME_DEFAULT,
                          'options' => [
                            'placeholder' => 'Select',
                            'id' => 'tour_city_' . $key,
                            'data-id' => $key,
                            'class' => 'form-control tour_city',
                          ],
                          'pluginOptions' => [
                            'allowClear' => false,
                          ],
                        ]);
                        ?>
                      </div>
                    </div>
                  </div>


                  <div class="form-group">
                    <label class="d-block">Stay & Eat</label>
                    <div class="custom-control custom-control-inline custom-checkbox <?= $model->isActivity() ? 'd-none' : '' ?>">
                      <input type="checkbox" data-target="hide_is_stay_<?= $key ?>" data-toggle="checkboxToggle" class="custom-control-input" name="chk_stay[]" <?= $value['check_stay'] ?> data-id="<?= $key ?>" id="is_stay_<?= $key ?>">
                      <label class="custom-control-label" for="is_stay_<?= $key ?>">Overnight</label>
                      <input type="hidden" name="hide_is_stay[]" value="<?= $value['is_stay'] ?>" data-id="<?= $key ?>" id="hide_is_stay_<?= $key ?>">
                    </div>
                    <div class="custom-control custom-control-inline custom-checkbox">
                      <input type="checkbox" data-target="hide_is_breakfast_<?= $key ?>" data-toggle="checkboxToggle" class="custom-control-input" name="chk_breakfast[]" <?= $value['check_breakfast'] ?> data-id="<?= $key ?>" id="breakfast_day_<?= $key ?>">
                      <label class="custom-control-label" for="breakfast_day_<?= $key ?>">Breakfast</label>
                      <input type="hidden" name="hide_is_breakfast[]" value="<?= $value['is_breakfast'] ?>" data-id="<?= $key ?>" id="hide_is_breakfast_<?= $key ?>">
                    </div>
                    <div class="custom-control custom-control-inline custom-checkbox">
                      <input type="checkbox" data-target="hide_is_lunch_<?= $key ?>" data-toggle="checkboxToggle" class="custom-control-input" name="chk_lunch[]" <?= $value['check_lunch'] ?> data-id="<?= $key ?>" id="lunch_day_<?= $key ?>">
                      <label class="custom-control-label" for="lunch_day_<?= $key ?>">Lunch</label>
                      <input type="hidden" name="hide_is_lunch[]" value="<?= $value['is_lunch'] ?>" data-id="<?= $key ?>" id="hide_is_lunch_<?= $key ?>">
                    </div>
                    <div class="custom-control custom-control-inline custom-checkbox">
                      <input type="checkbox" data-target="hide_is_dinner_<?= $key ?>" data-toggle="checkboxToggle" class="custom-control-input" name="chk_dinner[]" <?= $value['check_dinner'] ?> data-id="<?= $key ?>" id="dinner_day_<?= $key ?>">
                      <label class="custom-control-label" for="dinner_day_<?= $key ?>">Dinner</label>
                      <input type="hidden" name="hide_is_dinner[]" value="<?= $value['is_dinner'] ?>" data-id="<?= $key ?>" id="hide_is_dinner_<?= $key ?>">
                    </div>
                  </div>
                  <label for="description_day_<?= $key ?>">Description</label>
                  <textarea name="description[]" id="description_day_<?= $key ?>" data-id="<?= $key ?>" placeholder="Description" rows="6" class="form-control tour-editor"><?= $value["description"]; ?></textarea>

                </div>
                <div class="col-md-2">
                  <div class="text-right action_button">
                    <button type='button' class='btn btn-secondary btn-icon btn_move_up' id='move_up_row_<?= $key ?>' data-id="<?= $key ?>"><i class="fas fa-arrow-up"></i></button>
                    <button type='button' class='btn btn-secondary btn-icon btn_move_down' id='move_down_row_<?= $key ?>' data-id="<?= $key ?>"><i class="fas fa-arrow-down"></i></button>
                  </div>
                </div>
              </div>

            </div>
          </div>
        <?php } ?>

      </div>
      <hr>
      <div class="form-group text-right">
        <?= Html::submitButton('<i class="far fa-save mr-1"></i> Save Changes', ['class' => 'btn btn-success']) ?>
      </div>
      <?php ActiveForm::end(); ?>
    </div>
  </div>

</div>
<?php
$script = <<<JS

  $(document).on("click", "[data-toggle='checkboxToggle']", function(){
      var target = $(this).data("target");
      if($(this).is(":checked")){
          $("#"+target).val(1);
      }else{
          $("#"+target).val(0);
      }
  });

  $(document).on("click", ".btn_move_up", function(){
      $(this).parents('.row_line').insertBefore($(this).parents('.row_line').prev());
  });

  $(document).on("click", ".btn_move_down", function(){
      $(this).parents('.row_line').insertAfter($(this).parents('.row_line').next());
  });

JS;

$this->registerJs($script);

?>