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
$id = $_GET['id'];
echo "<head><title>Jaringan $id</title></head>";

$query = mysql_query("SELECT * FROM data_teknis_sn WHERE no_jaringan='$id'");

if(mysql_num_rows($query) != 0){
if($data = mysql_fetch_array($query)){
    
    echo "
    <div id='dataform_menu' style='padding: 0 0 10px 10px'>
        <a href='?page=editsn&id=$id' id='edit'>Edit</a>
        <a href='javascript:history.back(-1)' id='back'>Kembali</a>
    </div>
    <div id='dataform'>
	<h1>Detail Serial Number</h1>
    
    <div id='dataform_bottom'>
    <h4>Serial Number</h4>
    <table width='50%'>
    <tr><td width='30%'>No. Jaringan</td><td> : $data[no_jaringan]</td></tr>
	<tr><td>Modem</td><td> : $data[modem]</td></tr>
	<tr><td>Router</td><td> : $data[router]</td></tr>
	<tr><td>Server</td><td> : $data[server]</td></tr>
	<tr><td>UPS</td><td> : $data[UPS]</td></tr>
	<tr><td>Access Point 1</td><td> : $data[AP_1]</td></tr>
	<tr><td>Access Point 1</td><td> : $data[AP_2]</td></tr>
    <tr><td>Access Point 1</td><td> : $data[AP_3]</td></tr>
	<tr><td>Switch</td><td> : $data[switch]</td></tr>
    </table>
    </div>
	
    </div>
    ";
}
}else{
	echo "<h2>Error 404</h2><p>Halaman tidak ditemukan!</p>";
}
?>