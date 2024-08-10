<?php
ob_start();
$conn = mysqli_connect("localhost", "root", "", "shushaOtel");
if (!$conn) {
    die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
}



$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : null;

if ($id) {
    $query = mysqli_query($conn, 'SELECT * FROM `roomType`,`room` WHERE roomType.id = room.typeID 
                                   AND room.id = "' . $id . '"');
} else {
    $query = mysqli_query($conn, 'SELECT * FROM roomType  ORDER BY id');
}

if (!$query) {
    die("Sorgu başarısız: " . mysqli_error($conn));
}






?>
<?php include ("partials/_header.php"); ?>
<?php include ("partials/_pageHeader.php"); ?>



        <!-- Booking Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title text-center text-primary text-uppercase">Otaq Rezervasiyası</h6>
                    <h1 class="mb-5">Lüks Otaqlar <span class="text-primary text-uppercase">Sifariş Edin</span></h1>
                </div>
                <div class="row g-5">
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
                    <div class="col-lg-6">
                        <div class="wow fadeInUp" data-wow-delay="0.2s">
                            <form>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Adınız">
                                            <label for="name">Adınız</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="surname" id="surname" placeholder="Soyadınız">
                                            <label for="surname">Soyadınız</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select class="form-select" name="country" id="country">
                                            </select>
                                            <label for="country">Ölkeniz</label>
                                          </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input class="form-control" name="passport" id="passport" placeholder="Pasport Nömresi">
                                            <label for="passport">Pasport Nömresi</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" name="email" id="email" placeholder="E-poçtunuz">
                                            <label for="email">E-poçtunuz</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating date" id="date3" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" name="checkin" id="checkin" placeholder="Giriş Tarixi" data-target="#date3" data-toggle="datetimepicker" value="<?php if (isset($_GET['checkin'])) {
                                                echo $_GET['checkin'];

                                            }

                                            ?>" />
                                            <label for="checkin">Giriş Tarixi</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating date" id="date4" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" name="checkout" id="checkout" placeholder="Çıxış Tarixi" data-target="#date4" data-toggle="datetimepicker" value="<?php if (isset($_GET['checkout'])) {
                                                echo $_GET['checkout'];
                                            } ?>"/>
                                            <label for="checkout">Çıxış Tarixi</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select class="form-select" name="adult" id="select1">
                                              <option value="1 Nefer">1 Nefer</option>
                                              <option value="2 Nefer">2 Nefer</option>
                                              <option value="3 Nefer">3 Nefer</option>
                                              <option value="4 Nefer">4 Nefer</option>
                                              <option value="5 Nefer">5 Nefer</option>
                                            </select>
                                            <label for="select1">Qonaq sayı</label>
                                          </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select class="form-select" name="child" id="select2">
                                              <option value="Yoxdur">Yoxdur</option>
                                              <option value="1 Uşaq">1 Uşaq</option>
                                              <option value="2 Uşaq">2 Uşaq</option>
                                              <option value="3 Uşaq">3 Uşaq</option>
                                              <option value="4 Uşaq">4 Uşaq</option>
                                              <option value="5 Uşaq">5 Uşaq</option>
                                            </select>
                                            <label for="select2">Uşaq Sayı (varsa)</label>
                                          </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                        <select class="form-select" name="room" id="select3">
                                           <?php if (isset($_GET['checkin'])): ?>
                                            <option value="<?php echo $_GET['room']; ?>">
                                                <?php if (isset($_GET['room'])) {
                                                  echo $_GET['room'];
                                                };?></option>
                                            <?php else: ?>
                                                    <?php while ($type = mysqli_fetch_array($query)): ?>
                                                        <option value="<?php echo htmlspecialchars($type['id']); ?>"
                                                            <?php if ($type['id'] == $id): ?>
                                                                    selected
                                                            <?php endif; ?>>
                                                            <?php echo htmlspecialchars($type['type']); ?>
                                                   
                                                        </option>
                                                    <?php endwhile; ?>
                                            <?php endif; ?>

                                        </select>

                                            <label for="select3">Otaq Seçimi</label>
                                          </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Special Request" name="message" id="message" style="height: 100px"></textarea>
                                            <label for="message">Özəl istək</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100 py-3" name="bookBtn" type="submit">İndi rezerv edin</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Booking End -->

        <?php include ("partials/_newsletter.php"); ?>
        <?php include ("partials/_footer.php"); ?>
