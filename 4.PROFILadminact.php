<?php
session_start();
include('connection.php');
if(isset($_POST['nama'])){
    $namabaru = $_POST['nama'];
    $IDA = $_SESSION['IDA'];
    mysqli_query($conn, "UPDATE admin SET Nama='$namabaru' WHERE ID_Admin='$IDA'");
    $namaadmin = mysqli_query($conn, "SELECT * FROM admin WHERE ID_Admin = '$IDA'");
    $dataadmin = mysqli_fetch_assoc($namaadmin);
    $nama_admin = $dataadmin['Nama'];
    $_SESSION['Nama'] = $nama_admin;
    echo $_SESSION['Nama'];
    header('Location: 4.PROFILadmin.php');
}

if(isset($_POST['HP'])){
    $HPbaru = $_POST['HP'];
    $IDA = $_SESSION['IDA'];
    mysqli_query($conn, "UPDATE admin SET HP='$HPbaru' WHERE ID_Admin='$IDA'");
    $HPuser = mysqli_query($conn, "SELECT * FROM admin WHERE ID_Admin = '$IDA'");
    $datausers = mysqli_fetch_assoc($HPuser);
    $HP_user = $datausers['HP'];
    $_SESSION['HP'] = $HP_user;
    header('Location: 4.PROFILadmin.php');
}

if(isset($_POST['Pass'])){
    $Passbaru = $_POST['Pass'];
    $IDA = $_SESSION['IDA'];
    mysqli_query($conn, "UPDATE admin SET Password='$Passbaru' WHERE ID_Admin='$IDA'");
    $Pass = mysqli_query($conn, "SELECT * FROM admin WHERE ID_Admin = '$IDA'");
    $dataadmin = mysqli_fetch_assoc($Pass);
    $Pass_admin = $dataadmin['Password'];
    $_SESSION['Pass'] = $Pass_admin;
    header('Location: 4.PROFILadmin.php');
}

if (isset($_POST['tgambar'])){
    $IDA = $_SESSION['IDA'];
    $filename = $_FILES['gambar']['name'];
    $foldername = $_FILES['gambar']['tmp_name'];

    $ekstensivalid = ['jpg', 'jpeg', 'png'];
    $ekstensigambar = explode('.',$filename);
    $ekstensigambar = strtolower(end($ekstensigambar));

    $fileuniq = uniqid();
    $fileuniq .= ".";
    $fileuniq .= $ekstensigambar;
    $folder = "/".$fileuniq;
    if(in_array($ekstensigambar,$ekstensivalid)){
        move_uploaded_file($foldername, $folder);
        mysqli_query($conn, "UPDATE admin SET image='$folder' WHERE ID_Admin='$IDA'");
        $imageadmin = mysqli_query($conn, "SELECT * FROM admin WHERE ID_Admin = '$IDA'");
        $dataadmin = mysqli_fetch_assoc($imageadmin);
        $image_admin = $dataadmin['image'];
        $_SESSION['Gambar'] = $image_admin;
        header('Location: 4.PROFILadmin.php');
    }else{
        header('Location: 4.PROFILadmin.php?error=eror');
    }
}
?>