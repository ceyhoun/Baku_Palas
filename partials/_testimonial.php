     <?php
     $conn = mysqli_connect("localhost", "root", "", "shushaOtel");
     $sql = 'SELECT * FROM `comments` WHERE status=1';
     $query = mysqli_query($conn, $sql);
     ?>
     <!-- Testimonial Start -->
    <!-- Testimonial End -->

    <div class="container-xxl testimonial mt-5 py-5 bg-dark wow zoomIn" data-wow-delay="0.1s" style="margin-bottom: 90px;">
            <div class="container">
                <div class="owl-carousel testimonial-carousel py-5">
                    <?php while($comment =mysqli_fetch_array($query)):?>
                    <div class="testimonial-item position-relative bg-white rounded overflow-hidden">
                    <p><?php echo $comment['message'];?></p>
                        <div class="d-flex align-items-center">
                            <div class="ps-3">
                            <h6 class="fw-bold mb-1"><?php echo $comment['customer'];?></h6>
                                <small><?php echo $comment['subject'];?></small>
                            </div>
                        </div>
                        <i class="fa fa-quote-right fa-3x text-primary position-absolute end-0 bottom-0 me-4 mb-n1"></i>
                    </div>
                    <?php endwhile;?>
                </div>
            </div>
        </div>

