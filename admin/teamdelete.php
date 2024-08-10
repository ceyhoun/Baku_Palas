<?php
$conn = mysqli_connect("localhost", "root", "", "shushaOtel");
$id = intval($_GET['id']);
$query = mysqli_query($conn, 'DELETE FROM team WHERE id="' . $id . '"');


if ($query) {
                    header("location: ourteam.php");
} 
?>