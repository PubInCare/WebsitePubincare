<?php

session_start();
include('connection.php');
if(isset($_POST['wisata'])){
  $IDL=$_POST['wisata'];
  $komentar=$_POST['komentar'];
  $IDU=$_SESSION['IDU'];
  $rating=$_POST['star'];
  $IDK=uniqid();
  mysqli_query($conn, "INSERT INTO komentar (IDK, penjelasan, ID_User, ID_Lokasi, rating) VALUES ('$IDK', '$komentar', '$IDU', '$IDL', '$rating')");
  header('Location: 17.TelusuriLokasiWisata.php');
}else if(isset($_POST['komentar'])){
  $komentar=$_POST['komentar'];
  $desa=$_POST['submit'];
  $IDU=$_SESSION['IDU'];
  $IDK=uniqid();
  mysqli_query($conn, "INSERT INTO komentar (IDK, penjelasan, ID_User, ID_Desa) VALUES ('$IDK', '$komentar', '$IDU', '$desa')");
  header('Location: 12.DetilDesa.php');
}else if(isset($_POST['hapuscommwisata'])){
  $comm=$_POST['hapuscommwisata'];
  mysqli_query($conn, "DELETE FROM komentar WHERE IDK='$comm'");
  header('Location: 17.TelusuriLokasiWisata.php');
}else if(isset($_POST['hapuscommdesa'])){
  $comm=$_POST['hapuscommdesa'];
  mysqli_query($conn, "DELETE FROM komentar WHERE IDK='$comm'");
  header('Location: 12.DetilDesa.php');
}

?>