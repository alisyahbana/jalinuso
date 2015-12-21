<style type='text/css'>
#result_image {
    height: 125px;
    padding:3px;
    border: 1px solid #000;
    margin: 10px 5px 0 0;
    
}
#img_description {
	margin-top:10px;
}
#jpeg_encode_button, #jpeg_upload_button {
	width:inherit;
}
#upload_image input {
	text-transform:none;
	width:95%;
}
#files {
  margin-top:15px;
}
#console_out {
  overflow: auto;
  height: 90px;
  border: 1px solid #d8d8d8;
  border-radius: 8px;
  padding: 10px;
  font-family: Courier;
  margin-bottom: 35px;
  line-height:22px;
}
</style>
<script src="ajax/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="js/JIC.js" type="text/javascript"></script>
<script src="js/image_compress.js" type="text/javascript"></script>
<script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>

    <!--menambahkan css fancybox-->
    <link href="js/fancybox/jquery.fancybox-1.3.4.css" type="text/css" rel="stylesheet"/>
    <link href="style.css" type="text/css" rel="stylesheet"/>
    <script type="text/javascript">
    $(document).ready(function(){
        $(".fancy").fancybox();
        });

    </script>

<div id='dataform_right'>
<h4>Dokumentasi (Gambar/Foto)</h4>

<table width='100%' id='upload_image'>
	<tr valign='top'>
		<!--image helper-->
		<td width='50%'>
			<input type="file" id="files" name="files[]"  accept="image/x-png, image/gif, image/jpeg, image/jpg" />
			<output id="list"></output>
			<script>
			  function handleFileSelect(evt) {
				var files = evt.target.files; // FileList object

				// Loop through the FileList and render image files as thumbnails.
				for (var i = 0, f; f = files[i]; i++) {
				
				
				  // Only process image files.
				  if (!f.type.match('image.*')) {
					continue;
				  }

				  var reader = new FileReader();

				  // Closure to capture the file information.
				  reader.onload = (function(theFile) {
					return function(e) {
					  // Render thumbnail.
					  var span = document.createElement('span');
					  span.innerHTML = ['<img id="result_image" src="', e.target.result,
										'" title="', escape(theFile.name), '" /> <input type="text" id="img_description" name="img_description" placeholder="deskripsi gambar" />'].join('');
					  document.getElementById('list').insertBefore(span, null);
					  
					  var inputImage = document.getElementById("files");
						inputImage.parentNode.removeChild(inputImage);
					};
				  })(f);

				  // Read in the image file as a data URL.
				  reader.readAsDataURL(f);
				}
			  }

			  document.getElementById('files').addEventListener('change', handleFileSelect, false);
			</script>
		</td>
		
		<!--console-->
		<td width='50%'>
			Console<br>
			<div id='console_out'></div>
		</td>
	</tr>
	<tr>
		<td colspan='2'>
			<br/>
			<a class='btn btn-large btn-primary' id="jpeg_encode_button">Compress</a>&nbsp;
			<a class='btn btn-large btn-success' id="jpeg_upload_button">Upload</a>
		</td>
	</tr>
</table>
<div class='holder' id="holder" hidden />
</div>

<?php

    //membaca data dari database
    $result = mysql_query("select * from data_dokumentasi where no_jaringan='$id'");

    //menampilkan foto
    ?>
    <div class="container">
    <table>
        <tr>
            &nbsp
        </tr>
        <tr>
        <?php
        $i = 1;
        while($row = mysql_fetch_array($result)){
        ?>
            <td>
                           <a href="files/dokumentasi/upload/<?php echo $row['nama_file'];?>" >
                <img src="files/dokumentasi/upload/<?php echo $row['nama_file'];?>" alt=""  height="100" border="0"/><br/>
                </a>
                <br/><?php echo $row['deskripsi'];?>
                <br/>
                <a href="files/dokumentasi/delete-gallery.php?id=<?php echo $row['id'];?>" onclick="return confirm('Anda yakin?');">Delete</a>
     <!-- <br/><a href="edit-gallery.php?id=<?php echo $row['id'];?>">Edit</a> -->
            </td>
        <?php
        //jumlah foto dalam satu baris
            if($i % 4 == 0){
                echo '</tr><tr>';
            }
            $i++;
        }
        ?>
        </tr>
    </table>
    </div>