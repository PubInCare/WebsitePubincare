<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!---------------------PHP--------------------->
<?php
    session_start();
    include('connection.php');

	if(isset($_GET['error'])){
		$eror = $_GET['error'];
	}

    if (isset($_POST['Camat'])){
        $Camat = $_POST['Camat'];
        $_SESSION['Camat'] = $Camat;
        $Nama = $_POST['fname'] . " " . $_POST['lname'];
        $_SESSION['Nama'] = $Nama;
        $EmailUser = $_POST['EmailUser'];
        $_SESSION['EmailUser'] = $EmailUser;
		$KTP = $_POST['KTP'];
        $_SESSION['KTP'] = $KTP;
        $ID_User = $_POST['ID_User'];
        $_SESSION['ID_User'] = $ID_User;
        $NoHPUser = $_POST['NoHPUser'];
        $_SESSION['NoHPUser'] = $NoHPUser;
        $gender = $_POST['gender'];
        $_SESSION['gender'] = $gender;
        $passUser = $_POST['passUser'];
        $_SESSION['passUser'] = $passUser;
        $sql = "SELECT * from desa WHERE ID_Kecamatan = '$Camat'";
        $result = mysqli_query($conn, $sql);
        $datas = mysqli_fetch_all($result, MYSQLI_ASSOC); 
    }
?>

<!Doctype html>
<html>
<head>
     <meta charset="UTF-8">
     <title>Registration Form</title>
     	<meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" type="text/css" href="3.Register.css">
	 <style>
		 .container{
			 margin-top:50px;
		 }
	 </style>
</head>
<body>
 <div class="container">
 <!---heading---->
     <header class="heading"> Registration-Form</header><hr></hr>
	<!---Form starting----> 
	<form action="" method="post" enctype="multipart/form-data">
		<table>
			<span><?php if(isset($_GET['error'])){echo "<tr><td style='color:white;'>Eror</td><td style='color:white;'>Ekstensi Gambar Tidak Sesuai</td></tr>";}?></span>
			<tr>
				<td class="Kolom1">Nama Depan</td>
				<td><input type="text" name="fname" required value=<?php if (isset($_POST['Camat'])){ echo $_POST["fname"]; }?>></td>
			</tr>
			<tr>
				<td class="Kolom1">Nama Belakang</td>
				<td><input type="text" name="lname" required value=<?php if (isset($_POST['Camat'])){ echo $_POST["lname"]; }?>></td>
			</tr>
			<tr>
				<td class="Kolom1">
					Nomor KTP
				</td>
				<td>
					<input class="form" type="text" name="KTP" required value=<?php if (isset($_POST['Camat'])){ echo $_POST["KTP"]; }?>>
				</td>
			</tr>
			<tr>
				<td class="Kolom1">
					No Urut User Anda <span>
						<?php
							$hasil = mysqli_query($conn, "SELECT * from user");
							$jumlah = mysqli_num_rows($hasil);
						?>
					</span>
				</td>
				<td>
					<input class="form" type="text" name="ID_User" required value=<?php echo $jumlah+1;?> readonly>
				</td>
			</tr>
			<tr>
				<td class="Kolom1">
					Email
				</td>
				<td>
					<input class="form" type="email" name="EmailUser" required value=<?php if (isset($_POST['Camat'])){ echo $_POST["EmailUser"]; }?>>
				</td>
			</tr>
			<tr>
				<td class="Kolom1">
					No_HP
				</td>
				<td>
					<input class="form" type="text" name="NoHPUser" required value=<?php if (isset($_POST['Camat'])){ echo $_POST["NoHPUser"]; }?>>
				</td>
			</tr>
			<tr>
				<td class="Kolom1">
					Jenis Kelamin
				</td>
				<td>
					<form>
						<input type="radio" name="gender" value="L" required <?php if (isset($_POST['Camat']) && $gender=="L"){ echo "checked"; }?>>
						<label style="color:white;">Laki-laki</label><br>
						<input type="radio" name="gender" value="P" required <?php if (isset($_POST['Camat']) && $gender=="P"){ echo "checked"; }?>>
						<label style="color:white;">Perempuan</label>
					</form>
				</td>
			</tr>
			<tr>
				<td class="Kolom1">
					Password
				</td>
				<td>
					<input type="password" name="passUser" required value=<?php if (isset($_POST['Camat'])){ echo $passUser; }?>>
				</td>
			</tr>
			<tr>
				<td class="Kolom1">
					Kecamatan Asal
				</td>
				<td>
					<select name="Camat" id="Camat" required>
						<option value="KLU1" <?php if (isset($_POST['Camat']) && $Camat=="KLU1"){ echo "selected"; }?>>Bayan</option>
						<option value="KLU2" <?php if (isset($_POST['Camat']) && $Camat=="KLU2"){ echo "selected"; }?>>Gangga</option>
						<option value="KLU3" <?php if (isset($_POST['Camat']) && $Camat=="KLU3"){ echo "selected"; }?>>Kayangan</option>
						<option value="KLU4" <?php if (isset($_POST['Camat']) && $Camat=="KLU4"){ echo "selected"; }?>>Pemenang</option>
						<option value="KLU5" <?php if (isset($_POST['Camat']) && $Camat=="KLU5"){ echo "selected"; }?>>Tanjung</option>
					</select>
					<button type="submit">Pilih Kecamatan</button>
				</td>
			</tr>
	</form>
	<form action="3.RegistrasiAct.php" method="post" enctype="multipart/form-data">
		<tr>
			<td class="Kolom1">
				Desa Asal
			</td>
			<td>
				<select name="Desa" id="Desa" required>
					<?php foreach ($datas as $data) : ?>
                        <option value=<?= $data['ID_Desa'] ?>><?= $data['Nama_Desa'] ?></option>
                    <?php endforeach; ?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="Kolom1">
				Upload Poto (jpg, jpeg, png)
			</td>
			<td>
				<input type="file" name="image" required>
			</td>
		</tr>
		<tr>
			<td></td>
			<td><input class="btn btn-warning" type="submit" onclick="runPopup()"></input></td>
			<script>  
    			function runPopup(){
    				window.alert("APAKAH ANDA YAKIN DENGAN DATA ANDA ?");
    			}
  			</script>
		</tr>
	</table>
	</form>
</div>
</body>		
</html>