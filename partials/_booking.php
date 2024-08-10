<?php
ob_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

$conn = mysqli_connect("localhost", "root", "", "shushaOtel");

$checkin_err = $checkout_err = $room_err = "";
if (isset($_POST['checkBtn'])) {

    $date = date('Y-m-d');
    if (empty($_POST['checkin'])) {
        $checkin_err = "Zeruridir";
    }elseif ($_POST['checkin'] < $date) {
        $checkin_err = "Çekmiş Tarix Seçile Bilmez";
    } else {
        $checkin = mysqli_real_escape_string($conn, htmlspecialchars($_POST['checkin']));
    }

    if (empty($_POST['checkout'])) {
        $checkout_err = "Zeruridir";
    }elseif ($_POST['checkout'] < $date) {
        $checkout_err = "Çekmiş Tarix Seçile Bilmez";
    } else {
        $checkout = mysqli_real_escape_string($conn, htmlspecialchars($_POST['checkout']));
    }

    if (empty($_POST['roomcontrol'])) {
        $room_err = "Zeruridir";
    } else {
        $room = mysqli_real_escape_string($conn, htmlspecialchars($_POST['roomcontrol']));
    }


    if (isset($checkin) && isset($checkout) && isset($room)) {
        $query_control = mysqli_query(
            $conn,
            'SELECT 
                roomType.type AS tip,
                booking.checkin AS bookcheckin, 
                booking.checkout AS bookcheckout
                FROM booking
                INNER JOIN 
                roomType ON booking.room = roomType.id
                WHERE
                booking.checkin = "' . $checkin . '"
                AND 
                booking.checkout = "' . $checkout . '"
                AND
                roomType.type = "' . $room . '"'
        );

        if ($query_control) {
            $row = mysqli_num_rows($query_control);
            if ($row == 0) {
                header('location:booking.php?checkin='.htmlspecialchars($_POST['checkin']).'&checkout='.htmlspecialchars($_POST['checkout']).'&room='.htmlspecialchars(trim($_POST['roomcontrol'])));
            }else{
                echo 'tapılmadı';
            }
        } 
    }

}

?>
<!-- Booking Start -->

<div class="container-fluid booking pb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <div class="bg-white shadow" style="padding: 35px;">
        <?php if (isset($row) && $row > 0): ?>
                <p class="text-center" style="color:orange;">İstediyiniz Otaq Seçtiyiniz Tarixde Booking Olunub, Zehmet Olmazsa Başqa Bir Tarix Seçin</p>  
        <?php endif; ?>
            <form method="post">
                <div class="row g-2">
                    <div class="col-md-10">
                        <div class="row g-2">
                            <div class="col-md-4">
                                <div class="date" id="date1" >
                                    <input type="date" name="checkin" class="form-control datetimepicker-input is-invalid"
                                        placeholder="Giriş" data-target="#date1" data-toggle="datetimepicker" />
                                        <div class="invalid-feedback"><?php echo $checkin_err; ?></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="date" id="date2" >
                                    <input type="date" name="checkout" class="form-control datetimepicker-input is-invalid"
                                        placeholder="Çıxış" data-target="#date2" data-toggle="datetimepicker"/>
                                        <div class="invalid-feedback"><?php echo $checkout_err; ?></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                            <select class="form-select is-invalid" name="roomcontrol">
                            <?php
                            $query_room = mysqli_query($conn, 'SELECT roomType.type AS tip FROM `roomType`, `room` WHERE roomType.id = room.typeID');
                            while ($room = mysqli_fetch_array($query_room)) {
                                echo '<option value="' . htmlspecialchars($room['tip']) . '">' . htmlspecialchars($room['tip']) . '</option>';
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback"><?php echo $room_err; ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" name="checkBtn" class="btn btn-primary w-100">Bron Et</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
<!-- Booking End -->
