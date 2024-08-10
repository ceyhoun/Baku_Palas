<?php
session_start();
ob_start();
include ("../admin/section/top.php");
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

$success = isset($_SESSION['success']) ? $_SESSION['success'] : "";
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : "";

unset($_SESSION['success']);
unset($_SESSION['errors']);

$conn = mysqli_connect("localhost", "root", "", "shushaOtel");

$query = mysqli_query($conn, 'SELECT 
room.id AS romID,
room.file AS roomimg,
 room.price AS roomprice,
 room.bed AS bedCount,
 room.bath AS bathCount,
 room.wifi AS iswifi, 
 roomType.type AS roomtype 
FROM room,roomType WHERE room.typeID =roomType.id');

?>

<?php
if ($success) {
  echo "<p style='color: green;'>$success</p>";
}
if ($errors) {
  echo "<p style='color: red;'>$errors</p>";
}
?>
<div class="container">

  <table class="table">
    <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Otaq</th>
      <th scope="col">Otağın Şekili</th>
      <th scope="col">Qiymeti</th>
      <th scope="col">Yataq Sayı</th>
      <th scope="col">Duş Sayı</th>
      <th scope="col">İnternet Xidmeti</th>
      <th scope="col">Deyiş/Sil</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($room = mysqli_fetch_array($query)): ?>
      <tr>
    <th scope="row"><?php echo $room['romID']; ?></th>
    <td><?php echo $room['roomtype']; ?></td>
    <td><img width="100" src="<?php echo $room['roomimg']; ?>" alt="<?php echo $room['roomtype']; ?>"></td>
    <td><?php echo $room['roomprice']; ?> AZN</td>
    <td><?php echo $room['bedCount']; ?> Eded</td>
    <td><?php echo $room['bathCount']; ?> Eded</td>
    <td><?php echo $room['iswifi']; ?></td>
    <td>
      <a href="roomsedit.php?id=<?php echo $room['romID']; ?>"><button type="submit" class="btn btn-warning">Deyiş</button></a>
      <a href="roomsdelete.php?id=<?php echo $room['romID']; ?>"><button type="submit" class="deleteroom btn btn-danger">Sil</button></a>
    </td>
  </tr>
<?php endwhile; ?>
  </tbody>
  </table>
</div>
<?php
?>

<?php
include ("../admin/section/bottom.php"); ?>