<?php 
ob_start();
$conn = mysqli_connect("localhost", "root", "", "shushaOtel");
$id=intval($_GET['id']);
$delete_sql =mysqli_query($conn, 'DELETE room FROM room 
INNER JOIN roomType ON room.typeID = roomType.id WHERE room.id="'.$id.'"');

if ($delete_sql) {
                 header('Location: rooms.php');
}

?>