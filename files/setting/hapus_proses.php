	<script>
	var opsi = confirm('Anda yakin ingin menghapus jaringan dengan ID ?');
			if( opsi == false ){
				
				exit;
			}
			</script>
	<?php
	include ('../connect.php');
$id=$_GET['id'];
$action=$_GET['action'];
if( $action == 'delete'){
    $query = mysql_query("delete from data_user where username='$id'");
	 if(!$query){
			   die(mysql_error());
		}else{

	 echo "<script>alert('Akun Berhasil Dihapus'); window.location.href='javascript:history.back(-1)';
	 </script>";  

		}

	 }

	 ?>