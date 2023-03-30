<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\DatetimepickerAsset;

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
        'method' => 'get',
    ]); ?>
    <div class="row">
        <div class="col-lg-4">
            <label>Date Range</label>
            <div id="order__date__range" style="cursor: pointer;" class="form-control">
                <i class="fas fa-calendar text-muted"></i>&nbsp;
                <span></span> <i class="fa fa-caret-down text-muted float-right"></i>
            </div>
            <?= $form->field($model, 'from_date')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'to_date')->hiddenInput()->label(false) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'globalSearch')->textInput(['placeholder' => 'Search by title, slug,...etc'])->label('Search') ?>
        </div>
        <div class="col-lg-4">
            <div class="float-right">
                <div class="blank_space_label"></div>
                <?= Html::a(
                    '<i class="fas fa-plus mr-1"></i>  Add Product',
                    ['create'],
                    [
                        'class' => 'btn rounded-pill btn-success',
                        'data-pjax' => 0,
                    ]
                ) ?>
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
        var start = moment($("#articlesearch-from_date").val());
        var end = moment($("#articlesearch-to_date").val());
    }

    function cb(start, end) {
        $('#order__date__range span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
        $("#articlesearch-from_date").val(start.format('YYYY-MM-D'));
        $("#articlesearch-to_date").val(end.format('YYYY-MM-D'));
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
        $('#formArticleSearch').trigger('submit');
    });

    $(document).on("change","#articlesearch-globalsearch", function(){
        $('#formArticleSearch').trigger('submit');
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