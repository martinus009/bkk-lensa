<?php
	require "../../php/connection.php";
	$nama = $_POST['nama'];
			
	$strQuery = "INSERT INTO kota VALUES(null,'$nama')";
	$query = mysqli_query($connection, $strQuery);
	if(!$query){
		echo "<script language=javascript>alert('Terjadi Kesalahan Saat Menambah Data Kota');</script>";	
	}
	
	echo "<script language=javascript>document.location.href='../kota.php'</script>";
	mysqli_close($connection);
?>