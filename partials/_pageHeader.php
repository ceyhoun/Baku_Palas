<?php
// URL'den sayfa adını al
$url = $_SERVER['REQUEST_URI'];
$page = basename($url, '.php');

// Başlık ve breadcrumb'ı belirle
$pages = array(
    "index" => array("Esas Sehife", "Home"),
    "about" => array("Haqqımızda", "About"),
    "service" => array("Xidmetlerimiz", "Services"),
    "room" => array("Otaqlar", "Rooms"),
    "booking" => array("Rezervasiya", "Booking"),
    "team" => array("Komandamız", "Team"),
    "testimonial" => array("Müşteriler", "Testimonials"),
    "contact" => array("Elaqe", "Contact"),
);

$pageTitle = "Undefined";
$breadcrumb = "Undefined";

// Sayfanın adını kontrol ederek başlık ve breadcrumb'ı belirle
for ($i = 0; $i < count($pages); $i++) {
    $key = array_keys($pages)[$i];
    if ($key == $page) {
       echo $pageTitle = $pages[$key][0];
       echo $breadcrumb = $pages[$key][1];
        break;
    }
}
?>

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-1.jpg);">
    <div class="container-fluid page-header-inner py-5">
        <div class="container text-center pb-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown"><?php echo $pageTitle; ?></h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-uppercase">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page"><?php echo $breadcrumb; ?></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Header End -->
