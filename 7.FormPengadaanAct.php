<?php

session_start();
include('connection.php');

if(isset($_POST['submit'])){
    $nama=$_POST['namafasilitas'];
    $jumlah=$_POST['jumlah'];
    $alasan=$_POST['alasan'];
    $desaaduan=$_SESSION['desa_aduan'];
    $IDP=$_SESSION['IDP'];
    $IDU=$_SESSION['IDU'];
    $sql = mysqli_query($conn, "SELECT * FROM admindesa WHERE ID_Desa_Asal = '$desaaduan'");
    $desa = mysqli_fetch_array($sql, MYSQLI_ASSOC);
    $desaaduan = $desa['ID_Admin'];
    $currdate = date("Y-m-d");
    // Image
    $filename = $_FILES['imgaduan']['name'];
    $foldername = $_FILES['imgaduan']['tmp_name'];
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
        $query1 = "INSERT INTO pengaduan VALUES ('$IDP', '$desaaduan', '$IDU', '', '$currdate')";
        mysqli_query($conn, $query1);
        echo mysqli_error($conn);
        $query2 = "INSERT INTO pengadaan VALUES ('$IDP', '$nama', '$jumlah', '$alasan', '$folder')";
        mysqli_query($conn, $query2);
        echo mysqli_error($conn);
        header('Location: 5.UserBeranda.php');
    }else{
        header('Location: 7.FormPengadaan.php?error=Ekstensi Gambar Tidak');
    }
}


?>