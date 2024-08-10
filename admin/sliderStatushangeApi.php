<?php
$conn = mysqli_connect("localhost", "root", "", "shushaOtel");

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

$id = intval($_GET['id']) ? intval($_GET['id']) : null;

//echo $id;

$sql = mysqli_query($conn, 'SELECT status FROM slider WHERE id="' . $id . '"');

$current_status = mysqli_fetch_assoc($sql);

$new_status = $current_status['status'] == 0 ? 1 : 0;

//echo $new_status;

$update_sql =mysqli_query($conn, 'UPDATE slider SET status="'.$new_status.'" WHERE id="'.$id.'" ');

echo json_encode(array("new_status" => $new_status));

?>