<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\DatetimepickerAsset;
use yii\helpers\Url;

DatetimepickerAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\articleSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .blank_space_label {
        padding-top: 32px;
    }
</style>
<div class="order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'options' => ['data-pjax' => true, 'id' => 'formArticleSearch'],
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
            <?= $form->field($model, 'globalSearch')->textInput(['placeholder' => 'Search by title, slug,...etc'])->label('Search') ?>
        </div>
        <div class="col-lg-4">
            <div class="float-right">
                <div class="blank_space_label"></div>
                <?= Html::a('<i class="fas fa-plus mr-1"></i> Add Post', ['create'], ['class' => 'btn rounded-pill btn-success']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<<JS

    var is_filter = $("#articlesearch-from_date").val() != ''?true:false;

    // if(!is_filter){
    //     var start = moment().startOf('week');
    //     var end = moment();
    // }else{
    //     var start = moment($("#articlesearch-from_date").val());
    //     var end = moment($("#articlesearch-to_date").val());
    // }

    // function cb(start, end) {
    //     $('#order__date__range span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
    //     $("#articlesearch-from_date").val(start.format('YYYY-MM-D'));
    //     $("#articlesearch-to_date").val(end.format('YYYY-MM-D'));
    // }

    // $('#order__date__range').daterangepicker({
    //     startDate: start,
    //     endDate: end,
    //     ranges: {
    //        'Today': [moment(), moment()],
    //        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    //        'This Week': [moment().startOf('week'), moment()],
    //        'This Month': [moment().startOf('month'), moment().endOf('month')],
    //        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    //     }
    // }, cb);

    // cb(start, end);

    // $('#order__date__range').on('apply.daterangepicker', function(ev, picker) {
    //     $('#formArticleSearch').trigger('submit');
    // });

    $(document).on("change","#articlesearch-globalsearch", function(){
        $('#formArticleSearch').trigger('submit');
    });


    $(".triggerModal").click(function(){
        $("#modal").modal("show")
            .find("#modalContent")
            .load($(this).attr("value"));
        $("#modal").find("#modal-label").text($(this).data("title"));

    });

    //Date range as a button
    // $('#daterange-btn').daterangepicker(
    //   {
    //     ranges   : {
    //       'Today'       : [moment(), moment()],
    //       'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    //       'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
    //       'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    //       'This Month'  : [moment().startOf('month'), moment().endOf('month')],
    //       'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    //     },
    //     startDate: moment().subtract(29, 'days'),
    //     endDate  : moment()
    //   },
    //   function (start, end) {
    //     $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    //   }
    // )

JS;
$this->registerJs($script);
?>