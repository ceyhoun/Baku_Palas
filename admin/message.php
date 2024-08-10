<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
$conn = mysqli_connect("localhost", "root", "", "shushaOtel");

//$query = mysqli_query($conn, 'SELECT * FROM messages');
//echo "Gönderen:"." ". $msj['name']."<br>";
//echo "Mövzu:"." ". $msj['subject']."<br>";
//echo "Mesaj:"." ". $msj['text'];

?>
<?php include ("../admin/section/top.php") ?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail Sayfası</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<div class="email-content">
<div class="bar">
        <ul>
          <li><a href="#" id="mail-yaz"><i class="fa-solid fa-pen-nib"></i>Mail yaz</a></li>
          <li><a href="../admin/inbox.php" id="gelen-kutusu"><i class="fa-solid fa-inbox"></i> Gələn Mesajlar</a></li>
          <li><a href="#" id="giden-mesajlar"><i class="fa-solid fa-message"></i>Gedən Mesajlar</a></li>
          <li><a href="#" id="taslaklar"><i class="fa-solid fa-list"></i>Qaralamalar</a></li>
          <li><a href="#" id="cop-kutusu"><i class="fa-solid fa-trash"></i>Zibil Qabı</a></li>
        </ul>
    </div>

    <div class="icerik">

    <?php include("../admin/inbox.php");?>


        <!-- Giden Mesajlar -->
        <div id="sent" class="sent-section" style="display: none;">
            <h2>Gedən Mesajlar</h2>
            <!-- Giden mesajlar burada gösterilecek -->
            <p>Bu bölümde giden mesajlar listelenecek.</p>
        </div>

        <!-- Taslaklar -->
        <div id="drafts" class="drafts-section" style="display: none;">
            <h2>Qaralamalar</h2>
            <!-- Taslaklar burada gösterilecek -->
            <p>Bu bölümde taslaklar listelenecek.</p>
        </div>

        <!-- Çöp Kutusu -->
        <div id="trash" class="trash-section" style="display: none;">
            <h2>Zibil Qabı</h2>
            <!-- Çöp kutusu burada gösterilecek -->
            <p>Bu bölümde çöp kutusundaki mesajlar listelenecek.</p>
        </div>

        <!-- Mail Yaz -->
        <div id="compose" class="compose-section" style="display: none;">
            <h2>Mail Yaz</h2>
            <form>
                <div>
                    <label for="to">Kimə:</label>
                    <input type="email" id="to" name="to" required>
                </div>
                <div>
                    <label for="subject">Mövzu:</label>
                    <input type="text" id="subject" name="subject" required>
                </div>
                <div>
                    <label for="message">Mesaj:</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                <button type="submit">Göndər</button>
            </form>
        </div>
    </div>
</div>

    <script>
        // JavaScript kodu
        const gelenKutusuLink = document.getElementById('gelen-kutusu');
        const gidenMesajlarLink = document.getElementById('giden-mesajlar');
        const taslaklarLink = document.getElementById('taslaklar');
        const copKutusuLink = document.getElementById('cop-kutusu');
        const mailYazLink = document.getElementById('mail-yaz');
        const inboxSection = document.getElementById('inbox');
        const sentSection = document.getElementById('sent');
        const draftsSection = document.getElementById('drafts');
        const trashSection = document.getElementById('trash');
        const composeSection = document.getElementById('compose');

        function showSection(sectionToShow) {
            // Tüm bölümleri gizle
            inboxSection.style.display = 'none';
            sentSection.style.display = 'none';
            draftsSection.style.display = 'none';
            trashSection.style.display = 'none';
            composeSection.style.display = 'none';

            // Gösterilecek bölümü aç
            sectionToShow.style.display = 'block';
        }

        // Gelen Kutusu
        gelenKutusuLink.addEventListener('click', function(event) {
            event.preventDefault();
            showSection(inboxSection);
        });

        // Giden Mesajlar
        gidenMesajlarLink.addEventListener('click', function(event) {
            event.preventDefault();
            showSection(sentSection);
        });

        // Taslaklar
        taslaklarLink.addEventListener('click', function(event) {
            event.preventDefault();
            showSection(draftsSection);
        });

        // Çöp Kutusu
        copKutusuLink.addEventListener('click', function(event) {
            event.preventDefault();
            showSection(trashSection);
        });

        // Mail Yaz
        mailYazLink.addEventListener('click', function(event) {
            event.preventDefault();
            showSection(composeSection);
        });
    </script>
</body>

</html>

</html>
<?php include ("../admin/section/bottom.php") ?>