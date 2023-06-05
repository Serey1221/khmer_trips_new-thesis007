<?php
$this->title = 'Invoice: ' . $model->invoice_code;
/** @var app\components\Formater $formater */
$formater = Yii::$app->formater;
?>
<style>
  tfoot td {
    vertical-align: middle !important;
  }
</style>
<div class="container mt-3">
  <div class="card">
    <div class="card-body">
      <div class="row d-flex align-items-baseline">
        <div class="col-xl-9">
          <p style="color: #7e8d9f;font-size: 20px;">Invoice >> <strong>ID: <?= $model->invoice_code ?></strong></p>
        </div>

        <hr>
      </div>

      <div class="container">
        <div class="col-md-12">
          <div class="text-center">
            <h4 class="m-0 text-primary mb-5"><img src="<?= Yii::getAlias("@web/img/Khmer_Travel.png"); ?>" width="40px" /> <span class="text-dark">KHMER</span>TRAVEL</h4>
          </div>

        </div>


        <div class="row">
          <div class="col-xl-8">
            <ul class="list-unstyled">
              <li class="text-muted">To: <span class="text-info"><?= $customer->name ?></span></li>
              <li class="text-muted"><?= $customer->address ?></li>
              <li class="text-muted"><i class="fas fa-phone"></i> <?= $customer->phone_number ?></li>
            </ul>
          </div>
          <div class="col-xl-4">
            <p class="text-muted">Invoice</p>
            <ul class="list-unstyled">
              <li class="text-muted"><i class="fas fa-circle text-primary"></i> <span class="fw-bold">ID:</span># <?= $model->invoice_code ?></li>
              <li class="text-muted"><i class="fas fa-circle text-primary"></i> <span class="fw-bold">Creation Date: </span> <?= $formater->date($invoiceDate) ?></li>
              <li class="text-muted"><i class="fas fa-circle text-primary"></i> <span class="me-1 fw-bold">Status: </span> <?= $model->getPaymentStatus() ?></li>
            </ul>
          </div>
        </div>

        <div class="row my-2 mx-1 justify-content-center">
          <table class="table table-striped table-borderless">
            <thead style="background-color:#7ab730 ;" class="text-white">
              <tr>
                <th>#</th>
                <th>Description</th>
                <th>Qty</th>
                <th class="text-right">Unit Price</th>
                <th class="text-right">Amount</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (!empty($invoiceItem)) {
                foreach ($invoiceItem as $key => $value) {
                  $key++;
              ?>
                  <tr>
                    <th><?= $key ?></th>
                    <td><?= $value->product->name ?></td>
                    <td><?= $value->total_guest ?> pax(s)</td>
                    <td class="text-right"><?= $formater->DollarFormat($value->price) ?></td>
                    <td class="text-right"><?= $formater->DollarFormat($value->total_price) ?></td>
                  </tr>
              <?php
                }
              }
              ?>


            </tbody>
            <tfoot>
              <tr>
                <td class="text-right" colspan="4">Total Amount</td>
                <td class="text-right"><span style="font-size: 1.5rem"><?= $formater->DollarFormat($model->total_amount) ?></span></td>
              </tr>
              <tr>
                <td class="text-right text-danger" colspan="4">Balance Due</td>
                <td class="text-right text-danger"><span style="font-size: 1.5rem"><?= $formater->DollarFormat($model->balance_amount) ?></span></td>
              </tr>
            </tfoot>
          </table>
        </div>
        <hr>
        <div class="row">
          <div class="col-xl-12">
            <p>Thank you for your purchase with KHMERTRAVEL.</p>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>