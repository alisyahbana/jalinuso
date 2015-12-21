<?php
include('../connect.php');
session_start();
$r=mysql_fetch_array(mysql_query('select * from data_user where username="'.$_SESSION['ID'].'"'));

$pass_lama=md5($_REQUEST['pass_lama']);
$pass_baru=md5($_REQUEST['pass_baru']);
$pass_ulangi=md5($_REQUEST['pass_ulangi']);
$password=$r['password'];
$id=$_SESSION['ID'];

if (empty($pass_baru) OR empty($pass_lama) OR empty($pass_ulangi)){
  echo "<p align=center>Anda harus mengisikan semua data pada form Ganti Password.<br />"; 
  echo "<a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a></p>";
}
else{ 
// Apabila password lama cocok dengan password admin di database
if ($pass_lama==$password){
  // Pastikan bahwa password baru yang dimasukkan sebanyak dua kali sudah cocok
  if ($pass_baru==$pass_ulangi){
    mysql_query("UPDATE data_user SET password = '$pass_baru' where username = '$id' ");
    echo "<script>alert('Password berhasil dirubah'); window.location.href= 'javascript:history.back(-1)';</script>";
	
 
  }
  else{
    echo "<script>alert('Password baru yang Anda masukkan sebanyak dua kali belum cocok'); window.location.href= 'javascript:history.back(-1)';</script>";
  
  }
}
else{
  echo "<script>alert('Anda salah memasukkan Password lama Anda'); window.location.href= 'javascript:history.back(-1)';</script>";
  
}
}

?>