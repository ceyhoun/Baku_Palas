<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
$conn = mysqli_connect("localhost", "root", "", "shushaOtel");

$room_query=mysqli_query($conn,'SELECT * FROM `roomType`');


$name_err = $surname_err = $country_err = $passport_err = $email_err = $adult_err = $child_err = $room_err = $checkin_err = $checkout_err = "";
if (isset($_POST['bookingBtn'])) {


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
          }elseif ($_POST['adult'] === 'select') {
                    $adult_err = 'Müşterinin sayı boş ola bilmez';
          } else {
                    $adult = $_POST['adult'];
          }
          //child
          if (empty($_POST['child'])) {
                    $child_err = 'Uşaq sayı seçilmedi';
          }elseif ($_POST['child'] =='select') {
                    $child_err = 'Uşaq sayı seçilmedi';
          } else {
                    $child = $_POST['child'];
          }
          //child
          if (empty($_POST['room'])) {
                    $room_err = 'Otaq növü adresini seçilmedi';
          } elseif ($_POST['room'] =='select') {
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
                

          

          if (!empty($name)  && !empty($surname) && !empty($country) && !empty($passport) && !empty($email) && !empty($adult) && !empty($child) && !empty($room) && !empty($checkin) && !empty($checkout)) {
                    $query = mysqli_query($conn, 'INSERT INTO `booking`(`name`, `surname`, `country`, `passport`, `email`, `adult`, `child`, `room`, `checkin`, `checkout`, `message`) VALUES("' . $name . '","' . $surname . '","' . $country . '","' . $passport . '","' . $email . '","' . (int)$adult . '","' . $child . '","' . $room . '","' . $checkin . '","' . $checkout . '","' . $message . '")');
                    if ($query) {
                              echo '<div class="alert alert-success" role="alert">Rezervasiya elave olundu...</div>';
                    }else{
                              echo '<div class="alert alert-danger" role="alert">Xeta...</div>';

                    }
          }
                
          




}

?>
<?php include ("../admin/section/top.php") ?>

<div class="container">
<p class="text-center mt-3">Rezervation</p>

<form method="post">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                                  <label for="n">Adınız</label>
                                            <input type="text" class="form-control <?php echo empty($name) ? 'is-invalid':'is-valid'?>" name="name" id="n" placeholder="Adınız">
                                            <small class="invalid-feedback"><?php echo $name_err; ?></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                                  <label for="surname">Soyadınız</label>
                                            <input type="text" class="form-control <?php echo empty($surname) ? 'is-invalid':'is-valid'?>" name="surname" id="surname" placeholder="Soyadınız">
                                            <small class="invalid-feedback"><?php echo $surname_err; ?></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                                  <label for="country">Ölkeniz</label>
                                            <select class="form-select form-control <?php echo empty($country) ? 'is-invalid':'is-valid'?>" name="country" id="country">
                                                  <option value="secin" selected>Seçin</option>
                                            </select>
                                            <small class="invalid-feedback"><?php echo $country_err; ?></small>
                                            <small id="small"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                                  <label for="passport">Pasport Nömresi</label>
                                            <input class="form-control <?php echo empty($passport) ? 'is-invalid':'is-valid'?>" name="passport" id="passport" placeholder="Pasport Nömresi">
                                            <small class="invalid-feedback"><?php echo $passport_err; ?></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                                  <label for="email">E-poçtunuz</label>
                                            <input type="email" class="form-control <?php echo empty($email) ? 'is-invalid':'is-valid'?>" name="email" id="email" placeholder="E-poçtunuz">
                                            <small class="invalid-feedback"><?php echo $email_err; ?></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                        <label for="select1">Qonaq sayı</label>
                                            <select class="form-select form-control <?php echo empty($adult) ? 'is-invalid':'is-valid'?>" name="adult" id="select1">
                                            <option value="select" selected>Seçin</option>
                                              <option value="1 Nefer">1 Nefer</option>
                                              <option value="2 Nefer">2 Nefer</option>
                                              <option value="3 Nefer">3 Nefer</option>
                                              <option value="4 Nefer">4 Nefer</option>
                                              <option value="5 Nefer">5 Nefer</option>
                                            </select>
                                            <small class="invalid-feedback"><?php echo $adult_err; ?></small>
                                          </div>
                                    </div> <div class="col-md-6">
                                        <div class="form-floating">
                                        <label for="select2">Uşaq Sayı (varsa)</label>
                                            <select class="form-select form-control  <?php echo empty($child) ? 'is-invalid':'is-valid'?>" name="child" id="select2">
                                              <option value="select" selected>Seçin</option>
                                              <option value="Yoxdur">Yoxdur</option>
                                              <option value="1 Uşaq">1 Uşaq</option>
                                              <option value="2 Uşaq">2 Uşaq</option>
                                              <option value="3 Uşaq">3 Uşaq</option>
                                              <option value="4 Uşaq">4 Uşaq</option>
                                              <option value="5 Uşaq">5 Uşaq</option>
                                            </select>
                                            <small class="invalid-feedback"><?php echo $child_err; ?></small>
                                            
                                          </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                        <label for="select3">Otaq Seçimi</label>
                                            <select class="form-select form-control  <?php echo empty($room) ? 'is-invalid':'is-valid'?>" name="room" id="select3">
                                              <option value="select" selected>Seçin</option>
                                              <?php while($room=mysqli_fetch_array($room_query)):?>
                                                  <option value="<?php echo $room['id']?>" ><?php echo $room['type']?></option>
                                              <?php endwhile;?>
                                            </select>
                                            <small class="invalid-feedback"><?php echo $room_err; ?></small>

                                          </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating date" id="date3" data-target-input="nearest">
                                                  <label for="in">Giriş Tarixi</label>
                                            <input type="date" class="form-control datetimepicker-input <?php echo empty($checkin) ? 'is-invalid':'is-valid'?>" name="checkin" id="in" placeholder="Giriş Tarixi" data-target="#date3" data-toggle="datetimepicker" />
                                            <small class="invalid-feedback"><?php echo $checkin_err; ?></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating date" id="date4" data-target-input="nearest">
                                                  <label for="out">Çıxış Tarixi</label>
                                            <input type="date" class="form-control datetimepicker-input <?php echo empty($checkout) ? 'is-invalid':'is-valid'?>" name="checkout" id="out" placeholder="Çıxış Tarixi" data-target="#date4" data-toggle="datetimepicker" />
                                            <small class="invalid-feedback"><?php echo $checkout_err; ?></small>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Özel İstek" name="message" id="message" style="height: 100px"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100 py-3" name="bookingBtn" id="bookingBtn" type="submit">Rezervasiya elave edin</button>
                                    </div>
                                </div>
                            </form>


<?php 

?>
                    
</div>


<?php include ("../admin/section/bottom.php"); ?>
