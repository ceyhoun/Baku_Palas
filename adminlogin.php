<?php
session_start();
ob_start();

if (isset($_SESSION['login']) && $_SESSION['login']== true) {
                   header('location: admin/index.php');
}
$conn = mysqli_connect("localhost", "root", "", "shushaOtel");
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);




if (isset($_POST['adminLoginBtn'])) {
                    $adminusername = mysqli_real_escape_string($conn, htmlspecialchars($_POST['adminusername'], ENT_QUOTES));
                    $adminpassword = mysqli_real_escape_string($conn, htmlspecialchars($_POST['adminpassword'], ENT_QUOTES));

                    $query = mysqli_query($conn, 'SELECT `adminusername`,`adminpassword` FROM `users` WHERE `adminusername`="' . $adminusername . '" AND `adminpassword`="' . $adminpassword . '"');

                    $admin = mysqli_num_rows($query);

                    if ($admin > 0) {
                                        $_SESSION['login'] = true;
                                        header('Location: admin/index.php');
                    } else {
                                        $_SESSION['login'] = false;
                                        header('Location: #');
                    }


}
; ?>

<!DOCTYPE html>
<html lang="en">
<head>
                    <title>Login V4</title>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
                    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
                    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
                    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
                    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
                    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
                    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
                    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">	
                    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
                    <link rel="stylesheet" type="text/css" href="css/util.css">
                    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
                    
<div class="limiter">
<div class="container-login100" style="background-image: url('carousel-2.jpg');">
<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                    <form class="login100-form validate-form" method="post">
                    <span class="login100-form-title p-b-49">Admin Giriş </span>
                    <div class="wrap-input100 validate-input m-b-23" data-validate = "Username is reauired">
                    <span class="label-input100">Admin İstifadeçi Adı</span>
                    <input class="input100" type="text" name="adminusername" placeholder="Admin İstifadeçi Adı">
                    <span class="focus-input100" data-symbol="&#xf206;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                     <span class="label-input100">Admin Şifreniz</span>
                     <input class="input100" type="password" name="adminpassword" placeholder="Admin Şifreniz">
                    <span class="focus-input100" data-symbol="&#xf190;"></span>
                    </div>
                                                                                                    
                    <div class="text-right p-t-8 p-b-31">
                    <a href="#">
                                         Şifreni Unutdun ?
                    </a>
                    </div>
                                                                                                    
                    <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                                        <div class="login100-form-bgbtn"></div>
                                        <button class="login100-form-btn" type="submit" name="adminLoginBtn">
                                                             Daxil Ol
                                         </button>
                     </div>
</div>

                                                                                

                    </form>
</div>
</div>
</div>
                    

<div id="dropDownSelect1"></div>
                    
<!--===============================================================================================-->
                    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
                    <script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
                    <script src="vendor/bootstrap/js/popper.js"></script>
                    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
                    <script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
                    <script src="vendor/daterangepicker/moment.min.js"></script>
                    <script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
                    <script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
                    <script src="js/main.js"></script>

</body>
</html>