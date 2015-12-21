<?php

if(!isset($_SESSION)){
 session_start();
}

if ( !isset($_SESSION['ID']) || !isset($_SESSION['PASS']) ){
	die('illegal Acces');
}

if($_SESSION ['LEVEL']=='0'){
	echo "<script>alert('Selamat datang, " . $_SESSION['ID'] . " || Level = Super Admin'); window.location.href= './';</script>";
}
elseif($_SESSION ['LEVEL']=='1'){
	echo "<script>alert('Selamat datang, " . $_SESSION['ID'] . " || Level = Admin'); window.location.href= './';</script>";
}
elseif ($_SESSION ['LEVEL']=='2') {
	echo "<script>alert('Selamat datang, " . $_SESSION['ID'] . " || Level = Operator'); window.location.href= './';</script>";
}
else{
	echo "<script>alert('Selamat datang, " . $_SESSION['ID'] . " " . $_SESSION['LEVEL'] . "'); window.location.href= './';</script>";
}



?>
