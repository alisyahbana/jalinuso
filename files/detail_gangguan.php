<?php

if (!isset($_SESSION['LEVEL'])) {
    header('Location: /');
}
else{
	$admin=$_SESSION['LEVEL'];
}


$id = $_GET['id'];
echo "<head><title>Jaringan $id</title></head>";

$query = mysql_query("SELECT * FROM data_gangguan WHERE data_gangguan.id='$id'") ;

if(mysql_num_rows($query) != 0){
	if($data = mysql_fetch_array($query)){
			
			echo "
				<div id='dataform'>
				
				<div id='dataform_left'>
				<h4>Detail Gangguan</h4>
				<table width='100%'>
				<tr><td width='35%'>Nama Pelapor</td><td> : </td><td><input type='text' id='no_jar' value='$data[nama_pelapor]' disabled/></td></tr>
				<tr><td>No. Telp. Pelapor</td><td> : </td><td><input type='text' value='$data[telp_pelapor]' disabled/></td></tr>
				<tr><td>Paket</td><td> : </td><td><input type='text' value='$data[paket]' disabled/></td></tr>
				<tr><td>Provinsi</td><td> : </td><td><input type='text' value='$data[provinsi]' disabled/></td></tr>
				<tr><td>Kabupaten</td><td> : </td><td><input type='text' value='$data[kabupaten]' disabled/></td></tr>
				<tr><td>Site</td><td> : </td><td><input type='text' value='$data[site]' disabled/></td></tr>
				<tr><td>Institusi</td><td> : </td><td><input type='text' value='$data[institusi]' disabled/></td></tr>
				<tr valign='top'><td>Alamat</td><td> : </td><td><textarea disabled>$data[alamat]</textarea></td></tr>
				<tr><td>Jenis Gangguan</td><td> : </td><td><input type='text' value='$data[jenis_gangguan]' disabled/></td></tr>
				<tr valign='top'><td>Detail Gangguan</td><td> : </td><td><textarea disabled style='height:120px'>$data[detail_gangguan]</textarea></td></tr>
				<tr><td>Tanggal Input</td><td> : </td><td><input type='text' value='$data[tanggal_input]' disabled/></td></tr>
				
				</table>
				</div>
				
				<div id='dataform_gangguan'>
				<h4>Dokumentasi</h4>

				";
				if ($data['dokumentasi']=='') {
				echo"<i> Kosong</i>";
			}else{
				echo"<p align='center'><a href='http://gangguan.indotelco.net/upload/$data[dokumentasi]'><img src='http://gangguan.indotelco.net/upload/$data[dokumentasi]' alt=''  style='max-width: 456; max-height: 300;' border='0'/></a><br/></p>";
			}
				echo"
			
					

				</div>
				
				</div>
				
			";
			

			

	}else{
			echo "fetch_array query";
		}
}else {
	echo "<h2>Error 404</h2><p>Halaman tidak ditemukan!</p>";
}


if(isset($_POST['delete'])){
	echo "<script>function deleteJaringan(){
			var opsi = confirm('Anda yakin ingin menghapus Gangguan ini');
			if( opsi == true ){
				location.href='http://gangguan.indotelco.net/delete.php?id=$id';
			}else{
				location.href='';
			}
		}deleteJaringan();</script>";
} else if(isset($_POST['back'])){
	
		echo "<script>window.location.href='/';</script>";
	
}

?>