<?php
if(!isset($_SESSION)){
 session_start();
}

if (!isset($_SESSION['LEVEL'])) {
	//echo "<script> window.location.href= './files/login.php';</script>";
	include("./files/login.php");
}
else {
	$admin = $_SESSION['LEVEL'];
	include('dbconfig');
?>

<html>
<head>
	<title>Aplikasi Jalin USO</title>
	<link rel="stylesheet" href="./css/style.css" />
	<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon"/>
	
	<!--menambahkan jquery-->
	<script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/JIC.js"></script>
	<!--menambahkan fancybox-->
	<script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>

	<!--menambahkan css fancybox-->
	<link href="js/fancybox/jquery.fancybox-1.3.4.css" type="text/css" rel="stylesheet"/>
	
	<!-- Ajax Autocomplete Search -->
	<script type="text/javascript" src="ajax/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="ajax/jquery-ui-1.8.18.min.js"></script>
	<link rel="stylesheet" type="text/css" href="ajax/jquery-ui-1.8.css" />
	<script type="text/javascript">
		$(document).ready(function(){
			$("#search").autocomplete({
				source:'files/livesearch.php',
				minLength:1
			});
		});
	</script>
</head>
	
<body>
	<div id="leftsection">
		<div id="logo"><a href="./">Indotelco<span class="logosmall">Services</span></a></div>
		<div id="verticalmenu">
			<div id="credit">Aplikasi Jalin USO v1.0</div>
			<ul>
				<li><a class="home" href="./" title="Home">HOME</a></li>
				<li>
					<a class="trigger" href="#" title="Wilayah Kalimantan">PAKET 3</a>
					<ul>
						<?php
							$paket3 = mysql_query("SELECT * FROM provinsi WHERE paket=3");
							while($paket = mysql_fetch_array($paket3)){
								echo "<li><a href='?list=".strtolower($paket['nama_provinsi'])."'>$paket[nama_provinsi]</a></li>";
							}
						?>
					</ul>
				</li>
				
				<li>
					<a class="trigger" href="#" title="Wilayah Sulawesi">PAKET 4</a>
					<ul>
						<?php
							$paket4 = mysql_query("SELECT * FROM provinsi WHERE paket=4");
							while($paket = mysql_fetch_array($paket4)){
								echo "<li><a href='?list=".strtolower($paket['nama_provinsi'])."'>$paket[nama_provinsi]</a></li>";
							}
						?>
					</ul>
				</li>
				
				<li>
					<a class="trigger" href="#" title="Wilayah Balinusra">PAKET 6</a>
					<ul>
						<?php
							$paket6 = mysql_query("SELECT * FROM provinsi WHERE paket=6");
							while($paket = mysql_fetch_array($paket6)){
								echo "<li><a href='?list=".strtolower($paket['nama_provinsi'])."'>$paket[nama_provinsi]</a></li>";
							}
						?>
					</ul>
				</li>
				<li><a class='gangguan' href="?page=gangguan" title="Daftar Gangguan">GANGGUAN</a></li>
				<li><a class='setting' href="?page=setting" title="Pengaturan Akun">SETTING</a></li>
				<li><a class='logout' href="?page=logout" title="Keluar Aplikasi">LOGOUT</a></li>
			</ul>
		</div>
	</div>
	
	<div id="rightsection">
		<div id="topmenu">
			<span style="float:right;color:#a7a7a7;padding:0 10px;line-height:50px;">
				<?php
					if($_SESSION['LEVEL']==0){
						$tipe = "Super Admin";
					}else if($_SESSION['LEVEL']==1){
						$tipe = "Administrator";
					}else if($_SESSION['LEVEL']==2){
						$tipe = "Operator";
					}
					
					echo $_SESSION['ID']." (".$tipe.")";
				?>
			</span>
			<script type="text/javascript">
				function searchDetail(){
					var id = document.getElementById("search").value;
					document.getElementById("search_form").action = "/?page=detail&id="+id;
				}
			</script>
			<form id="search_form" method="POST">
				<input type="text" class="search" id="search" name="search" placeholder="Pencarian  no.jaringan,  kota,  dan  alamat..."></input>
				<input type="submit" id="submit" name="submit_search" onclick="searchDetail()" value="Submit"/>
			</form>
		</div>
		<div id="menu">
			<span id="menu_left">
				<?php
					if(!empty($_GET['list'])){
						echo "Menampilkan Hasil untuk Provinsi : <a href='?list=$_GET[list]'>$_GET[list]</a>";
					}
if($_GET['page'] == "gangguan"){
 echo "Menampilkan <a href='/?page=gangguan'>Daftar Gangguan</a>";
}
				?>
			</span>
			<span id="menu_right">
			<?php
			if(isset($_GET['page'])){
				if($_GET['page'] == "detail"){
						?>
							<form id='detail_jaringan' method='POST' action=''>
							<?php
								if($_SESSION['LEVEL'] != 2){
									if($_SESSION['LEVEL'] == 1){
										$query_provinsi = mysql_query("SELECT * FROM data_lokasi WHERE no_jaringan='$_GET[id]'");
										$prov = mysql_fetch_array($query_provinsi);
											if($_SESSION['PROV'] == $prov['provinsi']){
												echo "
												<input type='submit' class='edit' name='edit' value='Edit'/>
												<input type='submit' class='delete' name='delete' value='Hapus'/>
												";
											}
									} else {
										echo "
										<input type='submit' class='edit' name='edit' value='Edit'/>
										<input type='submit' class='delete' name='delete' value='Hapus'/>
										";
									}
								}
							?>
							<input type='submit' class='back' name='back' value='Kembali'/>
							</form>
						<?php
				}
				if ($_GET['page'] == "detail_gangguan") {
					?>

							<form id='detail_jaringan' method='POST' action=''>
							<input type='submit' class='delete' name='delete' value='Hapus'/>
							<input type='submit' class='back' name='back' value='Kembali'/>
							</form>

					<?php
				}
			} else {
				if($_SESSION['LEVEL'] != 2){
					echo "
						<form id='edit_jaringan' method='POST' action='?page=add'>
							<input type='submit' class='tambah' name='tambah' value='Tambah Data'/>
						</form>
					";
				}
			}
			?>
			</span>
		</div>
		<div id="content">
			<?php
				if(isset($_GET['page'])){
					if(file_exists("./files/$_GET[page].php")){
						include ("./files/$_GET[page].php");
					}
					else {
						echo "<h2>Error 404</h2><p>Halaman tidak ditemukan!</p>";
					}
				}
				else {
					
					if(isset($_GET['list'])){
						$getprovinsi = mysql_fetch_array(mysql_query("SELECT * FROM provinsi WHERE nama_provinsi LIKE '$_GET[list]'"));
						$provinsi = $getprovinsi['id_provinsi'];
						$_SESSION['list'] = $_GET['list'];
						include ("./files/list.php");
					} else {
						include ("./files/home.php");
					}
					
					if(!isset($_GET['list'])){
						unset($_SESSION['list']);
					}
				}
			?>
		</div>
	</div>
</body>
</html>

<?php
}		//end of else session level
?>

<?php
 if (isset ($_POST["paket"])){
 $paket=$_POST["paket"];
  $result=mysql_query("select * FROM provinsi where paket='$paket' ");
  while($provinsi=mysql_fetch_array($result)){
      echo"<option value='$provinsi[nama_provinsi]'>$provinsi[nama_provinsi]</option>";
 
  } 
 }
 
?>