<div class="container py-5 mt-5">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">User</a></li>
                    <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="text-center">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                        <h5 class="my-2">John Smith</h5>
                        <p>joined at 01 Jun 2023</p>
                    </div>
                    <hr>
                    <a href="<?= Yii::getAlias('@web/user/index') ?>" class="text-dark"><i class="fas fa-user mr-3"></i> Profile</a>
                    <hr>
                    <a href="<?= Yii::getAlias('@web/user/booking') ?>" class="text-dark"><i class="fas fa-list mr-3"></i> My Booking</a>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row my-3">
                        <div class="col-lg-12">
                            <form role="form">
                                <h5>Profile Details</h5>
                                <hr>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">First name</label>
                                    <div class="col-lg-9">
                                        <input class="form-control form-control-lg" type="text" value="Jane" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Last name</label>
                                    <div class="col-lg-9">
                                        <input class="form-control form-control-lg" type="text" value="Bishop" />
                                    </div>
                                </div>
                                <h5>Contact Details</h5>
                                <hr>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Email</label>
                                    <div class="col-lg-9">
                                        <input class="form-control form-control-lg" type="email" value="email@gmail.com" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Phone Number</label>
                                    <div class="col-lg-9">
                                        <input class="form-control form-control-lg" type="number" value="phonenumber" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-9 ml-auto text-right">
                                        <input type="button" class="btn btn-primary" value="Save Changes" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>