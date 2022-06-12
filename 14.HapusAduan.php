<?php

session_start();
include('connection.php');
if(isset($_POST['IDP'])){
    $IDP=$_POST['IDP'];
    mysqli_query($conn, "DELETE FROM pengaduan WHERE ID_Pengaduan='$IDP'"); 
    mysqli_error($conn);
    header('Location: 13.AduanDiri.php');
}

?>