<?php 
ini_set("display_errors",1);
ini_set("display_startup_errors",1);
error_reporting(E_ALL);
$conn =mysqli_connect("localhost","root","","shushaOtel");

//if ($conn) {
  //echo 'Qoşuldu';
//}

$typename_err="";
if (isset($_POST['typenameBtn'])) {

if (empty($_POST['typename'])) {
  $typename_err="Boş Ola Bilmez";
}else {
  $typename=mysqli_real_escape_string($conn,htmlspecialchars($_POST['typename'], ENT_QUOTES));


  $query =mysqli_query($conn, 'INSERT INTO `roomType`(`type`) VALUES ("'.$typename.'")');

  if ($query) {
    echo 'Başarılı';
    header('location: #');
  }else{
    echo 'Ret';
  }

}
}

$query2=mysqli_query($conn,'SELECT * FROM `roomType`');


if (isset($_GET['searchBtn'])) {
  
  $search = mysqli_real_escape_string($conn,htmlspecialchars($_GET['searchname']));

  $query3 =mysqli_query($conn,"SELECT * FROM roomType WHERE type LIKE '%$search%'");

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
          <div class="content ">
        <form method="post">
          <div class="mb-3">
          <input type="text" name="typename" class="form-control <?php echo !empty($_POST['typename']) ? 'is-valid' : 'is-invalid'; ?>" placeholder="Otaq Növü">
            <small class="invalid-feedback"><?php echo $typename_err;?></small>
          </div>
          <div class="mb-3">
            <button type="submit" name="typenameBtn" class="form-control btn btn-info">Elave Et</button>
          </div>
        </form>
        </div>
          <!-- RoomType-->
        <div class="container">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Növü</th>
              <th scope="col">Yenile</th>
              <th scope="col">Sil</th>
              <th scope="col">Statusu</th>
            </tr>
          </thead>
          <tbody>

            <?php while($read =mysqli_fetch_array($query2)):?>

            <tr>
              <th scope="row"><?php echo  $read['id']?></th>
              <td><?php echo $read['type']?></td>
              <td><a href="roomtypeedit.php?id=<?php echo $read['id']?>"><button type="submit" class="btn btn-warning">Yenile</button></a></td>
              <td><a class="deleteType" href="roomtypedelete.php?id=<?php echo $read['id']?>"><button type="submit" class=" btn btn-danger">Sil</button></a></td>
            </tr>

            <?php endwhile;?>
          </tbody>
        </table>
        </div>


        </div>
        <?php include("../admin/section/bottom.php");?>
