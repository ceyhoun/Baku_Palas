<!DOCTYPE html >
<html lang="en">

  <head>
    

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BP Admin - Dashboard</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="index.php">Baku Palas</a><br>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button">
              <i class="fas fa-search"></i>
              
            </button>
          </div>
        </div>
      </form>
      
      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
      <!-- sil -->
<?php 
$conn = mysqli_connect("localhost", "root", "", "shushaOtel");
$query=mysqli_query($conn,'SELECT email FROM subscribe ORDER BY created_At DESC LIMIT 1');


$count =mysqli_num_rows($query);

?>


        <!-- HTML: Zil simgesi -->
<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span id="notificationBadge" class="badge badge-warning"><?php echo $count?></span>
        <i class="fas fa-bell fa-fw"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
    <a class="dropdown-item" href="subscribe.php"> Yeni <?php echo $count; ?> Abunə</a>
    </div>
</li>

      <!-- mesaj -->

        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="badge badge-success">9+</span>

            <i class="fas fa-envelope fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
            <a class="dropdown-item" href="#">Mesajlar</a>
            <a class="dropdown-item" href="#">Another action</a>
          </div>
        </li>
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#">Ayarlar</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Çıxış</a>
          </div>
        </li>
      </ul>

    </nav>

    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
      <li class="nav-item active">
          <a class="nav-link" href="../index.php">
          <i class="fa-solid fa-house-signal"></i>            <span>Sayta get</span>
          </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Otaqlar</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Otaq idaresi:</h6>
            <a class="dropdown-item" href="roomtype.php">Otaq Növü Elave Et</a>
            <a class="dropdown-item" href="addroom.php">Otaq Elave Et</a>
      <!--ek işlemler

            <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">Other Pages:</h6>-->
      <!--ek işlemler-->
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Rezervasiya idaresi</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Rezervasiya</h6>
            <a class="dropdown-item" href="roomtype.php">Bron Elave Et</a>
            <a class="dropdown-item" href="reservation.php">Rezervasiya Elave Et</a>
      <!--ek işlemler-->
      <h6 class="dropdown-header">Elave Olunanlar</h6>
            <a class="dropdown-item" href="#">Bronlar</a>
            <a class="dropdown-item" href="showreservation.php">Rezervasiyalar</a>
      <!--ek işlemler-->
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="rooms.php">
            <i class="fa fa-home"></i>
            <span>Otaqlar</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="slider.php">
          <i class="fa-solid fa-sliders"></i>         
            <span>Slider</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
          <i class="fa-solid fa-table"></i>
            <span>Rezervasiya</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="subscribe.php">
          <i class="fa-solid fa-subscript"></i>            <span>Abone Olanlar</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="message.php">
          <i class="fa-solid fa-inbox"></i>                  <span>Mesajlar</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="ourteam.php">
          <i class="fa-solid fa-user"></i>               <span>Bizim Heyət</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="comment.php">
          <i class="fa-solid fa-comment"></i>      
                 <span>Şerhler</span></a>
        </li>
        <li class="nav-item">
          <a href="exit.php" onclick="return confirm(`Panelden Çıxacaq ! Eminsiniz ?`)" class="nav-link">
          <i class="fa-solid fa-arrow-right-from-bracket"></i> 
          <span>Çıxış</span></a>

          </a></li>
      </ul>

      <div id="content-wrapper">