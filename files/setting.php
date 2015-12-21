<?php
if (!isset($_SESSION['LEVEL'])) {
    header('Location: login.php');
}
else{
$level=$_SESSION ['LEVEL'];
$username=$_SESSION['ID'];
if($level!='0'){
	echo "Halaman Setting Hanya Untuk Super Admin";
  exit;
}
}
?>
<div id='dataform'>
<div id='dataform_left'>
<h4>Ganti Password</h4>
          <form action="files/setting/password_proses.php" method="post">
          <table width='100%'>
          <tr><td width='35%'>Masukkan Password Lama</td><td> : </td><td><input type='password' name="pass_lama"></td></tr>
          <tr><td>Masukkan Password Baru</td><td> : </td><td><input type='password' name="pass_baru"></td></tr>
          <tr><td>Masukkan Lagi Password Baru</td><td> : </td><td><input type=password name="pass_ulangi"></td></tr>
          <tr><td></td><td></td><td>
            <div id='datasetting_submit'>
          <input type='submit' class="button" name="gantipassword" value='Proses'    />
        </div></td>
      </tr>
                            <!-- <input type=button value=Batal onclick=self.history.back()></td></tr> -->
          </table>
        </form>
        </div>

<div id='dataform_right'>
<h4>Ganti Username</h4>
          <form action="files/setting/username_proses.php" method="post">
          <table width='100%'>
          <tr><td width='35%'>Username</td><td> : </td><td><input type='text' name="username" value='<?php echo $username?>' readonly style="text-transform:none;"></td></tr>
          <tr><td>Username Baru</td><td> : </td><td><input type='text' name="username_baru" style="text-transform:none;"></td></tr>
          <tr><td></td><td></td><td>
            <div id='datasetting_submit'>
          <input type='submit' class="button" name="gantipassword" value='Proses'    />
        </div></td>
      </tr>
                            <!-- <input type=button value=Batal onclick=self.history.back()></td></tr> -->
          </table>
        </form>
        </div>
        
<div id='dataform_bottom'>
<h4>Akun Baru</h4>
<form action="files/setting/nambah_proses.php" method="post">
          <table width='100%'>
          <tr><td width='10%'>Username</td><td> :</td><td> <input type='text' name="newacc_username" style="width:40%;"></td></tr>
          <tr><td>Password</td><td> :</td><td> <input type='password' name="newacc_password" style="width:40%;"></td></tr>
          <tr><td>Ulangi Password</td><td> : </td><td><input type='password' name="newacc_password_repeat" style="width:40%;"></td></tr>
          <tr><td>Tipe </td><td>: </td><td>
   <input type="radio" name="tipe"   value="1" checked> Admin
   <input type="radio" name="tipe"   value="2"> Operator
   <br><br></td></tr>
          <tr><td>Provinsi</td><td> : </td><td><select name="provinsi" id="provinsi" style="">

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


          <tr><td colspan=2>
            <div id='datasetting_submit'>
          <input type='submit' class="button" name="gantipassword" value='Proses'    />
        </div></td>
            <!-- <input type="submit" class="button" name="akunbaru" value=Proses> -->
                            <!-- <input type=button value=Batal onclick=self.history.back()></td></tr> -->
          </table></form>
          
          <h4>Daftar Akun</h4>

          <table border="0" cellpadding="10" width=100%>
          
<tr bgcolor="#25313e" align="center" style="font-weight:bolder; color:white;">  
<td width=10%>No.</td>
<td>Akun</td>
<td>Provinsi</td>
<td>Action</td>
<?php
$query = "select * from data_user";  
$rowSet = mysql_query($query);
$i=1;
while($row = mysql_fetch_array($rowSet)){
$Akun=$row['username'];
$id_provinsi=$row['provinsi'];

$sql=mysql_query("select * from provinsi where id_provinsi='$id_provinsi'");
$r=mysql_fetch_array($sql);
$provinsi=$r['nama_provinsi'];

echo"<tr style='font-size:13px' ><td align='center'>".$i."</td>
<td>$Akun</td>
<td>$provinsi</td>
<td><a href='files/setting/hapus_proses.php?id=".$row['username']."&action=delete'>Delete</a></td>";
$i++;  

}

?>

</table>



</div> <!-- end of dataform_bottom -->



</div> <!-- end of dataform -->