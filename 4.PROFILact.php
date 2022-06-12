<?php
session_start();
include('connection.php');
if(isset($_POST['nama'])){
    $namabaru = $_POST['nama'];
    $IDU = $_SESSION['IDU'];
    mysqli_query($conn, "UPDATE user SET Nama='$namabaru' WHERE ID_User=$IDU");
    $namauser = mysqli_query($conn, "SELECT * FROM user WHERE ID_User = $IDU");
    $datausers = mysqli_fetch_assoc($namauser);
    $nama_user = $datausers['Nama'];
    $_SESSION['Nama'] = $nama_user;
    header('Location: 4.PROFIL.php');
}

if(isset($_POST['Email'])){
    $emailbaru = $_POST['Email'];
    $IDU = $_SESSION['IDU'];
    mysqli_query($conn, "UPDATE user SET Email='$emailbaru' WHERE ID_User=$IDU");
    $emailuser = mysqli_query($conn, "SELECT * FROM user WHERE ID_User = $IDU");
    $datausers = mysqli_fetch_assoc($emailuser);
    $email_user = $datausers['Email'];
    $_SESSION['Email'] = $email_user;
    header('Location: 4.PROFIL.php');
}

if(isset($_POST['HP'])){
    $HPbaru = $_POST['HP'];
    $IDU = $_SESSION['IDU'];
    mysqli_query($conn, "UPDATE user SET HP='$HPbaru' WHERE ID_User=$IDU");
    $HPuser = mysqli_query($conn, "SELECT * FROM user WHERE ID_User = $IDU");
    $datausers = mysqli_fetch_assoc($HPuser);
    $HP_user = $datausers['HP'];
    $_SESSION['HP'] = $HP_user;
    header('Location: 4.PROFIL.php');
}

if(isset($_POST['Pass'])){
    $Passbaru = $_POST['Pass'];
    $IDU = $_SESSION['IDU'];
    mysqli_query($conn, "UPDATE user SET Password='$Passbaru' WHERE ID_User=$IDU");
    $Pass = mysqli_query($conn, "SELECT * FROM user WHERE ID_User = $IDU");
    $datausers = mysqli_fetch_assoc($Pass);
    $Pass_user = $datausers['Password'];
    $_SESSION['Pass'] = $Pass_user;
    header('Location: 4.PROFIL.php');
}

if (isset($_POST['tgambar'])){
    $IDU = $_SESSION['IDU'];
    $filename = $_FILES['gambar']['name'];
    $foldername = $_FILES['gambar']['tmp_name'];

    $ekstensivalid = ['jpg', 'jpeg', 'png'];
    $ekstensigambar = explode('.',$filename);
    $ekstensigambar = strtolower(end($ekstensigambar));

    $fileuniq = uniqid();
    $fileuniq .= ".";
    $fileuniq .= $ekstensigambar;
    $folder = "image/".$fileuniq;
    if(in_array($ekstensigambar,$ekstensivalid)){
        move_uploaded_file($foldername, $folder);
        mysqli_query($conn, "UPDATE user SET image='$folder' WHERE ID_User=$IDU");
        $imageuser = mysqli_query($conn, "SELECT * FROM user WHERE ID_User = $IDU");
        $datausers = mysqli_fetch_assoc($imageuser);
        $image_user = $datausers['image'];
        $_SESSION['Gambar'] = $image_user;
        header('Location: 4.PROFIL.php');
    }else{
        header('Location: 4.PROFIL.php?error=eror');
    }
}
?>