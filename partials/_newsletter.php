        <?php
ini_set("display_errors", 1);
error_reporting(E_ALL);

// Veritabanına bağlanın
$conn = mysqli_connect("localhost", "root", "", "shushaOtel");


$success=$danger="";
if (isset($_POST['emailBtn'])) {

    if (empty($_POST['email'])) {
        $danger='e-Poçtunuzu Daxil Edin';
    } elseif (!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
        $danger="Yanlış e-poçt formatı";
    }else {
        $email=mysqli_real_escape_string($conn,htmlspecialchars($_POST['email'],ENT_QUOTES));
    }
    
    if (isset($email)) {
        $email_insert=mysqli_query($conn,'INSERT INTO `subscribe`(`email`) VALUES ("'.$email.'")');

        if ($email) {
            $success="Abunə Olundu!";
        }
    }
}
        ?>
        
        <!-- Newsletter Start -->
        <div class="container newsletter mt-5 wow fadeIn" data-wow-delay="0.1s">

            <div class="row justify-content-center">
                <div class="col-lg-10 border rounded p-1">
                    <div class="border rounded text-center p-1">
                        <div class="bg-white rounded text-center p-5">
                            <h4 class="mb-4">Yenilikler Üçün <span class="text-primary text-uppercase">Abunə Ol</span></h4>
                            <?php if($success):?>
            <div class="alert alert-success text-center"><?php echo $success;?></div>
        <?php elseif($danger):?>
            <div class="alert alert-danger text-center"><?php echo $danger;?></div>
        <?php endif;?>
                            <div class="position-relative mx-auto" style="max-width: 400px;">
                            <form  method="post">
                                <div class="MB-3">
                                    <input class="form-control w-100 py-3 ps-4 pe-5" name="email" type="text" placeholder="e-poçtunu yaz">
                                </div>
                                <button type="submit" name="emailBtn" class="btn btn-primary py-2 px-3 position-absolute top-0 end-0 mt-2 me-2">Gönder</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Newsletter Start -->