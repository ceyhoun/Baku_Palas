<?php 
// Hata raporlamayı açma
ob_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

// Veritabanı bağlantısı
$conn = mysqli_connect("localhost", "root", "", "shushaOtel");


$bookID = $_GET['id'];

// Sorguyu oluşturma
$delete_query = 'DELETE FROM `booking` WHERE id = "' . $bookID. '"';

$delete_result = mysqli_query($conn, $delete_query);

if ($delete_result) {
    header('Location: showreservation.php');
    
} else {
    echo '<div class="alert alert-danger" role="alert">Hata! Rezervasyon silinemedi.</div>';
    echo '<div class="alert alert-danger" role="alert">Hata mesajı: ' . mysqli_error($conn) . '</div>';
}


?>


