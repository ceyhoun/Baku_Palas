<?php
session_start();
ob_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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


//RESERVATİON 

$name_err = $surname_err = $country_err = $passport_err = $email_err = $adult_err = $child_err = $room_err = $checkin_err = $checkout_err = "";
if (isset($_POST['bookBtn'])) {


    // name
    if (empty($_POST['name'])) {
        $name_err = 'Müşteri Adını Girin';
    } else {
        $name = $_POST['name'];
    }

    //surname
    if (empty($_POST['surname'])) {
        $surname_err = 'Müşteri Soyad Girin';
    } else {
        $surname = $_POST['surname'];
    }

    //country
    if (empty($_POST['country'])) {
        $country_err = 'Müşterinin ölkesini seçin';
    } elseif ($_POST['country'] === 'secin') {
        $country_err = 'Ölke boş ola bilmez';
    } else {
        $country = $_POST['country'];
    }
    //pasport

    if (empty($_POST['passport'])) {
        $passport_err = 'Müşterinin Pasport Nömresini seçin';
    } else {
        $passport = $_POST['passport'];
    }

    //email
    if (empty($_POST['email'])) {
        $email_err = 'Müşterinin e-mail adresini seçin';
    } else {
        $email = $_POST['email'];
    }
    //adult
    if (empty($_POST['adult'])) {
        $adult_err = 'Müşterinin sayı seçilmedi';
    } elseif ($_POST['adult'] === 'select') {
        $adult_err = 'Müşterinin sayı boş ola bilmez';
    } else {
        $adult = $_POST['adult'];
    }
    //child
    if (empty($_POST['child'])) {
        $child_err = 'Uşaq sayı seçilmedi';
    } elseif ($_POST['child'] == 'select') {
        $child_err = 'Uşaq sayı seçilmedi';
    } else {
        $child = $_POST['child'];
    }
    //child
    if (empty($_POST['room'])) {
        $room_err = 'Otaq növü adresini seçilmedi';
    } elseif ($_POST['room'] == 'select') {
        $room_err = 'Otaq növü seçilmedi';
    } else {
        $room = $_POST['room'];
    }

    //checkin
    $date = date('Y-m-d');

    if (empty($_POST['checkin'])) {
        $checkin_err = 'Giriş Tarixini qeyd edin';
    } elseif ($_POST['checkin'] < $date) {
        $checkin_err = 'Keçmiş Tarix Seçile bilmez';
    } else {
        $checkin = $_POST['checkin'];
    }



    //checkout
    if (empty($_POST['checkout'])) {
        $checkout_err = 'Çıxış Tarixini qeyd edin';
    } elseif ($_POST['checkout'] < $date) {
        $checkout_err = 'Keçmiş Tarix Seçile bilmez';
    } elseif ($_POST['checkin'] == $_POST['checkout']) {
        $checkout_err = 'Çıxış Tarixi bugün ola bilmez';
    } else {
        $checkout = $_POST['checkout'];
    }

    //message

    if (isset($_POST['message'])) {
        $message = $_POST['message'];
    } else {
        $message = '';
    }




    if (!empty($name) && !empty($surname) && !empty($country) && !empty($passport) && !empty($email) && !empty($adult) && !empty($child) && !empty($room) && !empty($checkin) && !empty($checkout)) {
        $query = mysqli_query($conn, 'INSERT INTO `booking`(`name`, `surname`, `country`, `passport`, `email`, `adult`, `child`, `room`, `checkin`, `checkout`, `message`) VALUES("' . $name . '","' . $surname . '","' . $country . '","' . $passport . '","' . $email . '","' . (int) $adult . '","' . $child . '","' . $room . '","' . $checkin . '","' . $checkout . '","' . $message . '")');
        if ($query) {
            $_SESSION['success_message'] = 'Rezervasiya elave olundu...';
            header('Location: booking.php');
            exit();
        } else {
            $_SESSION['error_message'] = 'Xeta: ' . mysqli_error($conn);
            header('Location: booking.php');
            exit();
        }
    }






}

?>
<?php include("partials/_header.php"); ?>
<?php include("partials/_pageHeader.php"); ?>



        <!-- Booking Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <?php 
                
                if (isset($_SESSION['success_message'])) {
                    echo '<div class="alert alert-success" role="alert">' . $_SESSION['success_message'] . '</div>';
                    unset($_SESSION['success_message']); // Mesajı görüntüledikten sonra temizle
                }
                
                if (isset($_SESSION['error_message'])) {
                    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_message'] . '</div>';
                    unset($_SESSION['error_message']); // Mesajı görüntüledikten sonra temizle
                }
                ?>
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
                            <form method="POST">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control <?php echo empty($name_err) ? 'isvalid' : 'is-invalid'; ?>" name="name" id="name" placeholder="Adınız" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                                            <small class="invalid-feedback"><?php echo $name_err ?></small>
                                            <label for="name">Adınız</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control <?php echo empty($surname_err) ? 'isvalid' : 'is-invalid'; ?>" name="surname" id="surname" placeholder="Soyadınız">
                                            <small class="invalid-feedback"><?php echo $surname_err; ?></small>
                                            <label for="surname">Soyadınız</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            
                                            <select class="form-select <?php echo isset($_POST['country']) && isset($_POST['country']) == 'Seçin' ? 'is-invalid' : ''; ?>" name="country" id="country" value="<?php echo isset($_POST['country']) ? htmlspecialchars($_POST['country']) : 'Seçin'; ?>">
                                            <option value="Seçin" selected>Seçin</option>
                                            </select>
                                            <small class="invalid-feedback"><?php echo $country_err; ?></small>
                                            <label for="country">Ölkeniz</label>
                                          </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input class="form-control <?php echo empty($passport_err) ? 'isvalid' : 'is-invalid'; ?>" name="passport" id="passport" placeholder="Pasport Nömresi">
                                            <small class="invalid-feedback"><?php echo $passport_err; ?></small>
                                            <label for="passport">Pasport Nömresi</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control <?php echo empty($email_err) ? 'isvalid' : 'is-invalid'; ?>" name="email" id="email" placeholder="E-poçtunuz">
                                            <small class="invalid-feedback"><?php echo $email_err; ?></small>
                                            <label for="email">E-poçtunuz</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating date" id="date3" data-target-input="nearest">
                                            
                                            
<input type="date" class="form-control datetimepicker-input <?php echo empty($checkin) ? 'is-invalid' : 'is-valid' ?>" name="checkin" id="in" placeholder="Giriş Tarixi" data-target="#date3" data-toggle="datetimepicker" value="<?php if (isset($_GET['checkin'])) {
                                                echo $_GET['checkin'];
                                            } ?>"/>



                                            <small class="invalid-feedback"><?php echo $checkin_err; ?></small>
                                            <label for="checkin">Giriş Tarixi</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating date" id="date4" data-target-input="nearest">

<input type="date" class="form-control datetimepicker-input <?php echo empty($checkout) ? 'is-invalid' : 'is-valid' ?>" name="checkout" id="out" placeholder="Çıxış Tarixi" data-target="#date4" data-toggle="datetimepicker" value="<?php if (isset($_GET['checkout'])) {
                                                echo $_GET['checkout'];
                                            } ?>"/>

                                            <small class="invalid-feedback"><?php echo $checkout_err; ?></small>
                                            <label for="checkout">Çıxış Tarixi</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select class="form-select is-invalid" name="adult" id="select1">
                                              <option value="seçin" selected>Seçin</option>
                                              <option value="1 Nefer">1 Nefer</option>
                                              <option value="2 Nefer">2 Nefer</option>
                                              <option value="3 Nefer">3 Nefer</option>
                                              <option value="4 Nefer">4 Nefer</option>
                                              <option value="5 Nefer">5 Nefer</option>
                                            </select>
                                        <small class="invalid-feedback"><?php echo $adult_err; ?></small>
                                            
                                            <label for="select1">Qonaq sayı</label>
                                          </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select class="form-select is-invalid" name="child" id="select2">
                                              <option value="seçin" selected>Seçin</option>
                                              <option value="Yoxdur">Yoxdur</option>
                                              <option value="1 Uşaq">1 Uşaq</option>
                                              <option value="2 Uşaq">2 Uşaq</option>
                                              <option value="3 Uşaq">3 Uşaq</option>
                                              <option value="4 Uşaq">4 Uşaq</option>
                                              <option value="5 Uşaq">5 Uşaq</option>
                                            </select>
                                        <small class="invalid-feedback"><?php echo $child_err; ?></small>
                                            
                                            <label for="select2">Uşaq Sayı (varsa)</label>
                                          </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                        <select class="form-select is-invalid" name="room" id="select3">
                                        <option value="seçin" selected>Seçin</option>
                                            
                                           <?php if (isset($_GET['room'])): ?>
                                                                                            <option value="<?php echo $_GET['room']; ?>">
                                                                                                <?php if (isset($_GET['room'])) {
                                                                                                    echo $_GET['room'];
                                                                                                }
                                                                                                ; ?></option>
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
                                        <small class="invalid-feedback"><?php echo $room_err; ?></small>
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

        <?php include("partials/_newsletter.php"); ?>
        <?php include("partials/_footer.php"); ?>
