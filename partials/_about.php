  <?php 
$conn = mysqli_connect("localhost", "root", "", "shushaOtel");
$room_select =mysqli_query($conn,'SELECT * FROM room');
$roomCount=mysqli_num_rows($room_select);
$team_select =mysqli_query($conn,'SELECT * FROM team');
$teamCount=mysqli_num_rows($team_select);
$booking_select =mysqli_query($conn,'SELECT * FROM booking');
$bookingCount=mysqli_num_rows($booking_select);
$comment_select =mysqli_query($conn,'SELECT * FROM comments');
$commentCount=mysqli_num_rows($comment_select);
  ?>
  <!-- About Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <h6 class="section-title text-start text-primary text-uppercase">Haqqımızda</h6>
                        <h1 class="mb-4">Xoş Geldiniz <span class="text-primary text-uppercase">Baku Palas</span></h1>
                        <p class="mb-4">Tetilinizi daha yadda qalan ve eylenceli etmek üçün </p>
                        <div class="row g-3 pb-4">
                            <div class="col-sm-4 wow fadeIn" data-wow-delay="0.1s">
                                <div class="border rounded p-1">
                                    <div class="border rounded text-center p-4">
                                        <i class="fa fa-hotel fa-2x text-primary mb-2"></i>
                                        <h2 class="mb-1" data-toggle="counter-up"><?php echo $roomCount;?></h2>
                                        <p class="mb-0">Otaqlarımız</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 wow fadeIn" data-wow-delay="0.3s">
                                <div class="border rounded p-1">
                                    <div class="border rounded text-center p-4">
                                        <i class="fa fa-users-cog fa-2x text-primary mb-2"></i>
                                        <h2 class="mb-1" data-toggle="counter-up"><?php echo $teamCount;?></h2>
                                        <p class="mb-0">Kadrlarımız</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 wow fadeIn" data-wow-delay="0.5s">
                                <div class="border rounded p-1">
                                    <div class="border rounded text-center p-4">
                                        <i class="fa fa-users fa-2x text-primary mb-2"></i>
                                        <h2 class="mb-1" data-toggle="counter-up"><?php echo $bookingCount;?></h2>
                                        <p class="mb-0">Müşterilerimiz</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 wow fadeIn" data-wow-delay="0.5s">
                                <div class="border rounded p-1">
                                    <div class="border rounded text-center p-4">
                                        <i class="fa fa-comment fa-2x text-primary mb-2"></i>
                                        <h2 class="mb-1" data-toggle="counter-up"><?php echo $commentCount;?></h2>
                                        <p class="mb-0">Rəylər</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="btn btn-primary py-3 px-5 mt-2" href="about.php">Daha çox </a>
                    </div>
                    <div class="col-lg-6">
                        <div class="row g-3">
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.1s" src="img/about-1.jpg" style="margin-top: 25%;">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.3s" src="img/about-2.jpg">
                            </div>
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-50 wow zoomIn" data-wow-delay="0.5s" src="img/about-3.jpg">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.7s" src="img/about-4.jpg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->
