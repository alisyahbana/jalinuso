<?php


// jumlah data yang akan ditampilkan per halaman

$dataPerPage = 5;

// apabila $_GET['page'] sudah didefinisikan, gunakan nomor halaman tersebut, 
// sedangkan apabila belum, nomor halamannya 1.

if(isset($_GET['id']))
{
    $noPage = $_GET['id'];
} 
else $noPage = 1;

// perhitungan offset

$offset = ($noPage - 1) * $dataPerPage;

// query SQL untuk menampilkan data perhalaman sesuai offset

$query = "SELECT * FROM data_gangguan ORDER BY id DESC LIMIT $offset, $dataPerPage ";

$result = mysql_query($query) or die(mysql_error());
// menampilkan data 

//echo "<table border='1'>";
//echo "<tr><td>Nama</td><td>Telp</td><td>Paket</td><td>Provinsi</td><td>Kabupaten</td><td>Site</td><td>Institusi</td><td>Alamat</td><td>Jenis Gangguan</td><td>Detail Gangguan</td></tr>";
while($data = mysql_fetch_array($result))
{
   echo "<ul style='list-style:none; padding:0; font-weight:normal; '>
<li>

<a href='?page=detail_gangguan&id=$data[id]'>
Data Pelapor : $data[nama_pelapor], $data[telp_pelapor] 
<br>
Status : $data[jenis_gangguan]
<br>
Lokasi : $data[alamat], $data[kabupaten], $data[provinsi]
<br>
<!--
Data Jaringan: $data[paket], $data[provinsi], $data[kabupaten], $data[site], $data[institusi]
<br>
Alamat Jaringan : $data[alamat]
<br> 
Data Gangguan: $data[jenis_gangguan], $data[detail_gangguan]
<br> 
Tanggal Input: $data[tanggal_input]
<br>
-->

<br>
<!--
<a href='./files/delete_gangguan.php?id=".$data['id']."&action=delete' onclick=\"return confirm('Anda yakin?');\">Delete</a>
-->
</a>
</li>
</ul>";
}

//echo "</table>";

// mencari jumlah semua data dalam tabel data_gangguan

$query   = "SELECT COUNT(*) AS jumData FROM data_gangguan";
$hasil  = mysql_query($query);
$data     = mysql_fetch_array($hasil);

$jumData = $data['jumData'];

// menentukan jumlah halaman yang muncul berdasarkan jumlah semua data

$jumPage = ceil($jumData/$dataPerPage);

echo "page : ";
// menampilkan link previous

if ($noPage > 1) echo  "<a href='".$_SERVER['PHP_SELF']."?page=home&id=".($noPage-1)."'>&lt;&lt; Prev</a>";

// memunculkan nomor halaman dan linknya

for($page = 1; $page <= $jumPage; $page++)
{
         if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage)) 
         {   

           // if (($showPage == 1) && ($page != 2))  echo "..."; 
           //  if (($showPage != ($jumPage - 1)) && ($page == $jumPage))  echo "...";
            if ($page == $noPage) echo " <b>".$page."</b> ";
            else echo " <a href='".$_SERVER['PHP_SELF']."?page=home&id=".$page."'>".$page."</a> ";
            $showPage = $page;   
         }
}

// menampilkan link next

if ($noPage < $jumPage) echo "<a href='".$_SERVER['PHP_SELF']."?page=home&id=".($noPage+1)."'>Next &gt;&gt;</a>";

?>
<br>