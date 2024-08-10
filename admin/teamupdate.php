<?php 
session_start();
ob_start(); 
include ("../admin/section/top.php");
$conn = mysqli_connect("localhost", "root", "", "shushaOtel");
$id = intval($_GET['id']);
$sql = 'SELECT * FROM team WHERE id="' . $id . '"';
$query = mysqli_query($conn, $sql);
$team = mysqli_fetch_assoc($query);
?>
<div class="container">
                              <form method="post" enctype="multipart/form-data">
                              <div class="mb-3">
                              <img style="border-radius: 50%;" width="100" src="<?php echo $team['image']; ?>" alt="<?php echo $team['name']; ?>">
                              </div>
                                        <div class="mb-3 w-50">
                                                            <input type="text" name="upname" class="form-control" value="<?php echo $team['name']; ?>">
                                        </div>
                                        <div class="mb-3 w-50">
                                                            <input type="text" name="upsurname" class="form-control" value="<?php echo $team['surname']; ?>">
                                        </div>
                                        <div class="mb-3 w-50">
                                                            <input type="text" name="uptask" class="form-control" value="<?php echo $team['task']; ?>">
                                        </div>
                                        <div class="mb-3">
                                                        <input type="file" name="upfile">   
                                        </div>
                                        <div class="mb-3 w-50">
                                                            <input type="url" name="upfb" class="form-control" value="<?php echo $team['facebook']; ?>">	
                                        </div>
                                        <div class="mb-3 w-50">
                                                            <input type="url" name="upx" class="form-control" value="<?php echo $team['twitter']; ?>">
                                        </div>
                                        <div class="mb-3 w-50">
                                                            <input type="url" name="upinsta" class="form-control" value="<?php echo $team['instagram']; ?>">
                                        </div>
                                        <div class="mb-3">
                                                            <button type="submit" class="btn btn-outline-success" name="upteamBtn">Yenile</button>
                                        </div>
                              </form>
                   
</div>
<?php
if (isset($_POST['upteamBtn'])) {
                    $id = intval($_GET['id']);
                    $upname = mysqli_real_escape_string($conn, htmlspecialchars($_POST['upname'], ENT_QUOTES));
                    $upsurname = mysqli_real_escape_string($conn, htmlspecialchars($_POST['upsurname'], ENT_QUOTES));
                    $uptask = mysqli_real_escape_string($conn, htmlspecialchars($_POST['uptask'], ENT_QUOTES));

                    // Dosya yükleme
                    $allowed_types = ["image/jpeg", "image/png", "image/jpg"];
                    if ($_FILES['upfile']['error'] == UPLOAD_ERR_OK) {
                                        $file_type = mime_content_type($_FILES['upfile']['tmp_name']);
                                        if (in_array($file_type, $allowed_types)) {
                                                            $random_number = rand(9999999, 9999999999999999);
                                                            $image = "../upteam_upload/" . $random_number . "_" . basename($_FILES['upfile']['name']);

                                                            if (move_uploaded_file($_FILES['upfile']['tmp_name'], $image)) {
                                                                                // Dosya başarıyla yüklendi
                                                                                $upfile = $image;
                                                            } else {
                                                                                $errors['upfile'] = "Fayl Yüklemesinde xəta baş verdi:.";
                                                            }
                                        } else {
                                                            $errors['upfile'] = "Yanlış fayl növü. Sadece jpeg, png ve jpg faylları yüklenebiler.";
                                        }
                    } elseif ($_FILES['upfile']['error'] != UPLOAD_ERR_NO_FILE) {
                                        $errors['upfile'] = "Fayl Yüklemesinde xəta baş verdi:.";
                    }

                    $upfb = mysqli_real_escape_string($conn, htmlspecialchars($_POST['upfb'], ENT_QUOTES));
                    $upx = mysqli_real_escape_string($conn, htmlspecialchars($_POST['upx'], ENT_QUOTES));
                    $upinsta = mysqli_real_escape_string($conn, htmlspecialchars($_POST['upinsta'], ENT_QUOTES));

                    //update
                    $sql =
                                        "UPDATE team SET 
                    `name`='$upname',
                    `surname`='$upsurname',
                    `task`='$uptask'";

                    if (isset($upfile)) {
                                        $sql .= ", image='$upfile'";
                    }

                    $sql .= "WHERE id='$id'";

                    if (mysqli_query($conn, $sql)) {
                                        $_SESSION['info'] = "Uğurla Yenilendi";
                                        header("Location: ourteam.php");
                    }


}
include ("../admin/section/bottom.php"); ?>
