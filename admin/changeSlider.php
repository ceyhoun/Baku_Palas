<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
$conn = mysqli_connect("localhost", "root", "", "shushaOtel");

$id = intval($_GET['id']);

$sql = mysqli_query($conn, 'SELECT status FROM slider WHERE id="' . $id . '"');

if (!$sql) {
                    $error_message = mysqli_error($conn);
                    echo json_encode(array("error" => $error_message));
                    exit;
}

$row = mysqli_fetch_array($sql);
$current_status = $row['status'];
$new_status = $current_status == 0 ? 1 : 0;
$sql_update = 'UPDATE slider SET status =$new_status WHERE id="' . $id . '"';
if (mysqli_query($conn, $sql_update)) {
                    echo json_encode(array("success" => true, "new_status" => $new_status));
} else {
                    $error_message = mysqli_error($conn);
                    echo json_encode(array("error" => $error_message));
}
?>