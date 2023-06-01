<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\DatetimepickerAsset;
use app\modules\admin\models\Product;
use yii\bootstrap4\Dropdown;

DatetimepickerAsset::register($this);

/** @var yii\web\View $this */
/** @var app\modules\admin\models\ProductSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>
<style>
    .blank_space_label {
        padding-top: 32px;
    }
</style>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'options' => ['data-pjax' => true, 'id' => 'formProductsearch'],
        'method' => 'get',
    ]); ?>
    <div class="row">
        <div class="col-lg-4">
            <label>Date Range</label>
            <div id="order__date__range" style="cursor: pointer;" class="form-control">
                <i class="fas fa-calendar-alt text-muted"></i>&nbsp;
                <span></span> <i class="fa fa-caret-down text-muted float-right"></i>
            </div>
            <?= $form->field($model, 'from_date')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'to_date')->hiddenInput()->label(false) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'globalSearch')->textInput(['placeholder' => 'Search by name,...etc'])->label('Search') ?>
        </div>
        <div class="col-lg-4">
            <div class="float-right">
                <div class="blank_space_label"></div>
                <div class="dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle btn rounded-pill btn-success"><i class="fas fa-plus mr-1"></i> Product Action <b class="caret"></b></a>
                    <?php
                    echo Dropdown::widget([
                        'items' => [
                            ['label' => 'Add Activity', 'linkOptions' => ['data-pjax' => 0], 'url' => ['product/form', 'type' => Product::ACTIVITY]],
                            ['label' => 'Add Tour', 'linkOptions' => ['data-pjax' => 0], 'url' => ['product/form', 'type' => Product::TOUR]],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php // $form->field($model, 'id')
    ?>

    <?php
    // $form->field($model, 'name')
    ?>

    <?php
    // $form->field($model, 'namekh')
    ?>

    <?php
    // $form->field($model, 'tourday')
    ?>

    <?php
    // $form->field($model, 'tournight')
    ?>

    <?php
    // echo $form->field($model, 'tourhour')
    ?>

    <?php
    // echo $form->field($model, 'tourmin')
    ?>

    <?php
    // echo $form->field($model, 'overview')
    ?>

    <?php
    // echo $form->field($model, 'overviewkh')
    ?>

    <?php
    // echo $form->field($model, 'highlight')
    ?>

    <?php
    // echo $form->field($model, 'highlight_kh')
    ?>

    <?php
    // echo $form->field($model, 'pick_up')
    ?>

    <?php
    // echo $form->field($model, 'pick_up_kh')
    ?>

    <?php
    // echo $form->field($model, 'drop_off')
    ?>

    <?php
    // echo $form->field($model, 'drop_off_kh')
    ?>

    <?php
    // echo $form->field($model, 'price_include_kh')
    ?>

    <?php
    // echo $form->field($model, 'price_exclude_kh')
    ?>

    <?php
    // echo $form->field($model, 'status')
    ?>

    <?php
    // echo $form->field($model, 'created_at')
    ?>

    <?php
    // echo $form->field($model, 'created_by')
    ?>

    <?php
    // echo $form->field($model, 'updated_at')
    ?>

    <?php
    // echo $form->field($model, 'updated_by')
    ?>

    <?php
    // echo $form->field($model, 'deleted_at')
    ?>

    <?php
    // echo $form->field($model, 'deleted_by')
    ?>

    <?php
    // echo $form->field($model, 'rate')
    ?>

    <div class="form-group">
        <?php
        // Html::submitButton('Search', ['class' => 'btn btn-primary']);
        ?>
        <?php
        // Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary',]);
        ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<<JS

    var is_filter = $("#productsearch-from_date").val() != ''?true:false;

    if(!is_filter){
        var start = moment().startOf('week');
        var end = moment();
    }else{
        var start = moment($("#productsearch-from_date").val());
        var end = moment($("#productsearch-to_date").val());
    }

    function cb(start, end) {
        $('#order__date__range span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
        $("#productsearch-from_date").val(start.format('YYYY-MM-D'));
        $("#productsearch-to_date").val(end.format('YYYY-MM-D'));
    }

    $('#order__date__range').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'This Week': [moment().startOf('week'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);

    $('#order__date__range').on('apply.daterangepicker', function(ev, picker) {
        $('#formProductsearch').trigger('submit');
    });

    $(document).on("change","#productsearch-globalsearch", function(){
        $('#formProductsearch').trigger('submit');
    });


    $(".triggerModal").click(function(){
        $("#modal").modal("show")
            .find("#modalContent")
            .load($(this).attr("value"));
        $("#modal").find("#modal-label").text($(this).data("title"));

    });

JS;
$this->registerJs($script);
?>