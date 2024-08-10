<?php
session_start();
ob_start();


ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
$conn = mysqli_connect("localhost", "root", "", "shushaOtel");
$query = mysqli_query($conn, 'SELECT * FROM slider WHERE status=1 ORDER BY RAND()');



?>


<?php include ("partials/_header.php"); ?>
                        <?php if (isset($success) && $success): ?>
                                <div class="alert alert-success"><?php echo $success ?></div>
                        <?php elseif (isset($danger) && $danger): ?>
                                <div class="alert alert-success"><?php echo $danger ?></div>
                        <?php endif; ?>
        <!-- Carousel Start -->
        <div class="container-fluid p-0 mb-5">

            <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $count = 0;
                    while ($slider = mysqli_fetch_array($query)) {
                        if ($count == 0) {
                            $active = 'active';
                        } else {
                            $active = "";
                        }
                        $count++;
                        ?>
                        <div class="carousel-item <?php echo $active; ?>">
                            <img class="w-100" src="upload_slider/<?php echo $slider['slider_image'] ?>" alt="Image">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h6 class="section-title text-white text-uppercase mb-3 animated slideInDown"><?php echo $slider['slider_title1'] ? $slider['slider_title1'] : 'Dəbdəbəli Yaşayış'; ?></h6>
                                    <h1 class="display-3 text-white mb-4 animated slideInDown">
                                    <?php echo $slider['slider_title2'] ? $slider['slider_title2'] : 'Brend Oteli kəşf edin'; ?></h1>
                                        <a href="room.php" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Otaqlarımız</a>
                                    <a href="" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Otaq bron edin</a>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <?php
                if ($count > 1) {
                    ?>
                    <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                <?php
                }
                ?>
            </div>

        </div>
        <!-- Carousel End -->


<?php include ("partials/_booking.php"); ?>
<?php include ("partials/_about.php"); ?>
<?php include ("partials/_room.php"); ?>






        <!-- Video Start -->
        <div class="container-xxl py-5 px-0 wow zoomIn" data-wow-delay="0.1s">
            <div class="row g-0">
                <div class="col-md-6 bg-dark d-flex align-items-center">
                    <div class="p-5">
                        <h6 class="section-title text-start text-white text-uppercase mb-3">Luxury Living</h6>
                        <h1 class="text-white mb-4">Discover A Brand Luxurious Hotel</h1>
                        <p class="text-white mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
                        <a href="room.php" class="btn btn-primary py-md-3 px-md-5 me-3">Otaqlara Bax</a>
                        <a href="booking.php" class="btn btn-light py-md-3 px-md-5">Rezervasiya Edin</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="video">
                        <button type="button" class="btn-play" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/0RnSVNAetcM?si=fWILWZaeRMRCc6Og" data-bs-target="#videoModal">
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Youtube Video</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- 16:9 aspect ratio -->
                        <div class="ratio ratio-16x9">
                            <iframe class="embed-responsive-item" src="" id="video" allowfullscreen allowscriptaccess="always"
                                allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Video Start -->

        <?php include ("partials/_service.php"); ?>



<?php include ("partials/_team.php"); ?>
<?php include ("partials/_testimonial.php"); ?>
<?php include ("partials/_newsletter.php"); ?>
<?php include ("partials/_footer.php"); ?>