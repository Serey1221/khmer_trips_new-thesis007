<?php
$this->title = 'Checkout';
?>
<style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }

    .container {
        margin-top: 140px;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-5 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Order summary</span>
                <!-- <span class="badge badge-primary badge-pill">3</span> -->
            </h4>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="<?= Yii::getAlias('@web/app/img/no-img.png') ?>" alt="..." class="img-thumbnail">
                        </div>
                        <div class="col-sm-9">
                            <div class="d-flax h6">
                                <span>Angkor Wat: Highlights and Sunrise Guided Tour</span>
                            </div>
                            <div class="d-flax">
                                <span>Provided by Journey Cambodia</span>
                            </div>
                            <div class="d-flax">
                                <span>review:</span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mt-2"> <span class="fw-500"><i class="fas fa-ticket-alt"></i> Small Group Angkor Wat Full-Day Sunrise Tour</span></div>
                    <div class="d-flex justify-content-between mt-2"> <span class="fw-500"><i class="fas fa-clock"></i> Sat, June 3, 2023 at 4:20 AM</span> </div>
                    <div class="d-flex justify-content-between mt-2"> <span class="fw-500"><i class="fa fa-users"></i> 1 Adult (Age 18 - 99) </span> </div>
                    <hr>
                    <div class="d-flex justify-content-between h6 mt-2"> <span class="fw-500">Free Cancelation </span> </div>
                    <small>Until 6:15 PM on June 14 </small>
                    <div class="d-flex justify-content-between h6 mt-2"> <span class="fw-500">Great Value </span> </div>
                    <small>Customers rated this 4.7/5 for value for money</small>
                    <hr>
                    <small>Enter gift code or promo code</small>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Promo code">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Redeem</button>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between h4 mt-2"> <span class="fw-500">Subtotal </span> <span class="text-success">$85.00</span> </div>
                </div>
            </div>
        </div>
        <div class="col-md-7 order-md-1">
            <h2 class="mb-3">Check Your Personal Details</h2>
            <div class="row">
                <div class="col-sm-10">
                    <form class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="username">Tour Leader</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="username" placeholder="name" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <div class="input-group">
                                <input type="email" class="form-control" id="email" placeholder="you@example.com">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="phonenumber">Phone Number</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="phonenumber" placeholder="phonenumber" required>
                            </div>
                        </div>
                        <hr class="mb-4 mt-4">

                        <h4 class="mb-3">Payment</h4>
                        <div class="d-block my-3">
                            <div class="custom-control custom-radio">
                                <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                                <label class="custom-control-label" for="paypal">PayPal</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cc-name">Name on card</label>
                                <input type="text" class="form-control" id="cc-name" placeholder="" required>
                                <small class="text-muted">Full name as displayed on card</small>
                                <div class="invalid-feedback">
                                    Name on card is required
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cc-number">Credit card number</label>
                                <input type="text" class="form-control" id="cc-number" placeholder="" required>
                                <div class="invalid-feedback">
                                    Credit card number is required
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="cc-expiration">Expiration</label>
                                <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                                <div class="invalid-feedback">
                                    Expiration date required
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="cc-cvv">CVV</label>
                                <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                                <div class="invalid-feedback">
                                    Security code required
                                </div>
                            </div>
                        </div>
                        <hr class="mb-4">
                        <a href="<?= Yii::getAlias('@web/site/success-pay') ?>" class="btn btn-primary btn-lg btn-block">Continue to checkout</a>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>