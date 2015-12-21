<?php

if (!isset($_SESSION['LEVEL'])) {
	header('Location: login.php');
}
else{
$admin=$_SESSION['LEVEL'];
}
?>
<?php

include ('connect.php');

//start of save to db
if(isset($_POST['save'])){
	$save = mysql_query("UPDATE data_teknis_sn SET no_jaringan='$_POST[no_jar]', modem='$_POST[modem]', router='$_POST[router]', server='$_POST[server]', 
					UPS='$_POST[ups]', AP_1='$_POST[ap_1]', AP_2='$_POST[ap_2]', AP_3='$_POST[ap_3]', switch='$_POST[switch]' WHERE no_jaringan='$_GET[id]'");
	if(!$save) {
		die(mysql_error());
	}else {
		echo "<script>alert('Data Berhasil Diperbaharui!'); window.location.href='?page=detailsn&id=$_POST[no_jar]';</script>";
	}
}
//end of save to db

$id = $_GET['id'];
echo "<head><title>Jaringan $id</title></head>";

$query = mysql_query("SELECT * FROM data_teknis_sn WHERE no_jaringan='$id'");

if($data = mysql_fetch_array($query)){
    
    echo "
    <form id='edit_sn' method='POST' action=''>
	<div id='dataform_menu'>
	<input type='submit' id='save' name='save' value='Simpan'/>
	<a href='?page=detailsn&id=$id' id='cancel'>Cancel</a>
	</div>
	
    <div id='dataform'>
    <h1>Detail Serial Number</h1>
	
    <div id='dataform_bottom'>
    <h4>Serial Number</h4>
    <table width='50%'>
    <tr><td width='30%'>No. Jaringan</td><td> : <input type='text' name='no_jar' value='$data[no_jaringan]'/></td></tr>
	<tr><td>Modem</td><td> : <input type='text' name='modem' value='$data[modem]'/></td></tr>
	<tr><td>Router</td><td> : <input type='text' name='router' value='$data[router]'/></td></tr>
	<tr><td>Server</td><td> : <input type='text' name='server' value='$data[server]'/></td></tr>
	<tr><td>UPS</td><td> : <input type='text' name='ups' value='$data[UPS]'/></td></tr>
	<tr><td>Access Point 1</td><td> : <input type='text' name='ap_1' value='$data[AP_1]'/></td></tr>
	<tr><td>Access Point 1</td><td> : <input type='text' name='ap_2' value='$data[AP_2]'/></td></tr>
    <tr><td>Access Point 1</td><td> : <input type='text' name='ap_3' value='$data[AP_3]'/></td></tr>
	<tr><td>Switch</td><td> : <input type='text' name='switch' value='$data[switch]'/></td></tr>
    </table>
    </div>
	
    </div>
	</form>
    ";
}
?>