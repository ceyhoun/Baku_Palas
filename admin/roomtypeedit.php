<?php 
ob_start();
ini_set("display_errors",1);
ini_set("display_startup_errors",1);
error_reporting(E_ALL);
$conn =mysqli_connect("localhost","root","","shushaOtel");
$id =$_GET['id'];
$roomType =mysqli_query($conn,'SELECT * FROM roomType WHERE id="'.$id.'"');
$updateRoom=mysqli_fetch_array($roomType);

if (isset($_POST['uptypenameBtn'])) {
          $newType=mysqli_real_escape_string($conn,$_POST['editname']);

          $update_room_type_query=mysqli_query($conn, 'UPDATE `roomType` SET type="'.$newType.'" WHERE id="'.$id.'"');

          if ($update_room_type_query) {
                   header('location: roomtype.php');
          }
}


?>
<?php include("../admin/section/top.php");?>

<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Otaq Növleri</li>
  </ol>

  <!-- RoomType-->
  <div class="content">
<form method="post">
  <div class="mb-3">
  <input type="text" name="editname" class="form-control" placeholder="Otaq Növü" value="<?php echo $updateRoom['type']?>">
  </div>
  <div class="mb-3">
    <button type="submit" name="uptypenameBtn" class="form-control btn btn-info">Elave Et</button>
  </div>
</form>
</div>
</div>

<?php include("../admin/section/bottom.php");?>
