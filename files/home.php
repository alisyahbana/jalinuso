<div id='dataform'>

<div id='dataform_gangguan'>
	<h4>List Gangguan</h4>
<?php
	include ('./files/show.php');
	 ?>
<br><br><br><br>

	
</div>

<div id='dataform_left'>
	<h4>Overview</h4>
Jumlah Total Database<br>
  <?php
$datakalbar = mysql_fetch_array(mysql_query("SELECT COUNT(provinsi) AS jumdata FROM data_lokasi WHERE provinsi='301' "));
$datakalsel = mysql_fetch_array(mysql_query("SELECT COUNT(provinsi) AS jumdata FROM data_lokasi WHERE provinsi='302' "));
$datakalteng = mysql_fetch_array(mysql_query("SELECT COUNT(provinsi) AS jumdata FROM data_lokasi WHERE provinsi='303' "));
$datakaltim = mysql_fetch_array(mysql_query("SELECT COUNT(provinsi) AS jumdata FROM data_lokasi WHERE provinsi='304' "));

$datagor = mysql_fetch_array(mysql_query("SELECT COUNT(provinsi) AS jumdata FROM data_lokasi WHERE provinsi='401' "));
$datasulbar = mysql_fetch_array(mysql_query("SELECT COUNT(provinsi) AS jumdata FROM data_lokasi WHERE provinsi='402' "));
$datasulsel = mysql_fetch_array(mysql_query("SELECT COUNT(provinsi) AS jumdata FROM data_lokasi WHERE provinsi='403' "));
$datasulteng = mysql_fetch_array(mysql_query("SELECT COUNT(provinsi) AS jumdata FROM data_lokasi WHERE provinsi='404' "));
$datasultengg = mysql_fetch_array(mysql_query("SELECT COUNT(provinsi) AS jumdata FROM data_lokasi WHERE provinsi='405' "));
$datasulut = mysql_fetch_array(mysql_query("SELECT COUNT(provinsi) AS jumdata FROM data_lokasi WHERE provinsi='406' "));

$databali = mysql_fetch_array(mysql_query("SELECT COUNT(provinsi) AS jumdata FROM data_lokasi WHERE provinsi='601' "));
$datantb = mysql_fetch_array(mysql_query("SELECT COUNT(provinsi) AS jumdata FROM data_lokasi WHERE provinsi='602' "));
$datantt = mysql_fetch_array(mysql_query("SELECT COUNT(provinsi) AS jumdata FROM data_lokasi WHERE provinsi='603' "));
    
    ?>
<div id="left_col">
Paket 3 :
	<br>Kalimantan Barat = <?php echo $datakalbar['jumdata'];?>
	<br>Kalimantan Selatan = <?php echo $datakalsel['jumdata'];?>
	<br>Kalimantan Tengah = <?php echo $datakalteng['jumdata'];?>
	<br>Kalimantan Timur = <?php echo $datakaltim['jumdata'];?>
	<br>
	<br>
	Paket 4 :
	<br>Gorontalo = <?php echo $datagor['jumdata'];?>
	<br>Sulawesi Barat = <?php echo $datasulbar['jumdata'];?>
	<br>Sulawesi Selatan = <?php echo $datasulsel['jumdata'];?>
	<br>Sulawesi Tengah = <?php echo $datasulteng['jumdata'];?>
	<br>Sulawesi Tenggara = <?php echo $datasultengg['jumdata'];?>
	<br>Sulawesi Utara = <?php echo $datasulut['jumdata'];?>
	<br>
	<br>
    </div>
    <div id="right_col">
	Paket 6 :
	<br>Bali = <?php echo $databali['jumdata'];?>
	<br>Nusa Tenggara Barat = <?php echo $datantb['jumdata'];?>
	<br>Nusa Tenggara Timur = <?php echo $datantb['jumdata'];?>

    </div>
	


</div>
<div id='dataform_left'>
	<h4>Tentang Aplikasi</h4>
	<p><img src='images/mini-overview.png' alt='jalinuso'/>Aplikasi Jalin USO merupakan sebuah aplikasi berbasis web yang dibangun menggunakan bahasa pemrograman PHP yang ditujukan untuk memudahkan pengguna dalam memanage database. 
	Fitur yang tersedia meliputi CRUD (Tambah, View, Edit, Hapus) untuk database dan user, upload foto dokumentasi, pencatatan gangguan, dan pengaturan akun.
	<br>Baca panduan -> <a href='?page=about' title='About and Help'>Selengkapnya</a></p>
</div>

</div>