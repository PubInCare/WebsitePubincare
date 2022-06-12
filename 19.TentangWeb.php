<?php

session_start();
include('connection.php');

function cekAdmin($ID){
    include('connection.php');
    $cekdata=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM admindesa WHERE ID_Admin='$ID'"));
    if($cekdata==null){
        $cekdata=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM adminkecamatan WHERE ID_Admin='$ID'"));
        if($cekdata==null){
            $cekdata=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM adminkecamatan WHERE ID_Admin='$ID'"));
            return "5.AdminKabupatenBeranda.php";
        }else{
            return "5.AdminCamatBeranda.php";
        }
    }else{
        return "5.AdminBeranda.php";
    }
}

if(isset($_SESSION['IDA'])){
    $kembali = cekAdmin($_SESSION['IDA']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com    @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>About Us</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="user.css">
    <link rel="stylesheet" href="4.PROFIL.css">
    <style>
        .judul{
            margin-top:20px;
            margin-bottom:20px;
            text-align: center;
        }
        .Logo{
            height: 80px;
            width: 70px;
            margin-top: 5px;
            margin-bottom: 5px;
        }
        .SIPI{
            width: 60px;
            height: 60px;
            background-color: teal;
            border-radius: 50%;
            overflow: hidden;
        }
        .nama_web{
            font-size: 8pt;
        }
        .cont-Logo{
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            }
  
        .navbar-inverse{
        background-color:#336E7B;
        }
        .contact {
            color: white;
            text-decoration: none;
        }

        a:hover{
            color: #FFC312;
            text-decoration: none;
        }
        
        tr, th, td{
            color: black;
            text-align: justify;
        }

        td b{
            font-size: x-large;
            text-align: center;
        }
        
    </style>
</head>
<body style="overflow-x:hidden;">
    <div class="container-fluid">
        <div class="cont-Logo">
          <img src="Logo_web.png" alt="Logo KLU" class="Logo">
          <h3 class="judul" style="text-align: center;">SIPI KLU <br>
            <p class="nama_web">Sistem Informasi Pengaduan Infrastruktur Kabupaten Lombok Utara</p>
          </h3>
          <div class="SIPI">
              <img src="./web.jpg" alt="logo" width="60px;" height="60px;">
          </div>
        </div>
      </div>
    <div class="container bootstrap snippets bootdey"></div>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-dark" style="background-color:aqua;">
          <div class="NavMenu">
            <div class="menulink">
              </a>
              <a class="submenu" id="submenu" href=<?php if(isset($_SESSION['IDU'])){ echo '5.UserBeranda.php'; }else if(isset($_SESSION['IDA'])){ echo $kembali; }else{ echo '1.Homepage.php'; } ?>>Kembali</a>
            </div>
        </nav>
        <div class="col-md">
            <h3><i class="fas fa-blog mr-2"></i>Tentang Web</h3><hr>
                <table>
                    <tr>
                        <th> </th>
                        <th> </th>
                    </tr>
                    <tr >
                        <td> 
                            <b>SIPI.KLU</b> <br> 
                            Sistem Informsai Pengaduan Infrastruktur Kabupaten Lombok Utara (SIPI.KlU) merupakan sebuah sistem informasi yang digunakan untuk melakukan pengajuan kepada pemerintah terkait infrastruktur di daerah mereka, baik itu dalam bentuk penambahan infrastruktur maupun perbaikan infrastruktur.
                            Infrastruktur yang diajukan nantinya akan langsung diproses oleh pemerintah desa yang kemudian akan diteruskan ke pemerintah kecamatan ataupun kabuopaten jika aduan yang diajukan dirasa membutuhkan dana ytang tidak sedikit.
                        </td>
                        <td> 
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="padding-left: 20%;">
                            <b>ALUR KERJA WEB SIPI</b><br>
                            <ol>
                                <li>Login</li>
                                <li>Klik halaman kecamatan</li>
                                <li>Klik halaman desa</li>
                                <li>Pilih aduan yang akan diajukan (Pengadaan atau perbaikan infrastruktur</li>
                                <li>Isi aJuan yang diinginkan</li>
                                <li>Klik tombol ajukan</li>
                                <li>Pengaduan akan di proses</li>
                            </ol>
                        </td>
                    </tr>
                    <tr>
                        <td> 
                            <b>KENAPA SIPI.KLU?</b> 
                            <ol>
                                <li>Kurangnya tempat atau platform untuk pengaduan infrastruktur</li>
                                <li>Banykanya kecelakaan atau tindak kejahatan akibat kurang memadainya infrastruktur</li> 
                                <li>Memanfaatkan dana infrastruktur yang sudah ada</li>
                            </ol>
                        </td>
                        <td> 
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td style="padding-left: 20%;">
                            <b>LOCATION KLU IN MAPS</b><br>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d133133.81257149676!2d116.18849667437416!3d-8.40216980117525!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dcdd0c5f6aca733%3A0x3030bfbcaf7d0c0!2sKabupaten%20Lombok%20Utara%2C%20Nusa%20Tenggara%20Bar.!5e1!3m2!1sid!2sid!4v1621992229758!5m2!1sid!2sid" width="500px" height="350px" style="border:0;" loading="lazy"></iframe>
                        </td>
                    </tr>
                    
                </table><br><br><br>
            </div>
        </div>  
    </div>
    <div class="jumbotron text-center bg-dark" id="KontakKami" style="margin-bottom:0;" >
        <div class="contact" id="KontakUs">
            <p>@SIPI.KLU</p>
            <p></p>
            For more Information <br> Contact Us: <br>
            <i class="fas fa-envelope">  E-mail: <a href="mailto:mapparewaandhika@gmail.com" target="_blank">E-mail admin</a></i><br>
            <i class="fas fa-phone-alt">  Phone: <a href="https://wa.me/087701021946" target="_blank">Nomer admin</a></i>
        </div>   
    </div>
</body>
</html>