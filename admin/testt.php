<?php
$conn = mysqli_connect("localhost", "root", "", "shushaOtel");
$sql = 'SELECT room.id AS id, room.file AS photo, room.price AS price, room.bed AS bed, room.bath AS bath, room.wifi AS wifi,roomType.type AS name FROM room,roomType WHERE room.typeID =roomType.id';
$query = mysqli_query($conn, $sql);


?>

<?php include("../admin/section/top.php")?>

        <div class="container">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Şekili</th>
                <th scope="col">Növü</th>
                <th scope="col">Yataq Sayı</th>
                <th scope="col">Hamam Sayı</th>
                <th scope="col">İnternet</th>
                <th scope="col">Qiymeti</th>
                <th scope="col">İdare et</th>

              </tr>
            </thead>
            <tbody>//
            <?php while ($room = mysqli_fetch_array($query)): ?>
                <tr>
                  <th scope="row"><?php echo $room['id']; ?></th>
                  <td>
    <img src="<?php echo $room['photo']; ?>" alt="" width="100" height="100">
  </td>
                  <td><?php echo $room['name']; ?></td>
                  <td><?php echo $room['bed']; ?></td>
                  <td><?php echo $room['bath']; ?></td>
                  <td><?php echo $room['wifi']; ?></td>
                  <td><?php echo $room['price']; ?></td>
                  <td><div class="dropdown show">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Otaq idaresi
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" href="#">Yenile</a>
    <a class="dropdown-item" href="#">Sil</a>
  </div>
</div></td>

                </tr>
            <?php endwhile; ?>
            </tbody>
          </table>
        </div>


<?php include("../admin/section/bottom.php");?>
    