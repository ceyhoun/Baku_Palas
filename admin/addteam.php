<?php
ob_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
$conn = mysqli_connect("localhost", "root", "", "shushaOtel");

$name_err = $surname_err = $task_err = $success = $danger = "";
if (isset($_POST['teamBtn'])) {
    //name
    if (empty($_POST['name'])) {
        $name_err = "Ad Boş Ola Bilmez";
    } else {
        $name = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['name'], ENT_QUOTES)));

    }

    //surname
    if (empty($_POST['surname'])) {
        $surname_err = "Soyad Boş Ola Bilmez";
    } else {
        $surname = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['surname'], ENT_QUOTES)));

    }
    //task
    if (empty($_POST['task'])) {
        $task_err = "Vezife Boş Ola Bilmez";

    } else {
        $task = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['task'], ENT_QUOTES)));

    }

    $allowed_types = ["image/jpeg", "image/png", "image/jpg"];
    if (!in_array($_FILES['teamfile']['type'], $allowed_types)) {
        $errors['teamfile'] = "Geçersiz dosya türü. Sadece jpeg, png ve jpg dosyaları yüklenebilir.";
    } else {
        $random_number = rand(9999999, 9999999999999999);
        $image = "../team_upload/" . $random_number . "_" . basename($_FILES['teamfile']['name']);
        
        if (!move_uploaded_file($_FILES['teamfile']['tmp_name'], $image)) {
            $errors['teamfile'] = "Dosya yüklenirken bir hata oluştu.";
        }
    }
    
    $fb = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['fb'], ENT_QUOTES)));
    $x = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['x'], ENT_QUOTES)));
    $insta = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['insta'], ENT_QUOTES)));

    if (isset($name) && isset($surname) && isset($task) && isset($image)) {
        $team_query = mysqli_query($conn, 'INSERT INTO `team`(`name`, `surname`, `task`, `image`,`facebook`, `twitter`, `instagram`) VALUES  ("' . $name . '","' . $surname . '","' . $task . '","' . $image . '","' . $fb . '","' . $x . '","' . $insta . '")');
        if ($team_query) {
            header("location: ourteam.php");
        }
    }


}
?>
<?php include ("../admin/section/top.php"); ?>
<div class="container">
          <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                              <input type="text" class="form-control is-invalid" name="name" placeholder="işçi Adı">
                              <small class="invalid-feedback"><?php echo $name_err; ?></small>
                    </div>
                    <div class="mb-3">
                              <input type="text" class="form-control is-invalid" name="surname" placeholder="İşçi Soyadı">
                              <small class="invalid-feedback"><?php echo $surname_err; ?></small>
                    </div>
                    <div class="mb-3">
                              <input type="text" class="form-control is-invalid" name="task" placeholder="İşçi Vezifesi">
                              <small class="invalid-feedback"><?php echo $task_err; ?></small>
                    </div>
                    <div class="mb-3">
                              <input type="url" class="form-control" name="fb" placeholder="Facebook link">
                    </div>
                    <div class="mb-3">
                              <input type="url" class="form-control" name="insta" placeholder="İnstagram linki">
                    </div>
                    <div class="mb-3">
                              <input type="url" class="form-control" name="x" placeholder="X linki">
                    </div>
                    <div class="mb-3">
                              <input type="file" class="form-control is-invalid" name="teamfile">
                              <small class="invalid-feedback"><?php echo $danger; ?></small>

                    </div>
                    <div class="btn">
                              <button type="submit" name="teamBtn" class="form-control btn btn-info w-50">Elave Et</button>
                              <a class="text-white text-decoration-none btn btn-info w-50" href="../admin/ourteam.php">Geri Dön</a>
                              
                    </div>
          </form>
</div>
<?php include ("../admin/section/bottom.php"); ?>
