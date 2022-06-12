<?php

session_start();
include('connection.php');
if(isset($_POST['aduan'])){
  $_SESSION['desa_aduan']=$_SESSION['caridesa'];
  $_SESSION['IDP']=$_POST['aduan'];
  $hasil = mysqli_query($conn, "SELECT * from perbaikan");
  $jumlah = mysqli_num_rows($hasil);
  $jumlah++;
  $_SESSION['IDP']=$_SESSION['IDP'].$jumlah;
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
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="user.css">
    <title>Perbaikan Infrastruktur</title>
    <style>
      button {
        background-color: #04AA6D;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        opacity: 0.9;
      }
      .cancelbtn, .deletebtn {
        float: left;
        width: 50%;
      }
      .cancelbtn {
        background-color: #ccc;
        color: black;
      }
      .deletebtn {
        background-color:rgb(10, 163, 10);
      }
      .container_modal {
        padding: 16px;
        text-align: center;
      }
      .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 5; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: #474e5d;
        padding-top: 50px;
      }
      .modal-content {
        background-color: #fefefe;
        margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
        border: 1px solid #888;
        width: 40%; /* Could be more or less, depending on screen size */
      }
      .clearfix::after {
        content: "";
        clear: both;
        display: table;
      }
      .ajukan{
        background-color:rgb(10, 163, 10); 
        color:white; 
        height:40px; 
        display:flex; 
        align-items:center; 
        justify-content:center; 
        cursor:pointer;
      }
      .ajukan:hover{
        background-color:rgb(6, 255, 6); 
      }
    </style>
  </head>
  <body>
  <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-warning" style="display:flex; justify-content:space-between; z-index: 1;">
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
              <h2 class="alert alert-warning text-center">FORM PENGADUAN PERBAIKAN</h2>
              <form action="8.FormPerbaikanAct.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label>Nama Fasilitas</label>
                  <input type="text" name="namafasilitas" class="form-control" placeholder="Masukan Nama Fasilitas Yang Diajukan">
                </div>
                <div class="form-group">
                  <label>Jumlah Fasilitas</label>
                  <input type="text" name="jumlah" class="form-control" placeholder="Masukan Jumlah Fasilitas Yang Diinginkan">
                  <div class="form-group">
                    <label>Alasan Pengadaan</label>
                    <textarea class="form-control" rows="5" name="alasan"></textarea>
                  </div>
                  <div class="form-group">
                    <label>Kondisi Fasilitas Saat Ini</label>
                    <textarea class="form-control" rows="5" name="kondisi"></textarea>
                  </div>
                  <div class="form-group">
                    <label>Upload Dokumentasi Fasilitas/Lokasi Perbaikan</label>
                    <input type="file" class="form-control-file" name="imgaduan">
                    <small>Ukuran File Maksimal 20MB</small>
                  </div>
                  <div class="text-center">
                    <div class="ajukan" onclick="document.getElementById('id01').style.display='block'">Ajukan</div>
                    <div id="id01" class="modal">
                      <div class="modal-content"> 
                        <h1>Aduan Perbaikan</h1>
                        <p>Apakah Anda Yakin Ingin Mengirimkan Aduan Ini ?</p>
                          <div class="container_modal">
                            <div class="clearfix">
                              <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Batalkan</button>
                              <button type="submit" name="submit" class="deletebtn">Yakin</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </form>
            </div>


<script>
var modal = document.getElementById('id01');
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
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