<?php
session_start();
include('connection.php');

if (isset($_POST['Desa'])) {
    $ID_Desa = $_POST['Desa'];
    $KTP = $_SESSION['KTP'];
    $Camat = $_SESSION['Camat'];
    $Nama = $_SESSION['Nama'];
    $ID_User = $_SESSION['ID_User'];
    $EmailUser = $_SESSION['EmailUser'];
    $NoHPUser = $_SESSION['NoHPUser'];
    $gender = $_SESSION['gender'];
    $passUser = $_SESSION['passUser'];
    // Image
    $filename = $_FILES['image']['name'];
    $foldername = $_FILES['image']['tmp_name'];
    $folder = "image/".$filename;
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
        $query = "INSERT INTO user VALUES ('$Nama',$ID_User,'$EmailUser','$NoHPUser','$gender','$passUser','$ID_Desa', '$KTP', '$folder')";
        if (mysqli_query($conn, $query)) {
            header('Location: 2.Login.php');
        }
    }else{
        header('Location: 3.Register.php?error=eror');
    }
    session_unset();
    session_destroy();
}
?>