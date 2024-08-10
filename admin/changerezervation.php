<?php
ob_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
$conn = mysqli_connect("localhost", "root", "", "shushaOtel");
$id = intval($_GET['id']);
$get_query = mysqli_query($conn, 'SELECT 
roomType.type AS roomtype,
booking.id AS bookid,
booking.name AS bookname,
booking.surname AS booksurname,
booking.country AS bookcountry,
booking.passport AS bookingpassport,
booking.email AS bookingemail,
booking.adult AS bookingadult,
booking.child AS bookingchild,
booking.checkin AS bookingcheckin,
booking.checkout AS bookingcheckout,
booking.message AS bookingmessage
FROM `roomType`,`booking` WHERE roomType.id=booking.room  AND booking.id ="' . $id . '"');


?>
<?php include ("../admin/section/top.php") ?>

<div class="container">
<h3 class="text-center mt-3">Rezervasiya Deyişme</h3>
<form method="post">
                                <div class="row g-3">
                                        <?php while ($change = mysqli_fetch_array($get_query)): ?>
                                                            <div class="col-md-6">
                                                                <div class="form-floating">
                                                                          <label for="n">Adınız</label>
                                                                    <input type="text" class="form-control" value="<?php echo $change['bookname']; ?>" name="uptname" id="n" placeholder="Adınız">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-floating">
                                                                          <label for="surname">Soyadınız</label>booksurname
                                                                    <input type="text" class="form-control" value="<?php echo $change['booksurname']; ?>" name="uptsurname" id="surname" placeholder="Soyadınız">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-floating">
                                                                          <label for="country">Ölkeniz</label>
                                                                    <select class="form-select form-control" name="uptcountry" id="country">
                                                                          <option value="<?php echo $change['bookcountry']; ?>" selected> <?php echo $change['bookcountry']; ?></option>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-floating">
                                                                          <label for="passport">Pasport Nömresi</label>
                                                                    <input class="form-control" value="<?php echo $change['bookingpassport']; ?>" name="uptpassport" id="passport" placeholder="Pasport Nömresi">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-floating">
                                                                          <label for="email">E-poçtunuz</label>
                                                                    <input type="email" class="form-control" value="<?php echo $change['bookingemail']; ?>" name="uptemail" id="in" placeholder="Giriş Tarixi" data-target="#date3" data-toggle="datetimepicker" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-floating">
                                                                <label for="select1">Qonaq sayı</label>
                                                                    <select class="form-select form-control"  name="uptadult" id="select1">
                                                                    <option value="<?php echo $change['bookingadult']; ?>" selected><?php echo $change['bookingadult']; ?></option>
                                                                    <?php
                                                                    $adult_arr = ["Yoxdur", "1 Nefer", "2 Nefer", "3 Nefer", "4 Nefer", "5 Nefer"];

                                                                    foreach ($adult_arr as $adult) {
                                                                        if ($change['bookingadult'] != $adult) {
                                                                            echo "<option value='$adult'>$adult</option>";
                                                                        }
                                                                    }
                                                                    ?>
                                                                                                    
                                                                          </select>
                                                                  </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-floating">
                                                                <label for="select2">Uşaq Sayı (varsa)</label>
                                                                <select class="form-select form-control" name="uptchild" id="select2">
                                                                          <option value="<?php echo $change['bookingchild']; ?>"><?php echo $change['bookingchild']; ?></option>
                                                                                    <?php
                                                                                    $child_arr = ["Yoxdur", "1 Uşaq", "2 Uşaq", "3 Uşaq", "4 Uşaq", "5 Uşaq"];
                                                                                    foreach ($child_arr as $child) {
                                                                                        if ($change['bookingchild'] != $child) {
                                                                                            echo "<option value='$child'>$child</option>";
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                </select>
                                                                </div>
                                                                </div>

                                                                <div class="col-md-6">
        <div class="form-floating">
            <label for="select3">Otaq Seçimi</label>
            <select class="form-select form-control" name="uptroom" id="select3">
                <option value="<?php echo $change['roomtype'] ?>" selected><?php echo $change['roomtype'] ?></option>
                <?php
                $room_query = mysqli_query($conn, 'SELECT * FROM roomType');
                while ($room = mysqli_fetch_assoc($room_query)) {
                    if ($room['type'] !== $change['roomtype']) {
                        echo '<option value="' . $room['type'] . '">' . $room['type'] . '</option>';
                    }
                }
                ?>
            </select>
        </div>
    </div>


                                                            <div class="col-md-6">
                                                                <div class="form-floating date" id="date4" data-target-input="nearest">
                                                                          <label for="in">Giriş Tarixi</label>
                                                                    <input type="date" class="form-control datetimepicker-input" value="<?php echo $change['bookingcheckin']; ?>" name="uptcheckin" id="in" placeholder="Çıxış Tarixi" data-target="#date4" data-toggle="datetimepicker" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-floating date" id="date4" data-target-input="nearest">
                                                                          <label for="out">Çıxış Tarixi</label>
                                                                    <input type="date" class="form-control datetimepicker-input" value="<?php echo $change['bookingcheckout']; ?>" name="uptcheckout" id="out" placeholder="Çıxış Tarixi" data-target="#date4" data-toggle="datetimepicker" />
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-floating">
                                                                    <textarea class="form-control" placeholder="Özel İstek" name="uptmessage" id="message" style="height: 100px"><?php echo $change['bookingmessage']; ?></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <button class="btn btn-primary w-100 py-3" name="bookingBtn" id="bookingBtn" type="submit">Rezervasiyanı Deyişdirin</button>
                                                            </div>
                                    <?php endwhile; ?>

                                </div>
                            </form>    
</div>

<?php
if (isset($_POST['bookingBtn'])) {
    // Kullanıcının form verilerini alıyoruz ve güvenli bir şekilde kaçırıyoruz
    $uptname = mysqli_real_escape_string($conn, $_POST['uptname']);
    $uptsurname = mysqli_real_escape_string($conn, $_POST['uptsurname']);
    $uptcountry = mysqli_real_escape_string($conn, $_POST['uptcountry']);
    $uptpassport = mysqli_real_escape_string($conn, $_POST['uptpassport']);
    $uptemail = mysqli_real_escape_string($conn, $_POST['uptemail']);
    $uptadult = mysqli_real_escape_string($conn, $_POST['uptadult']);
    $uptchild = mysqli_real_escape_string($conn, $_POST['uptchild']);
    $uptroom = mysqli_real_escape_string($conn, $_POST['uptroom']);
    $uptcheckin = mysqli_real_escape_string($conn, $_POST['uptcheckin']);
    $uptcheckout = mysqli_real_escape_string($conn, $_POST['uptcheckout']);
    $uptmessage = mysqli_real_escape_string($conn, $_POST['uptmessage']);

    $room_id_query = mysqli_query($conn, "SELECT id FROM roomType WHERE type = '$uptroom'");
    $row = mysqli_fetch_assoc($room_id_query);
    $room_id = $row['id'];

    // Booking tablosunu güncellemek için sorgu
    $booking_update_query = "UPDATE booking SET 
        name = '$uptname', 
        surname = '$uptsurname', 
        country = '$uptcountry', 
        passport = '$uptpassport', 
        email = '$uptemail', 
        adult = '$uptadult', 
        child = '$uptchild', 
        room = '$room_id', 
        checkin = '$uptcheckin', 
        checkout = '$uptcheckout', 
        message = '$uptmessage'
        WHERE id = '$id'";

$booking_update_result = mysqli_query($conn, $booking_update_query);

if ($booking_update_result) {
    header('Location: ../admin/showreservation.php');
    exit;
} else {
    echo "Booking tablosunu güncellerken bir hata meydana geldi: " . mysqli_error($conn);
}
}

?>


<?php include ("../admin/section/bottom.php"); ?>