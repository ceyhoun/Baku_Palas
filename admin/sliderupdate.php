<?php
ob_start(); 
include ("../admin/section/top.php");

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
$connect = new mysqli("localhost", "root", "", "shushaOtel");

$id = intval($_GET['id']);
$sql = mysqli_query($connect, 'SELECT * FROM `slider` WHERE id="' . $id . '"');
$update_sql = mysqli_fetch_assoc($sql);

?>

<div class="container">
<form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                                        <input type="text" name="uptsliname" value="<?php echo $update_sql['slider_name']; ?>">
                    </div>
                    <div class="mb-3">
                                        <input type="text" name="uptslititle" value="<?php echo $update_sql['slider_title1'] ? $update_sql['slider_title1'] : 'Qeyd Olunmayıb'; ?>">
                    </div>
                    <div class="mb-3">
                                        <input type="text" name="uptslititle1" value="<?php echo $update_sql['slider_title2'] ? $update_sql['slider_title2'] : 'Qeyd Olunmayıb'; ?>">
                    </div>
                    <div class="mb-3">
                                        <img style="border-radius: 50%;" width="100" src="<?php echo $update_sql['slider_image']; ?>" alt="">
                    </div>
                    <div class="mb-3">
                                                        <input type="file" name="uptslifile">   
                                        </div>
                    <div class="mb-3">
                                        <button type="submit" name="uptBtnSlider" class="btn btn-outline-info">Deyiş</button>
                    </div>
</form>
</div>
<?php
if (isset($_POST['uptBtnSlider'])) {
                    $id = intval($_GET['id']);
                    $data1 = mysqli_real_escape_string($connect, htmlspecialchars($_POST['uptsliname'], ENT_QUOTES));
                    $data2 = mysqli_real_escape_string($connect, htmlspecialchars($_POST['uptslititle'], ENT_QUOTES));
                    $data3 = mysqli_real_escape_string($connect, htmlspecialchars($_POST['uptslititle1'], ENT_QUOTES));

                    $allowed_types = ["image/jpeg", "image/png", "image/jpg"];
                    if ($_FILES['uptslifile']['error'] == UPLOAD_ERR_OK) {
                                        $file_type = mime_content_type($_FILES['uptslifile']['tmp_name']);
                                        if (in_array($file_type, $allowed_types)) {
                                                            $random_number = rand(9999999, 9999999999999999);
                                                            $image = "../upload_slider/" . $random_number . "_" . basename($_FILES['uptslifile']['name']);

                                                            if (move_uploaded_file($_FILES['uptslifile']['tmp_name'], $image)) {
                                                                                // Dosya başarıyla yüklendi
                                                                                $data4 = $image;
                                                            } else {
                                                                                $errors['uptslifile'] = "Fayl Yüklemesinde xəta baş verdi:.";
                                                            }
                                        } else {
                                                            $errors['uptslifile'] = "Yanlış fayl növü. Sadece jpeg, png ve jpg faylları yüklenebiler.";
                                        }
                    } elseif ($_FILES['uptslifile']['error'] != UPLOAD_ERR_NO_FILE) {
                                        $errors['uptslifile'] = "Fayl Yüklemesinde xəta baş verdi:.";
                    }

                    $sql = " UPDATE `slider` SET 
                      `slider_name` ='$data1',
                      `slider_title1` ='$data2',
                      `slider_title2` ='$data3'";

                    if (isset($data4)) {
                                        $sql .= ", `slider_image` ='$data4'";
                    }

                    $sql .= " WHERE id= $id ";

                    $update_sql = mysqli_query($connect, $sql);

                    if ($update_sql) {
                                        header("Location: slider.php");

                                       
                    }
}

include ("../admin/section/bottom.php");
?>