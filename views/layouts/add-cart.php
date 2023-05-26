<!-- Modal -->
<div class="modal right fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Shopping Cart</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-4 d-flex justify-content-between align-items-center">
                    <div class="col-md-2 col-lg-2 col-xl-2">
                        <img src="../app/img/photo-4.png" class="img-fluid rounded-3" style="max-width:130%;" alt="">
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-6">
                        <h6 class="m-1">Yeak loam crater lake</h6>
                        <div class="d-flexmb-3">
                            <small class="m-0"><i class="fa fa-map-marker-alt text-primary mr-2"></i>Ratanakiri</small>
                            <small class="m-0"><i class="fa fa-calendar-alt text-primary mr-2"></i>2 days</small>
                            <small class="m-0"><i class="fa fa-user text-primary mr-2"></i>2 </small>
                        </div>
                        <div class="d-flexmb-3">
                            <small class="m-0"><i class="fa fa-star text-primary mr-2"></i>4.5 <small>(250)</small></small>
                            <small>July 01, 2023</small>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-3 offset-lg-1">
                        <div class="d-flexm-3 text-right mb-3">
                            <a href="#!" class="text-muted"><i class="fas fa-trash"></i></a>
                        </div>
                        <h6 class="mb-0 text-right">$ 84.00</h6>
                    </div>

                </div>
                <hr>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="<?= Yii::getAlias('@web/site/add-cart') ?>" class="btn btn-primary m-0"><i class="fas fa-shopping-cart"></i> Go to Cart</a>
            </div>
        </div>
    </div>
</div>