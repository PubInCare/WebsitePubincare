<?php

session_start();
include('connection.php');
$sql = "SELECT * FROM kecamatan";
$result = mysqli_query($conn, $sql);
$datas = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"> 
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css"></li>
    <link rel="stylesheet" type="text/css" href="user.css">
    <title>Daftar kecamatan</title>
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
            <ul class="nav flex-column ml-3 mb-5" style="position:fixed">
              <li class="nav-item">
                <a class="nav-link active text-white" href="5.UserBeranda.php"><i class="fas fa-home mr-2"></i>Beranda</a><hr class="bg-secondary">
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="6.UserAduan.php"><i class="fas fa-envelope mr-2"></i>Pengaduan</a><hr class="bg-secondary">
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="19.TentangWeb.php"><i class="fas fa-blog mr-2"></i>Tentang Web</a><hr class="bg-secondary">
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="19.TentangWeb.php#KontakUs"><i class="fas fa-tty mr-2"></i>Kontak Kami</a><hr class="bg-secondary">
              </li>
              <li class="nav-item">
              <a class="nav-link text-white" href="10.Kecamatan.php" ><i class="fas fa-building mr-2"></i>Kecamatan</a><hr class="bg-secondary">
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="4.PROFIL.php"><i class="fas fa-user-alt mr-2"></i>Profile</a><hr class="bg-secondary">
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="18.Wisata.php"><i class="fas fa-bus mr-2"></i>Wisata</a><hr class="bg-secondary">
              </li>
            </ul>
        </div>
        <div class="col-md-10 p-5 pt-2">
            <h3><i class="fas fa-building mr-2"></i>KABUPATEN LOMBOK UTARA</h3><p class="font-italic text-muted">Bupati : Muhammad Kholil Umam <br>Kode Pos : 83350-83356</p><hr>
            <div class="container py-5" >
              <div class="row mb-4">
                <div class="col-lg-5">
                  <h2 class="display-4 font-weight-light">Daftar Kecamatan</h2>
                </div>
              </div>
              <div class="row text-center">
                <!-- kecamatan-->
                <?php foreach ($datas as $data) : ?>
                <div class="col-xl-4 col-sm-6 mb-5">
                  <div class="bg-white rounded shadow-sm py-5 px-4"><img src="./Logo_web.png" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                    <h5 class="mb-0" style="text-transform: uppercase;">Kecamatan <?php echo $data['Nama_Kecamatan']; ?></h5><span class="small text-uppercase text-muted">Kepala Kecamatan: <br></span>
                    <span style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;"><?php echo $data['Nm_Kacamat']; ?></span>
                    <ul class="social mb-0 list-inline mt-3"> 
                      <div>
                        <form action="11.Desa.php" method="post">
                          <button type="submit" class="btn btn-success" name="camat" value=<?php echo $data['ID_Kecamatan']; ?>>Lihat</button>
                        </form>
                      </div>
                    </ul>
                  </div>
                </div>
                <?php endforeach; ?>
                <!-- End-->
              </div>
            </div>
          <script src="http://netdna.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
          </body>
          </html>