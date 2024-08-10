 <?php 
 $conn = mysqli_connect("localhost", "root", "", "shushaOtel");
 $sql ='SELECT * FROM team';
 $query=mysqli_query($conn,$sql);
 ?>
 <!-- Team Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title text-center text-primary text-uppercase">Komandamız</h6>
                    <h1 class="mb-5">Heyyetimizi <span class="text-primary text-uppercase">Keşf Edin</span></h1>
                </div>
                <div class="row g-4">
                <?php while($team=mysqli_fetch_array($query)):?>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="rounded shadow overflow-hidden">
                            <div class="position-relative">
                                <img class="img-fluid" src="team_upload/<?php echo $team['image'];?>" alt="<?php echo $team['task'];?>">
                                <div class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                                    <a class="btn btn-square btn-primary mx-1" href="<?php echo $team['facebook'];?>"><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-primary mx-1" href="<?php echo $team['twitter'];?>"><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-primary mx-1" href="<?php echo $team['instagram'];?>"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                            <div class="text-center p-4 mt-3">
                                <h5 class="fw-bold mb-0"><?php echo $team['name'];?> <?php echo $team['surname'];?></h5>
                                <small><?php echo $team['task'];?></small>
                            </div>
                        </div>
                    </div>
                    <?php endwhile;?>
                </div>
            </div>
        </div>
        <!-- Team End -->
