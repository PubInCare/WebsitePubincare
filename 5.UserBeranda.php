<?php

session_start();
include('connection.php');
$sql = "SELECT * FROM pengadaan";
$result = mysqli_query($conn, $sql);
$datas1 = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql = "SELECT * FROM perbaikan";
$result = mysqli_query($conn, $sql);
$datas2 = mysqli_fetch_all($result, MYSQLI_ASSOC);

$indeks=0;
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

    <title>BerandaUser</title>
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
            <h3><i class="fas fa-home mr-2"></i>Beranda </h3><hr>
            <a href="13.AduanDiri.php"><button class="btn btn-success">Lihat Aduanmu</button></a>
            <br><br><br>
            <!-- Start Pengaduan -->
            <div class="row text-dark" style="margin-left:1px;">
              <?php 
              foreach ($datas1 as $data) :
                $indeks++;
                $IDPengadaan = $data['ID_Pengadaan'];
                $hasilsql = mysqli_query($conn, "SELECT * FROM desa WHERE ID_Desa IN (SELECT ID_Desa_Asal FROM admindesa WHERE ID_Admin IN (SELECT ID_Admin_Desa FROM pengaduan WHERE ID_Pengaduan = '$IDPengadaan'))");
                $Desa = mysqli_fetch_array($hasilsql, MYSQLI_ASSOC);
                $NamaDesa = $Desa['Nama_Desa'];
                $hasilsql = mysqli_query($conn, "SELECT * FROM kecamatan WHERE ID_Kecamatan IN (SELECT ID_Kecamatan from desa WHERE ID_Desa IN (SELECT ID_Desa_Asal FROM admindesa WHERE ID_Admin IN (SELECT ID_Admin_Desa FROM pengaduan WHERE ID_Pengaduan = '$IDPengadaan')))");
                $Kecamatan = mysqli_fetch_array($hasilsql, MYSQLI_ASSOC);
                $NamaKecamatan = $Kecamatan['Nama_Kecamatan'];
                $hasilsql = mysqli_query($conn, "SELECT * FROM pengaduan WHERE ID_Pengaduan = '$IDPengadaan'");
                $Pengadaan = mysqli_fetch_array($hasilsql, MYSQLI_ASSOC);
                $status = $Pengadaan['status'];
                if($status=="T" || $status=="TI"){
                  $status="Diteruskan";
                }else if($status=="V" || $status=="VI" || $status=="VII"){
                  $status="Diterima";
                }else if($status=="X" || $status=="XI" || $status=="XII"){
                  $status="Ditolak";
                }else{
                  $status="Menunggu";
                }
              ?>
                <div class="card mr-4" style="width: 18rem; margin-bottom:25px;">
                  <img src=<?php echo $data['DokumentasiBukti'];?> class="card-img-top" style="width: 100%; height: 190px;" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">Pengaduan <?php echo $indeks?></h5>
                        <p class="card-text">
                          <span style="font-weight: bold; color: black;">Jenis Pengaduan : </span>Pengadaan<br>
                          <span style="font-weight: bold; color: black;">Lokasi Pengaduan : </span>Desa <?php echo $NamaDesa; ?>, Kecamatan <?php echo $NamaKecamatan; ?>, Kabupaten Lombok Utara<br>
                          <span style="font-weight: bold; color: black;">Status Pengaduan : </span><?php echo $status;?><br>
                        </p>
                        <form action="9.DetilAduan.php" method="post">
                          <button type="submit" value="<?php echo $data['ID_Pengadaan']; ?>" name="IDP"  class="btn btn-secondary">Selengkapnya</button>
                        </form>
                      </div>
                </div>
              <?php endforeach; ?>
              <?php 
              foreach ($datas2 as $data) : 
                $indeks++;
                $IDPerbaikan = $data['ID_Perbaikan'];
                $hasilsql = mysqli_query($conn, "SELECT * FROM desa WHERE ID_Desa IN (SELECT ID_Desa_Asal FROM admindesa WHERE ID_Admin IN (SELECT ID_Admin_Desa FROM pengaduan WHERE ID_Pengaduan = '$IDPerbaikan'))");
                $Desa = mysqli_fetch_array($hasilsql, MYSQLI_ASSOC);
                $NamaDesa = $Desa['Nama_Desa'];
                $hasilsql = mysqli_query($conn, "SELECT * FROM kecamatan WHERE ID_Kecamatan IN (SELECT ID_Kecamatan from desa WHERE ID_Desa IN (SELECT ID_Desa_Asal FROM admindesa WHERE ID_Admin IN (SELECT ID_Admin_Desa FROM pengaduan WHERE ID_Pengaduan = '$IDPerbaikan')))");
                $Kecamatan = mysqli_fetch_array($hasilsql, MYSQLI_ASSOC);
                $NamaKecamatan = $Kecamatan['Nama_Kecamatan'];
                $hasilsql = mysqli_query($conn, "SELECT * FROM pengaduan WHERE ID_Pengaduan = '$IDPerbaikan'");
                $Pengadaan = mysqli_fetch_array($hasilsql, MYSQLI_ASSOC);
                $status = $Pengadaan['status'];
                if($status=="T" || $status=="TI"){
                  $status="Diteruskan";
                }else if($status=="V" || $status=="VI" || $status=="VII"){
                  $status="Diterima";
                }else if($status=="X" || $status=="XI" || $status=="XII"){
                  $status="Ditolak";
                }else{
                  $status="Menunggu";
                }
              ?>
                <div class="card mr-4" style="width: 18rem; margin-bottom:25px;">
                  <img src=<?php echo $data['DokumentasiBukti'];?> class="card-img-top" style="width: 100%; height: 190px;" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">Pengaduan <?php echo $indeks?></h5>
                        <p class="card-text">
                          <span style="font-weight: bold; color: black;">Jenis Pengaduan : </span>Perbaikan<br>
                          <span style="font-weight: bold; color: black;">Lokasi Pengaduan : </span>Desa <?php echo $NamaDesa; ?>, Kecamatan <?php echo $NamaKecamatan; ?>, Kabupaten Lombok Utara<br>
                          <span style="font-weight: bold; color: black;">Status Pengaduan : </span><?php echo $status;?><br>
                        </p>
                        <form action="9.DetilAduan.php" method="post">
                          <button type="submit" value="<?php echo $data['ID_Perbaikan']; ?>" name="IDP"  class="btn btn-secondary">Selengkapnya</button>
                        </form>
                      </div>
                </div>
              <?php endforeach; ?>
              <div style="height:450px; display:<?php if($indeks!=0) echo 'none';?>; "></div>
            </div>
            <!-- Close Pengaduan -->
        </div>
    </div>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script type="text/javascript" src="tooltip.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
  </body>
</html>