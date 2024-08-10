<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
$conn = mysqli_connect("localhost", "root", "", "shushaOtel");

$slidername_err = "";
if (isset($_POST['sliderBtn'])) {


  //slider title1
  $slider_title1 = mysqli_real_escape_string($conn, htmlspecialchars($_POST['slidertitle'], ENT_QUOTES));
  $slider_title2 = mysqli_real_escape_string($conn, htmlspecialchars($_POST['slidertitle1'], ENT_QUOTES));

  //slider name
  if (empty($_POST['slidername'])) {
    $slidername_err = "Boş Buraxıla Bilmez";
  } else {
    $slidername = mysqli_real_escape_string($conn, htmlspecialchars($_POST['slidername'], ENT_QUOTES));
  }



  //slider image
  if (!empty($_FILES['sliderimage'])) {
    $allowed_types = ["image/jpeg", "image/png", "image/jpg"];

    if (in_array($_FILES['sliderimage']['type'], $allowed_types)) {
      $random_number = rand(9999999, 9999999999999999);
      $sliderimage = "../upload_slider/" . $random_number . "_" . basename($_FILES['sliderimage']['name']);

      if (move_uploaded_file($_FILES['sliderimage']['tmp_name'], $sliderimage)) {
        echo "Dosya başarıyla yüklendi!";
      } else {
        $error = error_get_last();
        $roomFile_err = "Dosya yüklenirken bir hata oluştu: " . $error['message'];
      }
    }
  }

  $status = isset($_POST['status']) ? 1 : 0;

  if (isset($slidername) && isset($sliderimage) && isset($status)) {
    $slider_query = mysqli_query($conn, 'INSERT INTO `slider`(`slider_name`, `slider_title1`, `slider_title2`, `slider_image`, `status`) VALUES ("' . $slidername . '","' . $slider_title1 . '","' . $slider_title2 . '","' . $sliderimage . '","' . $status . '")');

    if ($slider_query) {
      echo 'Yüklendi';
    } else {
      echo 'Xeta';
    }
  }


  //status change


}



?>
<?php include ("../admin/section/top.php") ?>
      <div class="container">
        
        <form method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <input type="text" name="slidertitle" class="form-control" placeholder="1-ci Başlıq">
          </div>
          <div class="mb-3">
            <input type="text" name="slidertitle1" class="form-control" placeholder="1-ci Başlıq">
          </div>
          <div class="mb-3">
            <input type="text" name="slidername" class="form-control <?php echo empty($_POST['slidername']) ? 'is-invalid' : 'is-valid'; ?>" placeholder="Slayder Adı">
            <small class="invalid-feedback"><?php echo $slidername_err; ?></small>
          </div>
          <div class="mb-3">
            <input type="file" name="sliderimage" class="form-control">
          </div>
          <div class="mb-3">
            Aktif/Deaktif <input type="checkbox" name="status" <?php echo isset($_POST['status']) == 'checked' ? 1 : 0 ?>>
          </div>
          <div class="mb-3">
            <input type="submit" value="Elave Et" name="sliderBtn">
          </div>
        </form>

        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Slider adı</th>
              <th scope="col">I.Slider başlığı</th>
              <th scope="col">II.Slider başlığı</th>
              <th scope="col">Slider üçün şekil</th>
              <th scope="col"> Statusu</th>
              <th scope="col">Statusu Deyiş</th>
              <th scope="col"> Yenile</th>
              <th scope="col"> Sil</th>
            </tr>
          </thead>
          <tbody>
            <?php $sql = mysqli_query($conn, 'SELECT * FROM slider'); ?>
            <?php while ($item = mysqli_fetch_array($sql)): ?>
                      <tr>
                        <th scope="row"> <?php echo $item['id'] ?></th>
                        <td><?php echo $item['slider_name'] ?></td>
                        <td><?php echo $item['slider_title1'] ? $item['slider_title1'] : 'Qeyd Olunmayıb' ?></td>
                        <td><?php echo $item['slider_title2'] ? $item['slider_title2'] : 'Qeyd Olunmayıb' ?></td>
                        <td><img width="100" height="100" src="<?php echo htmlspecialchars($item['slider_image']); ?>" alt="<?php echo htmlspecialchars($item['slider_name']); ?>"></td>
                        <td id="slider-<?php echo $item['id']; ?>"><?php echo $item['status'] == 1 ? 'Aktif' : 'Deaktif' ?> </td>
                        <td><button type="submit" class="<?php echo $item['status'] == 1 ? 'btn btn-outline-danger' : 'btn btn-outline-success' ?>"  name="changeBtn" onclick=" f(this); updateStatus(<?php echo $item['id']?>)"><?php echo $item['status'] == 1 ? 'Passif et' : 'Aktif et' ?></button></td>
                        <td><a href="sliderupdate.php?id=<?php echo $item['id']; ?>"><button type="submit" class="btn btn-outline-warning">Yenile</button></a></td>
                        <td><a href="sliderdelete.php?id=<?php echo $item['id']; ?>"><button type="submit" class="btn btn-outline-danger">Sil</button></a></td>
                      </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
<script>
function updateStatus(id) {
  fetch("sliderStatushangeApi.php?id="+id)
  .then(res=>res.json())
  .then(data=>{
    //console.log(data.new_status);

    let new_status =data.new_status;
    //console.log(new_status);

    let slider =document.getElementById("slider-"+id);

    slider.textContent=new_status==1 ? 'Aktif' : 'Deaktif';
   
  })
}


function f(x){
var a=x.getAttribute("class");
if(a=="btn btn-outline-danger"){
x.setAttribute("class","btn btn-outline-success");
x.innerText="Aktiv et";
}
else{
x.setAttribute("class","btn btn-outline-danger");
x.innerText="Passif et";
}
}
</script>
<?php include ("../admin/section/bottom.php"); ?>