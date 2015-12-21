<?php
if (!isset($_SESSION['LEVEL'])) {
    header('Location: ./');
}
else {
	$admin = $_SESSION['LEVEL'];
}
?>

<head>
    <title>Data IP Address</title>
    <link href="css/style.css" rel="stylesheet"/>
</head>


<?php
if(isset($provinsi)){
	$query = mysql_query("SELECT * FROM data_lokasi WHERE provinsi='$provinsi'");
} else {
	$query = mysql_query("SELECT * FROM data_lokasi");
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
        <tr>
            <th scope="col" width="">No.</th>
            <th scope="col" width="23%">Kabupaten/Kota</th>
            <th scope="col" width="10%">No. Jaringan</th>
            <th scope="col" width="7%">Site</th>
            <th scope="col" width="18%">Institusi</th>
            <th scope="col" width="42%">Alamat</th>
        </tr>
        </thead>
    <?php
    while($data = mysql_fetch_array($query)){
        $no++;
        
        if(empty($data['kab_kota'])){
			$data['kab_kota'] = "-";
		}
		
		if(empty($data['site'])){
			$data['site'] = "-";
		} else {$data['site'] = "Site $data[site]";}
		
		if(empty($data['instansi'])){
			$data['instansi'] = "-";
		}
        
        if(empty($data['alamat'])){
			$data['alamat'] = "-";
		}
		
        echo "
        <tbody>
        <tr onclick=\"if (link) window.location ='?page=detail&id=$data[no_jaringan]'\">
            <td>$no</td>
            <td>$data[kab_kota]</td>
            <td>$data[no_jaringan]</td>
            <td>$data[site]</td>
            <td>$data[instansi]</td>
            <td>$data[alamat]</td>
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
