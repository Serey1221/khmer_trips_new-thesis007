<?php

?>
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
    <div class="row ">
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
            <div class="card">
                <div class="card-header p-3">
                    <h3 class="mb-0 ml-2"> My Booking </h3>
                </div>
                <div class="card-body" data-mdb-perfect-scrollbar="true" style="position: relative; height: 400px">

                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Date</th>
                                <th scope="col">Code</th>
                                <th scope="col">Customer</th>
                                <th scope="col">value</th>
                                <th scope="col">Payment</th>
                                <th scope="col">Paid</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="fw-normal">
                                <th>
                                    <h6>1</h6>
                                </th>
                                <td class="align-middle">
                                    <h6>02-06-2023</h6>
                                </td>
                                <td class="align-middle">
                                    <h6>HDWE453F</h6>
                                </td>
                                <td class="align-middle">
                                    <h6>Ben Jenny</h6>
                                </td>
                                <td class="align-middle">
                                    <h6>$100</h6>
                                </td>
                                <td class="align-middle">
                                    <h6>Full Amount</h6>
                                </td>
                                <td class="align-middle">
                                    <h6>$100</h6>
                                </td>
                                <td class="align-middle">
                                    <h6 class="mb-0 text-white"><span class="badge bg-danger">Cancelled</span></h6>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
</div>