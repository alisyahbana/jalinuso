<?php

if (!isset($_SESSION['LEVEL'])) {
    header('Location: login.php');
}
else{
$admin=$_SESSION['LEVEL'];
}
?>

	<script type="text/javascript">
		function save(){
			document.getElementById("add").submit();	
		}
	</script>
	
    <form id='tambah_jaringan' method='POST' action=''>
	
    <div id='dataform'>
	
	<div id='dataform_left'>
	<h4>Data Lokasi</h4>
    <table width='100%'>
	<tr><td width='35%'>No. Jaringan</td><td> : </td><td><input type='text' name='no_jar'/></td></tr>
    <tr>
		<td>Provinsi</td>
		<td> : </td>
		<td>
			<?php
				$prop = mysql_query("SELECT * FROM provinsi");
				echo "<select name='provinsi'>";
				while($provinsi = mysql_fetch_array($prop)){
					echo "<option value='$provinsi[id_provinsi]' ";
					if($provinsi['id_provinsi'] == $_SESSION['PROV']){
						echo "selected";
					} else if($provinsi['id_provinsi'] != $_SESSION['PROV']){
						if($_SESSION['LEVEL'] != 0) {
							echo "disabled";
						}
					}
					echo ">$provinsi[nama_provinsi]</option>";
				}
			?>
			</select>
		</td>
	</tr>
    <tr><td>Kab./Kota</td><td> : </td><td><input type='text' name='kab_kota'/></td></tr>
    <tr valign="top"><td>Alamat</td><td> : </td><td><textarea name='alamat'></textarea></td></tr>
    <tr><td>SITE</td><td> : </td><td><input type='text' name='site' /></td></tr>
    <tr><td>PIC</td><td> : </td><td><input type='text' name='pic' /></td></tr>
    <tr><td>Jabatan</td><td> : </td><td><input type='text' name='jabatan' /></td></tr>
    <tr><td>Instansi</td><td> : </td><td><input type='text' name='instansi' /></td></tr>
    <tr><td>Kordinat</td><td> : </td><td><input type='text' name='kordinat' /></td></tr>
    <tr><td>Status Kepemilikan (Gedung)</td><td> : </td><td><input type='text' name='status_kepemilikan_tempat' /></td></tr>
    <tr><td>No. Telp Kantor</td><td> : </td><td><input type='text' name='no_tlp' /></td></tr>
    <tr><td>Hp</td><td> : </td><td><input type='text' name='hp' /></td></tr>
    <tr><td>Tanggal BA OPS</td><td> : </td><td><input type='text' name='tgl_ba_ops' /></td></tr>
    
    </table>
	</div>
	
    <div id='dataform_right'>
    <h4>Data Teknis</h4>
    <table width='100%'>
	<tr><td></td><td></td><td>IP Address<td></td><td>Serial Number</td></tr>
    <tr><td width="20%">Modem</td><td> : </td><td width="30%"><input type='text' name='ipmodem'/><td></td><td><input type='text' name='snmodem'/></td></tr>
    <tr><td>Router</td><td> : </td><td><input type='text' name='iprouter'/></td><td></td><td><input type='text' name='snrouter'/></td></tr>
    <tr><td>Server</td><td> : </td><td><input type='text' name='ipserver'/></td><td></td><td><input type='text' name='snserver'/></td></tr>
    <tr><td>Switch</td><td> : </td><td><input type='text' name='ipswitch'/></td><td></td><td><input type='text' name='snswitch'/></td></tr>
    <tr><td>Client</td><td> : </td><td><input type='text' name='ipclient'/></td><td></td><td><input type='text' name='snclient'/></td></tr>
    <tr><td>Access Point 1</td><td> : </td><td><input type='text' name='ipap_1'/></td><td></td><td><input type='text' name='snap_1'/></td></tr>
    <tr><td>Access Point 2</td><td> : </td><td><input type='text' name='ipap_2'/></td><td></td><td><input type='text' name='snap_2'/></td></tr>
    <tr><td>Access Point 3</td><td> : </td><td><input type='text' name='ipap_3'/></td><td></td><td><input type='text' name='snap_3'/></td></tr>
    </table>
    </div>
    
    <div id='dataform_right'>
    <h4>Upload Foto</h4>
    Untuk mengunggah foto, silahkan simpan data jaringan terlebih dahulu kemudian masuk ke detail jaringan.
    </div>
    
    <div id="dataform_submit">
		<input type="submit" id="save" name="add" value="Simpan"/>
		<input type="submit" id="cancel" name="cancel" value="Batal"/>
	</div>

    </div>
    </form>


<?php
	if(isset($_POST['add'])){
		$no_jar = $_POST['no_jar'];
		
		$query_dl = mysql_query("INSERT INTO data_lokasi (`no_jaringan`, `provinsi`, `kab_kota`, `site`, `pic`, `jabatan`, `instansi`, 
								`kordinat`, `status_kepemilikan_tempat`, `no_tlp`, `hp`, `alamat`, `tgl_ba_ops`) 
								VALUES ('$no_jar', '$_POST[provinsi]', '$_POST[kab_kota]', '$_POST[site]', '$_POST[pic]' , 
								'$_POST[jabatan]' , '$_POST[instansi]', '$_POST[kordinat]' , '$_POST[status_kepemilikan_tempat]' , '$_POST[no_tlp]' , 
								'$_POST[hp]', '$_POST[alamat]', '$_POST[tgl_ba_ops]');");
		
		$query_ip = mysql_query("INSERT INTO data_teknis_ip (`no_jaringan`, `modem`, `router`, `server`, `switch`, `client`, `AP1`, `AP2`, `AP3`) 
								VALUES ('$no_jar', '$_POST[ipmodem]', '$_POST[iprouter]', '$_POST[ipserver]', '$_POST[ipswitch]', '$_POST[ipclient]', 
								'$_POST[ipap_1]', '$_POST[ipap_2]', '$_POST[ipap_3]');");
		
		$query_sn = mysql_query("INSERT INTO data_teknis_sn (`no_jaringan`, `modem`, `router`, `server`, `switch`, `client`, `AP1`, `AP2`, `AP3`) 
								VALUES ('$no_jar', '$_POST[snmodem]', '$_POST[snrouter]', '$_POST[snserver]', '$_POST[snswitch]', '$_POST[snclient]', 
								'$_POST[snap_1]', '$_POST[snap_2]', '$_POST[snap_3]');");
								
		if(!$query_dl){
			die(mysql_error());
		} else if(!$query_ip){
            die(mysql_error());
        } else if(!$query_sn){
            die(mysql_error());
        } else{
			echo "<script>alert('Data Berhasil Ditambahkan!'); window.location.href='./';</script>";
		}
	} else if(isset($_POST['cancel'])){
			echo "<script>window.location.href='./';</script>";
	}
?>