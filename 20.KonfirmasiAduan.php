<?php

session_start();
include('connection.php');
if(isset($_POST['Terima'])){
    $IDP=$_POST['Terima'];
    mysqli_query($conn, "UPDATE pengaduan SET status='V' WHERE ID_Pengaduan='$IDP'");
    header('Location: 20.DesaKami.php');
}else if(isset($_POST['Tolak'])){
    $IDP=$_POST['Tolak'];
    mysqli_query($conn, "UPDATE pengaduan SET status='X' WHERE ID_Pengaduan='$IDP'");
    header('Location: 20.DesaKami.php');
}else if(isset($_POST['Teruskan'])){
    $IDP=$_POST['Teruskan'];
    $IDC=$_SESSION['camattujuanaduan'];
    $IDD=$_SESSION['desaasaltujuan'];
    mysqli_query($conn, "UPDATE pengaduan SET status='T' WHERE ID_Pengaduan='$IDP'");
    mysqli_query($conn, "INSERT INTO aduanwarga VALUES ('$IDP', '$IDC', '$IDD')");
    header('Location: 20.DesaKami.php');
}else if(isset($_POST['urungkan'])){
    $IDP=$_POST['urungkan'];
    mysqli_query($conn, "UPDATE pengaduan SET status='' WHERE ID_Pengaduan='$IDP'");
    header('Location: 20.DesaKami.php');
}else if(isset($_POST['TeruskanCamat'])){
    $IDP=$_POST['TeruskanCamat'];
    $IDC=$_SESSION['camatadmin'];
    mysqli_query($conn, "UPDATE pengaduan SET status='TI' WHERE ID_Pengaduan='$IDP'");
    mysqli_query($conn, "INSERT INTO aduanwarga VALUES ('$IDC', '$IDP', 'KLU')");
    header('Location: 20.CamatKami.php');
}else if(isset($_POST['TerimaCamat'])){
    $IDP=$_POST['TerimaCamat'];
    mysqli_query($conn, "UPDATE pengaduan SET status='VI' WHERE ID_Pengaduan='$IDP'");
    header('Location: 20.CamatKami.php');
}else if(isset($_POST['TolakCamat'])){
    $IDP=$_POST['TolakCamat'];
    mysqli_query($conn, "UPDATE pengaduan SET status='XI' WHERE ID_Pengaduan='$IDP'");
    header('Location: 20.CamatKami.php');
}else if(isset($_POST['urungkancamat'])){
    $IDP=$_POST['urungkancamat'];
    mysqli_query($conn, "UPDATE pengaduan SET status='T' WHERE ID_Pengaduan='$IDP'");
    header('Location: 20.CamatKami.php');
}else if(isset($_POST['TerimaKab'])){
    $IDP=$_POST['TerimaKab'];
    mysqli_query($conn, "UPDATE pengaduan SET status='VII' WHERE ID_Pengaduan='$IDP'");
    header('Location: 20.KabupatenKami.php');
}else if(isset($_POST['TolakKab'])){
    $IDP=$_POST['TolakKab'];
    mysqli_query($conn, "UPDATE pengaduan SET status='XII' WHERE ID_Pengaduan='$IDP'");
    header('Location: 20.KabupatenKami.php');
}else if(isset($_POST['urungkanKab'])){
    $IDP=$_POST['urungkanKab'];
    mysqli_query($conn, "UPDATE pengaduan SET status='TI' WHERE ID_Pengaduan='$IDP'");
    header('Location: 20.KabupatenKami.php');
}



?>