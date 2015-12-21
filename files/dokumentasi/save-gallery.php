<?php
include ('../connect.php');
//upload file
    $nojar=$_POST['id'];
if(!empty($_FILES) && $_FILES['file']['size'] > 0 && $_FILES['file']['error'] == 0){
	$fileName = $_FILES['file']['name'];
	$move = move_uploaded_file($_FILES['file']['tmp_name'], 'upload/'.$nojar. $fileName);
	if($move){
		//simpan deskripsi dan nama file ke database
		$sql = "insert into data_dokumentasi (nama_file, deskripsi, no_jaringan) values
				('$nojar$fileName', '".$_POST['deskripsi']."', '$nojar')";
		mysql_query($sql);
		if(!$sql){
		die(mysql_error());
		}else{
		echo "<script>alert('Foto Berhasil Di Upload! '); window.location.href='javascript:history.back(-1)';</script>";
		exit;
		}

		
	}
}
else{
		echo "<script>alert('Masukkan Foto!'); window.location.href='javascript:history.back(-1)';</script>";
	}

	?>

	