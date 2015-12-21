<?php
include ('../connect.php');
if($_POST['newacc_password']!=$_POST['newacc_password_repeat']){
	echo "<script>alert('Cek Kembali Password!'); window.location.href='javascript:history.back(-1)';</script>";
	exit;
}
$password=md5($_POST['newacc_password']);
$sql=mysql_query("select * from provinsi where nama_provinsi='$_POST[provinsi]'");
$r=mysql_fetch_array($sql);
$id_provinsi=$r['id_provinsi'];

if($_POST['tipe']=='2'){
	$id_provinsi='0';
}

		
		$query = mysql_query("INSERT INTO data_user VALUES ('$_POST[newacc_username]','$password','$_POST[tipe]', '$id_provinsi');");

        if(!$query){
			   die(mysql_error());
		}
        

        else{
			echo "<script>alert('Akun Baru Berhasil Ditambahkan $id_provinsi!'); window.location.href='javascript:history.back(-1)';</script>";
		}


?>