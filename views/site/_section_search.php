<?php

use app\assets\DatePickerAsset;

DatePickerAsset::register($this);
?>

<div class="container-fluid booking mt-5 pb-5">
    <div class="container pb-5">
        <div class="bg-light shadow" style="padding: 30px;">
            <div class="row align-items-center" style="min-height: 60px;">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-3">
                            <h4 class="title">Location</h4>
                            <label>Your destination</label>
                            <div class="mb-3 mb-md-0">
                                <select class="custom-select px-4" style="height: 47px;">
                                    <option selected>All</option>
                                    <?php if (!empty($numberCity)) {
                                        foreach ($numberCity as $key => $value) { ?>
                                            <option value=""><?= $value->name ?></option>

                                    <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <h4 class="title">Date</h4>
                            <label>Departure</label>
                            <!-- <div class="mb-3 mb-md-0">
                                        <div class="date" id="date1" data-target-input="nearest">
                                            <input type="text" class="form-control p-4 datetimepicker-input" placeholder="D/M/Y" data-target="#date1" data-toggle="datetimepicker" />

                                        </div>
                                    </div> -->
                            <div class="form-group">
                                <!-- <label for="id_start_datetime"></label> -->
                                <div class="input-group date" id='datetimepicker1'>
                                    <input type="text" name="departure_date" value="<?= date("Y-m-d") ?>" class="form-control bg-transparent p-4" required />
                                    <div class="input-group-addon input-group-append">
                                        <div class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>&nbsp;
                                            <!-- <i class="glyphicon glyphicon-calendar fa fa-calendar"></i> -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-3">
                            <h4 class="title">Day</h4>
                            <label>Duration</label>
                            <div class="mb-3 mb-md-0">
                                <!-- <div class="date" id="date2" data-target-input="nearest">
                                            <input type="text" class="form-control p-4 datetimepicker-input" placeholder="Number of days" data-target="#date2" data-toggle="datetimepicker" />
                                        </div> -->
                                <select class="custom-select px-4" style="height: 47px;">
                                    <option selected>Number of days</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                            <!-- <div class="input-group date" id="datetimepicker">
                                    <input type="text" class="form-control" style="height: 47px;">
                                    <span class="input-group-append">
                                        <span class="input-group-text bg-white">Number of people
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </span>
                                </div> -->
                        </div>
                        <div class="col-md-3">
                            <h4 class="title">Number</h4>
                            <label>People</label>
                            <div class="mb-3 mb-md-0">
                                <select class="custom-select px-4" style="height: 47px;">
                                    <option selected>Guests</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary btn-block" type="submit" style="height: 47px; margin-top: 52px;">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$script = <<<JS
    
    flatpickr('input[name="departure_date"', {
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
    });
JS;
$this->registerJs($script);
?>