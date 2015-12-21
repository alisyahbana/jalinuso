<?php

if (!isset($_SESSION['LEVEL'])) {
	header('Location: login.php');
}
else{
$admin=$_SESSION['LEVEL'];
}
?>

<?php
	
	$id = $_GET['id'];
	echo "
		HAPUS $id
	";
	$delete = mysql_query("DELETE FROM data_teknis_ip WHERE no_jaringan='$id'");
	$delete2= mysql_query("DELETE FROM data_lokasi WHERE no_jaringan='$id'");
	if(!$delete){
		die(mysql_error());
	}else if(!$delete2){
		die(mysql_error());
	}
	else{
		echo "<script>alert('Data Berhasil Dihapus!'); window.location.href='./';</script>";
	}
?>
