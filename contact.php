<?php include ("partials/_header.php"); ?>
<?php include ("partials/_pageHeader.php"); ?>

<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
$conn = mysqli_connect("localhost", "root", "", "shushaOtel");

$name_err = $mail_err = $subject_err = $message_err =$danger=$success= "";
if (isset($_POST['messageBtn'])) {
    
        if (empty($_POST['name'])) {
            $name_err = "Adınızı Yazmadınız!";
        } else {
            $name = mysqli_real_escape_string($conn, htmlspecialchars($_POST['name']));
        }
        
        if (empty($_POST['mail'])) {
            $mail_err = "e-Poçtunuzu Yazmadınız!";
        }elseif (!filter_var($_POST['mail'],FILTER_VALIDATE_EMAIL)) {
            $mail_err = "e-Poçtunuzun Formatı Sehvdir!";
        } else {
            $mail = mysqli_real_escape_string($conn, htmlspecialchars($_POST['mail']));
        }
        
        if (empty($_POST['subject'])) {
            $subject_err = "Mövzu Yazmadınız!";
        } else {
            $subject = mysqli_real_escape_string($conn, htmlspecialchars($_POST['subject']));
        }
        
        if (empty($_POST['message'])) {
            $message_err = "Mesaj Yazmadınız!";
        } else {
            $message = mysqli_real_escape_string($conn, htmlspecialchars($_POST['message']));
        }
    }
    
    if (isset($name) && isset($mail) && isset($subject) && isset($message)) {
        $insert_mail =mysqli_query($conn,'INSERT INTO `messages`(`name`, `email`, `subject`, `text`) VALUES ("'.$name.'","'.$mail.'","'.$subject.'","'.$message.'")');

        if ($insert_mail) {
            $success ="Mesajınız Gönderildi";
        }else{
            $danger ="Xeta! Mesaj Gönderilmedi!";
        }
    }
    

?>
        <!-- Contact Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title text-center text-primary text-uppercase">Bizimlə əlaqə saxlayın</h6>
                    <h1 class="mb-5"> <span class="text-primary text-uppercase">İstənilən sorğu üçün</span> Əlaqə</h1>
                </div>
                <div class="row g-4">
                    <div class="col-12">
                        <div class="row gy-4">
                            <div class="col-md-4">
                                <h6 class="section-title text-start text-primary text-uppercase">Rezervasiya Üçün</h6>
                                <p><i class="fa fa-envelope-open text-primary me-2"></i>book@example.com</p>
                            </div>
                            <div class="col-md-4">
                                <h6 class="section-title text-start text-primary text-uppercase">Ümumi Məsələlər Üçün</h6>
                                <p><i class="fa fa-envelope-open text-primary me-2"></i>info@example.com</p>
                            </div>
                            <div class="col-md-4">
                                <h6 class="section-title text-start text-primary text-uppercase">Texnik Məsələlər Üçün</h6>
                                <p><i class="fa fa-envelope-open text-primary me-2"></i>tech@example.com</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 wow fadeIn" data-wow-delay="0.1s">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3039.5403623826746!2d49.85418007561987!3d40.37471497144643!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40307daa691e0ae3%3A0xd712bbbeb3c68148!2sJW%20Marriott%20Absheron%20Baku%20Hotel!5e0!3m2!1str!2str!4v1714754784676!5m2!1str!2str" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="col-md-6">
                        <?php if($success):?>
                            <div class="alert alert-success"><?php echo $success?></div>
                            <?php elseif($danger):?>
                            <div class="alert alert-success"><?php echo $danger?></div>
                        <?php endif;?>

                            <form method="post">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control <?php echo !empty($name_err) ? 'is-invalid' : 'is-valid'; ?>" name="name" id="name" placeholder="Your Name">
                                            <small class="invalid-feedback"><?php echo $name_err; ?></small>
                                            <label for="name">Adınız</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control <?php echo !empty($mail_err) ? 'is-invalid' : 'is-valid'; ?>" name="mail" id="email" placeholder="Your Email">
                                            <small class="invalid-feedback"><?php echo $mail_err; ?></small>
                                            <label for="email">e-Poçtunuz</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control <?php echo !empty($subject_err) ? 'is-invalid' : 'is-valid'; ?>" name="subject" id="subject" placeholder="Subject">
                                            <small class="invalid-feedback"><?php echo $subject_err; ?></small>
                                            <label for="subject">Mövzu</label>
                                        </div>
                                    </div>
                                        <div class="form-floating">
                                        <textarea class="form-control <?php echo !empty($message_err) ? 'is-invalid' : 'is-valid'; ?>" name="message" placeholder="Leave a message here" id="message" style="height: 150px">
                                            <?php echo $message_err; ?>
                                        </textarea>
                                        <label for="message">Mesajınız</label>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100 py-3" type="submit" name="messageBtn">Mesajı Göndər</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->


<?php include ("partials/_newsletter.php"); ?>
        
<?php include ("partials/_footer.php"); ?>