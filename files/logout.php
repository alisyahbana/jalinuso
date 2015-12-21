<?php
if (!isset($_SESSION['LEVEL'])) {
	header('Location: ./');
}
else {
	$admin = $_SESSION['LEVEL'];
}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Logout ~ Aplikasi Database Jalin KPU/USO</title>
</head>

<body>

<?php
if( isset($_SESSION['ID']) || isset($_SESSION['PASS'])){
	$_SESSION = array();
	session_destroy();
	mysql_close();
	echo "<script>alert('anda telah logout'); window.location.href= './';</script>";
}
else {
	echo  "<script>alert('anda belum login'); window.location.href= './';</script>";
}
?>
</body>
</html>
