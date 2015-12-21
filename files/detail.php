<?php

if (!isset($_SESSION['LEVEL'])) {
    header('Location: /');
}
else{
$admin=$_SESSION['LEVEL'];
}


$id = $_GET['id'];
echo "<head><title>Jaringan $id</title></head>";

if(isset($_POST['edit'])){
	echo "<script>window.location.href='?page=edit&id=$id';</script>";
} else if(isset($_POST['delete'])){
	echo "<script>function deleteJaringan(){
			var opsi = confirm('Anda yakin ingin menghapus jaringan dengan ID = $id ?');
			if( opsi == true ){
				location.href='?page=delete&id=$id';
			}else{
				location.href='';
			}
		}deleteJaringan();</script>";
} else if(isset($_POST['back'])){
	if(isset($_SESSION['list'])){
		echo "<script>window.location.href='./?list=$_SESSION[list]';</script>";
		unset($_SESSION['list']);
	}else {
		echo "<script>window.location.href='/';</script>";
	}
}

echo "
	<script type='text/javascript'>
		function deleteJaringan(){
			var opsi = confirm('Anda yakin ingin menghapus jaringan dengan ID = $id ?');
			if( opsi == true ){
				location.href='?page=delete&id=$id';
				alert('');
			}
		}
		
		function editJaringan(){
			location.href='?page=edit&id=$id';
		}
	</script>
";


$query = mysql_query("SELECT * FROM data_lokasi INNER JOIN data_teknis_ip ON data_lokasi.no_jaringan=data_teknis_ip.no_jaringan WHERE data_lokasi.no_jaringan='$id'") ;
//$query = mysql_query("SELECT * FROM data_lokasi WHERE no_jaringan='$id'") ;
$query_sn = mysql_query("SELECT * FROM data_teknis_sn WHERE no_jaringan='$id'");

if(mysql_num_rows($query) != 0){
	if($data = mysql_fetch_array($query)){
		if($sn = mysql_fetch_array($query_sn)){
			
			$prov = mysql_query("SELECT * FROM provinsi WHERE id_provinsi='$data[provinsi]'");
			if(mysql_num_rows($prov) !=0){
				$provinsi = mysql_fetch_array($prov);
			}
			/*
			if(empty($sn['modem'])){
				$sn['modem'] = "-";
			}
			
			if(empty($sn['router'])){
				$sn['router'] = "-";
			}
			
			if(empty($sn['server'])){
				$sn['server'] = "-";
			}
			
			if(empty($sn['switch'])){
				$sn['switch'] = "-";
			}
			
			if(empty($sn['client'])){
				$sn['client'] = "-";
			}
			
			if(empty($sn['AP1'])){
				$sn['AP1'] = "-";
			}
			
			if(empty($sn['AP2'])){
				$sn['AP2'] = "-";
			}
			
			if(empty($sn['AP3'])){
				$sn['AP3'] = "-";
			}*/
			
			echo "
				<div id='dataform'>
				
				<div id='dataform_left'>
				<h4>Data Lokasi</h4>
				<table width='100%'>
				<tr><td width='35%'>No. Jaringan</td><td> : </td><td><input type='text' id='no_jar' value='$data[no_jaringan]' disabled/></td></tr>
				<tr><td>Provinsi</td><td> : </td><td><input type='text' value='$provinsi[nama_provinsi]' disabled/></td></tr>
				<tr><td>Kab./Kota</td><td> : </td><td><input type='text' value='$data[kab_kota]' disabled/></td></tr>
				<tr valign='top'><td>Alamat</td><td> : </td><td><textarea disabled>$data[alamat]</textarea></td></tr>
				<tr><td>SITE</td><td> : </td><td><input type='text' value='$data[site]' disabled/></td></tr>
				<tr><td>PIC</td><td> : </td><td><input type='text' value='$data[pic]' disabled/></td></tr>
				<tr><td>Jabatan</td><td> : </td><td><input type='text' value='$data[jabatan]' disabled/></td></tr>
				<tr><td>Instansi</td><td> : </td><td><input type='text' value='$data[instansi]' disabled/></td></tr>
				<tr><td>Kordinat</td><td> : </td><td><input type='text' value='$data[kordinat]' disabled/></td></tr>
				<tr><td>Status Kepemilikan (Gedung)</td><td> : </td><td><input type='text' value='$data[status_kepemilikan_tempat]' disabled/></td></tr>
				<tr><td>No. Telp Kantor</td><td> : </td><td><input type='text' value='$data[no_tlp]' disabled/></td></tr>
				<tr><td>Hp</td><td> : </td><td><input type='text' value='$data[hp]' disabled/></td></tr>
				<tr><td>Tanggal BA OPS</td><td> : </td><td><input type='text' value='$data[tgl_ba_ops]' disabled/></td></tr>
				
				</table>
				</div>
				
				<div id='dataform_right'>
				<h4>Data Teknis</h4>
				<table width='100%'>
				<tr><td></td><td></td><td>IP Address<td></td><td>Serial Number</td></tr>
				<tr><td width='20%'>Modem</td><td> : </td><td width='30%'><input type='text' value='$data[modem]' disabled/><td></td><td><input type='text' value='$sn[modem]' disabled/></td></tr>
				<tr><td>Router</td><td> : </td><td><input type='text' value='$data[router]' disabled/></td><td></td><td><input type='text' value='$sn[router]' disabled/></td></tr>
				<tr><td>Server</td><td> : </td><td><input type='text' value='$data[server]' disabled/></td><td></td><td><input type='text' value='$sn[server]' disabled/></td></tr>
				<tr><td>Switch</td><td> : </td><td><input type='text' value='$data[switch]' disabled/></td><td></td><td><input type='text' value='$sn[switch]' disabled/></td></tr>
				<tr><td>Client</td><td> : </td><td><input type='text' value='$data[client]' disabled/></td><td></td><td><input type='text' value='$sn[client]' disabled/></td></tr>
				<tr><td>Access Point 1</td><td> : </td><td><input type='text' value='$data[AP1]' disabled/></td><td></td><td><input type='text' value='$sn[AP1]' disabled/></td></tr>
				<tr><td>Access Point 2</td><td> : </td><td><input type='text' value='$data[AP2]' disabled/></td><td></td><td><input type='text' value='$sn[AP2]' disabled/></td></tr>
				<tr><td>Access Point 3</td><td> : </td><td><input type='text' value='$data[AP3]' disabled/></td><td></td><td><input type='text' value='$sn[AP3]' disabled/></td></tr>
				</table>
				</div>
			";
			
//include untuk dokumentasi

include('files/dokumentasi/dokumentasi.php');

		} else {
				echo "fetch_array_query_sn";
			}
	}else{
			echo "fetch_array query";
		}
}else {
	echo "<h2>Error 404</h2><p>Halaman tidak ditemukan!</p>";
}


?>