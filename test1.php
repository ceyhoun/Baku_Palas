<?php

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

$conn = mysqli_connect("localhost", "root", "", "shushaOtel");

if (isset($_POST['checkBtn'])) {
                    $checkin = mysqli_real_escape_string($conn, htmlspecialchars($_POST['checkin']));
                    $checkout = mysqli_real_escape_string($conn, htmlspecialchars($_POST['checkout']));
                    $room = mysqli_real_escape_string($conn, htmlspecialchars($_POST['roomcontrol']));

                    //$query = mysqli_query($conn, 'SELECT * FROM booking WHERE checkin = "' . $checkin . '" AND checkout = "' . $checkout . '" AND room ="'.$room.'"');

                    $query = mysqli_query(
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

                    $row = mysqli_num_rows($query);

                    if (isset($row) && $row > 0) {
                                        echo 'Qeyd mövcutdur';
                    } else {
                                        header('location: booking.php');
                    }
}


?>

<form method="post">
                    <input type="date" name="checkin">
                    <input type="date" name="checkout">
                    <select name="roomcontrol">
                            <?php
                            $query_room = mysqli_query($conn, 'SELECT * FROM `roomType`');

                            // Tüm oda tiplerini döngü ile seçenekler olarak oluştur
                            while ($room = mysqli_fetch_array($query_room)) {
                                                echo '<option value="' . htmlspecialchars($room['type']) . '">' . htmlspecialchars($room['type']) . '</option>';
                            }
                            ?>
                        </select>
                    <button type="submit" name="checkBtn">Gönder</button>
</form>