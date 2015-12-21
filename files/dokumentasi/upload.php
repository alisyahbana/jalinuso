<?php

include ('../connect.php');

//upload file
        
  ini_set("display_errors", 0);

  if ($_FILES["file"]["error"] > 0){
    
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
  
  }else{
	  
    $fileName = $_FILES['file']['name'];
    //$currentPage = $_SERVER['REDIRECT_SCRIPT_URI']; //$_SERVER['REQUEST_URI'];
//    $deskripsi = "helloooo";
    echo "Name: " . $fileName . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    echo $currentPage;

    if (file_exists($fileName)){
        unlink('upload/'.$fileName);
    }
    
    if(move_uploaded_file($_FILES["file"]["tmp_name"], 'upload/'.$fileName)){
      echo "View image <a href='files/dokumentasi/upload/" . $fileName ."' target='_blank'>here</a><br />";
      echo "<a href=''>Click</a> to reload page <br>";

      //simpan deskripsi dan nama file ke database
		$saveImage = mysql_query("INSERT INTO data_dokumentasi (nama_file, deskripsi, no_jaringan) VALUES ('$fileName', '$_COOKIE[deskripsi]', '$_COOKIE[nojar]');");
		if(!$saveImage){
			die(mysql_error());
			echo "Foto tidak berhasil di upload! :(";
		}else{
		        echo "Foto berhasil di upload! :)";
			exit;
		}
		
    }else{
      echo "Foto tidak berhasil di upload!";
    }
    
  } //file error
?>