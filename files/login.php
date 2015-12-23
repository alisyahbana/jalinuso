<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Login ~ Aplikasi Database Jalin KPU/USO</title>
  <link rel="stylesheet" href="./css/loginstyles.css" />
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body style="  background: #41586E;">
  <div class="login">
    <h1>Aplikasi Database Jalin KPU/USO</h1>
    <form method="post" name="login" action="">
      <p><input type="text" name="username" value="" placeholder="Username or Email"></p>
      <p><input type="password" name="password" value="" placeholder="Password"></p>
      <p class="remember_me">
        <label>
          <input type="checkbox" name="remember_me" id="remember_me">
          Remember me on this computer
        </label>
      </p>
      <p class="submit"><input type="submit" name="commit" value="Login"></p>
    </form>
  </div>

  <div class="login-help">
    <!-- <p>Forgot your password? </p> -->
  </div>
</body>
</html>

<?php
// start modul proses login
if(isset($_POST['commit'])){
	
	include ('./dbconfig');
	
	/* ambil variabel */
	$user_id = $_REQUEST['username'];
	$pass = md5($_REQUEST['password']);
	
	/*validasi*/
	$error = 0;
	if(empty($user_id) || empty($pass)){
		echo "<script>alert('Tidak boleh ada kolom yang kosong!'); window.location.href= './';</script>";
		$error++;
	} else {
		$sql = 'select * from data_user where username="'.$user_id.'"';
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
	
		if (empty ($row['username'])){
			echo "<script>alert('User Tidak Di Kenal'); window.location.href= './';</script>";
			$error++;
		} else {
			if($row['password'] != $pass){
				echo "<script>alert('Password Salah'); window.location.href= './';</script>";
				$error++;
			} else {
				$_SESSION['ID'] = $user_id;
				$_SESSION['PASS'] = $pass;
				$_SESSION['LEVEL'] = $row['tipe'];
				$_SESSION['PROV'] = $row['provinsi'];
			}
		}
	}

	if($error == 0){
		//login lanjut
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
		exit();
	} else {
		echo'<a href="./">Kembali</a>';
		exit();
	}
}
// end modul proses login
?>
