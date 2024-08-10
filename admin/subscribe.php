<?php include("../admin/section/top.php");
$conn = mysqli_connect("localhost", "root", "", "shushaOtel");

$query =mysqli_query($conn, 'SELECT * FROM subscribe');


?>
<div class="container">
         <a href="addsubscribe.php" class="text-white"> <button type="button" class="btn btn-success w-25 mb-3">Elave Et</button></a>
          <table class="table">
                    <thead>
                              <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Abone Olunan E-mail</th>
                                        <th scope="col">Abone Olma Tarixi</th>
                              </tr>
                    </thead>
                    <tbody>
                              <?php while($email=mysqli_fetch_assoc($query)):?>
                              <tr>
                                        <th scope="row"><?php echo $email['id'];?></th>
                                        <td><?php echo $email['email'];?></td>
                                        <td><?php echo $email['created_At'];?></td>
                              </tr>
                              <?php endwhile;?>
                    </tbody>
          </table>
</div>
<?php include("../admin/section/bottom.php")?>
