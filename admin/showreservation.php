<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

$conn = mysqli_connect("localhost", "root", "", "shushaOtel");

$sql = mysqli_query($conn, 'SELECT 
booking.id AS bookid,
booking.name AS bookName,
booking.surname AS booksurname,
booking.country AS bookCountry,
booking.passport AS bookPassport,
booking.email AS bookEmail,
booking.adult AS bookAdult,
booking.child AS bookChild,
booking.checkin AS bookCheckin,
booking.checkout AS bookCheckout,
DATEDIFF(booking.checkout, booking.checkin) AS bookDay,
booking.message AS bookMessage,
roomType.type AS bookRoomName
FROM booking
INNER JOIN roomType ON roomType.id = booking.room');

$row = mysqli_num_rows($sql);
?>
<?php include("../admin/section/top.php") ?>
<?php if ($row > 0): ?>

    <h3 class="text-center">Rezervasiyalar</h3>


              <table class="table" style="font-size: 12px;">
                        <thead>
                                  <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Adı</th>
                                            <th scope="col">Soyadı</th>
                                            <th scope="col">Ölkesi</th>
                                            <th scope="col">Pasport No</th>
                                            <th scope="col">e-Poçtu</th>
                                            <th scope="col">Qonaq Sayı</th>
                                            <th scope="col">Uşaq Sayı(Varsa)</th>
                                            <th scope="col">Seçtiyi Otaq</th>
                                            <th scope="col">Giriş Tarixi</th>
                                            <th scope="col">Çıxış Tarixi</th>
                                            <th scope="col">Qalacağı Gün </th>
                                            <th scope="col">Özel İstek (Varsa)</th>
                                            <th scope="col">İdare Et</th>
                                  </tr>
                        </thead>
                        <tbody>
                                  <?php while ($rez = mysqli_fetch_array($sql)): ?>
                                          <tr>
                                          <th scope="row"><?php echo $rez['bookid'] ?></th>
                                          <?php echo isset($rez['bookid']); ?>
            <td><?php echo $rez['bookName'] ?></td>
            <td><?php echo $rez['booksurname'] ?></td>
            <td><?php echo $rez['bookCountry'] ?></td>
            <td><?php echo $rez['bookPassport'] ?></td>
            <td><?php echo $rez['bookEmail'] ?></td>
            <td><?php echo $rez['bookAdult'] ?></td>
            <td><?php echo $rez['bookChild'] ?></td>
            <td><?php echo $rez['bookRoomName'] ?></td>
            <td><?php echo $rez['bookCheckin'] ?></td>
            <td><?php echo $rez['bookCheckout'] ?></td>
            <td><?php echo $rez['bookDay'] ?></td>
            <td><?php echo $rez['bookMessage'] ?></td>

                                                    <td>
            <div class="dropdown show">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    İdare Et
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="changerezervation.php?id=<?php echo $rez['bookid']; ?>"><button class="btn btn-warning">Yenile</button></a>
                    <a class="dropdown-item deleteRezervation" href="deleterezervation.php?id=<?php echo $rez['bookid']; ?>">Sil</a>
                </div>
            </div>
            </td>
                                          </tr>
                                  <?php endwhile; ?>
                        </tbody>
              </table>

<?php else: ?>
        <div class="container">
        <p>Elave Olunan Rezervasiya Yoxdur</p>
        </div>
<?php endif; ?>
<?php include("../admin/section/bottom.php") ?>
