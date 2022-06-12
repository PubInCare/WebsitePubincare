<?php

session_start();
include('connection.php');

if(isset($_POST['desa'])){
  $desa=$_POST['desa'];
  $_SESSION['caridesa']=$desa;
}
  $desa=$_SESSION['caridesa'];
  $sql=mysqli_query($conn, "SELECT * FROM kecamatan WHERE ID_Kecamatan IN (SELECT ID_Kecamatan FROM desa WHERE ID_Desa='$desa')");
  $result = mysqli_fetch_assoc($sql);
  $camat=$result['Nama_Kecamatan'];

  $sql=mysqli_query($conn, "SELECT * FROM desa WHERE ID_Desa='$desa'");
  echo mysqli_error($conn);
  $datadesa = mysqli_fetch_assoc($sql);
  $namadesa=$datadesa['Nama_Desa'];

  $sql = "SELECT * FROM pengadaan";
  $result = mysqli_query($conn, $sql);
  $datas1 = mysqli_fetch_all($result, MYSQLI_ASSOC);

  $sql = "SELECT * FROM perbaikan";
  $result = mysqli_query($conn, $sql);
  $datas2 = mysqli_fetch_all($result, MYSQLI_ASSOC);

  $koment=mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM komentar WHERE ID_Desa='$desa'"), MYSQLI_ASSOC);

$indeks=0; $jumlahaduankosong=0;
$jumlahaduanyangada=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pengaduan"));
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
    <title>Daftar Desa</title>
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
            <h3 style="text-transform: uppercase;"><i class="fas fa-building mr-2"></i>DESA <?php echo $namadesa ?></h3><p class="font-italic text-muted">Kepala Desa : <?php echo $datadesa['Nm_Kades']; ?> <br>Kode Pos : <?php echo $datadesa['kode_post']; ?></p><hr>
              <div class="row mb-4">
                <div class="col-lg-5">
                  <h2 class="display-4 font-weight-light">Detil Desa</h2>
                  <a href="11.Desa.php"><button type="submit" class="btn btn-success">Kembali</button></a>
                </div>
              </div>
              <div class="row text-center">
              <br><br><br>
              <div class="row text-center">
                <!-- Pengadaan-->
                <div class="col-xl-4 col-sm-6 mb-5">
                  <div class="bg-white rounded shadow-sm py-5 px-4"><img src="./Pengadaan.jpg" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                    <h5 class="mb-0">Pengadaan Infrastruktur</h5>
                    <ul class="social mb-0 list-inline mt-3"> 
                      <div>
                        <form action="7.FormPengadaan.php" method="post">
                          <button type="submit" class="btn btn-success" name="aduan" value="N2021-">Ajukan</button>
                        </form>
                      </div>
                    </ul>
                  </div>
                </div>
                <!-- End-->
                <!-- Perbaikanu-->
                <div class="col-xl-4 col-sm-6 mb-5">
                  <div class="bg-white rounded shadow-sm py-5 px-4"><img src="./Perbaikan.jpg" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                    <h5 class="mb-0">Perbaikan Infrastruktur</h5>
                    <ul class="social mb-0 list-inline mt-3">
                      <div>
                        <form action="8.FormPerbaikan.php" method="post">
                          <button type="submit" class="btn btn-success" name="aduan" value="R2021-">Ajukan</button>
                        </form>
                      </div>
                    </ul>
                  </div>
                </div>
                <!-- End-->
                <!-- Lokasi Wisata-->
                <div class="col-xl-4 col-sm-6 mb-5">
                  <div class="bg-white rounded shadow-sm py-5 px-4"><img src="./Wisata.jpg" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                    <h5 class="mb-0">Lokasi Wisata</h5>
                    <ul class="social mb-0 list-inline mt-3">
                      <div>
                        <form action="16.LokasiWisataDesa.php" method="post">
                          <button type="submit" class="btn btn-success" name="submit" value=<?php echo $desa; ?>>Lihat</button>
                        </form>
                      </div>
                    </ul>
                  </div>
                </div>
                <!-- End-->
                <div class="container py-5"><h3>Daftar Aduan Dalam Desa</h3></div>
                <!-- Aduan -->
                <div class="row text-dark" style="margin-left:18px;">
                  <?php 
                  foreach ($datas1 as $data) :
                    $indeks++;
                    $IDPengadaan = $data['ID_Pengadaan'];
                    $hasilsql = mysqli_query($conn, "SELECT * FROM pengaduan WHERE ID_Pengaduan = '$IDPengadaan'");
                    $Pengadaan = mysqli_fetch_array($hasilsql, MYSQLI_ASSOC);
                    $status = $Pengadaan['status'];
                    if($status=="T"){
                      $status="Diteruskan";
                    }else if($status=="V"){
                      $status="Diterima";
                    }else if($status=="X"){
                      $status="Ditolak";
                    }else{
                      $status="Menunggu";
                    }
                    // Filtering
                    $hasilsql=mysqli_query($conn, "SELECT * FROM admindesa WHERE ID_Desa_Asal='$desa'");
                    while($record=mysqli_fetch_array($hasilsql)){
                      if($record['ID_Admin']==$Pengadaan['ID_Admin_Desa']){
                        $cek='yes';
                      }else{
                        $cek='no';
                        $jumlahaduankosong++;
                      }
                    }
                  ?>
                    <div class="card mr-4" style="width: 18rem; display:<?php if($cek=='no'){ echo 'none'; } ?>;">
                      <img src=<?php echo $data['DokumentasiBukti'];?> class="card-img-top" style="width: 100%; height: 190px;" alt="...">
                          <div class="card-body">
                            <h5 class="card-title">Pengaduan <?php echo $indeks?></h5>
                            <p class="card-text">
                              <span style="font-weight: bold; color: black;">Jenis Pengaduan : </span>Pengadaan<br>
                              <span style="font-weight: bold; color: black;">Lokasi Pengaduan : </span>Desa <?php echo $namadesa; ?>, Kecamatan <?php echo $camat; ?>, Kabupaten Lombok Utara<br>
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
                    $hasilsql = mysqli_query($conn, "SELECT * FROM pengaduan WHERE ID_Pengaduan = '$IDPerbaikan'");
                    $Pengadaan = mysqli_fetch_array($hasilsql, MYSQLI_ASSOC);
                    $status = $Pengadaan['status'];
                    if($status=="T"){
                      $status="Diteruskan";
                    }else if($status=="V"){
                      $status="Diterima";
                    }else if($status=="X"){
                      $status="Ditolak";
                    }else{
                      $status="Menunggu";
                    }
                    // Filtering
                    $hasilsql=mysqli_query($conn, "SELECT * FROM admindesa WHERE ID_Desa_Asal='$desa'");
                    while($record=mysqli_fetch_array($hasilsql)){
                      if($record['ID_Admin']==$Pengadaan['ID_Admin_Desa']){
                        $cek='yes';
                      }else{
                        $cek='no';
                        $jumlahaduankosong++;
                      }
                    }
                  ?>
                    <div class="card mr-4" style="width: 18rem; display:<?php if($cek=='no'){ echo 'none'; } ?>;">
                      <img src=<?php echo $data['DokumentasiBukti'];?> class="card-img-top" style="width: 100%; height: 190px;" alt="...">
                          <div class="card-body">
                            <h5 class="card-title">Pengaduan <?php echo $indeks?></h5>
                            <p class="card-text">
                              <span style="font-weight: bold; color: black;">Jenis Pengaduan : </span>Perbaikan<br>
                              <span style="font-weight: bold; color: black;">Lokasi Pengaduan : </span>Desa <?php echo $namadesa; ?>, Kecamatan <?php echo $camat; ?>, Kabupaten Lombok Utara<br>
                              <span style="font-weight: bold; color: black;">Status Pengaduan : </span><?php echo $status;?><br>
                            </p>
                            <form action="9.DetilAduan.php" method="post">
                              <button type="submit" value="<?php echo $data['ID_Perbaikan']; ?>" name="IDP"  class="btn btn-secondary">Selengkapnya</button>
                            </form>
                          </div>
                    </div>
                  <?php endforeach; ?>
              <h5 style="margin-left:275px; display:<?php if($jumlahaduankosong!=$jumlahaduanyangada){ echo 'none'; } ?>;">Aduan Tidak Tersedia pada Halaman Desa Ini</h5>
            </div>
                <!-- End -->
                <!-- Komentar -->
                <div class="container py-5">
                  <h3>Komentar</h3>
                  <form action="15.TambahKomentar.php" method="post">
                  <div class="panel" style="display: flex; flex-direction: column; justify-content: left;">
                    <textarea placeholder="Apa pendapat anda tentang Desa ini?" rows="2" name="komentar" class="form-control input-lg p-text-area"></textarea>
                    <button type="submit" value=<?php echo $desa; ?> class="btn btn-warning pull-right" style="width: 60px;" name="submit">Post</button>
                  </div>
                  </form>
                </div>
                <?php foreach ($koment as $comm) : 
                  $IDuser=$comm['ID_User'];
                  $user=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE ID_User='$IDuser'"));
                ?>
                  <div style="border:1px solid green; margin-left:15px; width:100%; display:flex; justify-contet:first; border-radius:10px; padding:5px;">
                    <p style="font-weight:bolder;"><?php echo $user['Nama']; ?>:</p>
                    <p><?php echo $comm['penjelasan']; ?></p>
                    <form action="15.TambahKomentar.php" method="post">
                      <button type="submit" value=<?php echo $comm['IDK']; ?> name="hapuscommdesa" style="border:none; background-color:white; color:red; display:<?php if($comm['ID_User']!=$_SESSION['IDU']){ echo 'none'; } ?>;" >Hapus</button>
                    </form>

                  </div>
                <?php endforeach; ?>
                <!-- End -->
            </body>