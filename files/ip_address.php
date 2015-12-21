<?php
if (!isset($_SESSION['LEVEL'])) {
    header('Location: /jalinuso/files/login.php');
}
else{
$admin=$_SESSION['LEVEL'];
}
?>

<head>
    <title>Data IP Address</title>
    <link href="css/style.css" rel="stylesheet"/>
</head>

<?php

include('dbconfig');

if(isset($_POST['provinsi'])){
    $provinsi = $_POST['provinsi'];
    if($provinsi == "all"){
        $query = mysql_query("SELECT * FROM data_teknis_ip");
    } else {
        $query = mysql_query("SELECT * FROM data_teknis_ip WHERE provinsi LIKE '$provinsi'");
    }
} else {
    $query = mysql_query("SELECT * FROM data_teknis_ip");
} ?>
<div id='dataform_menu'><a href='?page=add' style="float:right;margin:-15px 10px 0 0;padding: 10px 30px 10px 50px;" id="add">Tambah Data</a></div>
<form id='select_provinsi' method='POST' action='' style="margin:10px 0 0 10px">
Tampil Berdasarkan Provinsi:
<select id="provinsi" name='provinsi' onchange='submit()'>
    <? $x = $_POST['provinsi']; ?>
    <option value='all'>--Semua Provinsi--</option>
    <option value='kalimantan barat' <? if((!empty($x)) && ($x == "kalimantan barat")){echo "selected='selected'";} ?> >Kalimantan Barat</option>
    <option value='kalimantan tengah' <? if((!empty($x)) && ($x == "kalimantan tengah")){echo "selected='selected'";} ?> >Kalimantan Tengah</option>
    <option value='kalimantan selatan' <? if((!empty($x)) && ($x == "kalimantan selatan")){echo "selected='selected'";} ?> >Kalimantan Selatan</option>
    <option value='kalimantan timur' <? if((!empty($x)) && ($x == "kalimantan timur")){echo "selected='selected'";} ?> >Kalimantan Timur</option>
    <option value='sulawesi utara' <? if((!empty($x)) && ($x == "sulawesi utara")){echo "selected='selected'";} ?> >Sulawesi Utara</option>
	<option value='sulawesi selatan' <? if((!empty($x)) && ($x == "sulawesi selatan")){echo "selected='selected'";} ?> >Sulawesi Selatan</option>
	<option value='sulawesi barat' <? if((!empty($x)) && ($x == "sulawesi barat")){echo "selected='selected'";} ?> >Sulawesi Barat</option>
	<option value='sulawesi tengah' <? if((!empty($x)) && ($x == "sulawesi tengah")){echo "selected='selected'";} ?> >Sulawesi Tengah</option>
    <option value='sulawesi tenggara' <? if((!empty($x)) && ($x == "sulawesi tenggara")){echo "selected='selected'";} ?> >Sulawesi Tenggara</option>
    <option value='gorontalo' <? if((!empty($x)) && ($x == "gorontalo")){echo "selected='selected'";} ?> >Gorontalo</option>
    <option value='bali' <? if((!empty($x)) && ($x == "bali")){echo "selected='selected'";} ?> >Bali</option>
    <option value='ntb' <? if((!empty($x)) && ($x == "ntb")){echo "selected='selected'";} ?> >NTB</option>
    <option value='ntt' <? if((!empty($x)) && ($x == "ntt")){echo "selected='selected'";} ?> >NTT</option>
</select>
</form>
<!--
<form id="search_form" method="POST" action="">
<input type="text" name="search"></input>
<input type="submit" name="submit_search" value="Search"/>
</form>
-->
<?php
if(isset($_POST['submit_search'])){
	$xy = $_POST['search'];
	$query = mysql_query("SELECT * FROM data_teknis_ip WHERE (no_jaringan LIKE '%$xy%') OR (provinsi LIKE '%$xy%') OR (kab_kota LIKE '%$xy%') OR 
							(router LIKE '%$xy%') OR (UPS LIKE '%$xy%')");
}


if(mysql_num_rows($query) != 0){
    $no = 0;
    ?>
    <script type="text/javascript">
        var link=true;
    </script>
    <div class='data_list'>
    <table id='gradient-style'> <!--border="1" cellpadding="3" width="100%" style="border-collapse:collapse" -->
        <thead>
        <tr> <!--bgcolor="#368ed2" style="font-weight:bolder"-->
            <th scope="col">No.</th>
            <th scope="col">Kabupaten/Kota</th>
            <th scope="col">No. Jaringan</th>
            <th scope="col">Modem</th>
            <th scope="col">Router</th>
            <th scope="col">Server</th>
            <th scope="col">UPS</th>
            <th scope="col">Access Point 1</th>
            <th scope="col">Access Point 2</th>
            <th scope="col">Access Point 3</th>
            <th scope="col">Switch</th>
            <th scope="col">User Gateway</th>
        </tr>
        </thead>
    <?php
    while($data = mysql_fetch_array($query)){
        $no++;
        echo "
        <tbody>
        <tr onclick=\"if (link) window.location ='?page=detail&id=$data[no_jaringan]'\">
            <td>$no</td>
            <td>$data[kab_kota]</td>
            <td>$data[no_jaringan]</td>
            <td>$data[modem]</td>
            <td>$data[router]</td>
            <td>$data[server]</td>
            <td>$data[UPS]</td>
            <td>$data[AP_1]</td>
            <td>$data[AP_2]</td>
            <td>$data[AP_3]</td>
            <td>$data[switch]</td>
            <td>$data[client_gateway]</td>
        </tr>
        </tbody>
        ";
    }
    ?>
    </table>
    </div>
    <?php
} else {
    echo "Data Tidak Ditemukan";
}

?>
