<style>
    .container.header {
        margin-top: 120px;
    }
</style>

<div class="container mb-5 header">
    <div class="card">
        <div class="card-body">
            <div class="row d-flex align-items-baseline">
                <div class="col-xl-9">
                    <p style="color: #7e8d9f;font-size: 20px;">Invoice >> <strong>ID: #123-123</strong></p>
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
                            <li class="text-muted">To: <span style="color:#5d9fc5 ;">John Lorem</span></li>
                            <li class="text-muted">Street, City</li>
                            <li class="text-muted">State, Country</li>
                            <li class="text-muted"><i class="fas fa-phone"></i> 123-456-789</li>
                        </ul>
                    </div>
                    <div class="col-xl-4">
                        <p class="text-muted">Invoice</p>
                        <ul class="list-unstyled">
                            <li class="text-muted"><i class="fas fa-circle text-primary"></i> <span class="fw-bold">ID:</span>#123-456</li>
                            <li class="text-muted"><i class="fas fa-circle text-primary"></i> <span class="fw-bold">Creation Date: </span>Jun 23,2021</li>
                            <li class="text-muted"><i class="fas fa-circle text-primary"></i> <span class="me-1 fw-bold">Status:</span><span class="badge bg-warning text-black fw-bold"> Unpaid</span></li>
                        </ul>
                    </div>
                </div>

                <div class="row my-2 mx-1 justify-content-center">
                    <table class="table table-striped table-borderless">
                        <thead style="background-color:#7ab730 ;" class="text-white">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Description</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Unit Price</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Pro Package</td>
                                <td>4</td>
                                <td>$200</td>
                                <td>$800</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Web hosting</td>
                                <td>1</td>
                                <td>$10</td>
                                <td>$10</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Consulting</td>
                                <td>1 year</td>
                                <td>$300</td>
                                <td>$300</td>
                            </tr>
                        </tbody>

                    </table>
                </div>
                <div class="row">
                    <div class="col-xl-8">


                    </div>
                    <div class="col-xl-3">

                        <p class="text-black float-start"><span class="text-black me-3"> Total Amount</span><span style="font-size: 25px;">$1221</span></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xl-10">
                        <p>Thank you for your purchase</p>
                    </div>
                    <div class="col-xl-2">
                        <button type="button" class="btn btn-primary text-capitalize" style="background-color:#7ab730 ;">Pay Now</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>