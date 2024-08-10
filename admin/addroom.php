<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

$conn = mysqli_connect("localhost", "root", "", "shushaOtel");


$errors = []; // Hataları saklamak için dizi

// Form gönderildiyse
if (isset($_POST['roomBtn'])) {
    // roomType doğrulama
    if (empty($_POST['roomType'])) {
        $errors['roomType'] = "Otaq seçimi boş olamaz.";
    } else {
        $roomType = mysqli_real_escape_string($conn, $_POST['roomType']);
    }

    // roomFile doğrulama
    $allowed_types = ["image/jpeg", "image/png", "image/jpg"];
    if (!in_array($_FILES['roomFile']['type'], $allowed_types)) {
        $errors['roomFile'] = "Geçersiz dosya türü. Sadece jpeg, png ve jpg dosyaları yüklenebilir.";
    } else {
        $random_number = rand(9999999, 9999999999999999);
        $roomFile = "../uploads/" . $random_number . "_" . basename($_FILES['roomFile']['name']);
        
        if (!move_uploaded_file($_FILES['roomFile']['tmp_name'], $roomFile)) {
            $errors['roomFile'] = "Dosya yüklenirken bir hata oluştu.";
        }
    }

    // roomPrice doğrulama
    if (empty($_POST['roomPrice'])) {
        $errors['roomPrice'] = "Otaq fiyatı boş olamaz.";
    } elseif (!is_numeric($_POST['roomPrice']) || $_POST['roomPrice'] <= 0) {
        $errors['roomPrice'] = "Geçersiz fiyat. Lütfen pozitif bir sayı girin.";
    } else {
        $roomPrice = mysqli_real_escape_string($conn, $_POST['roomPrice']);
    }

    // roomBed doğrulama
    if (empty($_POST['roomBed'])) {
        $errors['roomBed'] = "Yataq sayısı boş olamaz.";
    } elseif (!is_numeric($_POST['roomBed']) || $_POST['roomBed'] <= 0) {
        $errors['roomBed'] = "Geçersiz yatak sayısı. Lütfen pozitif bir sayı girin.";
    } else {
        $roomBed = mysqli_real_escape_string($conn, $_POST['roomBed']);
    }

    // roomBath doğrulama
    if (empty($_POST['roomBath'])) {
        $errors['roomBath'] = "Hamam sayısı boş olamaz.";
    } elseif (!is_numeric($_POST['roomBath']) || $_POST['roomBath'] <= 0) {
        $errors['roomBath'] = "Geçersiz hamam sayısı. Lütfen pozitif bir sayı girin.";
    } else {
        $roomBath = mysqli_real_escape_string($conn, $_POST['roomBath']);
    }

    // roomWifi doğrulama
    if (empty($_POST['roomWifi'])) {
        $errors['roomWifi'] = "WiFi seçimi boş olamaz.";
    } else {
        $roomWifi = mysqli_real_escape_string($conn, $_POST['roomWifi']);
    }

    // Eğer hatalar yoksa işlemleri yapabilirsiniz
    if (empty($errors)) {
      $room_id_query = mysqli_query($conn, "SELECT id FROM roomType WHERE type = '$roomType'");
      $row = mysqli_fetch_assoc($room_id_query);
      $room_id = $row['id'];
        $query = mysqli_query($conn, 'INSERT INTO `room`(`typeID`, `file`, `price`, `bed`, `bath`, `wifi`) VALUES( "' . $room_id . '", "' . $roomFile . '", "' . $roomPrice . '","' . $roomBed . '","' . $roomBath . '","' . $roomWifi . '")');
        if ($query) {
            echo "Otaq Elave Olundu!";
            header('Location: ../admin/index.php');
            exit;
        } else {
            echo "Xəta: " . mysqli_error($conn);
        }
    }
}

?>

<?php include ("../admin/section/top.php") ?>

<div class="form-room d-flex justify-content-center">
    <form method="post" enctype="multipart/form-data">
        <!-- roomType seçimi -->
        <div class="mb-3">
    <select class="form-control <?php echo isset($errors['roomType']) ? 'is-invalid' : ''; ?>" name="roomType">
        <option value="" <?php echo !isset($_POST['roomType']) ? 'selected' : ''; ?>>Otaq Seçin</option>
        <?php 
        $query = mysqli_query($conn, 'SELECT * FROM roomType');
        while ($read = mysqli_fetch_array($query)): ?>
            <option value="<?php echo $read['type']; ?>" <?php echo isset($_POST['roomType']) && $_POST['roomType'] == $read['type'] ? 'selected' : ''; ?>>
                <?php echo $read['type']; ?>
            </option>
        <?php endwhile; ?>
    </select>
    <small class="invalid-feedback">
        <?php echo $errors['roomType'] ?? ''; ?>
    </small>
</div>


        <!-- roomFile seçimi -->
        <div class="mb-3">
            <input type="file" name="roomFile" class="form-control <?php echo isset($errors['roomFile']) ? 'is-invalid' : ''; ?>">
            <small class="invalid-feedback">
                <?php echo $errors['roomFile'] ?? ''; ?>
            </small>
        </div>

        <!-- roomPrice seçimi -->
        <div class="mb-3">
            <input type="number" name="roomPrice" id="price" class="form-control <?php echo isset($errors['roomPrice']) ? 'is-invalid' : ''; ?>" placeholder="Otaq Qiymeti">
            <small class="invalid-feedback">
                <?php echo $errors['roomPrice'] ?? ''; ?>
            </small>
        </div>

        <!-- roomBed seçimi -->
        <div class="mb-3">
            <input type="number" name="roomBed" class="form-control <?php echo isset($errors['roomBed']) ? 'is-invalid' : ''; ?>" placeholder="Yataq Sayı">
            <small class="invalid-feedback">
                <?php echo $errors['roomBed'] ?? ''; ?>
            </small>
        </div>

        <!-- roomBath seçimi -->
        <div class="mb-3">
            <input type="number" name="roomBath" class="form-control <?php echo isset($errors['roomBath']) ? 'is-invalid' : ''; ?>" placeholder="Hamam Sayı">
            <small class="invalid-feedback">
                <?php echo $errors['roomBath'] ?? ''; ?>
            </small>
        </div>

        <!-- roomWifi seçimi -->
        <div class="mb-3">
            <select name="roomWifi" class="form-control <?php echo isset($errors['roomWifi']) ? 'is-invalid' : ''; ?>">
                <option selected>Seçin</option>
                <option value="Var">Var</option>
                <option value="Yox">Yox</option>
            </select>
            <small class="invalid-feedback">
                <?php echo $errors['roomWifi'] ?? ''; ?>
            </small>
        </div>

        <!-- Formu gönderme düğmesi -->
        <div class="mb-3">
            <button type="submit" name="roomBtn" id="roomBtn" class="form-control btn btn-info">Elave Et</button>
        </div>
    </form>
</div>


     <?php include ("../admin/section/bottom.php"); ?>
