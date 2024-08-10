<?php include ("../admin/section/top.php");
ini_set("display_errors",1);
ini_set("display_startup_errors",1);
error_reporting(E_ALL);
$conn = mysqli_connect("localhost", "root", "", "shushaOtel");

function control_mail($mail)
{          
          $conn = mysqli_connect("localhost", "root", "", "shushaOtel");
          $mail = mysqli_real_escape_string($conn,$_POST['mail']);
          $query = 'SELECT * FROM subscribe WHERE email = "' . $mail . '"';
          $result = mysqli_query($conn, $query);
          if ($result) {
                    $row_count = mysqli_num_rows($result);
                    if ($row_count > 0) {
                              return true;
                    } else {
                              return false;
                    }
          }
}

$email_err = $success = "";
if (isset($_POST['mailBtn'])) {
          if (empty($_POST['mail'])) {
                    $email_err = "Boş Buraxıla Bilmez";
          } elseif (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                    $email_err = "Yanlış e-poçt formatı";
          } elseif (control_mail($_POST['mail'])) {
                    $email_err = "e-Poçt Ünvanı Sistemde Var";
          } else {
                    $email = mysqli_real_escape_string($conn, htmlspecialchars($_POST['mail'], ENT_QUOTES));
          }

          if (isset($email)) {
                    $query1 = mysqli_query($conn, 'INSERT INTO `subscribe`(`email`) VALUES ("' . $email . '")');

                    if ($query1) {
                              $success = "Elave Olundu";
                    }
          }

          
}

?>
<div class="container">
          <?php if ($success): ?>
                              <div class="alert alert-success"><?php echo $success; ?></div>
          <?php elseif ($email_err): ?>
                              <div class="alert alert-danger"><?php echo $email_err; ?></div>

          <?php endif; ?>
          <form method="post">
                    <div class="mb-3">
                              <input type="text" class="form-control" name="mail" <?php empty($_POST['mail']) ? 'is-invalid' : 'is-valid' ?> placeholder="e-Poçt Yazın">
                    </div>
                    <div class="mb-3">
                              <input type="submit" class="form-control btn btn-success" name="mailBtn" <?php !empty($email_err) ? 'is-valid' : 'is-invalid' ?> value="Elave Et">
                              <small class="invalid-feedback"><?php echo $email_err ?></small>
                    </div>
                    <a href="subscribe.php"><button type="button"  name="mailBtn" class="btn btn-primary mt-3">Geri Dön</button></a>
          </form>
</div>
<?php include ("../admin/section/bottom.php"); ?>