<?php
include('../connect.php');
session_start();


$username=$_POST['username'];
$username_baru=$_POST['username_baru'];


$mysql=mysql_query("UPDATE data_user SET username = '$username_baru' where username = '$username' ");
if(!$mysql){
  die(mysql_error());
}else{
  $_SESSION['ID']=$username_baru;
    echo "<script>alert('Username berhasil dirubah'); window.location.href= 'javascript:history.back(-1)';</script>";
}
  

?>