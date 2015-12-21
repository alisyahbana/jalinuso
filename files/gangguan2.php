<style type="text/css">
.gangguan {width:95%}
</style>
<script type="text/javascript">
          function save(){
               document.getElementById("submitgangguan").submit();     
          }
function cek_data(){
if (form.nama_pelapor.value=="")
{
     alert("Nama Pelapor tidak boleh kosong");
     form.nama_pelapor.focus();
     return false;
}
if (form.telp_pelapor.value=="")
{
     alert("No Telp Pelapor tidak boleh kosong");
     form.telp_pelapor.focus();
     return false;
}
if (form.provinsi.value=="UNDEFINED")
{
     alert("Harap pilih Provinsi");
     form.provinsi.focus();
     return false;
}
if (form.kabupaten.value=="")
{
     alert("Kabupaten tidak boleh kosong");
     form.kabupaten.focus();
     return false;
}
if (form.institusi.value=="")
{
     alert("Institusi Pelapor tidak boleh kosong");
     form.institusi.focus();
     return false;
}
if (form.alamat.value=="")
{
     alert("Alamat tidak boleh kosong");
     form.alamat.focus();
     return false;
}
return true;
}
     </script>


		
          <font style="color:#FF0000;"><i>*  Harus Diisi</i></font>
<form action="" method="post" id="form" onsubmit="return cek_data()"    >
          <table width='95%' cellpadding='5'>
          <tr><td width='35%'>Nama Pelapor</td><td width='1%'> :</td><td width='64%'> <input type='text' id="nama_pelapor" class='gangguan' name="nama_pelapor" style="text-transform:none;"> 
          <span style="color: #FF0000">*</span></td></tr>

          <tr><td>No Telp Pelapor</td><td> :</td><td> <input type='text' class='gangguan' name="telp_pelapor" style="text-transform:none;">
          <span style="color: #FF0000">*</span></td></tr>
          <tr><td>Regional Paket</td><td> : </td><td><select name="regional" class='gangguan' id="regional">
          	<option>
          		KALIMANTAN (PAKET 3)
          	</option>
          	<option>
          		SULAWESI (PAKET 4)
          	</option>
          	<option>
          		BALINUSRA (PAKET 6)
          	</option>

          </select>
          </td></tr>
          <tr><td>Provinsi</td><td> : </td><td><select name="provinsi" class='gangguan' id="provinsi" >

          	<?php 
	
	$sql="select * from provinsi";
	$mysql=mysql_query($sql);
	while($row=mysql_fetch_array($mysql)){
	$provinsi=$row['nama_provinsi'];
	echo "<option>$provinsi</option>";
	}
	?>
          </select>

          </td></tr>

          <tr><td>Kabupaten</td><td> :</td><td> <input type='text' name="kabupaten" class='gangguan' style="text-transform:none;">
          <span style="color: #FF0000">*</span></td></tr>
          <tr><td>Site</td><td> :</td><td> 
          	<input type="checkbox" id="site1" name="site[]" value="Site 1 ">
               <label for="site1">Site 1</label><br>
			<input type="checkbox" id="site2" name="site[]" value="Site 2 ">
               <label for="site2">Site 2</label></td></tr>
          <tr><td>Institusi<br><font size="1.5"><i>(kominfo, dishub, sekolah, pesantren, dll)</font></td><td> :</td><td> <input type='text' class='gangguan' name="institusi" style="text-transform:none;">
          <span style="color: #FF0000">*</span></td></tr>
          <tr><td>Alamat</td><td> :</td><td> <input type='text' name="alamat" style="text-transform:none;">
          <span style="color: #FF0000">*</span></td></tr>

          <tr><td>Jenis Gangguan</td><td> :</td><td> 
          	<input type="checkbox" id="gangguan_jaringan" name="gangguan[]" value="Gangguan Jaringan; ">
               <label for="gangguan_jaringan">Gangguan Jaringan</label><br>
          	<input type="checkbox" id="gangguan_perangkat" name="gangguan[]" value="Gangguan Perangkat; ">
               <label for="gangguan_perangkat">Gangguan Perangkat</label><br>
          	<input type="checkbox" id="gangguan_aplikasi" name="gangguan[]" value="Gangguan Aplikasi; ">
               <label for="gangguan_aplikasi">Gangguan Aplikasi</label><br>
			<input type="checkbox" id="gangguan_lainnya" name="gangguan[]" value="Gangguan Lainnya; ">
               <label for="gangguan_lainnya">Gangguan Lainnya</label><br>


		</td></tr>

          <tr valign='top'><td>Penjelasan Detail Gangguan</td><td> :</td><td> <textarea name='detail_gangguan' id='deskripsi' value ='' rows='100' cols='55' class='gangguan' style='height:144px; text-transform:none;'></textarea></td></tr>


          <tr><td>
            <div id='datasetting_submit'>
          <input type='submit' id="save" class="button" name="submitgangguan" value='Submit'/>
        </div></td>
          </table></form>



<?php
$site_value=$gangguan_value="";

if(isset($_POST['submitgangguan'])){
    if(!empty($_POST['site'])) {
    foreach($_POST['site'] as $data) {
            $site_value .= $data; 
    }
     }

      if(!empty($_POST['gangguan'])) {
    foreach($_POST['gangguan'] as $data) {
            $gangguan_value .= $data; 
    }
     }


     $query=mysql_query("INSERT INTO `data_gangguan` VALUES (NULL, '$_POST[nama_pelapor]', '$_POST[telp_pelapor]', '$_POST[regional]', '$_POST[provinsi]', '$_POST[kabupaten]', '$site_value', '$_POST[institusi]', '$_POST[alamat]', '$gangguan_value', '$_POST[detail_gangguan]');");

     if(!$query){
               die(mysql_error());
          }else{
               echo "<script>alert('Data Berhasil Masuk!');</script>";
          }

}

     
?>