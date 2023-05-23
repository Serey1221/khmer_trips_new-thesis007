<?php

use yii\bootstrap4\Breadcrumbs;
use app\assets\DatePickerAsset;

DatePickerAsset::register($this);
$this->title = 'Booking Detail';
$this->params['breadcrumbs'][] = $this->title;

$formater = Yii::$app->formater;
?>
<?php // $this->render('booking'); 
?>
<style>
    .page-title {
        background-color: #7ab730;
        margin-top: 45px;
        height: 62px;
    }
</style>
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h4 class="text-justify py-3" style="color:white">Bayon or Angkor Thom temple</h4>
            </div>
            <div class="col-lg-4">
                <div class="text-justify py-2">
                    <?php
                    echo Breadcrumbs::widget([
                        'class' => 'py-4',
                        'homeLink' => [
                            'label' => Yii::t('yii', 'Back to package'),
                            'url' => Yii::getAlias('@web/site/package'),
                        ],
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]);
                    ?>
                </div>

            </div>
        </div>

    </div>
</div>
<!-- Blog Start -->
<div class="container-fluid">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                <!-- Blog Detail Start -->
                <div class="pb-3">
                    <div class="blog-item">
                        <div class="position-relative">
                            <img class="img-fluid w-100" src="../app/img/blog-3.png" alt="">
                            <div class="blog-date">
                                <h6 class="font-weight-bold mb-n1">01</h6>
                                <small class="text-white text-uppercase">Jan</small>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white mb-3" style="padding: 30px;">
                        <div class="d-flex mb-3">
                            <!-- <a class="text-primary text-uppercase text-decoration-none" href="">Admin</a>
                            <span class="text-primary px-2">|</span> -->
                            <a class="text-primary text-uppercase text-decoration-none" href="">Bayon or Angkor Thom temple</a>
                        </div>
                        <h2 class="mb-3">Buddhist symbolism in the foundation of the temple by King Jayavarman VII</h2>
                        <p>The Bayon was the last state temple to be built at Angkor (Khmer: ក្រុងអង្គរ), and the only Angkorian state temple to be built primarily to worship buddhist deities, though a great number of minor and local deities were also encompassed as representatives of the various districts and cities of the realm. Originally a Hindu temple, the Bayon(Jayagiri) was the centrepiece of Jayavarman VII's massive program of monumental construction and public works, which was also responsible for the walls and nāga-bridges of Angkor Thom (Khmer: អង្គរធំ) and the temples of Lord Vishnu (Khmer: ប្រាសាទព្រះខ័ន), Ta Prohm (Khmer: ប្រាសាទតាព្រហ្ម) and Banteay Kdei (Khmer: ប្រាសាទបន្ទាយក្តី).[7]
                            From the vantage point of the temple's upper terrace, one is struck by "the serenity of the stone faces" occupying many towers.[6]
                            The similarity of the 216 gigantic faces on the temple's towers to other statues of the has led many scholars to the conclusion that the faces are representations of Jayavarman VII, himself (Khmer: ព្រះបាទជ័យវរ្ម័នទី ៧). Scholars have theorized that the faces belong to the bodhisattva of compassion called Avalokitesvara or Lokesvara.[8] But the locals still have a solid concern that the temple was built for Lord Brahma and not for Budhha and they give a solid reason for their view that Buddha did not have three eyes, but that statues have three eyes carved in them. The god with three eyes is "Lord Shiva" who is known as "God of Destruction" one among the three powerful deities in the Hindu pantheon - Brahma, Vishnu, Maheshwara (Lord Shiva). Buddha's images seldom wear jewelry like necklaces, large earrings and a crown. They argued that the faces, arranged in four directions resemble that of Brahma. The two hypotheses need not be regarded as mutually exclusive. Angkor scholar George Coedès has theorized that Jayavarman VII stood squarely in the tradition of the Khmer monarchs in thinking of himself as a "devaraja" (god-king), the salient difference being that while his predecessors were Hindus and regarded themselves as consubstantial with Brahma and his symbol the chatur Mukh (four faced), Jayavarman VII was a Buddhist</p>

                        <h4 class="mb-3">Alterations following the death of Jayavarman VII</h4>
                        <img class="img-fluid w-50 float-left mr-4 mb-2" src="../app/img/JayavarmanVII.jpeg">
                        <p>Since the time of Jayavarman VII, the Bayon has undergone numerous Buddhist additions and alterations at the hands of subsequent monarchs.[6] During the reign of Jayavarman VIII in the mid-13th century, the Khmer empire reverted to Hinduism and its state temple was altered accordingly. In later centuries, Theravada Buddhism became the dominant religion, leading to still further changes, before the temple was eventually abandoned to the jungle. Current features which were not part of the original plan include the terrace to the east of the temple, the libraries, the square corners of the inner gallery, and parts of the upper terrace.</p>
                        <h5 class="mb-3 mt-3">Modern restoration</h5>
                        <img class="img-fluid w-50 float-right ml-4 mb-2" src="../app/img/Angkor-thom.jpeg">
                        <p>In the first part of the 20th century, the École Française d'Extrême Orient took the lead in the conservation of the temple, restoring it in accordance with the technique of anastylosis. Since 1995 the Japanese Government team for the Safeguarding of Angkor (the JSA) has been the main conservatory body, and has held annual symposia.</p>
                    </div>
                </div>
                <section id="checkavaibility">
                    <div class=" bg-primary shadow" style="padding: 30px;">
                        <h2 class="text-white">Select participants and date</h2>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3 mb-md-0">
                                            <select class="custom-select px-4" style="height: 47px;">
                                                <option selected>Guests</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <!-- <label for="id_start_datetime"></label> -->
                                            <div class="input-group date" id='datetimepicker1'>
                                                <input type="text" name="departure_date" value="<?= date("Y-m-d") ?>" class="form-control bg-white  p-4" required />
                                                <div class="input-group-addon input-group-append">
                                                    <div class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>&nbsp;
                                                        <!-- <i class="glyphicon glyphicon-calendar fa fa-calendar"></i> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-8"></div>
                            <div class="col-md-4">
                                <a href="#" class="btn btn-warning btn-block">Check availability</a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="col-lg-4 mt-5 mt-lg-0">
                <!-- Category List -->
                <div class="mb-5">
                    <h4 class="text-uppercase mb-4" style="letter-spacing: 2px;">Why book with us?</h4>
                    <div class="bg-white" style="padding: 30px;">
                        <ul class="list-inline m-0">
                            <li class="mb-3 d-flex justify-content-between align-items-center">
                                <a class="text-dark" href="#"><i class="fa fa-angle-right text-primary mr-2"></i>រៀបចំដំណើរកំសាន្តដោយសម្រិតសម្រាង</a>
                            </li>
                            <li class="mb-3 d-flex justify-content-between align-items-center">
                                <a class="text-dark" href="#"><i class="fa fa-angle-right text-primary mr-2"></i>ធានាលើតម្លៃ និង គុណភាពសេវាកម្ម</a>
                            </li>
                            <li class="mb-3 d-flex justify-content-between align-items-center">
                                <a class="text-dark" href="#"><i class="fa fa-angle-right text-primary mr-2"></i>ការបង់ប្រាក់ប្រកបដោយសុវត្ថិភាព</a>
                            </li>
                            <li class="mb-3 d-flex justify-content-between align-items-center">
                                <a class="text-dark" href="#"><i class="fa fa-angle-right text-primary mr-2"></i>បុគ្គលិកប្រកបដោយបទពិសោធន៍ខ្ពស់</a>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                <a class="text-dark" href="#"><i class="fa fa-angle-right text-primary mr-2"></i>កក់បានភ្លាមៗ ២៤/៧</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Recent Post -->
                <div class="mb-5">
                    <h4 class="text-uppercase mb-4" style="letter-spacing: 3px;">Recent Post</h4>
                    <?php if (!empty($threeproduct)) {
                        foreach ($threeproduct as $key => $value) { ?>
                            <a class="d-flex align-items-center text-decoration-none bg-white mb-3" href="">
                                <img class="img-fluid" onerror="this.onerror=null;this.src='<?= Yii::getAlias('@web/app/img/no-img.png') ?>';" src="<?= $value->getUploadUrl('img_url') ?>" alt="" style="max-width:40%;">
                                <div class="pl-3">
                                    <h6 class="ml-1"><?= $value['name'] ?></h6>
                                    <small class=""><?= $formater->date($value->created_at) ?></small>
                                </div>
                            </a>
                    <?php
                        }
                    } ?>
                </div>

                <div class="bg-white" style="padding: 30px;">
                    <h6>Need Assist from Khmer Travel?</h6>
                    <p>យើងរីករាយនឹងផ្តល់ប្រឹក្សា(24/7) ដល់អ្នកដើម្បីបំពេញតម្រូវការដំណើរកំសាន្តរបស់អ្នក។ khmertravel នឹងជូនអ្នកនៅកន្លែងដែលអ្នកប្រាថ្នា</p>
                    <p><i class="fa fa-phone-alt mr-2"></i>+012 345 67890</p>
                    <p><i class="fa fa-envelope mr-2"></i>khmertravel@gmail.com</p>
                </div>

                <div class="bg-white mt-4" style="padding: 30px;">
                    <div class="mb-2">
                        <div class="row">
                            <div class="col-sm-8">
                                <h5>Total Price</h5>
                            </div>
                            <div class="col-sm-4">
                                <h5>$300</h5>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="mb-2">
                        <a href="#checkavaibility" class="btn btn-primary btn-lg btn-block m-0"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                    </div>
                    <div class="mb-2">
                        <a href="#checkavaibility" class="btn btn-warning btn-lg btn-block m-0"></i> Book Now</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- The Original experience-->
        <div class="row mt-5 mb-4">
            <div class="col-lg-8">
                <h3>The Original experience</h3>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <h5>Highlights</h5>
                    </div>
                    <div class="col-md-8">
                        <p>Join a professional art historian for an exclusive tour of MoMA's galleries
                            Access the galleries via a private entrance and explore MoMA free of crowds
                            See a variety renowned works including those by Monet, Van Gogh, and Picasso
                            Discover contemporary pieces by Elizabeth Murray, Cindy Sherman, and Andy Warhol
                            Benefit from additional access to the MoMA PS1 contemporary art center</p>
                    </div>
                </div>
                <hr>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <h5>Overview</h5>
                    </div>
                    <div class="col-md-8">
                        <p>Join a professional art historian for an exclusive tour of MoMA's galleries
                            Access the galleries via a private entrance and explore MoMA free of crowds
                            See a variety renowned works including those by Monet, Van Gogh, and Picasso
                            Discover contemporary pieces by Elizabeth Murray, Cindy Sherman, and Andy Warhol
                            Benefit from additional access to the MoMA PS1 contemporary art center</p>
                    </div>
                </div>
                <hr>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <h5>Includes</h5>
                    </div>
                    <div class="col-md-8">
                        <p>Join a professional art historian for an exclusive tour of MoMA's galleries
                            Access the galleries via a private entrance and explore MoMA free of crowds
                            See a variety renowned works including those by Monet, Van Gogh, and Picasso
                            Discover contemporary pieces by Elizabeth Murray, Cindy Sherman, and Andy Warhol
                            Benefit from additional access to the MoMA PS1 contemporary art center</p>
                    </div>
                </div>
                <hr>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <h5>Excludes</h5>
                    </div>
                    <div class="col-md-8">
                        <p>Join a professional art historian for an exclusive tour of MoMA's galleries
                            Access the galleries via a private entrance and explore MoMA free of crowds
                            See a variety renowned works including those by Monet, Van Gogh, and Picasso
                            Discover contemporary pieces by Elizabeth Murray, Cindy Sherman, and Andy Warhol
                            Benefit from additional access to the MoMA PS1 contemporary art center</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- You might also like-->
        <div class="row mt-4">
            <div class="col-lg-12">
                <h4>You might also like...</h4>

            </div>
        </div>

        <div class="row">
            <?php if (!empty($threeproduct)) {
                foreach ($threeproduct as $key => $value) { ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="package-item bg-white mb-2">
                            <img class="img-fluid" onerror="this.onerror=null;this.src='<?= Yii::getAlias('@web/app/img/no-img.png') ?>';" src="<?= $value->getUploadUrl('img_url') ?>" alt="">
                            <div class="h_container" style="position: absolute;top: 8px;right: 24px;">
                                <i id="heart" class="far fa-heart"></i>
                            </div>
                            <div class="p-4">
                                <div class="d-flex justify-content-between mb-3">
                                    <small class="m-0"><i class="fa fa-map-marker-alt text-primary mr-2"></i>Koh Ker</small>
                                    <small class="m-0"><i class="fa fa-calendar-alt text-primary mr-2"></i>3 days</small>
                                    <small class="m-0"><i class="fa fa-user text-primary mr-2"></i>2 Person</small>
                                </div>
                                <a class="h5 text-decoration-none" href="<?= Yii::getAlias('@web/site/booking-detail') ?>"><?= $value['name'] ?></a>
                                <div class="border-top mt-4 pt-4">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="m-0"><i class="fa fa-star text-primary mr-2"></i>4.5 <small>(250)</small></h6>
                                        <h5 class="m-0">$350</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } ?>
            <!-- <div class="col-lg-4 col-md-6 mb-4">
                <div class="package-item bg-white mb-2">
                    <img class="img-fluid" src="../app/img/photo-9.png" alt="">
                    <div class="p-4">
                        <div class="d-flex justify-content-between mb-3">
                            <small class="m-0"><i class="fa fa-map-marker-alt text-primary mr-2"></i>Kbal Spean</small>
                            <small class="m-0"><i class="fa fa-calendar-alt text-primary mr-2"></i>3 days</small>
                            <small class="m-0"><i class="fa fa-user text-primary mr-2"></i>2 Person</small>
                        </div>
                        <a class="h5 text-decoration-none" href="">Kbal Spean</a>
                        <p>Kbal Spean is an Angkorian-era archaeological site on the southwest slopes of the Kulen Hills </p>
                        <div class="border-top mt-4 pt-4">
                            <div class="d-flex justify-content-between">
                                <h6 class="m-0"><i class="fa fa-star text-primary mr-2"></i>4.5 <small>(250)</small></h6>
                                <h5 class="m-0">$350</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="package-item bg-white mb-2">
                    <img class="img-fluid" src="../app/img/photo-10.png" alt="">
                    <div class="p-4">
                        <div class="d-flex justify-content-between mb-3">
                            <small class="m-0"><i class="fa fa-map-marker-alt text-primary mr-2"></i>Mekong River</small>
                            <small class="m-0"><i class="fa fa-calendar-alt text-primary mr-2"></i>3 days</small>
                            <small class="m-0"><i class="fa fa-user text-primary mr-2"></i>2 Person</small>
                        </div>
                        <a class="h5 text-decoration-none" href="">Mekong River</a>
                        <p>The Mekong or Mekong River is a trans-boundary river in East Asia and Southeast Asia.</p>
                        <div class="border-top mt-4 pt-4">
                            <div class="d-flex justify-content-between">
                                <h6 class="m-0"><i class="fa fa-star text-primary mr-2"></i>4.5 <small>(250)</small></h6>
                                <h5 class="m-0">$350</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->


        </div>
        <div class="row">

            <div class="col-lg-12 mt-4">
                <h2>Comment Form Start </h2>
                <!-- Comment Form Start -->
                <div class="bg-white mb-3" style="padding: 30px;">
                    <h4 class="text-uppercase mb-4" style="letter-spacing: 5px;">Leave a comment</h4>
                    <form>
                        <div class="form-group">
                            <label for="name">Name *</label>
                            <input type="text" class="form-control" id="name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="url" class="form-control" id="website">
                        </div>

                        <div class="form-group">
                            <label for="message">Message *</label>
                            <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="form-group mb-0">
                            <input type="submit" value="Leave a comment" class="btn btn-primary font-weight-semi-bold py-2 px-3">
                        </div>
                    </form>
                </div>
                <!-- Comment Form End -->
            </div>
        </div>
    </div>
</div>
<!-- Blog End -->
<?php
$script = <<<JS
    
    flatpickr('input[name="departure_date"', {
        minDate: "today",
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
    });
JS;
$this->registerJs($script);
?>