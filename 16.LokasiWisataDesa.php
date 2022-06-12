<?php

session_start();
include('connection.php');
if(isset($_POST['submit'])){
  $desa=$_POST['submit'];
  $wisatadesa=mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM lokasiwisata WHERE ID_Desa='$desa'"), MYSQLI_ASSOC);
  $namadesa=mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM desa WHERE ID_Desa='$desa'"), MYSQLI_ASSOC);
  $namacamat=mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM kecamatan WHERE ID_Kecamatan IN (SELECT ID_Kecamatan FROM desa WHERE ID_Desa='$desa')"), MYSQLI_ASSOC);
}
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
            <h3><i class="fas fa-building mr-2"></i>Desa <?php echo $namadesa['Nama_Desa']; ?></h3><p class="font-italic text-muted">Kepala Desa: <?php echo $namadesa['Nm_Kades']; ?><br>Kode Pos: <?php echo $namadesa['kode_post']; ?></p><hr>
            <a href="12.DetilDesa.php"><button type="submit" class="btn btn-success">Kembali</button></a>
            <div class="container py-5" >
              <div class="row text-center">
                <!-- Desa-->
                <?php foreach ($wisatadesa as $data) :
                  $indeks++;
                ?>
                <div class="col-xl-4 col-sm-6 mb-5" style="box-shadow: 0px 0px 10px grey;">
                  <div class="bg-white rounded shadow-sm py-5 px-4">
                    <div style="width: 100%; height: 200px; box-shadow: 0px 0px 2px lightgrey; display: flex; align-items: center; justify-content: center; margin-bottom:10px;">
                      <img src=<?php echo $data['Dokumentasi']; ?> alt="" width="200">
                    </div>
                    <h5 class="mb-0"><?php echo $data['Nama_Lokasi']; ?></h5>
                    <ul class="social mb-0 list-inline mt-3"> 
                      <form action="17.TelusuriLokasiWisata.php" method="post">
                        <button type="submit" class="btn btn-primary" name="IDL" value="<?php echo $data['ID_Lokasi']; ?>">Telusuri</button>
                      </form>
                    </ul>
                  </div>
                </div>
                <?php endforeach; ?>
                <div style="height:300px; display:<?php if($indeks!=0){ echo'none'; } ?>; width:100%;"><h5 style="text-align:center;">Tidak Ada Lokasi Wisata Pada Desa Ini</h5></div>
                <!-- End-->
        </div>
      </div>
      <script src="http://netdna.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
      <script type="text/javascript">   
      </script>
  </body>
</html>