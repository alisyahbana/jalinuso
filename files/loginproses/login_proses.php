<?php
session_start();

	include ('../connect.php');
	
	/* ambil variabel */
	$user_id = $_REQUEST['username'];
	$pass = $_REQUEST['password'];
	
	/*validasi*/
	$error = 0;
	if(empty($user_id) || empty($pass))
	{
	echo "<script>alert('Tidak boleh kolom yang kosong'); window.location.href= '/jalinuso/login.php';</script>";
	$error++;
	}
	else
	{
	$sql = 'select * from user where username="'.$user_id.'"';
	$query = mysql_query($sql);
	$row = mysql_fetch_array($query);
	
	if (empty ($row['username']))
	{
	echo "<script>alert('User Tidak Di Kenal'); window.location.href= '/jalinuso/login.php';</script>";
	$error++;
	}
	else	
	{
	if($row['password'] != $pass)
	{
	echo "<script>alert('Password Salah'); window.location.href= '/jalinuso/login.php';</script>";
	$error++;
	}
	else{
	$_SESSION['ID'] = $user_id;
	$_SESSION['PASS'] = $pass;
	$_SESSION['LEVEL'] = $row['tipe'];
	
	
	}
	}
	
	}
if($error == 0 )
{
header('Location:login_lanjut.php');
exit();
}
else
{
echo'<a href="/jalinuso/">Kembali</a>';
exit();
}	
?>