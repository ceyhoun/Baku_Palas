<?php 
$conn = mysqli_connect("localhost", "root", "", "shushaOtel");

$id = intval($_GET['id']);

// Yorumun mevcut durumunu al
$sql_select = "SELECT status FROM comments WHERE id = $id";
$result_select = mysqli_query($conn, $sql_select);

if (!$result_select) {
    // Sorgu başarısız olduysa hata mesajı döndür
    $error_message = mysqli_error($conn);
    echo json_encode(array("error" => $error_message));
    exit;
}

$row = mysqli_fetch_assoc($result_select);
$current_status = $row['status'];

// Yeni durumu belirle
$new_status = $current_status == 0 ? 1 : 0;

// Yorumun durumunu güncelle
$sql_update = "UPDATE comments SET status = $new_status WHERE id = $id";
if (mysqli_query($conn, $sql_update)) {
    // Başarılı bir şekilde güncellendiğini belirtmek için bir JSON yanıtı döndür
    echo json_encode(array("success" => true, "new_status" => $new_status));
} else {
    // Hata oluşursa hata mesajını döndür
    $error_message = mysqli_error($conn);
    echo json_encode(array("error" => $error_message));
}

?>
