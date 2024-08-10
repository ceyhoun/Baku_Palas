<?php
session_start();
ob_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include ("../admin/section/top.php");

// Veritabanı bağlantısı
$conn = mysqli_connect("localhost", "root", "", "shushaOtel");

// Bağlantı hatasını kontrol et
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// id parametresini al ve integer'a çevir
$id = intval($_GET['id']);

// SQL sorgusu
$sql = mysqli_query($conn, 'SELECT 
    room.id AS romID,
    room.file AS roomimg,
    room.price AS roomprice,
    room.bed AS bedCount,
    room.bath AS bathCount,
    room.wifi AS iswifi, 
    roomType.type AS roomtype 
FROM room 
JOIN roomType ON room.typeID = roomType.id 
WHERE room.id=' . $id);

$room = mysqli_fetch_array($sql);
$success = $errors = "";
if (isset($_POST['updateBtn'])) {


if ($success) {
                $_SESSION['success']=$success;
}

if ($errors) {
                    $_SESSION['errors']=$errors;

}

    // string ve int data
    $data1 = mysqli_real_escape_string($conn, htmlspecialchars($_POST['roomtype']));
    $data2 = mysqli_real_escape_string($conn, $_POST['roomprice']);
    $data3 = mysqli_real_escape_string($conn, $_POST['bedCount']);
    $data4 = mysqli_real_escape_string($conn, $_POST['bathCount']);
    $data5 = mysqli_real_escape_string($conn, $_POST['iswifi']);

    // Fayl data
    if ($_FILES['roomimg']['error'] == UPLOAD_ERR_OK) {
        $file_type = mime_content_type($_FILES['roomimg']['tmp_name']);
        $allowed_types = ["image/jpg", "image/png", "image/jpeg"];
        if (in_array($file_type, $allowed_types)) {
            $random = rand(99999, 999999999999);
            $image = "../uploads/" . $random . "_" . basename($_FILES['roomimg']['name']);
            if (move_uploaded_file($_FILES['roomimg']['tmp_name'], $image)) {
                $data6 = $image;
            } else {
                    $errors .= "Fayl yüklenebilmedi! ";
                }
            } else {
                $errors .= "İcazesiz fayl növü! ";
            }
    } else {
        $data6 = $room['roomimg']; // Dosya seçilmezse önceki dosya kalır
    }

    // Güncelleme sorgusu
    if (empty($errors)) {
                    $update_query = "UPDATE room 
        INNER JOIN roomType ON room.typeID = roomType.id
        SET 
            roomType.type = '$data1',
            room.price = '$data2',
            room.bed = '$data3',
            room.bath = '$data4',
            room.wifi = '$data5',
            room.file = '$data6'
        WHERE room.id = '$id'";

    if (mysqli_query($conn, $update_query)) {
        $success= 'Melumat Yenilendi.';
        header('Location: rooms.php');
        exit();
    } else {
          echo "Xeta!.. Melumat Yenilenmedi";
    }
    }
    
}
?>

<div class="container">
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <select name="roomtype">
                <option value="<?php echo $room['roomtype']; ?>" selected><?php echo $room['roomtype']; ?></option>
                <?php
                $sql1 = mysqli_query($conn, 'SELECT * FROM roomType');
                while ($roomtype = mysqli_fetch_array($sql1)) {
                    $sel =($room['roomtype'] == $roomtype['type'] ? 'selected' :'');

                    if ($sel) {
                            continue;        
                    }
                        
                    echo '<option value="' . $roomtype['type'] . '" '.$sel.'>' . $roomtype['type'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <input type="text" name="roomprice" value="<?php echo $room['roomprice']; ?>" required>
        </div>
        <div class="mb-3">
            <input type="text" name="bedCount" value="<?php echo $room['bedCount']; ?>" required>
        </div>
        <div class="mb-3">
            <input type="text" name="bathCount" value="<?php echo $room['bathCount']; ?>" required>
        </div>
        <div class="mb-3">
            <select name="iswifi">
                <option value="Var" <?php if ($room['iswifi'] == 'Var') echo 'selected'; ?>>Var</option>
                <option value="Yox" <?php if ($room['iswifi'] == 'Yox') echo 'selected'; ?>>Yox</option>
            </select>
        </div>
        <div class="mb-3" style="display: inline-block; position: relative;">
        <input type="file" name="roomimg" >
            <img width="100" src="<?php echo $room['roomimg']; ?>">
        </div>
        <div class="mb-3">
            <button type="submit" name="updateBtn" class="btn btn-warning">Yenile</button>
        </div>
    </form>
    <?php
    if ($success) {
        echo "<p style='color: green;'>$success</p>";
    }
    if ($errors) {
        echo "<p style='color: red;'>$errors</p>";
    }
    ?>
</div>

<?php
include ("../admin/section/bottom.php");
mysqli_close($conn);
ob_end_flush();
?>
