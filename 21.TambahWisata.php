<?php

session_start();
include('connection.php');
$jumlah=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM lokasiwisata"));
$jumlah++;
if(isset($_POST['desa'])){
  $_SESSION['DesaTujuanTambahWisata']=$_POST['desa'];
}else if(isset($_POST['submit'])){
  $IDL=$_POST['submit'];
  $desa=$_SESSION['desaasaltujuan'];
  $nama=$_POST['nama'];
  $alamat=$_POST['alamat'];
  // Image
  $filename = $_FILES['image']['name'];
  $foldername = $_FILES['image']['tmp_name'];
  $folder = "image/".$filename;
  //Cek Ekstensi
  $ekstensivalid = ['jpg', 'jpeg', 'png'];
  $ekstensigambar = explode('.',$filename);
  $ekstensigambar = strtolower(end($ekstensigambar));
  //Uniq
  $fileuniq = uniqid();
  $fileuniq .= ".";
  $fileuniq .= $ekstensigambar;
  $folder = "image/".$fileuniq;
  if(in_array($ekstensigambar,$ekstensivalid)){
    move_uploaded_file($foldername, $folder);
    $query = "INSERT INTO lokasiwisata VALUES ('$IDL', '$nama', '$desa', '$alamat','$folder')";
      if (mysqli_query($conn, $query)) {
          header('Location: 5.AdminBeranda.php');
      }
  }else{
    header('Location: 20.DesaKami.php?error=eror');
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
    <div class="row no-gutters mt-5" style="display:flex; justify-content:center;">
        <div class="col-md-10 p-5 pt-2">
            <h3><i class="fas fa-bus mr-2"></i>Lokasi Wisata</h3><hr>
            <div class="row text-dark">
            <div class="container">
              <h2 class="alert alert-warning text-center">TAMBAH LOKASI WISATA</h2>
              <?php 
                if(isset($_GET['error'])){
                  echo 'Waring : '.$_GET['error'];
                }
              ?>
              <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label>Nama Lokasi</label>
                  <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Lokasi Wisata">
                </div>
                 <div class="form-group">
                    <label>Link Alamat</label>
                    <textarea class="form-control" rows="5" name="alamat"></textarea>
                    <small>Gunakan tautan berikut untuk mencari lokasi : <a href="https://maps.google.com/" target="_blank">link</a></small>
                    <small>*Pastikan link yang dikirim adalah link untuk mencetak elemen pada html</small>
                  </div>
                  <div class="form-group">
                    <label>Upload Dokumentasi Lokasi Wisata</label>
                    <input type="file" class="form-control-file" name="image">
                    <small>Ukuran File Maksimal 20MB</small>
                  </div>
                  <div class="text-center">
                    <button type="submit" value=<?php echo $jumlah ?> class="btn btn-success" name="submit">Ajukan</button>
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
  </body>
</html>