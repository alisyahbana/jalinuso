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

	$query = mysql_query("SELECT * FROM data_gangguan ORDER BY id DESC");

if(mysql_num_rows($query) != 0){
    $no = 0;
    ?>
    <script type="text/javascript">
        var link=true;
    </script>
    <div class='data_list'>
    <table id='gradient-style' width="100%"> <!--border="1" cellpadding="3" width="100%" style="border-collapse:collapse" -->
        <thead>
        <tr>
            <th scope="col" width="1%">No.</th>
            <th scope="col" width="13%">Nama Pelapor</th>
            <th scope="col" width="8%">No. Telp.</th>
            <th scope="col" width="12%">Provinsi</th>
            <th scope="col" width="13%">Kabupaten</th>
            <th scope="col" width="13%">Institusi</th>
            <th scope="col" width="22%">Alamat</th>
            <th scope="col" width="10%">Jenis Gangguan</th>
            <th scope="col" width="8%">Tgl. Input</th>
        </tr>
        </thead>
    <?php
    while($data = mysql_fetch_array($query)){
        $no++;
		
        echo "
        <tbody>
        <tr onclick=\"if (link) window.location ='?page=detail_gangguan&id=$data[id]'\">
            <td>$no</td>
            <td>$data[nama_pelapor]</td>
            <td>$data[telp_pelapor]</td>
            <td>$data[provinsi]</td>
            <td>$data[kabupaten]</td>
            <td>$data[institusi]</td>
            <td>$data[alamat]</td>
            <td>$data[jenis_gangguan]</td>
            <td>$data[tanggal_input]</td>
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