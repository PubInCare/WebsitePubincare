<?php

session_start();
include('connection.php');
if(isset($_POST['IDL'])){
  $IDL=$_POST['IDL'];
  $_SESSION['IDL']=$IDL;
  $wisata=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM lokasiwisata WHERE ID_Lokasi='$IDL'"));
  $desa=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM desa WHERE ID_Desa IN (SELECT ID_Desa FROM lokasiwisata WHERE ID_Lokasi='$IDL')"));
  $IDD=$desa['ID_Desa'];
  $camat=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM kecamatan WHERE ID_Kecamatan IN (SELECT ID_Kecamatan FROM desa WHERE ID_Desa='$IDD')"));
  $koment=mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM komentar WHERE ID_Lokasi='$IDL'"), MYSQLI_ASSOC);
}else{
  $IDL=$_SESSION['IDL'];
  $wisata=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM lokasiwisata WHERE ID_Lokasi='$IDL'"));
  $desa=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM desa WHERE ID_Desa IN (SELECT ID_Desa FROM lokasiwisata WHERE ID_Lokasi='$IDL')"));
  $IDD=$desa['ID_Desa'];
  $camat=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM kecamatan WHERE ID_Kecamatan IN (SELECT ID_Kecamatan FROM desa WHERE ID_Desa='$IDD')"));
  $koment=mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM komentar WHERE ID_Lokasi='$IDL'"), MYSQLI_ASSOC);
}

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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Get Location</title>
    <style>
        th:hover a{
            background-color: white;
            color: #FFC312;
            text-decoration: none;
        }

        div.stars {
            width: 270px;
            display: inline-block;
        }

        input.star {
            display: none;
        }

        label.star {
            float: right;
            padding: 10px;
            font-size: 36px;
            color: #4A148C;
            transition: all .2s;
        }

        input.star:checked~label.star:before {
            content: '\f005';
            color: #FD4;
            transition: all .25s;
        }

        input.star-5:checked~label.star:before {
            color: #FE7;
            text-shadow: 0 0 20px #952;
        }

        input.star-1:checked~label.star:before {
            color: #F62;
        }

        label.star:hover {
            transform: rotate(-15deg) scale(1.3);
        }

        label.star:before {
            content: '\f006';
            font-family: fontAwesome;
        }
</style>
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
      <div class="col-md-10 p-5 pt-2">
        <h3><i class="fas fa-bus mr-2"></i><?php echo $wisata['Nama_Lokasi']; ?></h3><p class="font-italic text-muted">Kecamatan: <?php echo $camat['Nama_Kecamatan']; ?><br>Desa: <?php echo $desa['Nama_Desa']; ?></p><hr>
        <div class="container py-5">
            <h3>Location</h3>
            <?php echo $wisata['Link_Alamat']; ?>
            <br><br><br><br>
            <div class="panel"><h3>Komentar</h3></div>
            <div style="margin-top:80px; margin-left:-20px;">
            <?php foreach ($koment as $comm) : 
                  $IDuser=$comm['ID_User'];
                  $user=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE ID_User='$IDuser'"));
            ?>
              <div style="border:1px solid lightgreen; margin-bottom:0.5px; margin-left:15px; width:100%; display:flex; justify-contet:first; border-radius:10px; padding:5px;">
                <p style="font-weight:bolder;"><?php echo $user['Nama']; ?>:</p>
                <p><?php echo $comm['penjelasan']; ?></p>
                <div>(<i class="fa fa-star" aria-hidden="true"></i><?php echo $comm['rating']; ?>)</div>
              </div>
            <?php endforeach; ?>
            </div>
        </div>
    </body>
</html>
