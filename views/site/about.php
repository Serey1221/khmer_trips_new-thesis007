<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'About';
// $this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_section_search', ['model' => $searchModel]) ?>

<?= $this->render('_sub_about'); ?>


<!-- Feature Start -->
<div class="container-fluid pb-5">
    <div class="container pb-5">
        <div class="row">
            <div class="col-md-4">
                <div class="d-flex mb-4 mb-lg-0">
                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary mr-3" style="height: 100px; width: 100px;">
                        <i class="fa fa-2x fa-money-check-alt text-white"></i>
                    </div>
                    <div class="d-flex flex-column">
                        <h5 class="">Competitive Pricing</h5>
                        <p class="m-0">Khmer Travel provide best price to customers</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex mb-4 mb-lg-0">
                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary mr-3" style="height: 100px; width: 100px;">
                        <i class="fa fa-2x fa-award text-white"></i>
                    </div>
                    <div class="d-flex flex-column">
                        <h5 class="">Best Services</h5>
                        <p class="m-0">Khmer Travel brings you the best service and confidence.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex mb-4 mb-lg-0">
                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary mr-3" style="height: 100px; width: 100px;">
                        <i class="fa fa-2x fa-globe text-white"></i>
                    </div>
                    <div class="d-flex flex-column">
                        <h5 class="">Nationwide Coverage</h5>
                        <p class="m-0">Khmer Travel brings you new destinations closest to you.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Feature End -->
<div class="container-fluid mt-5">
    <div class="container pb-5">
        <div class="lightbox">
            <div class="row">
                <div class="col-lg-6">
                    <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Our activities</h6>
                    <h1>Our journey so far</h1>
                    <p>We would like to thank to all professors, advisor, owner and leader at Euro Khmer Voyage very much and we cannot express enough gratitude to you, for how much you have taught and inputted to us.</p>
                </div>
                <!-- <div class="col-lg-4">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Thumbnails/Slides/1.webp" data-mdb-img="https://mdbcdn.b-cdn.net/img/Photos/Slides/1.webp" alt="Table Full of Spices" class="w-100 mb-2 mb-md-4 shadow-1-strong rounded" />
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Thumbnails/Square/1.webp" data-mdb-img="https://mdbcdn.b-cdn.net/img/Photos/Square/1.webp" alt="Coconut with Strawberries" class="w-100 shadow-1-strong rounded" />
                </div> -->
                <div class="col-lg-6">
                    <img src="../app/img/Team-5.jpg" alt="Team Meeting" class="w-100 shadow-1-strong rounded" />
                </div>
            </div>
            <div class="row " style="margin-top: 15%;">
                <div class="col-lg-6">
                    <img src="../app/img/Team-6.jpg" alt="Team Meeting" class="w-100 shadow-1-strong rounded" />
                </div>
                <div class="col-lg-6 py-5">
                    <h3>Our journey so far</h3>
                    <p>Thanks for being very patient with us from the first day until we finish this Sarona. With your help, we could fight with our struggling in any matter and ending up to get a potential project done. Thank you very much.</p>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Team Start -->
<div class="container-fluid py-5">
    <div class="container pt-5 pb-3">
        <div class="text-center mb-3 pb-3">
            <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">About Us</h6>
            <h1>Our Team</h1>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="team-item bg-white mb-4">
                    <div class="team-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="../app/img/Team-1.png" alt="">
                        <div class="team-social">
                            <a class="btn btn-outline-primary btn-square mr-2" href="https://twitter.com/SNakatok4810" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-primary btn-square mr-2" href="https://web.facebook.com/srout.serey.5" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-primary btn-square mr-2" href="https://t.me/Serey_nakanaka" target="_blank"><i class="fab fa-telegram"></i></a>
                            <a class="btn btn-outline-primary btn-square" href="https://www.instagram.com/sereynakato/" target="_blank"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <h5 class="text-truncate">Sruot Serey</h5>
                        <p class="m-0">Web Application</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="team-item bg-white mb-4">
                    <div class="team-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="../app/img/Team-2.png" alt="">
                        <div class="team-social">
                            <a class="btn btn-outline-primary btn-square mr-2" href="https://twitter.com/psovanmony/" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-primary btn-square mr-2" href="https://www.facebook.com/profile.php?id=100020864430839&mibextid=LQQJ4d" target="_blank"><i class="fab fa-facebook-f" target="_blank"></i></a>
                            <a class="btn btn-outline-primary btn-square mr-2" href="https://t.me/phoeungsovanmony" target="_blank"><i class="fab fa-telegram"></i></a>
                            <a class="btn btn-outline-primary btn-square" href="https://instagram.com/phoeungsovanmony?igshid=MzRlODBiNWFlZA==" target="_blank"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <h5 class="text-truncate">Phoeung Sovanmony</h5>
                        <p class="m-0">Docs Support</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="team-item bg-white mb-4">
                    <div class="team-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="../app/img/Team-3.png" alt="">
                        <div class="team-social">
                            <a class="btn btn-outline-primary btn-square mr-2" href="https://twitter.com/khmer_travel" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-primary btn-square mr-2" href="https://www.facebook.com/profile.php?id=100091447657537" target="_blank"><i class="fab fa-facebook-f" target="_blank"></i></a>
                            <a class="btn btn-outline-primary btn-square mr-2" href="https://manager.line.biz/account/@313rhjxt" target="_blank"><i class="fab fa-telegram"></i></a>
                            <a class="btn btn-outline-primary btn-square" href="https://www.instagram.com/khmertravel.cambodia/" target="_blank"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <h5 class="text-truncate">Yoeun Sokha</h5>
                        <p class="m-0">Docs Support</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="team-item bg-white mb-4">
                    <div class="team-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="../app/img/Team-4.png" alt="">
                        <div class="team-social">
                            <a class="btn btn-outline-primary btn-square mr-2" href="https://twitter.com/khmer_travel" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-primary btn-square mr-2" href="https://www.facebook.com/profile.php?id=100091447657537" target="_blank"><i class="fab fa-facebook-f" target="_blank"></i></a>
                            <a class="btn btn-outline-primary btn-square mr-2" href="https://manager.line.biz/account/@313rhjxt" target="_blank"><i class="fab fa-telegram"></i></a>
                            <a class="btn btn-outline-primary btn-square" href="https://www.instagram.com/khmertravel.cambodia/" target="_blank"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <h5 class="text-truncate">Chek Chetra</h5>
                        <p class="m-0">Tech Support</p>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">

            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="team-item bg-white mb-4">
                    <div class="team-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="../app/img/Team.png" alt="">
                        <div class="team-social">
                            <a class="btn btn-outline-primary btn-square mr-2" href="https://twitter.com/khmer_travel" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-primary btn-square mr-2" href="https://www.facebook.com/profile.php?id=100091447657537" target="_blank"><i class="fab fa-facebook-f" target="_blank"></i></a>
                            <a class="btn btn-outline-primary btn-square mr-2" href="https://manager.line.biz/account/@313rhjxt" target="_blank"><i class="fab fa-telegram"></i></a>
                            <a class="btn btn-outline-primary btn-square" href="https://www.instagram.com/khmertravel.cambodia/" target="_blank"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <h5 class="text-truncate">Mao Samet</h5>
                        <p class="m-0">Tech Support</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="https://t.me/khmertravel07" class="btn btn-primary m-0" target="_blank"><i class="fab fa-telegram"></i> Join Us</a>
        </div>
    </div>
</div>
<!-- Team End -->
<!-- 
<div class="container-fluid py-5">
    <div class="container pb-3">
        <div class="text-center mb-3 pb-3">
            <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">About Us</h6>
            <h1>Our Team</h1>
        </div>
        <div class="row">
            <div class="col-6">

            </div>
            <div class="col-6 text-right">
                <a class="btn btn-primary mb-3 mr-1" href="#carouselExampleIndicators2" role="button" data-slide="prev">
                    <i class="fa fa-arrow-left"></i>
                </a>
                <a class="btn btn-primary mb-3 " href="#carouselExampleIndicators2" role="button" data-slide="next">
                    <i class="fa fa-arrow-right"></i>
                </a>
            </div>
            <div class="col-lg-12">
                <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">

                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">

                                <div class="col-md-3 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x280" src="../app/img/Team-1.png">
                                        <div class="card-body">
                                            <h4 class="card-title">Special title treatment</h4>
                                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>

                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x280" src="../app/img/Team-2.png">
                                        <div class="card-body">
                                            <h4 class="card-title">Special title treatment</h4>
                                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x280" src="../app/img/Team-3.png">
                                        <div class="card-body">
                                            <h4 class="card-title">Special title treatment</h4>
                                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x280" src="../app/img/Team-4.png">
                                        <div class="card-body">
                                            <h4 class="card-title">Special title treatment</h4>
                                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">

                                <div class="col-md-3 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x280" src="../app/img/Team.png">
                                        <div class="card-body">
                                            <h4 class="card-title">Special title treatment</h4>
                                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->