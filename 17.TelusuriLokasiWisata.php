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
  $rata=mysqli_fetch_assoc(mysqli_query($conn, "SELECT AVG(rating) as rating FROM komentar WHERE ID_Lokasi='$IDL'"));
}else{
  $IDL=$_SESSION['IDL'];
  $wisata=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM lokasiwisata WHERE ID_Lokasi='$IDL'"));
  $desa=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM desa WHERE ID_Desa IN (SELECT ID_Desa FROM lokasiwisata WHERE ID_Lokasi='$IDL')"));
  $IDD=$desa['ID_Desa'];
  $camat=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM kecamatan WHERE ID_Kecamatan IN (SELECT ID_Kecamatan FROM desa WHERE ID_Desa='$IDD')"));
  $koment=mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM komentar WHERE ID_Lokasi='$IDL'"), MYSQLI_ASSOC);
  $rata=mysqli_fetch_assoc(mysqli_query($conn, "SELECT AVG(rating) as rating FROM komentar WHERE ID_Lokasi='$IDL'"));
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
        <h3><i class="fas fa-bus mr-2"></i><?php echo $wisata['Nama_Lokasi']; ?></h3><p class="font-italic text-muted">Kecamatan: <?php echo $camat['Nama_Kecamatan']; ?><br>Desa: <?php echo $desa['Nama_Desa']; ?></p><hr>
        <div class="container py-5">
        <div style="margin-top:-50px; margin-bottom:20px; margin-left:-10px;">
          <a href="12.DetilDesa.php"><button type="submit" class="btn btn-success">Kembali</button></a>
        </div>
            <h3>Location</h3>
            <?php echo $wisata['Link_Alamat']; ?>
            <br><br><br><br>
            <div style="box-shadow:0px 0px 2px lightgrey; height:300px; box-sizing:border-box; padding:15px;">
              <form action="15.TambahKomentar.php" method="post"> 
              <h3>Rating</h3>
              <div class="container d-flex justify-content-center mt-200">
                  <div class="row">
                      <div class="col-md-12">
                          <div class="stars">
                              <input class="star star-5" value=5 id="star-5" type="radio" name="star"> 
                              <label class="star star-5" for="star-5"></label> 
                              <input class="star star-4" value=4 id="star-4" type="radio" name="star"> 
                              <label class="star star-4" for="star-4"></label> 
                              <input class="star star-3" value=3 id="star-3" type="radio" name="star"> 
                              <label class="star star-3" for="star-3"></label> 
                              <input class="star star-2" value=2 id="star-2" type="radio" name="star"> 
                              <label class="star star-2" for="star-2"></label> 
                              <input class="star star-1" value=1 id="star-1" type="radio" name="star"> 
                              <label class="star star-1" for="star-1"></label> 
                          </div>
                      </div>
                  </div>
              </div>
              <div class="panel">
                <h3>Komentar</h3>
                <textarea placeholder="Apa pendapat anda tentang tempat wisata ini?" rows="2" class="form-control input-lg p-text-area" name="komentar"></textarea>
                <button type="submit" name="wisata" value=<?php echo $IDL; ?> class="btn btn-warning pull-right" style="text-align:center">Post</button>
              </div>
              </form>
            </div>
            <br>
            <h2>Rating : <i class="fa fa-star" aria-hidden="true"></i><?php echo $rata['rating']; ?></h2>
            <div style="margin-top:80px; margin-left:-20px;">
            <?php foreach ($koment as $comm) : 
                  $IDuser=$comm['ID_User'];
                  $user=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE ID_User='$IDuser'"));
            ?>
              <div style="border:1px solid lightgreen; margin-bottom:0.5px; margin-left:15px; width:100%; display:flex; justify-contet:first; border-radius:10px; padding:5px;">
                <p style="font-weight:bolder;"><?php echo $user['Nama']; ?>:</p>
                <p><?php echo $comm['penjelasan']; ?></p>
                <div>(<i class="fa fa-star" aria-hidden="true"></i><?php echo $comm['rating']; ?>)</div>
                <form action="15.TambahKomentar.php" method="post">
                  <button type="submit" value=<?php echo $comm['IDK']; ?> name="hapuscommwisata" style="border:none; background-color:white; color:red; display:<?php if($comm['ID_User']!=$_SESSION['IDU']){ echo 'none'; } ?>;" >Hapus</button>
                </form>
              </div>
            <?php endforeach; ?>
            </div>
        </div>
    </body>
</html>
