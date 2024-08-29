<?php
ob_start();
include("partials/_header.php");

// Veritabanı bağlantısını başlat
$conn = mysqli_connect("localhost", "root", "", "shushaOtel");

$id = isset($_GET['id']) ? intval($_GET['id']) : null;


$query = mysqli_query($conn, 'SELECT 
room.id as id,
roomType.type as name,
room.file as photo,
room.price as price,
room.bed as bed,
room.bath as bath,
room.wifi as wifi
FROM room,roomType WHERE room.typeID=roomType.id AND room.id="' . $id . '"');


$room = mysqli_fetch_assoc($query);

//comment Form
$customer_err = $subject_err = $message_err = "";
if (isset($_POST['commentBtn'])) {
    //customer name
    if (empty($_POST['customer'])) {
        $customer_err = "Adınızı Yazmadınız";
    } else {
        $customer = mysqli_real_escape_string($conn, htmlspecialchars($_POST['customer'], ENT_QUOTES));

    }

    //subject
    if (empty($_POST['subject'])) {
        $subject_err = "Mövzu Yazmadınız";

    } else {
        $subject = mysqli_real_escape_string($conn, htmlspecialchars($_POST['subject'], ENT_QUOTES));
        echo $subject;
    }
    //message
    if (empty($_POST['message'])) {
        $message_err = "Mövzu Yazmadınız";

    } else {
        $message = mysqli_real_escape_string($conn, htmlspecialchars($_POST['message'], ENT_QUOTES));
        echo $message;
    }


    //insert
    if (isset($customer) && isset($subject) && isset($message)) {
        $sql = "INSERT INTO comments(`customer`,`subject`,`message`,`status`) VALUES('$customer','$subject','$message','0')";

        if ($query = mysqli_query($conn, $sql)) {
            echo '<div class="alert alert-success text-center">Şerhiniz Uğurla Elave Olundu</div>';
        } else {
            echo '<div class="alert alert-danger">Xeta!...</div>';
        }
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-6 mt-5">
            <img style="width: 100%;" src="upload/<?php echo htmlspecialchars($room['photo']); ?>" alt="">
        </div>
        <div class="col-6 mt-md-5">
           <p><strong>Otağın Növü: </strong><?php echo htmlspecialchars($room['name']); ?></p>
            <p><strong>Otağın Qiymeti: </strong><?php echo htmlspecialchars($room['price']); ?> AZN</p>
            <p><strong>Otaqdakı Yataq Sayı: </strong><?php echo htmlspecialchars($room['bed']); ?> Ədəd</p>
            <p><strong>Otaqdakı duş Sayı: </strong><?php echo htmlspecialchars($room['bath']); ?> Ədəd</p>
            <p><strong>İnternet Xidmet: </strong><?php echo htmlspecialchars($room['wifi']); ?></p>
            <a href="booking.php?id=<?php echo $room['id']; ?>"><button class="btn btn-outline-secondary">Rezerv Et/Booking Now</button></a>
            <a href="index.php"><button class="btn btn-outline-primary">Geri Dön/ Back Now</button></a>
            <form method="post" class="mt-3">
                    <div class="mb-3">
                                        <input type="text" class="form-control is-invalid" name="customer" placeholder="Adınız">
                                        <small class="invalid-feedback"><?php echo $customer_err; ?></small>
                    </div>
                    <div class="mb-3">
                                        <select name="subject" class="form-control">
                                            <option value="sikayet">Şikayet</option>
                                            <option value="rica">Rica</option>
                                        </select>
                    </div>
                    <div class="mb-3">
                                        <textarea name="message" class="form-control is-invalid" cols="30" rows="10" placeholder="Mesajınız"><?php echo $message_err; ?></textarea>
                    </div>
                    <div class="mb-3">
                                        <button type="submit" name="commentBtn" class="btn btn-outline-success">Şərh Elave Et</button>
                    </div>
        </form>
        </div>

    </div>
            <!-- Testimonial Start -->
<?php include("partials/_testimonial.php"); ?>
        <!-- Testimonial End -->
</div>

<?php

include("partials/_newsletter.php");
include("partials/_footer.php");
mysqli_close($conn); // Veritabanı bağlantısını kapat
?>
