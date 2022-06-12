<?php

session_start();
include('connection.php');
  $IDA=$_SESSION['IDA'];
  $datadesa=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM desa WHERE ID_Desa IN (SELECT ID_Desa_Asal FROM admindesa WHERE ID_Admin='$IDA')"));
  $desa=$datadesa['ID_Desa'];
  $namadesa=$datadesa['Nama_Desa'];
  $_SESSION['desaasaltujuan']=$desa;
  $sql=mysqli_query($conn, "SELECT * FROM kecamatan WHERE ID_Kecamatan IN (SELECT ID_Kecamatan FROM desa WHERE ID_Desa='$desa')");
  $result = mysqli_fetch_assoc($sql);
  $camat=$result['Nama_Kecamatan'];
  $_SESSION['camattujuanaduan'] = $result['ID_Kecamatan'];

  $sql = "SELECT * FROM pengadaan";
  $result = mysqli_query($conn, $sql);
  $datas1 = mysqli_fetch_all($result, MYSQLI_ASSOC);

  $sql = "SELECT * FROM perbaikan";
  $result = mysqli_query($conn, $sql);
  $datas2 = mysqli_fetch_all($result, MYSQLI_ASSOC);

  $sql = "SELECT * FROM pengaduan WHERE ID_Admin_Desa ='$IDA'";
  $result = mysqli_query($conn, $sql);
  $datas3 = mysqli_fetch_all($result, MYSQLI_ASSOC);

  $datas4 = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM lokasiwisata WHERE ID_Desa='$desa'"), MYSQLI_ASSOC);

  $koment=mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM komentar WHERE ID_Desa='$desa' OR ID_Lokasi IN (SELECT ID_Lokasi FROM lokasiwisata WHERE ID_Desa='$desa')"), MYSQLI_ASSOC);

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
    <title>Aduan Desa</title>
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
                <a class="nav-link active text-white" href="5.AdminBeranda.php"><i class="fas fa-home mr-2"></i>Beranda</a><hr class="bg-secondary">
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="20.DesaKami.php" ><i class="fas fa-building mr-2"></i>Desa Kami</a><hr class="bg-secondary">
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
                <div style="color:white; text-align:center; margin-top:10px;">ADMIN DESA<br><?php echo $_SESSION['desaadmin'] ?><br><br><br>SIPI KLU</div>
              </li>
            </ul>
        </div>
        <div class="col-md-10 p-5 pt-2">
            <h3 style="text-transform: uppercase;"><i class="fas fa-building mr-2"></i>DESA <?php echo $datadesa['Nama_Desa']; ?></h3><p class="font-italic text-muted">Kepala Desa : <?php echo $datadesa['Nm_Kades']; ?> <br>Kode Pos : <?php echo $datadesa['kode_post']; ?></p><hr>
              <div class="row text-center">
                <!-- Daftar Aduan Desa -->
                <div class="container">
                  <h2 class="alert alert-warning text-center">DAFTAR ADUAN DESA</h2>
                </div>
                <div class="container" style="margin-left:20px;">
                    <div class="row">
                    <?php 
                      foreach ($datas1 as $data) :
                        $IDPengadaan = $data['ID_Pengadaan'];
                        $hasilsql = mysqli_query($conn, "SELECT * FROM pengaduan WHERE ID_Pengaduan = '$IDPengadaan'");
                        $Pengadaan = mysqli_fetch_array($hasilsql, MYSQLI_ASSOC);
                        $status = $Pengadaan['status'];
                        if($status=="" || $status==null){
                          $status="Menunggu";
                        }else if($status=="V"){
                          $status="Diterima";
                        }else if($status=="X"){
                          $status="Ditolak";
                        }else{
                          $status="Diteruskan";
                        }
                        // Filtering
                        $hasilsql=mysqli_query($conn, "SELECT * FROM admindesa WHERE ID_Desa_Asal='$desa'");
                        while($record=mysqli_fetch_array($hasilsql)){
                          if($record['ID_Admin']==$Pengadaan['ID_Admin_Desa']){
                            $cek='yes';
                            $indeks++;
                          }else{
                            $cek='no';
                            $jumlahaduankosong++;
                          }
                        }
                      ?>
                       <div class="card mr-5 text-center" style="width: 26rem; display:<?php if($cek=='no' || $status!='Menunggu'){ echo 'none'; } ?>; margin-bottom:20px;">
                            <img src=<?php echo $data['DokumentasiBukti'];?> class="card-img-top" alt="..." style="width:100%; height:300px;">
                                <div class="card-body">
                                  <h5 class="card-title">Pengaduan <?php echo $indeks?></h5>
                                  <p class="card-text">
                                    <span style="font-weight: bold; color: black;">Jenis Pengaduan : </span>Pengadaan<br>
                                    <span style="font-weight: bold; color: black;">Lokasi Pengaduan : </span>Desa <?php echo $namadesa; ?>, Kecamatan <?php echo $camat; ?>, Kabupaten Lombok Utara<br>
                                    <span style="font-weight: bold; color: black;">Status Pengaduan : </span><?php echo $status;?><br>
                                  </p>
                                  <div style="margin-bottom:10px; display:flex; justify-content:space-around;">
                                  <form action="20.KonfirmasiAduan.php" method="post">
                                    <button type="submit" class="btn btn-success" name="Terima" value=<?php echo $data['ID_Pengadaan']; ?>><i class="fas fa-check mr-2"></i>Terima</button>
                                  </form>
                                  <form action="20.KonfirmasiAduan.php" method="post">
                                    <button type="submit" class="btn btn-danger" name="Tolak" value=<?php echo $data['ID_Pengadaan']; ?>><i class="fas fa-times mr-2"></i>Tolak</button>
                                  </form>
                                  <form action="20.KonfirmasiAduan.php" method="post">
                                    <button type="submit" class="btn btn-primary" name="Teruskan" value=<?php echo $data['ID_Pengadaan']; ?>><i class="fas fa-share-square mr-2"></i>Teruskan</button>
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
                            $hasilsql = mysqli_query($conn, "SELECT * FROM pengaduan WHERE ID_Pengaduan = '$IDPerbaikan'");
                            $Pengadaan = mysqli_fetch_array($hasilsql, MYSQLI_ASSOC);
                            $status = $Pengadaan['status'];
                            if($status=="" || $status==null){
                              $status="Menunggu";
                            }else if($status=="V"){
                              $status="Diterima";
                            }else if($status=="X"){
                              $status="Ditolak";
                            }else{
                              $status="Diteruskan";
                            }
                            // Filtering
                            $hasilsql=mysqli_query($conn, "SELECT * FROM admindesa WHERE ID_Desa_Asal='$desa'");
                            while($record=mysqli_fetch_array($hasilsql)){
                              if($record['ID_Admin']==$Pengadaan['ID_Admin_Desa']){
                                $cek='yes';
                                $indeks++;
                              }else{
                                $cek='no';
                                $jumlahaduankosong++;
                              }
                            }
                          ?>
                          <div class="card mr-5 text-center" style="width: 26rem; display:<?php if($cek=='no' || $status!='Menunggu'){ echo 'none'; } ?>; margin-bottom:20px;">
                            <img src=<?php echo $data['DokumentasiBukti'];?> class="card-img-top" alt="..." style="width:100%; height:300px;">
                                <div class="card-body">
                                  <h5 class="card-title">Pengaduan <?php echo $indeks?></h5>
                                  <p class="card-text">
                                    <span style="font-weight: bold; color: black;">Jenis Pengaduan : </span>Perbaikan<br>
                                    <span style="font-weight: bold; color: black;">Lokasi Pengaduan : </span>Desa <?php echo $namadesa; ?>, Kecamatan <?php echo $camat; ?>, Kabupaten Lombok Utara<br>
                                    <span style="font-weight: bold; color: black;">Status Pengaduan : </span><?php echo $status;?><br>
                                  </p>
                                  <div style="margin-bottom:10px; display:flex; justify-content:space-around;">
                                  <form action="20.KonfirmasiAduan.php" method="post">
                                    <button type="submit" class="btn btn-success" name="Terima" value=<?php echo $data['ID_Perbaikan']; ?>><i class="fas fa-check mr-2"></i>Terima</button>
                                  </form>
                                  <form action="20.KonfirmasiAduan.php" method="post">
                                    <button type="submit" class="btn btn-danger" name="Tolak" value=<?php echo $data['ID_Perbaikan']; ?>><i class="fas fa-times mr-2"></i>Tolak</button>
                                  </form>
                                  <form action="20.KonfirmasiAduan.php" method="post">
                                    <button type="submit" class="btn btn-primary" name="Teruskan" value=<?php echo $data['ID_Perbaikan']; ?>><i class="fas fa-share-square mr-2"></i>Teruskan</button>
                                  </form>
                                  </div>
                                  <form action="9.DetilAduan.php" method="post">
                                    <button type="submit" value="<?php echo $data['ID_Pengaduan']; ?>" name="IDP"  class="btn btn-secondary">Selengkapnya</button>
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
                <div class="col-xl-4 col-sm-6 mb-5" style="box-shadow:0px 0px 5px lightgrey; box-sizing:border-box; padding:5px;"> 
                  <div style="" ><h5>Aduan Diterima</h5><hr></div>
                  <?php foreach ($datas3 as $data) : ?>
                  <div style="display:<?php if($data['status']=='V'){ echo 'flex'; }else{ echo 'none'; } ?>; flex-direction:row; justify-content:space-between; margin-bottom:5px;">
                    <p class="mb-0">ID Pengaduan : <?php echo $data['ID_Pengaduan']; ?></p>
                  </div>
                  <?php endforeach; ?>
                </div>
                <!-- End-->
                <!-- Aduan Ditolak-->
                <div class="col-xl-4 col-sm-6 mb-5" style="box-shadow:0px 0px 5px lightgrey; box-sizing:border-box; padding:5px;"> 
                  <div style="" ><h5>Aduan Ditolak</h5><hr></div>
                  <?php foreach ($datas3 as $data) : ?>
                  <div style="display:<?php if($data['status']=='X'){ echo 'flex'; }else{ echo 'none'; } ?>; flex-direction:row; justify-content:space-between; margin-bottom:5px;">
                    <p class="mb-0">ID Pengaduan : <?php echo $data['ID_Pengaduan']; ?></p>
                    <form action="20.KonfirmasiAduan.php" method="post">
                      <button type="submit" style="border:none; background-color:white; box-shadow:0px 0px 3px lightgrey;" name="urungkan" value=<?php echo $data['ID_Pengaduan']; ?>>Urungkan</button>
                    </form>
                  </div>
                  <?php endforeach; ?>
                </div>
                <!-- End-->
                <!-- Aduan Diteruskan-->
                <div class="col-xl-4 col-sm-6 mb-5" style="box-shadow:0px 0px 5px lightgrey; box-sizing:border-box; padding:5px;"> 
                  <div style="" ><h5>Aduan Diteruskan</h5><hr></div>
                  <?php foreach ($datas3 as $data) : ?>
                  <div style="display:<?php if($data['status']=='T'){ echo 'flex'; }else{ echo 'none'; } ?>; flex-direction:row; justify-content:space-between; margin-bottom:5px;">
                    <p class="mb-0">ID Pengaduan : <?php echo $data['ID_Pengaduan']; ?></p>
                  </div>
                  <?php endforeach; ?>
                </div>
                <!-- End-->
                <!-- Lokasi Wisata Dalam Desa -->
                <div class="container">
                  <h2 class="alert alert-warning text-center">DAFTAR LOKASI WISATA DESA</h2>
                </div>
                <?php foreach ($datas4 as $data) :?>
                <div class="col-xl-4 col-sm-6 mb-5" style="box-shadow: 0px 0px 10px grey;">
                  <div class="bg-white rounded shadow-sm py-5 px-4">
                    <div style="width: 100%; height: 200px; box-shadow: 0px 0px 2px lightgrey; display: flex; align-items: center; justify-content: center; margin-bottom:10px;">
                      <img src=<?php echo $data['Dokumentasi']; ?> alt="" width="200">
                    </div>
                    <h5 class="mb-0"><?php echo $data['Nama_Lokasi']; ?></h5>
                    <ul class="social mb-0 list-inline mt-3"> 
                      <form action="17.TelusuriLokasiWisata_Admin.php" method="post">
                        <button type="submit" class="btn btn-primary" name="IDL" value="<?php echo $data['ID_Lokasi']; ?>">Telusuri</button>
                      </form>
                    </ul>
                  </div>
                </div>
                <?php endforeach; ?>
                <!--  -->
                <div class="col-xl-4 col-sm-6 mb-5" style="box-shadow: 0px 0px 10px grey;">
                  <div class="bg-white rounded shadow-sm py-5 px-4" style="display:flex; flex-direction:column; justify-content:center; height:100%;">
                    <h5 class="mb-0">Tambah Lokasi Wisata ?</h5>
                    <ul class="social mb-0 list-inline mt-3"> 
                      <form action="21.TambahWisata.php" method="post">
                        <button type="submit" class="btn btn-primary" name="desa" value=<?php echo $desa; ?>>Tambah</button>
                      </form>
                    </ul>
                  </div>
                </div>
                <!-- End -->
                <!-- Komentar -->
                <div class="container">
                  <h2 class="alert alert-warning text-center">KOMENTAR</h2>
                </div>
                <?php foreach ($koment as $comm) : 
                  $IDuser=$comm['ID_User'];
                  $user=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE ID_User='$IDuser'"));
                ?>
                  <div style="border:1px solid green; margin-left:15px; width:100%; display:flex; justify-contet:first; border-radius:10px; padding:5px;">
                    <p style="font-weight:bolder;"><?php echo $user['Nama']; ?>:</p>
                    <p><?php echo $comm['penjelasan']; ?></p>
                    <div style="display:<?php if($comm['rating']==NULL){ echo 'none'; } ?>;">(<i class="fa fa-star" aria-hidden="true"></i><?php echo $comm['rating']; ?>)</div>
                  </div>
                <?php endforeach; ?>
                <!-- End -->
            </body>