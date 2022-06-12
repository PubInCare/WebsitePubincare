<?php

session_start();
include('connection.php');
if(isset($_POST['IDP'])){
    $IDP=$_POST['IDP'];
    $result=mysqli_query($conn, "SELECT * FROM pengaduan WHERE ID_Pengaduan='$IDP'");
    $datas1 = mysqli_fetch_assoc($result);
    $Jenis = substr($IDP,0,1);
    if($Jenis=='N'){
        $sql = "SELECT * FROM pengadaan WHERE ID_Pengadaan='$IDP'";
        $result = mysqli_query($conn, $sql);
        $datas2 = mysqli_fetch_assoc($result);
    }else{
        $sql = "SELECT * FROM perbaikan WHERE ID_Perbaikan='$IDP'";
        $result = mysqli_query($conn, $sql);
        $datas2 = mysqli_fetch_assoc($result);
    }
    // STATUS PENGADUAN
    if($datas1['status']=='V'){
        $datas1['status']='Diterima';
    }else if($datas1['status']=='X'){
        $datas1['status']='Ditolak';
    }else if($datas1['status']=='T'){
        $datas1['status']='Diteruskan';
    }else{
        $datas1['status']='Menunggu';
    }

    // USER PENGADU
    $IDU=$datas1['ID_User'];
    $result=mysqli_query($conn, "SELECT * FROM user WHERE ID_User='$IDU'");
    $datas3 = mysqli_fetch_assoc($result);

    $Desa=$datas3['ID_Desa_Asal'];
    $desauser = mysqli_query($conn, "SELECT * FROM desa WHERE ID_Desa = '$Desa'");
    $datausers = mysqli_fetch_assoc($desauser);
    $desa_user = $datausers['Nama_Desa'];

    $kecuser = mysqli_query($conn, "SELECT * FROM kecamatan WHERE ID_Kecamatan IN (SELECT ID_Kecamatan FROM desa WHERE ID_Desa='$Desa')");
    $datauserss = mysqli_fetch_assoc($kecuser);
    $kec_user = $datauserss['Nama_Kecamatan'];

    $kabuser = mysqli_query($conn, "SELECT * FROM kabupaten WHERE ID_Kabupaten IN (SELECT ID_Kabupaten FROM kecamatan WHERE ID_Kecamatan IN (SELECT ID_Kecamatan FROM desa WHERE ID_Desa='$Desa'))");
    $datausersss = mysqli_fetch_assoc($kabuser);
    $kab_user = $datausersss['Nama_kabupaten'];

    // ADUAN
    $result=mysqli_query($conn, "SELECT * FROM admindesa WHERE ID_Admin IN (SELECT ID_Admin_Desa FROM pengaduan WHERE ID_Pengaduan='$IDP')");
    $datas4 = mysqli_fetch_assoc($result);

    $Desa=$datas4['ID_Desa_Asal'];
    $desauser = mysqli_query($conn, "SELECT * FROM desa WHERE ID_Desa = '$Desa'");
    $datausers = mysqli_fetch_assoc($desauser);
    $desa_aduan = $datausers['Nama_Desa'];

    $kecuser = mysqli_query($conn, "SELECT * FROM kecamatan WHERE ID_Kecamatan IN (SELECT ID_Kecamatan FROM desa WHERE ID_Desa='$Desa')");
    $datauserss = mysqli_fetch_assoc($kecuser);
    $kec_aduan = $datauserss['Nama_Kecamatan'];

    $kabuser = mysqli_query($conn, "SELECT * FROM kabupaten WHERE ID_Kabupaten IN (SELECT ID_Kabupaten FROM kecamatan WHERE ID_Kecamatan IN (SELECT ID_Kecamatan FROM desa WHERE ID_Desa='$Desa'))");
    $datausersss = mysqli_fetch_assoc($kabuser);
    $kab_aduan = $datausersss['Nama_kabupaten'];

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Detil Aduan</title>
    <style>
    .image{
        height: 50px;
        width: 50px;
        border-radius: 50%;
        overflow: hidden;
    }
        img{
            height: 50px;
            width: 50px;
        }
        .header{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }
        .badan{
            width: 900px;
            height: 1200px;
            border: 1px solid black;
            box-sizing: border-box;
            padding-left: 30px;
            padding-right: 30px;
        }
        body{
            display:flex;
            justify-content: center;
        }
        .namaweb{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        h3{
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="badan">
        <div class="header">
            <img src="./Logo_web.png" alt="KLU.jpg">
            <div class="namaweb">
                <h3>SIPI KLU<br>
                    <span>Sistem Pengaduan Infrastruktur Kabupaten Lombok Utara</span>
                </h3>
            </div>
            <div class="image">
                <img src="./web.jpg" alt="SIPIKLU.jpg">
            </div>
        </div>
        <br><hr>
        <h2 style="text-align: center;">Pengaduan <br>
            <span style="font-size: 10pt;">Nomor Pengaduan : <?php echo $datas1['ID_Pengaduan']; ?> <br> Status : <?php echo $datas1['status']; ?> </span>
        </h2>
        <div class="konten">
            <p>Yang bertanggung jawab penuh atas pengaduan ini adalah :</p>
            <p>Nama  : <?php echo $datas3['Nama']; ?> </p>
            <p>ID User : <?php echo $datas3['ID_User']; ?> </p>
            <p>Nomor KTP : <?php echo $datas3['No_KTP']; ?></p>
            <p>Alamat : Desa <?php echo $desa_user; ?>, Kecamatan <?php echo $kec_user; ?>, Kabupaten <?php echo $kab_user; ?></p>
            <p>Nomor HP : <?php echo $datas3['HP']; ?></p>
            <br>
            <p style="text-align: justify;">Dengan ini, mengajukan pengaduan infrastruktur jenis <span style="font-weight: bold;"><?php if(substr($IDP, 0, 1)=="N"){ echo 'Pengadaan'; }else{ echo 'Perbaikan'; } ?></span> untuk Desa <?php echo $desa_aduan; ?>, Kecamatan <?php echo $kec_aduan; ?>, Kabupaten <?php echo $kab_aduan; ?>. Dengan ketentuan sebagai berikut:</p>
            <p style="text-align: justify;">Nama Fasilitas: <?php echo $datas2['Nama_Fasilitas']; ?></p>
            <p style="text-align: justify;">Jumlah Infrastruktur yang Dibutuhkan : <?php echo $datas2['Jumlah_Fasilitas']; ?></p>
            <p style="text-align: justify;">Alasan Pengaduan : <?php echo $datas2['Penjelasan']; ?></p>
            <p style="text-align: justify; display:<?php if($Jenis!='R'){ echo 'none'; } ?>;">Kondisi Infrastruktur Saat Ini : <?php echo $datas2['Kondisi_Fasilitas']; ?> </p>
            <center>
                <table>
                    <tr>
                        <td>
                            <div style="width: 300px; height: 200px; border: 1px solid black;">
                                <img style="width: 300px; height: 200px;" src="<?php echo $datas2['DokumentasiBukti']; ?>" alt="Infastruktur">
                                <p style="text-align: center;">Dokumentasi <?php echo $datas2['Nama_Fasilitas']; ?></p>
                            </div>
                        </td>
                    </tr>
                </table>
            </center>
        </div>
        <div style="dsiplay:flex; justify-content: center;">
            <br><br><br>
            <p><?php echo $desa_aduan; ?>, <?php echo $datas1['Tanggal']; ?></p>
            <br><br><br>
            <p>(<?php echo $datas3['Nama']; ?>)</p>
        </div>
    </div>
</body>
</html>