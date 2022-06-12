<?php
  session_start();
  include('connection.php');

	if(isset($_GET['error'])){
		$eror = $_GET['error'];
	}

  if(isset($_POST['kec'])){
    $Camat=$_POST['kec'];
    $sql = mysqli_query($conn, "SELECT * FROM desa WHERE ID_Kecamatan = '$Camat'");
    $desas = mysqli_fetch_all($sql, MYSQLI_ASSOC);
  }
  $sql = "SELECT * FROM kecamatan";
  $result = mysqli_query($conn, $sql);
  $datas = mysqli_fetch_all($result, MYSQLI_ASSOC);

  if(isset($_POST['JenisAduan'])){
    $_SESSION['desa_aduan'] = $_POST['DesaAduan'];
    $IDP = $_POST['JenisAduan'];
    if($IDP=="N2021-"){
      $hasil = mysqli_query($conn, "SELECT * from pengadaan");
      $cek=false;
      $jumlah=1;
      while($cek==false){
        $ID=$IDP.$jumlah;
        $cek=true;
        while($row = mysqli_fetch_array($hasil, MYSQLI_ASSOC)){
          if($ID==$row['ID_Pengadaan']){
            $cek=false;
            $jumlah++;
            break;
          }
        }
      }
      $_SESSION['IDP']=$IDP.$jumlah;
      $IDP=$_SESSION['IDP'];
      header('Location: 7.FormPengadaan.php');
    }else{
      $hasil = mysqli_query($conn, "SELECT * from perbaikan");
      $cek=false;
      $jumlah=1;
      while($cek==false){
        $ID=$IDP.$jumlah;
        $cek=true;
        while($row = mysqli_fetch_array($hasil, MYSQLI_ASSOC)){
          if($ID==$row['ID_Perbaikan']){
            $cek=false;
            $jumlah++;
            break;
          }
        }
      }
      $_SESSION['IDP']=$IDP.$jumlah;
      $IDP=$_SESSION['IDP'];
      header('Location: 8.FormPerbaikan.php');
    }
  }

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

    <title>Pengadaan Infrastruktur</title>
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
            <h3><i class="fas fa-envelope mr-2"></i>Pengaduan</h3><hr>
            <div class="row text-dark">
            <div class="container">
              <h2 class="alert alert-warning text-center">FORM PENGADUAN</h2>
              <form action="" method="post">
                <div class="form-group">
                  <label>Kecamatan Tujuan</label>
                  <select class="form-control" name="kec" required>
                    <option selected disabled hidden>Klik Disini</option>
                    <?php foreach ($datas as $data) : ?>
                      <option value=<?php echo $data['ID_Kecamatan']; ?> <?php if (isset($Camat) && $data['ID_Kecamatan']==$Camat){ echo "selected"; }?>><?php echo $data['Nama_Kecamatan']; ?></option>
                    <?php endforeach; ?>
                  </select>
                  <button type="submit" class="btn btn-success" style="margin-top:5px; margin-botton:5px;">Simpan Kecamatan</button>
              </form>
              <form action="" method="post">
                  <label>Desa Tujuan</label>
                  <select class="form-control" name="DesaAduan" required>
                    <option selected disabled hidden>Klik Disini</option>
                    <?php foreach ($desas as $desa) : ?>
                      <option value=<?php echo $desa['ID_Desa']; ?>> <?php echo $desa['Nama_Desa']; ?> </option>
                    <?php endforeach; ?>
                  </select>
                  <label>Jenis Pengaduan</label>
                  <select class="form-control" name="JenisAduan" required>
                    <option selected disabled hidden>Klik Disini</option>
                    <option value="N2021-">Pengadaan</option>
                    <option value="R2021-">Perbaikan</option>
                  </select>
                  <br>
                  <div class="text-center">
                    <button type="submit" class="btn btn-success" name="Aduan">Ajukan</button>
                  </div>
                </div>
            </form>
            </div>
                
    <!-- Optional JavaScript; choose one of the two! -->

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
    <div style="height:450px;"></div>
  </body>
</html>