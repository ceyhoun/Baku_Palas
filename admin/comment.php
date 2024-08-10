<?php include ("section/top.php");
$conn = mysqli_connect("localhost", "root", "", "shushaOtel");
$sql = 'SELECT * FROM `comments`';
$query = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Adı</th>
                    <th scope="col">Mövzu</th>
                    <th scope="col">Mesaj</th>
                    <th scope="col">Status</th>
                    <th scope="col">Deyiş</th>
                    <th scope="col">Yenile</th>
                    <th scope="col">Sil</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($comment = mysqli_fetch_array($query)): ?>
                                                            <tr>
                                                                <th scope="row"><?php echo $comment['id']; ?></th>
                                                                <td scope="row"><?php echo $comment['customer']; ?></td>
                                                                <td scope="row"><?php echo $comment['subject']; ?></td>
                                                                <td scope="row"><?php echo $comment['message']; ?></td>
                                                                <td scope="row" id="status-<?php echo $comment['id']; ?>">
                                                                    <?php echo $comment['status'] == 0 ? 'Passif' : 'Aktif'; ?>
                                                                </td>
                                                                <td scope="row">
                                                                    <button type="button" class="btn btn-outline-<?php echo $comment['status'] == 1 ? 'danger' : 'success' ?>" onclick="f(this); changeStatus(<?php echo $comment['id']; ?>)"><?php echo $comment['status'] == 0 ? 'Aktif Et' : 'Passif Et' ?></button>
                                                                </td>
                                                                <td scope="row">
                                                                    <a href="commentupdate.php?id=<?php echo $comment['id']; ?>">
                                                                    <button type="button" class="btn btn-outline-warning">
                                                                        Yenile
                                                                    </button>
                                                                </a>
                                                                </td>
                                                                <td scope="row">
                                                                    <a onclick="return confirm(`Silmek İstediyinizden Emin siniz ?`)" href="commentdelete.php?id=<?php echo $comment['id']; ?>">
                                                                    <button type="button" class="btn btn-outline-danger">
                                                                        Sil
                                                                        </button></a> 
                                                                </td>
                                                            </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <script>
      
      function changeStatus(id) {
    fetch("changecomment.php?id=" + id)
        .then(response => response.json())
        .then(data => {
           //console.log(data.new_status);

           const newStatus = data.new_status;
          
            const statusCell = document.getElementById("status-" + id);
             statusCell.textContent = newStatus == 0 ? 'Passif' : 'Aktif';
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
</body>
</html>
<?php include ("section/bottom.php"); ?>
