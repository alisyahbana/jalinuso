<?php

if (!isset($_SESSION['LEVEL'])) {
    header('Location: login.php');
}
else{
$admin=$_SESSION['LEVEL'];
}
?>
<?php

$id = $_GET['id'];
echo "<head><title>Jaringan $id</title></head>";

//start of save to db
if(isset($_POST['save'])){
   $update = mysql_query("UPDATE data_lokasi SET no_jaringan='$_POST[no_jar]',
				provinsi='$_POST[provinsi]', kab_kota='$_POST[kab_kota]', site='$_POST[site]', pic='$_POST[pic]',jabatan='$_POST[jabatan]',
				instansi='$_POST[instansi]',kordinat='$_POST[kordinat]', 
				status_kepemilikan_tempat ='$_POST[status_kepemilikan_tempat]', no_tlp ='$_POST[no_tlp]', 
				hp ='$_POST[hp]', alamat ='$_POST[alamat]', tgl_ba_ops = '$_POST[tgl_ba_ops]'
				 WHERE no_jaringan='$_GET[id]'");
        
    $updateip = mysql_query("UPDATE data_teknis_ip SET no_jaringan='$_POST[no_jar]', modem='$_POST[ipmodem]', router='$_POST[iprouter]',
					server='$_POST[ipserver]', AP1='$_POST[ipap_1]', AP2='$_POST[ipap_2]', AP3='$_POST[ipap_3]', switch='$_POST[ipswitch]', 
					client='$_POST[ipclient]' WHERE no_jaringan='$_POST[no_jar]'");
					
	$updatesn = mysql_query("UPDATE data_teknis_sn SET no_jaringan='$_POST[no_jar]', modem='$_POST[snmodem]', router='$_POST[snrouter]',
					server='$_POST[snserver]', switch='$_POST[snswitch]', AP1='$_POST[snap_1]', AP2='$_POST[snap_2]', AP3='$_POST[snap_3]', 
					client='$_POST[snclient]' WHERE no_jaringan='$_POST[no_jar]'");
	if(!$update) {
		die(mysql_error());
	}else if(!$updateip) {
		die(mysql_error());
    }else if(!$updatesn) {
		die(mysql_error());
    }
    else{
		echo "<script>alert('Data Berhasil Diperbaharui!'); window.location.href='?page=detail&id=$_POST[no_jar]';</script>";
	}
} else if(isset($_POST['cancel'])){
	echo "<script>window.location.href='./?page=detail&id=$id';</script>";
}
//end of save to db

$query = mysql_query("SELECT * FROM data_lokasi INNER JOIN data_teknis_ip ON data_lokasi.no_jaringan=data_teknis_ip.no_jaringan WHERE data_lokasi.no_jaringan='$id'");
$query_sn = mysql_query("SELECT * FROM data_teknis_sn WHERE no_jaringan='$id'");

if($data = mysql_fetch_array($query)){
	if($sn = mysql_fetch_array($query_sn)){
    
    echo "
	<form id='edit_ip' method='POST' action=''>
    <div id='dataform'>
	
	<div id='dataform_left'>
	<h4>Data Lokasi</h4>
    <table width='100%'>
	<tr><td width='35%'>No. Jaringan</td><td> : </td><td><input type='text' name='no_jar' value='$data[no_jaringan]'/></td></tr>";
	?>
	
    <tr>
		<td>Provinsi</td>
		<td> : </td>
		<td>
			<?php
				$prop = mysql_query("SELECT * FROM provinsi");
				echo "<select name='provinsi'>";
				while($provinsi = mysql_fetch_array($prop)){
					echo "<option value='$provinsi[id_provinsi]' ";
					if($_SESSION['LEVEL'] != 0){
						if($provinsi['id_provinsi'] == $_SESSION['PROV']){
							echo "selected";
						} else if($provinsi['id_provinsi'] != $_SESSION['PROV']){
							echo "disabled";
						}
					} else {
						$query_prov = mysql_query("SELECT * FROM data_lokasi WHERE no_jaringan='$_GET[id]'");
						$qprov = mysql_fetch_array($query_prov);
						if($provinsi['id_provinsi'] == $qprov['provinsi']){
							echo "selected";
						}
					}
					echo ">$provinsi[nama_provinsi]</option>";
				}
			?>
			</select>
		</td>
	</tr>
    
    <?php
    echo "
   <tr><td>Kab./Kota</td><td> : </td><td><input type='text' name='kab_kota' value='$data[kab_kota]'/></td></tr>
    <tr valign='top'><td>Alamat</td><td> : </td><td><textarea name='alamat'>$data[alamat]</textarea></td></tr>
    <tr><td>SITE</td><td> : </td><td><input type='text' name='site' value='$data[site]'/></td></tr>
    <tr><td>PIC</td><td> : </td><td><input type='text' name='pic' value='$data[pic]'/></td></tr>
    <tr><td>Jabatan</td><td> : </td><td><input type='text' name='jabatan' value='$data[jabatan]'/></td></tr>
    <tr><td>Instansi</td><td> : </td><td><input type='text' name='instansi' value='$data[instansi]'/></td></tr>
    <tr><td>Kordinat</td><td> : </td><td><input type='text' name='kordinat' value='$data[kordinat]'/></td></tr>
    <tr><td>Status Kepemilikan (Gedung)</td><td> : </td><td><input type='text' name='status_kepemilikan_tempat' value='$data[status_kepemilikan_tempat]'/></td></tr>
    <tr><td>No. Telp Kantor</td><td> : </td><td><input type='text' name='no_tlp' value='$data[no_tlp]'/></td></tr>
    <tr><td>Hp</td><td> : </td><td><input type='text' name='hp' value='$data[hp]'/></td></tr>
    <tr><td>Tanggal BA OPS</td><td> : </td><td><input type='text' name='tgl_ba_ops' value='$data[tgl_ba_ops]'/></td></tr>
    
     
    </table>
	</div>
    
    <div id='dataform_right'>
    <h4>Data Teknis</h4>
    <table width='100%'>
	<tr><td></td><td></td><td>IP Address<td></td><td>Serial Number</td></tr>
    <tr><td width='20%'>Modem</td><td> : </td><td width='30%'><input type='text' name='ipmodem' value='$data[modem]'/><td></td><td><input type='text' name='snmodem' value='$sn[modem]'/></td></tr>
    <tr><td>Router</td><td> : </td><td><input type='text' name='iprouter' value='$data[router]'/></td><td></td><td><input type='text' name='snrouter' value='$sn[router]'/></td></tr>
    <tr><td>Server</td><td> : </td><td><input type='text' name='ipserver' value='$data[server]'/></td><td></td><td><input type='text' name='snserver' value='$sn[server]'/></td></tr>
    <tr><td>Switch</td><td> : </td><td><input type='text' name='ipswitch' value='$data[switch]'/></td><td></td><td><input type='text' name='snswitch' value='$sn[switch]'/></td></tr>
    <tr><td>Client</td><td> : </td><td><input type='text' name='ipclient' value='$data[client]'/></td><td></td><td><input type='text' name='snclient' value='$sn[client]'/></td></tr>
    <tr><td>Access Point 1</td><td> : </td><td><input type='text' name='ipap_1' value='$data[AP1]'/></td><td></td><td><input type='text' name='snap_1' value='$sn[AP1]'/></td></tr>
    <tr><td>Access Point 2</td><td> : </td><td><input type='text' name='ipap_2' value='$data[AP2]'/></td><td></td><td><input type='text' name='snap_2' value='$sn[AP2]'/></td></tr>
    <tr><td>Access Point 3</td><td> : </td><td><input type='text' name='ipap_3' value='$data[AP3]'/></td><td></td><td><input type='text' name='snap_3' value='$sn[AP3]'/></td></tr>
    </table>
    </div>
    
    <div id='dataform_submit'>
		<input type='submit' id='save' name='save' value='Simpan'/>
		<input type='submit' id='cancel' name='cancel' value='Batal'/>
	</div>
    
    </div>
	</form>
    ";
	}
}
?>