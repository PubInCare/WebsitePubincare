<?php

session_start();
include('connection.php');
$wisata=mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM lokasiwisata"), MYSQLI_ASSOC);

?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css"></li>
    <link rel="stylesheet" type="text/css" href="user.css">

    <title>Aduan Diri</title>
  </head>
  <body>
  <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-warning" style="display:flex; justify-content:space-between;">
      <a class="navbar-brand" href="#"><?php echo $_SESSION['Nama']; ?> | <b> SIPI KLU</b></a>
        <div class="icon ml-4">
          <a href="1.Homepage.php">
            <h5>
                 <i class="fas fa-sign-out-alt mr-3" data-toggle="tooltip" title="Keluar"></i>
            </h5>
          </a>
        </div>
    </nav>
    <div class="row no-gutters mt-5">
    <div class="col-md-2 bg-dark mt-2 pr-3 pt-4">
            <ul class="nav flex-column ml-3 mb-5" style="position:fixed; margin-top:-10px;">
              <li class="nav-item">
                <a class="nav-link active text-white" href="5.AdminBeranda.php"><i class="fas fa-home mr-2"></i>Beranda</a><hr class="bg-secondary">
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="20.DesaKami.php" ><i class="fas fa-building mr-2"></i>Desa Kami</a><hr class="bg-secondary">
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="19.TentangWeb.php"><i class="fas fa-blog mr-2"></i>Tentang Web</a><hr class="bg-secondary">
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="4.PROFILadmin.php"><i class="fas fa-user-alt mr-2"></i>Profile</a><hr class="bg-secondary">
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="18.Wisata_Admin.php"><i class="fas fa-bus mr-2"></i>Wisata</a><hr class="bg-secondary">
              </li>
              <li>
                <div style="color:white; text-align:center; margin-top:10px;">ADMIN DESA<br><?php echo $_SESSION['desaadmin']; ?><br><br><br>SIPI KLU</div>
              </li>
            </ul>
        </div>
        <div class="col-md-10 p-5 pt-2">
            <h3><i class="fas fa-bus mr-2"></i>Wisata</h3><hr>
            <div class="container py-5" >
              <div class="row text-center">
                <!-- Desa-->
                <?php foreach ($wisata as $data) :?>
                <div class="col-xl-4 col-sm-6 mb-5" style="box-shadow: 0px 0px 10px grey;">
                  <div class="bg-white rounded shadow-sm py-5 px-4">
                    <div style="width: 100%; height: 200px; box-shadow: 0px 0px 2px lightgrey; display: flex; align-items: center; justify-content: center; margin-bottom:10px;">
                      <img src=<?php echo $data['Dokumentasi']; ?> alt="" width="200">
                    </div>
                    <h5 class="mb-0"><?php echo $data['Nama_Lokasi']; ?></h5>
                    <ul class="social mb-0 list-inline mt-3"> 
                      <form action="17.TelusuriLokasiWisata_Admin.php" method="post">
                        <button type="submit" class="btn btn-primary" name="IDL" value="<?php echo $data['ID_Lokasi']; ?>">Telusuri</button>
                      </form>
                    </ul>
                  </div>
                </div>
                <?php endforeach; ?>
                <!-- End-->
        </div>
      </div>
            </body>
        </html>