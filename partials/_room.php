<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

$conn = mysqli_connect("localhost", "root", "", "shushaOtel");

$query = mysqli_query($conn, 'SELECT room.id AS romID,room.file AS roomimg, room.price AS roomprice,room.bed AS bedCount,room.bath AS bathCount,room.wifi AS iswifi, roomType.type AS roomtype 
FROM room,roomType WHERE room.typeID =roomType.id');


?>

    <!-- Room Start -->
        <div class="container-xxl py-5">
                <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title text-center text-primary text-uppercase">Otaqlarımız</h6>
                    <h1 class="mb-5">Daha Çox Araştırın </h1>
                </div>
                <div class="row g-4">
                <?php while ($room = mysqli_fetch_array($query)): ?>
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="room-item shadow rounded overflow-hidden">
                                <div class="position-relative">
                                    <img class="img-fluid" src="..uploads/<?php echo $room['roomimg'] ?>" alt="">
                                    <small class="position-absolute start-0 top-100 translate-middle-y bg-primary text-white rounded py-1 px-3 ms-4"><?php echo $room['roomprice'] ?>AZN/Gecelik</small>
                                </div>
                                <div class="p-4 mt-2">
                                    <div class="d-flex justify-content-between mb-3">
                                        <h5 class="mb-0"><?php echo $room['roomtype'] ?></h5>
                                        <div class="ps-2">
                                            <small class="fa fa-star text-primary"></small>
                                            <small class="fa fa-star text-primary"></small>
                                            <small class="fa fa-star text-primary"></small>
                                            <small class="fa fa-star text-primary"></small>
                                            <small class="fa fa-star text-primary"></small>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <small class="border-end me-3 pe-3"><i class="fa fa-bed text-primary me-2"></i><?php echo $room['bedCount']; ?> Yataq</small>
                                        <small class="border-end me-3 pe-3"><i class="fa fa-bath text-primary me-2"></i><?php echo $room['bathCount']; ?> Hamam</small>
                                        <small><i class="fa fa-wifi text-primary me-2"></i><?php echo $room['iswifi'] ?></small>
                                    </div>
                                    <p class="text-body mb-3">Erat ipsum justo amet duo et elitr dolor, est duo duo eos lorem sed diam stet diam sed stet lorem.</p>
                                    <div class="d-flex justify-content-between">
                                        <a class="btn btn-sm btn-primary rounded py-2 px-4" href="roomabout.php?id=<?php echo $room['romID'];?>">Otaq Haqqında</a>
                                        <a class="btn btn-sm btn-dark rounded py-2 px-4" href="booking.php?id=<?php echo $room['romID'] ?>">Rezerv Et</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php endwhile; ?>
                </div>
                <nav aria-label="...">
  <ul class="pagination">
    <li class="page-item disabled">
      <a class="page-link">Previous</a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item active" aria-current="page">
      <a class="page-link" href="#">2</a>
    </li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>
            </div>
        </div>
        <!-- Room End -->