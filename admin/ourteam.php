<?php include ("../admin/section/top.php"); 
session_start();
$conn = mysqli_connect("localhost", "root", "", "shushaOtel");
$sql ='SELECT * FROM team';
$query=mysqli_query($conn,$sql);
?>
<div class="container">
                    <?php if(isset($_SESSION['info']) && $_SESSION['info'] ==true):?>
                                        <div class="alert alert-success">
                                                            <?php echo $_SESSION['info'];?>
                                        </div>
                    <?php endif;?>
          <button type="button" class="btn btn-check " ><a class="text-info " href="addteam.php">Yeni İşçi Elave Et</a></button>
          <table class="table">
                    <thead>
                              <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Adı</th>
                                        <th scope="col">Soyadı</th>
                                        <th scope="col">Vezifesi</th>
                                        <th scope="col">Fotosu</th>
                                        <th scope="col">Sosyal Medya FB</th>
                                        <th scope="col">Sosyal Medya İns</th>
                                        <th scope="col">Sosyal Medya X</th>
                                        <th scope="col">Sil</th>
                                        <th scope="col">Yenile</th>
                              </tr>
                    </thead>
                    <tbody>
                                        <?php while($team=mysqli_fetch_array($query)):?>
                              <tr>
                                        <th scope="row"><?php echo $team['id'];?></th>
                                        <td><?php echo $team['name'];?></td>
                                        <td><?php echo $team['surname'];?></td>
                                        <td><?php echo $team['task'];?></td>
                                        <td><img style="border-radius: 50%;" width="50" src="<?php echo $team['image'];?>" alt="<?php echo $team['name'];?>"></td>
                                        <td><?php echo $team['facebook'];?></td>
                                        <td><?php echo $team['twitter'];?></td>
                                        <td><?php echo $team['instagram'];?></td>
                                        <td><a class="text-dark" onclick='return confirm("İşçini Silmek İsteyirsiniz ?")' href="teamdelete.php?id=<?php echo $team['id'];?>"><button type="button" class="btn btn-outline-danger" >Sil</button></a></td>
                                        <td><a class="text-dark" href="teamupdate.php?id=<?php echo $team['id'];?>"><button type="button" class="btn btn-outline-secondary">Yenile</button></a></td>
                              </tr>
                              <?php endwhile;?>
                    </tbody>
          </table>
</div>
<?php include ("../admin/section/bottom.php"); ?>
