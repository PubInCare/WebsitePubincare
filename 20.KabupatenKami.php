<?php

session_start();
include('connection.php');
  $IDA=$_SESSION['IDA'];
  $datakab=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM kabupaten WHERE ID_Kabupaten IN (SELECT ID_Kabupaten_Asal FROM adminkabupaten WHERE ID_Admin='$IDA')"));
  $kab=$datakab['Nama_kabupaten'];

  $sql = "SELECT * FROM pengadaan";
  $result = mysqli_query($conn, $sql);
  $datas1 = mysqli_fetch_all($result, MYSQLI_ASSOC);

  $sql = "SELECT * FROM perbaikan";
  $result = mysqli_query($conn, $sql);
  $datas2 = mysqli_fetch_all($result, MYSQLI_ASSOC);

  $sql = "SELECT * FROM pengaduan WHERE ID_Admin_Desa IN (SELECT ID_Admin FROM admindesa WHERE ID_Desa_Asal IN (SELECT ID_Desa FROM desa WHERE ID_Kecamatan IN (SELECT ID_Kecamatan FROM kecamatan WHERE ID_Kabupaten IN (SELECT ID_Kabupaten FROM kabupaten WHERE ID_Kabupaten IN (SELECT ID_Kabupaten_Asal FROM adminkabupaten WHERE ID_Admin='$IDA')))))";
  $result = mysqli_query($conn, $sql);
  $datas3 = mysqli_fetch_all($result, MYSQLI_ASSOC);

  $indeks=0; $jumlahaduankosong=0;
  $jumlahaduanyangada=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM aduanwarga"));
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
    <title>Kecamatan</title>
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
                <a class="nav-link active text-white" href="5.AdminKabupatenBeranda.php"><i class="fas fa-home mr-2"></i>Beranda</a><hr class="bg-secondary">
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="20.KabupatenKami.php" ><i class="fas fa-building mr-2"></i>Kabupaten Kami</a><hr class="bg-secondary">
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
                <div style="color:white; text-align:center; margin-top:10px;">ADMIN KABUPATEN<br><?php echo $_SESSION['kabupatenadmin']; ?><br><br><br>SIPI KLU</div>
              </li>
            </ul>
        </div>
        <div class="col-md-10 p-5 pt-2">
            <h3 style="text-transform: uppercase;"><i class="fas fa-building mr-2"></i>KECAMATAN <?php echo $datakab['Nama_kabupaten']; ?></h3><p class="font-italic text-muted">Kepala Camat : <?php echo $datakab['Nm_Bupati']; ?> <br>Kode Pos : <?php echo $datakab['Kode_Post']; ?></p><hr>
              <div class="row text-center">
                <!-- Daftar Aduan Desa -->
                <div class="container">
                  <h2 class="alert alert-warning text-center">DAFTAR ADUAN</h2>
                </div>
                <div class="container" style="margin-left:20px;">
                    <div class="row">
                    <?php 
                      foreach ($datas1 as $data) :
                        $IDPengadaan = $data['ID_Pengadaan'];
                        $hasilsql = mysqli_query($conn, "SELECT * FROM desa WHERE ID_Desa IN (SELECT ID_Desa_Asal FROM admindesa WHERE ID_Admin IN (SELECT ID_Admin_Desa FROM pengaduan WHERE ID_Pengaduan = '$IDPengadaan'))");
                        $Desa = mysqli_fetch_array($hasilsql, MYSQLI_ASSOC);
                        $NamaDesa = $Desa['Nama_Desa'];

                        $hasilsql = mysqli_query($conn, "SELECT * FROM kecamatan WHERE ID_Kecamatan IN (SELECT ID_Kecamatan from desa WHERE ID_Desa IN (SELECT ID_Desa_Asal FROM admindesa WHERE ID_Admin IN (SELECT ID_Admin_Desa FROM pengaduan WHERE ID_Pengaduan = '$IDPengadaan')))");
                        $Kecamatan = mysqli_fetch_array($hasilsql, MYSQLI_ASSOC);
                        $NamaKecamatan = $Kecamatan['Nama_Kecamatan'];

                        $hasilsql = mysqli_query($conn, "SELECT * FROM pengaduan WHERE ID_Pengaduan = '$IDPengadaan' AND ID_Admin_Desa IN (SELECT ID_Admin FROM admindesa WHERE ID_Desa_Asal IN (SELECT ID_Desa FROM desa WHERE ID_Kecamatan IN (SELECT ID_Kecamatan FROM kecamatan WHERE ID_Kabupaten IN (SELECT ID_Kabupaten FROM kabupaten WHERE ID_Kabupaten IN (SELECT ID_Kabupaten_Asal FROM adminkabupaten WHERE ID_Admin='$IDA')))))");
                        $Pengadaan = mysqli_fetch_array($hasilsql, MYSQLI_ASSOC);
                        $status = $Pengadaan['status'];
                        if($status=="TI"){
                          $status="Menunggu";
                        }else if($status=="VII"){
                          $status="Diterima";
                        }else if($status=="XII"){
                          $status="Ditolak";
                        }
                        // Filtering
                        $hasilsql=mysqli_query($conn, "SELECT * FROM pengadaan WHERE ID_Pengadaan IN (SELECT ID_Pengaduan FROM pengaduan WHERE ID_Pengaduan IN (SELECT ID_Pengaduan FROM aduanwarga WHERE ID_Camat_Tujuan IN (SELECT ID_Kecamatan_Asal FROM adminkecamatan WHERE ID_Admin = '$IDA')))");
                        if($hasilsql==null){
                          $cek='no';
                          $jumlahaduankosong++;
                        }else{
                          $cek='yes';
                          $indeks++;
                        }
                      ?>
                       <div class="card mr-5 text-center" style="width: 26rem; display:<?php if($cek=='no' || $status!='Menunggu'){ echo 'none'; } ?>; margin-bottom:20px;">
                            <img src=<?php echo $data['DokumentasiBukti'];?> class="card-img-top" alt="..." style="width:100%; height:300px;">
                                <div class="card-body">
                                  <h5 class="card-title">Pengaduan <?php echo $indeks?></h5>
                                  <p class="card-text">
                                    <span style="font-weight: bold; color: black;">Jenis Pengaduan : </span>Pengadaan<br>
                                    <span style="font-weight: bold; color: black;">Lokasi Pengaduan : </span>Desa <?php echo $NamaDesa; ?>, Kecamatan <?php echo $NamaKecamatan; ?>, Kabupaten Lombok Utara<br>
                                    <span style="font-weight: bold; color: black;">Status Pengaduan : </span><?php echo $status;?><br>
                                  </p>
                                  <div style="margin-bottom:10px; display:flex; justify-content:space-around;">
                                  <form action="20.KonfirmasiAduan.php" method="post">
                                    <button type="submit" class="btn btn-success" name="TerimaKab" value=<?php echo $data['ID_Pengadaan']; ?>><i class="fas fa-check mr-2"></i>Terima</button>
                                  </form>
                                  <form action="20.KonfirmasiAduan.php" method="post">
                                    <button type="submit" class="btn btn-danger" name="TolakKab" value=<?php echo $data['ID_Pengadaan']; ?>><i class="fas fa-times mr-2"></i>Tolak</button>
                                  </form>
                                  </div>
                                  <form action="9.DetilAduan.php" method="post">
                                    <button type="submit" value="<?php echo $data['ID_Pengadaan']; ?>" name="IDP"  class="btn btn-secondary">Selengkapnya</button>
                                  </form>
                                </div>
                          </div>
                        <?php endforeach; ?>
                        <?php 
                          foreach ($datas2 as $data) : 
                            $IDPerbaikan = $data['ID_Perbaikan'];
                            $hasilsql = mysqli_query($conn, "SELECT * FROM desa WHERE ID_Desa IN (SELECT ID_Desa_Asal FROM admindesa WHERE ID_Admin IN (SELECT ID_Admin_Desa FROM pengaduan WHERE ID_Pengaduan = '$IDPerbaikan'))");
                            $Desa = mysqli_fetch_array($hasilsql, MYSQLI_ASSOC);
                            $NamaDesa = $Desa['Nama_Desa'];
    
                            $hasilsql = mysqli_query($conn, "SELECT * FROM kecamatan WHERE ID_Kecamatan IN (SELECT ID_Kecamatan from desa WHERE ID_Desa IN (SELECT ID_Desa_Asal FROM admindesa WHERE ID_Admin IN (SELECT ID_Admin_Desa FROM pengaduan WHERE ID_Pengaduan = '$IDPerbaikan')))");
                            $Kecamatan = mysqli_fetch_array($hasilsql, MYSQLI_ASSOC);
                            $NamaKecamatan = $Kecamatan['Nama_Kecamatan'];

                            $hasilsql = mysqli_query($conn, "SELECT * FROM pengaduan WHERE ID_Pengaduan = '$IDPerbaikan' AND ID_Admin_Desa IN (SELECT ID_Admin FROM admindesa WHERE ID_Desa_Asal IN (SELECT ID_Desa FROM desa WHERE ID_Kecamatan IN (SELECT ID_Kecamatan FROM kecamatan WHERE ID_Kabupaten IN (SELECT ID_Kabupaten FROM kabupaten WHERE ID_Kabupaten IN (SELECT ID_Kabupaten_Asal FROM adminkabupaten WHERE ID_Admin='$IDA')))))");
                            $Pengadaan = mysqli_fetch_array($hasilsql, MYSQLI_ASSOC);
                            $status = $Pengadaan['status'];
                            if($status=="TI"){
                              $status="Menunggu";
                            }else if($status=="VII"){
                              $status="Diterima";
                            }else if($status=="XII"){
                              $status="Ditolak";
                            }
                            // Filtering
                            $hasilsql=mysqli_query($conn, "SELECT * FROM perbaikan WHERE ID_Perbaikan IN (SELECT ID_Pengaduan FROM pengaduan WHERE ID_Pengaduan IN (SELECT ID_Pengaduan FROM aduanwarga WHERE ID_Camat_Tujuan IN (SELECT ID_Kecamatan_Asal FROM adminkecamatan WHERE ID_Admin = '$IDA')))");
                            if($hasilsql==null){
                              $cek='no';
                              $jumlahaduankosong++;
                            }else{
                              $cek='yes';
                              $indeks++;
                            }
                          ?>
                          <div class="card mr-5 text-center" style="width: 26rem; display:<?php if($cek=='no' || $status!='Menunggu'){ echo 'none'; } ?>; margin-bottom:20px;">
                            <img src=<?php echo $data['DokumentasiBukti'];?> class="card-img-top" alt="..." style="width:100%; height:300px;">
                                <div class="card-body">
                                  <h5 class="card-title">Pengaduan <?php echo $indeks?></h5>
                                  <p class="card-text">
                                    <span style="font-weight: bold; color: black;">Jenis Pengaduan : </span>Perbaikan<br>
                                    <span style="font-weight: bold; color: black;">Lokasi Pengaduan : </span>Desa <?php echo $NamaDesa; ?>, Kecamatan <?php echo $NamaKecamatan; ?>, Kabupaten Lombok Utara<br>
                                    <span style="font-weight: bold; color: black;">Status Pengaduan : </span><?php echo $status;?><br>
                                  </p>
                                  <div style="margin-bottom:10px; display:flex; justify-content:space-around;">
                                  <form action="20.KonfirmasiAduan.php" method="post">
                                    <button type="submit" class="btn btn-success" name="TerimaKab" value=<?php echo $data['ID_Perbaikan']; ?>><i class="fas fa-check mr-2"></i>Terima</button>
                                  </form>
                                  <form action="20.KonfirmasiAduan.php" method="post">
                                    <button type="submit" class="btn btn-danger" name="TolakKab" value=<?php echo $data['ID_Perbaikan']; ?>><i class="fas fa-times mr-2"></i>Tolak</button>
                                  </form>
                                  </div>
                                  <form action="9.DetilAduan.php" method="post">
                                    <button type="submit" value="<?php echo $data['ID_Perbaikan']; ?>" name="IDP"  class="btn btn-secondary">Selengkapnya</button>
                                  </form>
                                </div>
                          </div>
                          <?php endforeach; ?>
                          <h5 style="margin-left:275px; display:<?php if($jumlahaduankosong!=$jumlahaduanyangada){ echo 'none'; } ?>;">Aduan Tidak Tersedia pada Halaman Desa Ini</h5>
                        </div>
                      </div>
                <!-- End --> 
                <div class="container" style="margin-top:20px;">
                  <h2 class="alert alert-warning text-center">ADUAN DESA TERKONFIRMASI</h2>
                </div>
                <!-- Aduan Diterima-->
                <div class="col-xl-4 col-sm-6 mb-5" style="box-shadow:0px 0px 5px lightgrey; box-sizing:border-box; padding:5px; margin-left:120px;"> 
                  <div style="" ><h5>Aduan Diterima</h5><hr></div>
                  <?php foreach ($datas3 as $data) : ?>
                  <div style="display:<?php if($data['status']=='VII'){ echo 'flex'; }else{ echo 'none'; } ?>; flex-direction:row; justify-content:space-between; margin-bottom:5px;">
                    <p class="mb-0">ID Pengaduan : <?php echo $data['ID_Pengaduan']; ?></p>
                  </div>
                  <?php endforeach; ?>
                </div>
                <!-- End-->
                <!-- Aduan Ditolak-->
                <div class="col-xl-4 col-sm-6 mb-5" style="box-shadow:0px 0px 5px lightgrey; box-sizing:border-box; padding:5px; margin-left:100px;"> 
                  <div style="" ><h5>Aduan Ditolak</h5><hr></div>
                  <?php foreach ($datas3 as $data) : ?>
                  <div style="display:<?php if($data['status']=='XII'){ echo 'flex'; }else{ echo 'none'; } ?>; flex-direction:row; justify-content:space-between; margin-bottom:5px;">
                    <p class="mb-0">ID Pengaduan : <?php echo $data['ID_Pengaduan']; ?></p>
                    <form action="20.KonfirmasiAduan.php" method="post">
                      <button type="submit" style="border:none; background-color:white; box-shadow:0px 0px 3px lightgrey;" name="urungkanKab" value=<?php echo $data['ID_Pengaduan']; ?>>Urungkan</button>
                    </form>
                  </div>
                  <?php endforeach; ?>
                </div>
                <!-- End-->
                <div style="height:300px;"></div>
            </body>