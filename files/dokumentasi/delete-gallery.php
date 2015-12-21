<?php
//koneksi ke database
include ('../connect.php');

if(isset($_GET['id'])){
	$id = (int) $_GET['id'];
	$sql = "select * from data_dokumentasi where id='$id'";
	$result = mysql_query($sql);
	if(mysql_num_rows($result) > 0 ){
		$data = mysql_fetch_array($result);
		//delete file
		@unlink('upload/'.$data['nama_file']);
		//delete data di database
		mysql_query("delete from data_dokumentasi where id='$id'");
	}
} 
echo "<script>alert('Foto Terhapus!'); window.location.href='javascript:history.back(-1)';</script>";
