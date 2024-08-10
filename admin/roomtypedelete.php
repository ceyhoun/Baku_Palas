<?php 
ob_start();
ini_set("display_errors",1);
ini_set("display_startup_errors",1);
error_reporting(E_ALL);
$conn =mysqli_connect("localhost","root","","shushaOtel");
$id =$_GET['id'];

$delete_query=mysqli_query($conn,'DELETE FROM roomType WHERE id="'.$id.'"');

if ($delete_query) {
          header('location: roomtype.php');
}

?>