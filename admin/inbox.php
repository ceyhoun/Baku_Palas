<?php 
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
$conn = mysqli_connect("localhost", "root", "", "shushaOtel");

$query = mysqli_query($conn, 'SELECT * FROM messages');

?>
       <!-- Gelen Kutusu -->
        <div id="inbox" class="inbox-section">
            <h2>Gelen Kutusu</h2>
            <div class="email-item">     
               <?php while($inbox=mysqli_fetch_array($query)):?>
                          <p><strong>Göndərən: </strong> <?php echo $inbox['name'];?></p>
                          <p><strong>Göndərənin e-Poçtu: </strong> <?php echo $inbox['email'];?></p>
                          <p><strong>Mövzu: </strong> <?php echo $inbox['subject'];?></p>
                          <p><strong>Mesaj: </strong><?php echo $inbox['text'];?></p>
                    <?php endwhile;?>
           </div>
            <!-- Diğer e-postalar -->
        </div>